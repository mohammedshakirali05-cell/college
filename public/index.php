<?php
session_start();

define('BASE_URL', '/college/public/index.php?url=');

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../app/models/UserModel.php';
require_once __DIR__ . '/../app/services/MailService.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/StudentAuthController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/ProfileController.php';
require_once __DIR__ . '/../app/models/AdmissionModel.php';
require_once __DIR__ . '/../app/controllers/AdmissionController.php';
require_once __DIR__ . '/../app/models/FeesModel.php';
require_once __DIR__ . '/../app/controllers/FeesController.php';
require_once __DIR__ . '/../app/models/StudentPerformanceModel.php';
require_once __DIR__ . '/../app/controllers/StudentPerformanceController.php';
require_once __DIR__ . '/../app/controllers/ReportController.php';

$database = new Database();
$db = $database->getConnection();

function redirectTo($route) {
    header('Location: ' . BASE_URL . $route);
    exit();
}

$url = $_GET['url'] ?? 'home';

switch ($url) {
    case 'home':
        include __DIR__ . '/../app/views/public/home.php';
        break;

    case 'admission':
        $admissionController = new AdmissionController($db);
        $admissionController->showAdmissionForm();
        break;

    case 'admission-transfer':
        $admissionController = new AdmissionController($db);
        $admissionController->showTransferAdmissionForm();
        break;

    case 'admission-process':
        $admissionController = new AdmissionController($db);
        $admissionController->submitAdmission();
        break;

    case 'admission-payment':
        $admissionController = new AdmissionController($db);
        $admissionController->showPaymentPage();
        break;

    case 'admission-payment-process':
        $admissionController = new AdmissionController($db);
        $admissionController->processPayment();
        break;

    case 'admission-submit':
        $admissionController = new AdmissionController($db);
        $admissionController->submitFullAdmission();
        break;

    case 'admission-success':
        $admissionController = new AdmissionController($db);
        $admissionController->showAdmissionSuccess();
        break;

    case 'admission-pending':
        $admissionController = new AdmissionController($db);
        $admissionController->showAdmissionPending();
        break;

    case 'transfer-admission-payment':
        $admissionController = new AdmissionController($db);
        $admissionController->showTransferPaymentPage();
        break;

    case 'transfer-admission-payment-process':
        $admissionController = new AdmissionController($db);
        $admissionController->processTransferPayment();
        break;

    case 'api-check-admission-status':
        // API endpoint to check admission status
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents('php://input'), true);
        $uuid = $input['uuid'] ?? null;

        if (!$uuid) {
            echo json_encode(['success' => false, 'error' => 'Invalid UUID']);
            exit();
        }

        $admissionModel = new AdmissionModel($db);
        $admission = $admissionModel->getAdmissionByUuid($uuid);

        if (!$admission) {
            echo json_encode(['success' => false, 'error' => 'Admission not found']);
            exit();
        }

        echo json_encode([
            'success' => true,
            'status' => $admission['status'],
            'payment_status' => $admission['payment_status'],
            'message' => $admission['status'] === 'admitted' ? 'Your admission has been approved!' : 'Still pending...'
        ]);
        exit();

    case 'login':
        $userModel = new UserModel($db);
        $allowAdminRegister = !$userModel->adminExists();
        include __DIR__ . '/../app/views/auth/login.php';
        break;

    case 'register-admin':
        $userModel = new UserModel($db);

        if ($userModel->adminExists()) {
            redirectTo('login&error=admin_registration_closed');
        }

        include __DIR__ . '/../app/views/auth/register_admin.php';
        break;

    case 'register-admin-process':
        $auth = new AuthController($db);
        $auth->registerAdmin();
        break;

    case 'login-process':
        $auth = new AuthController($db);
        $auth->login();
        break;

    case 'dashboard':
        if (!isset($_SESSION['user_id'])) {
            redirectTo('login');
        }

        $role = strtolower($_SESSION['role'] ?? '');

        if ($role === 'admin') {
            $userModel = new UserModel($db);

            $totalUsers = $userModel->countAllUsers();
            $totalStudents = $userModel->countUsersByRole('Student');
            $totalFaculty = $userModel->countUsersByRole('Faculty');
            $activeUsers = $userModel->countActiveUsers();
            $recentUsers = $userModel->getRecentUsers(5);

            include __DIR__ . '/../app/views/admin/dashboard.php';
        } elseif ($role === 'faculty') {
            include __DIR__ . '/../app/views/faculty/dashboard.php';
        } elseif ($role === 'student') {
            include __DIR__ . '/../app/views/student/dashboard.php';
        } else {
            session_unset();
            session_destroy();
            redirectTo('home');
        }
        break;

    case 'students':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $admin = new AdminController($db);
        $users = $admin->getUsersByRole('Student');
        include __DIR__ . '/../app/views/admin/students.php';
        break;

    case 'faculty':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $admin = new AdminController($db);
        $users = $admin->getUsersByRole('Faculty');
        include __DIR__ . '/../app/views/admin/faculty.php';
        break;
    case 'reports':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $reportController = new ReportController($db);
        $reportController->overallReport();
        break;

    case 'admin-admissions':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $admissionController = new AdmissionController($db);
        $admissions = $admissionController->adminAdmissions();
        include __DIR__ . '/../app/views/admin/admissions.php';
        break;

    case 'admin-admission-review':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $admissionModel = new AdmissionModel($db);
        include __DIR__ . '/../app/views/admin/admission_review.php';
        break;

    case 'admin-admission-decision':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit();
        }

        $admissionController = new AdmissionController($db);
        $_SESSION['admin_id'] = $_SESSION['user_id'];
        $admissionController->handleAdmissionDecision();
        break;

    case 'admin-fees':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $feesController = new FeesController($db);
        $feesController->listFees();
        break;

    case 'admin-fees-create':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $feesController = new FeesController($db);
        $feesController->showCreateFeesForm();
        break;

    case 'admin-fees-save':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $feesController = new FeesController($db);
        $feesController->submitFees();
        break;

    case 'view-challan':
        $feesController = new FeesController($db);
        $feesController->viewChallan();
        break;

    case 'api-installments':
        $feesController = new FeesController($db);
        $feesController->getInstallmentsAPI();
        break;

    case 'api-record-installment':
        $feesController = new FeesController($db);
        $feesController->recordInstallmentPayment();
        break;

    case 'api-get-installments':
        $feesController = new FeesController($db);
        $feesController->getInstallmentsAPI();
        break;

    case 'admission-approve':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $admissionController = new AdmissionController($db);
        $admissionController->approveCashAdmission();
        break;

    case 'student-performance':
    if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
        redirectTo('login');
    }

    $performanceController = new StudentPerformanceController($db);
    $performanceController->dashboard();
    break; 

    case 'create-user':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $admin = new AdminController($db);
        $admin->createUser();
        break;

    case 'edit-user':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $admin = new AdminController($db);
        $user = $admin->getUserById((int)($_GET['id'] ?? 0));
        include __DIR__ . '/../app/views/admin/edit_user.php';
        break;

    case 'update-user':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $admin = new AdminController($db);
        $admin->updateUser();
        break;

    case 'delete-user':
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== 'admin') {
            redirectTo('login');
        }

        $admin = new AdminController($db);
        $admin->deleteUser();
        break;

    case 'profile':
        if (!isset($_SESSION['user_id'])) {
            redirectTo('login');
        }

        $profileController = new ProfileController($db);
        $user = $profileController->getCurrentUser((int)$_SESSION['user_id']);
        include __DIR__ . '/../app/views/profile/index.php';
        break;

    case 'update-profile':
        if (!isset($_SESSION['user_id'])) {
            redirectTo('login');
        }

        $profileController = new ProfileController($db);
        $profileController->updateProfile();
        break;

    // ===== STUDENT AUTHENTICATION ROUTES =====
    case 'student-register':
        $studentAuthController = new StudentAuthController($db);
        $studentAuthController->showRegistration();
        break;

    case 'student-register-submit':
        $studentAuthController = new StudentAuthController($db);
        $studentAuthController->processRegistration();
        break;

    case 'student-login':
        $studentAuthController = new StudentAuthController($db);
        $studentAuthController->showLogin();
        break;

    case 'student-login-submit':
        $studentAuthController = new StudentAuthController($db);
        $studentAuthController->processLogin();
        break;

    case 'student-admission-form':
        // Display student admission form (requires login)
        if (!isset($_SESSION['student_id'])) {
            redirectTo('student-login');
        }
        include __DIR__ . '/../app/views/public/student_admission_form.php';
        break;

    case 'student-admission-submit':
        // Process student admission form submission
        if (!isset($_SESSION['student_id'])) {
            redirectTo('student-login');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirectTo('student-admission-form&error=invalid_request');
        }

        try {
            $pucInstitute = trim($_POST['puc_institute'] ?? '');
            $lastAttended = trim($_POST['last_attended'] ?? '');
            $pucSubjects = trim($_POST['puc_subjects'] ?? '');
            $courseApplied = trim($_POST['course_applied'] ?? '');

            if ($pucInstitute === '' || $lastAttended === '' || $pucSubjects === '' || $courseApplied === '') {
                $_SESSION['error'] = 'All fields are required';
                redirectTo('student-admission-form&error=missing_fields');
            }

            $admissionModel = new AdmissionModel($db);
            $aadhar = $_SESSION['aadhar'];

            $updateQuery = "UPDATE admissions SET puc_institute = :puc_institute, last_attended = :last_attended, 
                           puc_subjects = :puc_subjects, status = 'form_completed', updated_at = NOW()
                           WHERE aadhar_number = :aadhar";

            $stmt = $db->prepare($updateQuery);
            $stmt->execute([
                ':puc_institute' => $pucInstitute,
                ':last_attended' => $lastAttended,
                ':puc_subjects' => $pucSubjects,
                ':aadhar' => $aadhar
            ]);

            $_SESSION['success'] = 'Admission form submitted successfully! Please complete the payment.';
            redirectTo('student-admission-success');
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error: ' . $e->getMessage();
            redirectTo('student-admission-form&error=submit_failed');
        }
        break;

    case 'student-admission-success':
        if (!isset($_SESSION['student_id'])) {
            redirectTo('student-login');
        }
        include __DIR__ . '/../app/views/public/student_admission_success.php';
        break;

    case 'student-admission-payment':
        // Redirect to payment after registration
        if (!isset($_GET['uuid'])) {
            redirectTo('home&error=invalid_reference');
        }
        $uuid = trim($_GET['uuid']);
        redirectTo('admission-payment&uuid=' . urlencode($uuid) . '&from_student=1');
        break;

    case 'student-logout':
        $studentAuthController = new StudentAuthController($db);
        $studentAuthController->logout();
        break;
    // ===== END STUDENT AUTHENTICATION ROUTES =====

    case 'logout':
        session_unset();
        session_destroy();
        redirectTo('home');
        break;

    default:
        http_response_code(404);
        echo '404 Page Not Found';
        break;
}