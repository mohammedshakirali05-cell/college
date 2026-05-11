<?php
require_once __DIR__ . '/../helpers/ChallanHelper.php';
require_once __DIR__ . '/../services/InstallmentsManager.php';

class FeesController
{
    private $feesModel;
    private $admissionModel;
    private $db;

    public function __construct($db)
    {
        $this->feesModel = new FeesModel($db);
        $this->admissionModel = new AdmissionModel($db);
        $this->db = $db;
        
        // Ensure tracking table exists
        $installmentsManager = new InstallmentsManager($db);
        $installmentsManager->ensureTrackingTableExists();
    }

    public function listFees()
    {
        $pendingAdmissions = $this->feesModel->getAdmittedAdmissionsWithoutFees();
        $fees = $this->feesModel->getAllFees();
        include __DIR__ . '/../views/admin/fees.php';
    }

   public function showCreateFeesForm()
{
    $admissionId = (int)($_GET['id'] ?? 0);

    if ($admissionId <= 0) {
        header('Location: ' . BASE_URL . 'admin-fees&msg=invalid_admission');
        exit();
    }

    $admission = $this->admissionModel->getAdmissionById($admissionId);

    if (!$admission || $admission['status'] !== 'admitted') {
        header('Location: ' . BASE_URL . 'admin-fees&msg=not_admitted');
        exit();
    }

    $existingFee = $this->feesModel->getFeesByAdmissionId($admissionId);
    $installments = [];

    if ($existingFee) {
        $installments = $this->feesModel->getInstallmentsByFeeId($existingFee['id']);
    }

    include __DIR__ . '/../views/admin/fee_form.php';
}

