<?php
class AdmissionController
{
    private $admissionModel;

    public function __construct($db)
    {
        $this->admissionModel = new AdmissionModel($db);
    }

    private function generateStudentId()
    {
        return 'STU-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5));
    }

    private function generateStudentPassword()
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789';
        return substr(str_shuffle(str_repeat($chars, 5)), 0, 10);
    }

    public function showAdmissionForm()
    {
        include __DIR__ . '/../views/public/admission.php';
    }

    public function showTransferAdmissionForm()
    {
        include __DIR__ . '/../views/public/admission_transfer.php';
    }

    public function submitAdmission()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admission');
            exit();
        }

        $fullName = trim($_POST['full_name'] ?? '');
        $fatherName = trim($_POST['father_name'] ?? '');
        $aadharNumber = trim($_POST['aadhar_number'] ?? '');

        $admissionType = trim($_POST['admission_type'] ?? 'first_year');
        $registrationNo = trim($_POST['registration_no'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($fullName === '' || $fatherName === '' || $email === '') {
            header('Location: ' . BASE_URL . 'admission&error=missing_fields');
            exit();
        }
        $mobileNo = trim($_POST['mobile_no'] ?? '');
        $courseApplied = trim($_POST['course_applied'] ?? '');

        $uploadDir = __DIR__ . '/../../public/uploads/admissions/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadedFiles = [];
        $fileFields = [
            'photo' => 'photo',
            'sslc_marks_card' => 'sslc_marks_card',
            'puc_marks_card' => 'puc_marks_card',
            'aadhar_card' => 'aadhar_card',
            'candidate_signature' => 'candidate_signature',
            'parent_signature' => 'parent_signature',
        ];

        foreach ($fileFields as $fieldName => $dbField) {
            if (!empty($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] !== UPLOAD_ERR_NO_FILE) {
                $file = $_FILES[$fieldName];
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $fileName = uniqid() . '_' . preg_replace('/[^A-Za-z0-9_.-]+/', '_', basename($file['name']));
                    $filePath = $uploadDir . $fileName;

                    if (move_uploaded_file($file['tmp_name'], $filePath)) {
                        $uploadedFiles[$dbField] = 'uploads/admissions/' . $fileName;
                        error_log("File uploaded successfully: " . $fieldName . " -> " . $fileName);
                    } else {
                        error_log("File upload failed for: " . $fieldName . " (original: " . $file['name'] . ")");
                        header('Location: ' . BASE_URL . 'admission&error=file_upload_failed');
                        exit();
                    }
                } else {
                    header('Location: ' . BASE_URL . 'admission&error=file_upload_error');
                    exit();
                }
            }
        }

        $admissionData = [
            'full_name' => $fullName,
            'father_name' => $fatherName,
            'aadhar_number' => $aadharNumber,
            'admission_type' => $admissionType,
            'registration_no' => $registrationNo,
            'email' => $email,
            'mobile_no' => $mobileNo,
            'course_applied' => $courseApplied,
            'photo' => $uploadedFiles['photo'] ?? '',
            'sslc_marks_card' => $uploadedFiles['sslc_marks_card'] ?? '',
            'puc_marks_card' => $uploadedFiles['puc_marks_card'] ?? '',
            'aadhar_card' => $uploadedFiles['aadhar_card'] ?? '',
            'candidate_signature' => $uploadedFiles['candidate_signature'] ?? '',
            'parent_signature' => $uploadedFiles['parent_signature'] ?? '',
            'puc_institute' => '',
            'last_attended' => '',
            'puc_subjects' => '',
            'payment_method' => 'none',
            'payment_status' => 'pending',
            'status' => 'payment_in_progress',
        ];

        $newAdmission = $this->admissionModel->createAdmission($admissionData);

        if (!$newAdmission) {
            header('Location: ' . BASE_URL . 'admission&error=save_failed');
            exit();
        }

        // Redirect to appropriate payment page based on admission type
        if ($admissionType === 'transfer') {
            header('Location: ' . BASE_URL . 'transfer-admission-payment&uuid=' . urlencode($newAdmission['uuid']));
        } else {
            header('Location: ' . BASE_URL . 'admission-payment&uuid=' . urlencode($newAdmission['uuid']));
        }
        exit();
    }

    public function showPaymentPage()
    {
        $uuid = trim($_GET['uuid'] ?? '');
        $admission = $this->admissionModel->getAdmissionByUuid($uuid);

        if (!$admission) {
            header('Location: ' . BASE_URL . 'admission&error=invalid_reference');
            exit();
        }

        include __DIR__ . '/../views/public/admission_payment.php';
    }

    public function processPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admission');
            exit();
        }

        $uuid = trim($_POST['uuid'] ?? '');
        $paymentMethod = trim($_POST['payment_method'] ?? '');

        $admission = $this->admissionModel->getAdmissionByUuid($uuid);
        if (!$admission) {
            header('Location: ' . BASE_URL . 'admission&error=invalid_reference');
            exit();
        }

        if ($paymentMethod === 'online') {
            $studentId = $admission['student_id'];
            $plainPassword = null;
            $updates = [
                'payment_method' => 'online',
                'payment_status' => 'paid',
                'status' => 'admitted',
                'admin_notes' => 'Online payment completed automatically.',
            ];

            if (empty($studentId) || empty($admission['password'])) {
                $studentId = $this->generateStudentId();
                $plainPassword = $this->generateStudentPassword();
                $updates['student_id'] = $studentId;
                $updates['password'] = password_hash($plainPassword, PASSWORD_BCRYPT);
            }

            $updated = $this->admissionModel->updateAdmissionStatus($admission['id'], $updates);

            if ($updated) {
                if (!empty($admission['email']) && !empty($plainPassword)) {
                    error_log('AdmissionController::processPayment: Sending credentials email to ' . $admission['email']);
                    $mailService = new MailService();
                    $mailResult = $mailService->sendCredentialsEmail(
                        $admission['email'], 
                        $admission['full_name'], 
                        'Student', 
                        $studentId, 
                        $plainPassword
                    );

                    if (!$mailResult['success']) {
                        error_log('AdmissionController::processPayment: Email send failed - ' . ($mailResult['error'] ?? 'Unknown error'));
                        if (strpos(strtolower($mailResult['error']), 'authenticate') !== false) {
                            $_SESSION['payment_warning'] = 'Payment is successful, but email sending failed because SMTP authentication failed. Please verify your Gmail app password and 2FA settings.';
                        } else {
                            $_SESSION['payment_warning'] = 'Payment is successful, but email sending failed. Please contact support.';
                        }
                    } else {
                        error_log('AdmissionController::processPayment: Email sent successfully to ' . $admission['email']);
                        $_SESSION['admission_email_message'] = 'Login credentials have been emailed to you. Use them to access the student portal and continue your admission process.';
                    }

                    $_SESSION['admission_credentials'] = [
                        'student_id' => $studentId,
                        'password' => $plainPassword,
                        'email' => $admission['email'],
                    ];
                } else {
                    error_log('AdmissionController::processPayment: Email or password empty - Email: ' . ($admission['email'] ?? 'EMPTY') . ', Password: ' . ($plainPassword ? 'SET' : 'EMPTY'));
                    $_SESSION['payment_warning'] = 'Payment is successful, but we could not send email because your email address or credentials are not available.';
                }

                if (!isset($_SESSION['admission_email_message'])) {
                    $_SESSION['admission_email_message'] = 'If the email does not arrive, please use the credentials shown on this page to login and complete your admission form.';
                }

                $_SESSION['payment_success'] = 'Payment successful! Your admission form is now activated.';
                header('Location: ' . BASE_URL . 'admission-success&uuid=' . urlencode($uuid));
                exit();
            }
        }

        if ($paymentMethod === 'cash') {
            $updated = $this->admissionModel->updateAdmissionStatus($admission['id'], [
                'payment_method' => 'cash',
                'payment_status' => 'pending',
                'status' => 'cash_request_sent',
                'admin_notes' => 'Cash payment requested, awaiting admin confirmation.',
            ]);

            if ($updated) {
                // Check if this is a student registration
                if (!empty($admission['aadhar_number'])) {
                    $_SESSION['payment_success'] = 'Cash payment request sent. Please log in to continue.';

                    if (!empty($admission['student_id'])) {
                        $_SESSION['student_id'] = $admission['student_id'];
                        header('Location: ' . BASE_URL . 'student-login&student_id=' . urlencode($admission['student_id']));
                    } else {
                        header('Location: ' . BASE_URL . 'student-login');
                    }
                } else {
                    header('Location: ' . BASE_URL . 'admission-pending&uuid=' . urlencode($uuid));
                }
                exit();
            }
        }

        header('Location: ' . BASE_URL . 'admission-payment&uuid=' . urlencode($uuid) . '&error=invalid_payment_method');
        exit();
    }

    public function showTransferPaymentPage()
    {
        $uuid = trim($_GET['uuid'] ?? '');
        $admission = $this->admissionModel->getAdmissionByUuid($uuid);

        if (!$admission) {
            header('Location: ' . BASE_URL . 'admission-transfer&error=invalid_reference');
            exit();
        }

        include __DIR__ . '/../views/public/admission_transfer_payment.php';
    }

    public function processTransferPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admission-transfer');
            exit();
        }

        $uuid = trim($_POST['uuid'] ?? '');
        $paymentMethod = trim($_POST['payment_method'] ?? '');

        $admission = $this->admissionModel->getAdmissionByUuid($uuid);
        if (!$admission) {
            header('Location: ' . BASE_URL . 'admission-transfer&error=invalid_reference');
            exit();
        }

        if ($paymentMethod === 'online') {
            $studentId = $admission['student_id'];
            $plainPassword = null;
            $updates = [
                'payment_method' => 'online',
                'payment_status' => 'paid',
                'status' => 'admitted',
                'admin_notes' => 'Online payment completed automatically.',
            ];

            if (empty($studentId) || empty($admission['password'])) {
                $studentId = $this->generateStudentId();
                $plainPassword = $this->generateStudentPassword();
                $updates['student_id'] = $studentId;
                $updates['password'] = password_hash($plainPassword, PASSWORD_BCRYPT);
            }

            $updated = $this->admissionModel->updateAdmissionStatus($admission['id'], $updates);

            if ($updated) {
                if (!empty($admission['email']) && !empty($plainPassword)) {
                    error_log('AdmissionController::processTransferPayment: Sending credentials email to ' . $admission['email']);
                    $mailService = new MailService();
                    $mailResult = $mailService->sendCredentialsEmail(
                        $admission['email'], 
                        $admission['full_name'], 
                        'Student', 
                        $studentId, 
                        $plainPassword
                    );

                    if (!$mailResult['success']) {
                        error_log('AdmissionController::processTransferPayment: Email send failed - ' . ($mailResult['error'] ?? 'Unknown error'));
                        if (strpos(strtolower($mailResult['error']), 'authenticate') !== false) {
                            $_SESSION['payment_warning'] = 'Payment is successful, but email sending failed because SMTP authentication failed. Please verify your Gmail app password and 2FA settings.';
                        } else {
                            $_SESSION['payment_warning'] = 'Payment is successful, but email sending failed. Please contact support.';
                        }
                    } else {
                        error_log('AdmissionController::processTransferPayment: Email sent successfully to ' . $admission['email']);
                        $_SESSION['admission_email_message'] = 'Login credentials have been emailed to you. Use them to access the student portal and continue your admission process.';
                    }

                    $_SESSION['admission_credentials'] = [
                        'student_id' => $studentId,
                        'password' => $plainPassword,
                        'email' => $admission['email'],
                    ];
                } else {
                    error_log('AdmissionController::processTransferPayment: Email or password empty - Email: ' . ($admission['email'] ?? 'EMPTY') . ', Password: ' . ($plainPassword ? 'SET' : 'EMPTY'));
                    $_SESSION['payment_warning'] = 'Payment is successful, but we could not send email because your email address or credentials are not available.';
                }

                if (!isset($_SESSION['admission_email_message'])) {
                    $_SESSION['admission_email_message'] = 'If the email does not arrive, please use the credentials shown on this page to login and complete your admission form.';
                }

                $_SESSION['payment_success'] = 'Payment successful! Your admission form is now activated.';
                header('Location: ' . BASE_URL . 'admission-success&uuid=' . urlencode($uuid));
                exit();
            }
        }

        if ($paymentMethod === 'cash') {
            $updated = $this->admissionModel->updateAdmissionStatus($admission['id'], [
                'payment_method' => 'cash',
                'payment_status' => 'pending',
                'status' => 'cash_request_sent',
                'admin_notes' => 'Cash payment requested, awaiting admin confirmation.',
            ]);

            if ($updated) {
                header('Location: ' . BASE_URL . 'admission-pending&uuid=' . urlencode($uuid));
                exit();
            }
        }

        header('Location: ' . BASE_URL . 'transfer-admission-payment&uuid=' . urlencode($uuid) . '&error=invalid_payment_method');
        exit();
    }

    public function showAdmissionSuccess()
    {
        $uuid = trim($_GET['uuid'] ?? '');
        $admission = $this->admissionModel->getAdmissionByUuid($uuid);

        if (!$admission || $admission['status'] !== 'admitted') {
            header('Location: ' . BASE_URL . 'admission&error=invalid_reference');
            exit();
        }

        // Check if this is a cash payment approval redirect
        $showCashApprovalNotice = false;
        if ($admission['payment_method'] === 'cash' && $admission['payment_status'] === 'paid') {
            $showCashApprovalNotice = true;
        }

        if (isset($admission['admission_type']) && $admission['admission_type'] === 'transfer') {
            include __DIR__ . '/../views/public/admission_transfer_form.php';
        } else {
            include __DIR__ . '/../views/public/admission_form_updated.php';
        }
    }

    public function showAdmissionPending()
    {
        $uuid = trim($_GET['uuid'] ?? '');
        $admission = $this->admissionModel->getAdmissionByUuid($uuid);

        if (!$admission || $admission['status'] !== 'cash_request_sent') {
            header('Location: ' . BASE_URL . 'admission&error=invalid_reference');
            exit();
        }

        include __DIR__ . '/../views/public/admission_pending.php';
    }

    public function adminAdmissions()
    {
        return $this->admissionModel->getAdmissions();
    }

    public function approveCashAdmission()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin-admissions');
            exit();
        }

        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            header('Location: ' . BASE_URL . 'admin-admissions&msg=invalid_request');
            exit();
        }

        $admission = $this->admissionModel->getAdmissionById($id);
        if (!$admission) {
            header('Location: ' . BASE_URL . 'admin-admissions&msg=approval_failed');
            exit();
        }

        $approved = $this->admissionModel->approveCashAdmission($id);
        if ($approved) {
            // Send email notification to student
            if (!empty($admission['email'])) {
                $mailService = new MailService();
                $successUrl = BASE_URL . 'admission-success&uuid=' . urlencode($admission['uuid']);
                // Convert relative URL to absolute if needed
                if (strpos($successUrl, 'http') === false) {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
                    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
                    $successUrl = $protocol . '://' . $host . '/college/public/index.php?url=admission-success&uuid=' . urlencode($admission['uuid']);
                }
                
                $mailService->sendCashApprovalEmail(
                    $admission['email'],
                    $admission['full_name'],
                    $admission['admission_number'],
                    $successUrl
                );
            }

            header('Location: ' . BASE_URL . 'admin-admissions&msg=cash_approved');
            exit();
        }

        header('Location: ' . BASE_URL . 'admin-admissions&msg=approval_failed');
        exit();
    }

    public function handleAdmissionDecision()
    {
        // Only accept JSON POST requests
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SERVER['CONTENT_TYPE']) || strpos($_SERVER['CONTENT_TYPE'], 'application/json') === false) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit();
        }

        $input = json_decode(file_get_contents('php://input'), true);
        
        $admissionId = (int)($input['admission_id'] ?? 0);
        $decision = trim($input['decision'] ?? '');
        $notes = trim($input['notes'] ?? '');
        $paymentStart = trim($input['payment_start'] ?? '');
        $paymentEnd = trim($input['payment_end'] ?? '');

        if ($admissionId <= 0 || !in_array($decision, ['approved', 'rejected'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
            exit();
        }

        $admission = $this->admissionModel->getAdmissionById($admissionId);
        if (!$admission) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Admission record not found']);
            exit();
        }

        $paymentSchedule = null;
        if ($paymentStart !== '' || $paymentEnd !== '') {
            $paymentSchedule = trim($paymentStart) . ' to ' . trim($paymentEnd);
        }

        // Update admission status
        $adminId = isset($_SESSION['admin_id']) ? (int)$_SESSION['admin_id'] : null;
        $updated = $this->admissionModel->updateAdmissionApprovalStatus(
            $admissionId,
            $decision,
            $notes,
            $adminId,
            $paymentSchedule
        );

        if (!$updated) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to update admission']);
            exit();
        }

        // Send email to student
        $this->sendAdmissionDecisionEmail($admission, $decision, $notes, $paymentSchedule);

        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => $decision === 'approved' 
                ? 'Admission approved! Email sent to student.' 
                : 'Admission rejected! Email sent to student.'
        ]);
        exit();
    }

    private function sendAdmissionDecisionEmail($admission, $decision, $notes, $paymentSchedule = null)
    {
        if (empty($admission['email'])) {
            return false;
        }

        $mailService = new MailService();
        
        if ($decision === 'approved') {
            $subject = 'Admission Approved - Next Steps for Fee Payment';
            $body = $this->getApprovalEmailTemplate($admission, $notes, $paymentSchedule);
        } else {
            $subject = 'Admission Application - Action Required';
            $body = $this->getRejectionEmailTemplate($admission, $notes);
        }

        return $mailService->sendEmail(
            $admission['email'],
            $subject,
            $body,
            'html'
        );
    }

    private function getApprovalEmailTemplate($admission, $notes, $paymentSchedule = null)
    {
        $collegeName = 'Nehru BBA & BCA College';
        $studentName = htmlspecialchars($admission['full_name']);
        $studentId = htmlspecialchars($admission['student_id'] ?? 'N/A');
        $feeAmount = '6,000 to 10,000';
        $portalUrl = BASE_URL . 'student-login';

        $scheduleBlock = '';
        if (!empty($paymentSchedule)) {
            $scheduleBlock = "<div class=\"info-box\"><div class=\"info-label\">Payment Window</div><div class=\"info-value\">{$paymentSchedule}</div></div>";
        }

        $adminNotesHtml = '';
        if (!empty(trim($notes))) {
            $adminNotesHtml = '<div class="admin-notes"><strong>Admin Notes:</strong><br>' . nl2br(htmlspecialchars($notes)) . '</div>';
        }

        return <<<EOT
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <style>
                body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; background: #eef2ff; margin: 0; padding: 0; }
                .container { max-width: 640px; margin: 0 auto; background: #ffffff; padding: 28px; border-radius: 22px; box-shadow: 0 26px 80px rgba(15, 23, 42, 0.12); }
                .header { background: linear-gradient(135deg, #0f172a 0%, #2563eb 100%); color: white; padding: 28px; border-radius: 18px 18px 0 0; text-align: center; }
                .header h1 { margin: 0; font-size: 28px; }
                .content { background: #f8fafc; padding: 30px; border-radius: 0 0 18px 18px; }
                .success-badge { background: #dcfce7; border-left: 4px solid #22c55e; color: #14532d; padding: 16px 18px; border-radius: 14px; margin-bottom: 24px; font-weight: 700; }
                .info-box { background: #eff6ff; border-left: 4px solid #2563eb; padding: 18px; margin-bottom: 20px; border-radius: 14px; }
                .info-label { font-size: 12px; color: #475569; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 8px; }
                .info-value { font-size: 18px; color: #0f172a; font-weight: 700; }
                .fee-section { background: #fffbeb; border-left: 4px solid #f59e0b; padding: 18px; margin-bottom: 24px; border-radius: 14px; }
                .fee-amount { font-size: 24px; font-weight: 800; color: #c2410c; margin: 0; }
                .button { display: inline-block; background: linear-gradient(135deg, #2563eb 0%, #0ea5e9 100%); color: white; text-decoration: none; padding: 14px 32px; border-radius: 999px; font-weight: 700; margin-top: 20px; }
                .footer { text-align: center; color: #64748b; font-size: 13px; margin-top: 28px; line-height: 1.7; }
                .admin-notes { background: #f1f5f9; padding: 16px; border-radius: 12px; font-size: 14px; color: #1e293b; }
                ol { margin: 0 0 0 18px; padding: 0; }
                li { margin-bottom: 12px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Admission Approved!</h1>
                    <p style="margin: 12px 0 0 0; font-size: 15px; opacity: 0.85;">Your admission is now approved. Complete fee payment to confirm your seat.</p>
                </div>
                <div class="content">
                    <div class="success-badge">✅ Your application has been approved by the admissions team.</div>

                    <h2 style="color: #0f172a; margin-top: 0;">Hello $studentName,</h2>
                    <p style="color: #475569;">Congratulations! Your admission application to $collegeName has been approved. Please follow the payment instructions below to secure your enrollment.</p>

                    <div class="info-box">
                        <div class="info-label">Student ID</div>
                        <div class="info-value">$studentId</div>
                    </div>

                    {$scheduleBlock}

                    <div class="fee-section">
                        <p style="margin: 0 0 10px 0; font-size: 14px; color: #475569;"><strong>College Fees Due</strong></p>
                        <p class="fee-amount">₹ $feeAmount</p>
                        <p style="margin: 10px 0 0 0; color: #7c3aed;">Pay your fees between the selected window to avoid seat cancellation.</p>
                    </div>

                    <h3 style="color: #0f172a; margin-bottom: 12px;">What to do next</h3>
                    <ol style="color: #475569;">
                        <li>Login to the student portal using your credentials.</li>
                        <li>Open the Fees section and choose your payment mode.</li>
                        <li>Complete payment securely online or in person as instructed.</li>
                        <li>Save your payment confirmation for future reference.</li>
                    </ol>

                    <p style="text-align: center;">
                        <a href="{$portalUrl}" class="button">Go to Student Portal</a>
                    </p>

                    {$adminNotesHtml}

                    <div class="footer">
                        <p><strong>$collegeName</strong><br>Ghantikeri, HUBLI – 580 020</p>
                        <p>This is an automated message. Do not reply to this email directly.</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        EOT;
    }

    private function getRejectionEmailTemplate($admission, $notes)
    {
        $collegeName = 'Nehru BBA & BCA College';
        $studentName = htmlspecialchars($admission['full_name']);
        $portalUrl = BASE_URL . 'student-login';
        $adminNotesHtml = '<div class="admin-notes">' . nl2br(htmlspecialchars($notes)) . '</div>';

        return <<<EOT
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <style>
                body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; background: #f8fafc; margin: 0; padding: 0; }
                .container { max-width: 640px; margin: 0 auto; background: #ffffff; padding: 28px; border-radius: 22px; box-shadow: 0 26px 80px rgba(15, 23, 42, 0.12); }
                .header { background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%); color: white; padding: 28px; border-radius: 18px 18px 0 0; text-align: center; }
                .header h1 { margin: 0; font-size: 28px; }
                .content { background: #ffffff; padding: 30px; border-radius: 0 0 18px 18px; }
                .warning-badge { background: #fef3c7; border-left: 4px solid #f59e0b; color: #92400e; padding: 16px 18px; border-radius: 14px; margin-bottom: 24px; }
                .info-box { background: #fee2e2; border-left: 4px solid #ef4444; padding: 18px; margin-bottom: 20px; border-radius: 14px; }
                .admin-notes { background: #f3f4f6; padding: 14px; border-radius: 12px; font-size: 14px; color: #374151; margin-top: 12px; }
                .button { display: inline-block; background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%); color: white; padding: 14px 30px; text-decoration: none; border-radius: 999px; margin-top: 18px; }
                .footer { text-align: center; color: #64748b; font-size: 13px; margin-top: 28px; line-height: 1.7; }
                ol { margin: 0 0 0 18px; padding: 0; }
                li { margin-bottom: 12px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <i style="font-size: 32px;">ℹ</i>
                    <h1>Application Review</h1>
                    <p style="margin: 12px 0 0 0; font-size: 15px; opacity: 0.85;">Your application requires some updates before we can move forward.</p>
                </div>
                <div class="content">
                    <div class="warning-badge">
                        <strong>Your application requires corrections.</strong> Please review the feedback below and resubmit your application with the necessary updates.
                    </div>

                    <h2 style="color: #0b1b35; margin-top: 0;">Dear $studentName,</h2>
                    <p style="color: #475569;">Thank you for submitting your admission application to $collegeName. We have reviewed your application and require you to make some corrections before we can proceed.</p>

                    <div class="info-box">
                        <h3 style="margin-top: 0; color: #991b1b;">Items to Correct:</h3>
                        {$adminNotesHtml}
                    </div>

                    <h3 style="color: #0b1b35;">What to Do Next:</h3>
                    <ol style="color: #556f91;">
                        <li>Review the corrections listed above carefully</li>
                        <li>Update your information and upload corrected documents</li>
                        <li>Log in to your student portal and resubmit your application</li>
                        <li>We will review your updated application within 2-3 business days</li>
                    </ol>

                    <p style="margin-top: 20px; text-align: center;">
                        <a href="{$portalUrl}" class="button">Go to Student Portal</a>
                    </p>

                    <h3 style="color: #0b1b35;">Need Help?</h3>
                    <p style="color: #556f91;">If you have any questions or need assistance with the corrections, please contact our admissions office:</p>
                    <ul style="color: #556f91;">
                        <li>Email: admissions@college.edu</li>
                        <li>Phone: +91-836-2XX-XXXX</li>
                        <li>Office Hours: Monday - Friday, 9:00 AM - 5:00 PM</li>
                    </ul>

                    <div class="footer">
                        <p><strong>$collegeName</strong><br>
                        Ghantikeri, HUBLI – 580 020<br>
                        Email: admissions@college.edu<br>
                        Phone: +91-836-2XX-XXXX</p>
                        <p>This is an automated email. Please do not reply to this email.</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        EOT;
    }

    public function submitFullAdmission()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admission');
            exit();
        }

        // Create uploads directory if it doesn't exist
        $uploadDir = __DIR__ . '/../../public/uploads/admissions/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadedFiles = [];

        // Handle file uploads
        $fileFields = [
            'photo' => 'photo',
            'sslc_marks_card' => 'sslc_marks_card',
            'puc_marks_card' => 'puc_marks_card',
            'aadhar_card' => 'aadhar_card',
            'candidate_signature' => 'candidate_signature',
            'parent_signature' => 'parent_signature'
        ];

        foreach ($fileFields as $fieldName => $dbField) {
            if (isset($_FILES[$fieldName])) {
                $file = $_FILES[$fieldName];
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $fileName = uniqid() . '_' . basename($file['name']);
                    $filePath = $uploadDir . $fileName;

                    error_log('AdmissionController::submitFullAdmission - Uploading field ' . $fieldName . ' file ' . $file['name']);

                    if (move_uploaded_file($file['tmp_name'], $filePath)) {
                        $uploadedFiles[$dbField] = 'uploads/admissions/' . $fileName;
                        error_log('AdmissionController::submitFullAdmission - Uploaded to ' . $filePath);
                    } else {
                        error_log('AdmissionController::submitFullAdmission - move_uploaded_file failed for ' . $file['name'] . ' tmp ' . $file['tmp_name']);
                        header('Location: ' . BASE_URL . 'admission-success&error=file_upload_failed');
                        exit();
                    }
                } elseif ($file['error'] !== UPLOAD_ERR_NO_FILE) {
                    error_log('AdmissionController::submitFullAdmission - Upload error for ' . $fieldName . ': ' . $file['error']);
                    header('Location: ' . BASE_URL . 'admission-success&error=file_upload_error');
                    exit();
                }
            }
        }

        // Collect form data
        $admissionData = [
            'application_no' => trim($_POST['application_no'] ?? ''),
            'registration_no' => trim($_POST['registration_no'] ?? ''),
            'candidate_name' => trim($_POST['candidate_name'] ?? ''),
            'father_name' => trim($_POST['father_name'] ?? ''),
            'mother_name' => trim($_POST['mother_name'] ?? ''),
            'surname' => trim($_POST['surname'] ?? ''),
            'gender' => trim($_POST['gender'] ?? ''),
            'date_of_birth' => trim($_POST['date_of_birth'] ?? ''),
            'aadhar_no' => trim($_POST['aadhar_no'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'category_cert_no' => trim($_POST['category_cert_no'] ?? ''),
            'annual_income' => trim($_POST['annual_income'] ?? ''),
            'income_caste_certificate_no' => trim($_POST['income_caste_certificate_no'] ?? ''),
            'sslc_reg_no' => trim($_POST['sslc_reg_no'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'permanent_address' => trim($_POST['permanent_address'] ?? ''),
            'city' => trim($_POST['city'] ?? ''),
            'state' => trim($_POST['state'] ?? ''),
            'postal_code' => trim($_POST['postal_code'] ?? ''),
            'district' => trim($_POST['district'] ?? ''),
            'taluk' => trim($_POST['taluk'] ?? ''),
            'area_type' => trim($_POST['area_type'] ?? ''),
            'ward_no' => trim($_POST['ward_no'] ?? ''),
            'mobile_no' => trim($_POST['mobile_no'] ?? ''),
            'parent_mobile_no' => trim($_POST['parent_mobile_no'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'overall_percentage' => trim($_POST['overall_percentage'] ?? ''),
            'course_applied' => trim($_POST['course_applied'] ?? ''),
            'last_attended_institution' => trim($_POST['last_attended_institution'] ?? ''),
            'year_of_admission' => trim($_POST['year_of_admission'] ?? ''),
            'year_of_passing' => trim($_POST['year_of_passing'] ?? ''),
            'declaration_1' => isset($_POST['declaration_1']) ? 1 : 0,
            'declaration_2' => isset($_POST['declaration_2']) ? 1 : 0,
            'declaration_3' => isset($_POST['declaration_3']) ? 1 : 0,
        ];

        // Add uploaded file paths to admission data
        foreach ($uploadedFiles as $field => $path) {
            $admissionData[$field] = $path;
            error_log('AdmissionController::submitFullAdmission - Added file path for ' . $field . ': ' . $path);
        }

        // Handle marks data
        for ($i = 1; $i <= 8; $i++) {
            $admissionData["marks_subject_$i"] = trim($_POST["marks_subject_$i"] ?? '');
            $admissionData["marks_max_$i"] = trim($_POST["marks_max_$i"] ?? '');
            $admissionData["marks_obtained_$i"] = trim($_POST["marks_obtained_$i"] ?? '');
        }

        $admissionData['total_marks_obtained'] = trim($_POST['total_marks_obtained'] ?? '');
        $admissionData['table_percentage'] = trim($_POST['table_percentage'] ?? '');

        // Handle semester subjects
        for ($i = 1; $i <= 10; $i++) {
            $admissionData["semester_subject_code_$i"] = trim($_POST["semester_subject_code_$i"] ?? '');
            $admissionData["semester_subject_title_$i"] = trim($_POST["semester_subject_title_$i"] ?? '');
        }

        // Save to database
        $result = $this->admissionModel->updateAdmissionWithFullDetails($admissionData);

        if ($result) {
            // Get the admission ID from the aadhar number to redirect to review
            $admission = $this->admissionModel->getAdmissionByAadhar($admissionData['aadhar_no']);
            if ($admission) {
                header('Location: ' . BASE_URL . 'admin-admission-review&id=' . urlencode($admission['id']));
            } else {
                header('Location: ' . BASE_URL . 'admin-admissions&msg=application_submitted');
            }
            exit();
        } else {
            header('Location: ' . BASE_URL . 'admission-success&error=save_failed');
            exit();
        }
    }
}