    public function submitFees()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . 'admin-fees');
        exit();
    }

    $admissionId = (int)($_POST['admission_id'] ?? 0);

    if ($admissionId <= 0) {
        header('Location: ' . BASE_URL . 'admin-fees&msg=invalid_submission');
        exit();
    }

    $admission = $this->admissionModel->getAdmissionById($admissionId);

    if (!$admission || $admission['status'] !== 'admitted') {
        header('Location: ' . BASE_URL . 'admin-fees&msg=invalid_admission');
        exit();
    }

    $existingFee = $this->feesModel->getFeesByAdmissionId($admissionId);

    if (!$existingFee) {
        $collegeTotalFees = (float)($_POST['college_total_fees'] ?? 0);
        $hasConcession = $_POST['has_concession'] ?? 'no';
        $concessionMemberName = trim($_POST['concession_member_name'] ?? '');
        $concessionDate = trim($_POST['concession_date'] ?? '');
        $concessionFees = (float)($_POST['concession_fees'] ?? 0);
        $finalizedFees = (float)($_POST['finalized_fees'] ?? 0);

        if ($hasConcession !== 'yes') {
            $concessionFees = 0;
            $concessionMemberName = null;
            $concessionDate = null;
        }

        if ($concessionFees > $collegeTotalFees) {
            header('Location: ' . BASE_URL . 'admin-fees-create&id=' . $admissionId . '&msg=invalid_concession');
            exit();
        }

        $challanNo = trim($_POST['challan_no'] ?? '');

        if (!$challanNo) {
            $challanNo = ChallanHelper::generateChallanNumber($this->db);
        }

        $feeId = $this->feesModel->createFeesForAdmission($admissionId, [
            'challan_no' => $challanNo,
            'student_name' => trim($_POST['student_name'] ?? $admission['full_name']),
            'student_id' => trim($_POST['student_id'] ?? $admission['admission_number']),
            'course' => trim($_POST['course'] ?? ''),
            'academic_year' => trim($_POST['academic_year'] ?? ''),
            'college_total_fees' => $collegeTotalFees,
            'has_concession' => $hasConcession,
            'concession_member_name' => $concessionMemberName,
            'concession_date' => $concessionDate,
            'concession_fees' => $concessionFees,
            'finalized_fees' => $finalizedFees,
        ]);
    } else {
        $feeId = $existingFee['id'];
    }

    $amount = (float)($_POST['new_installment_amount'] ?? 0);
    $paidDate = trim($_POST['new_installment_date'] ?? '');

    if ($amount > 0) {
        if (!$paidDate) {
            $paidDate = date('Y-m-d');
        }

        $fee = $this->feesModel->getFeesByAdmissionId($admissionId);
        $balance = (float)$fee['balance_fees'];

        if ($amount > $balance) {
            header('Location: ' . BASE_URL . 'admin-fees-create&id=' . $admissionId . '&msg=invalid_installments');
            exit();
        }

        $this->feesModel->addInstallment($feeId, $amount, $paidDate);
    }

    header('Location: ' . BASE_URL . 'view-challan&challan=' . urlencode($challanNo) . '&msg=fees_saved');
    exit();
}

    /**
     * Display challan for viewing and printing
     */
    public function viewChallan()
    {
        $challanNo = trim($_GET['challan'] ?? '');
        $feeId = (int)($_GET['fee_id'] ?? 0);
        $installmentNumber = (int)($_GET['installment'] ?? 0);

        if (!$challanNo && !$feeId) {
            if (isset($_SESSION['user_id'])) {
                header('Location: ' . BASE_URL . 'dashboard');
            } else {
                header('Location: ' . BASE_URL . 'home');
            }
            exit();
        }

        // Fetch fee record
        $fee = null;
        if ($feeId) {
            $query = "SELECT f.*, a.full_name, a.admission_number, a.course_applied
                      FROM fees_master f
                      LEFT JOIN admissions a ON a.id = f.admission_id
                      WHERE f.id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $feeId, PDO::PARAM_INT);
            $stmt->execute();
            $fee = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $query = "SELECT f.*, a.full_name, a.admission_number, a.course_applied
                      FROM fees_master f
                      LEFT JOIN admissions a ON a.id = f.admission_id
                      WHERE f.challan_no = :challan_no LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':challan_no', $challanNo);
            $stmt->execute();
            $fee = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if (!$fee) {
            header('Location: ' . BASE_URL . 'home&msg=challan_not_found');
            exit();
        }

        // Determine amount to display
        $displayAmount = (float)$fee['finalized_fees'];
        $installmentLabel = '';

        if ($installmentNumber > 0) {
            $installmentKey = "installment_$installmentNumber";
            if (isset($fee[$installmentKey]) && $fee[$installmentKey] > 0) {
                $displayAmount = (float)$fee[$installmentKey];
                $installmentLabel = "Installment $installmentNumber";
            }
        }

        // Prepare challan data using FEE FORM data, not admissions data
        $challanData = [
            'challan_no' => $fee['challan_no'],
            'student_name' => $fee['student_name'] ?? $fee['full_name'],
            'admission_number' => $fee['admission_number'] ?? $fee['student_id'],
            'program' => $fee['course'] ?? $fee['course_applied'] ?? 'BBA/BCA',
            'class' => $fee['course'] ?? $fee['course_applied'] ?? 'BBA/BCA',
            'academic_year' => $fee['academic_year'] ?? date('Y') . '-' . (date('Y') + 1),
            'amount_figures' => $displayAmount,
            'amount_words' => ChallanHelper::numberToWords($displayAmount),
            'date' => date('d-m-Y', strtotime($fee['created_at'] ?? 'now')),
            'installment_label' => $installmentLabel,
        ];

        include __DIR__ . '/../views/public/challan.php';
    }

    /**
     * Display admin dashboard for managing installments
     */
    public function manageInstallments()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_URL . 'login&msg=unauthorized');
            exit();
        }

        $feeId = (int)($_GET['fee_id'] ?? 0);
        if (!$feeId) {
            header('Location: ' . BASE_URL . 'admin-fees&msg=invalid_fee');
            exit();
        }

        $query = "SELECT f.*, 
                     (SELECT COUNT(*) FROM installment_payments WHERE fee_id = f.id) as total_installments,
                     (SELECT SUM(CASE WHEN status = 'paid' THEN 1 ELSE 0 END) FROM installment_payments WHERE fee_id = f.id) as paid_count
              FROM fees_master f
              WHERE f.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $feeId, PDO::PARAM_INT);
        $stmt->execute();
        $fee = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$fee) {
            header('Location: ' . BASE_URL . 'admin-fees&msg=fee_not_found');
            exit();
        }

        $query = "SELECT * FROM installment_payments 
              WHERE fee_id = :fee_id
              ORDER BY installment_number ASC";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
        $stmt->execute();
        $installments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/admin/installments_management.php';
    }

    /**
     * Mark installment as paid (offline payment)
     */
    public function markInstallmentAsPaid()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_URL . 'login&msg=unauthorized');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin-fees');
            exit();
        }

        $installmentId = (int)($_POST['installment_id'] ?? 0);
        if (!$installmentId) {
            header('Location: ' . BASE_URL . 'admin-fees&msg=invalid_installment');
            exit();
        }

        $query = "SELECT * FROM installment_payments WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $installmentId, PDO::PARAM_INT);
        $stmt->execute();
        $installment = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$installment) {
            header('Location: ' . BASE_URL . 'admin-fees&msg=installment_not_found');
            exit();
        }

        $updateQuery = "UPDATE installment_payments 
                    SET status = 'paid',
                        payment_date = NOW(),
                        payment_method = 'manual_admin',
                        transaction_id = CONCAT('ADMIN_', DATE_FORMAT(NOW(), '%Y%m%d%H%i%s')),
                        updated_at = NOW()
                    WHERE id = :id";

        $updateStmt = $this->db->prepare($updateQuery);
        $updateStmt->bindParam(':id', $installmentId, PDO::PARAM_INT);

        if ($updateStmt->execute()) {
            $this->recalculateFeeTotals($installment['fee_id']);
            header('Location: ' . BASE_URL . 'admin-manage-installments&fee_id=' . $installment['fee_id'] . '&msg=marked_paid');
            exit();
        }

        header('Location: ' . BASE_URL . 'admin-manage-installments&fee_id=' . $installment['fee_id'] . '&msg=error');
        exit();
    }

    /**
     * Recalculate fee totals after payment
     */
    private function recalculateFeeTotals($feeId)
    {
        $query = "UPDATE fees_master 
              SET total_paid = (
                  SELECT COALESCE(SUM(installment_amount), 0)
                  FROM installment_payments
                  WHERE fee_id = :fee_id AND status = 'paid'
              ),
              balance_fees = finalized_fees - (
                  SELECT COALESCE(SUM(installment_amount), 0)
                  FROM installment_payments
                  WHERE fee_id = :fee_id AND status = 'paid'
              ),
              updated_at = NOW()
              WHERE id = :fee_id";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':fee_id' => $feeId]);
    }

    /**
     * Get installment breakdown for a fee as JSON API
     */
    public function getInstallmentsAPI()
    {
        if (!isset($_GET['fee_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'fee_id required']);
            exit();
        }

        require_once __DIR__ . '/../services/InstallmentsManager.php';
        $installmentsManager = new InstallmentsManager($this->db);
        $installmentsManager->ensureTrackingTableExists();

        $feeId = (int)$_GET['fee_id'];
        $breakdown = $installmentsManager->getInstallmentBreakdown($feeId);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $breakdown]);
        exit();
    }

    /**
     * Record installment payment (AJAX)
     */
    public function recordInstallmentPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'POST request required']);
            exit();
        }

        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($input['fee_id']) || !isset($input['installment_number'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Missing required fields']);
            exit();
        }

        require_once __DIR__ . '/../services/InstallmentsManager.php';
        $installmentsManager = new InstallmentsManager($this->db);

        try {
            $paymentData = [
                'paid_date' => $input['paid_date'] ?? date('Y-m-d'),
                'payment_method' => $input['payment_method'] ?? 'offline',
                'transaction_id' => $input['transaction_id'] ?? ''
            ];

            $installmentsManager->recordInstallmentPayment(
                (int)$input['fee_id'],
                (int)$input['installment_number'],
                $paymentData
            );

            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Installment payment recorded successfully'
            ]);
            exit();

        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            exit();
        }
    }
}
