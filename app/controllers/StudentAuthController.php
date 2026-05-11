<?php
/**
 * StudentAuthController
 * Handles student registration, login, and authentication
 */

class StudentAuthController {
    private $db;
    private $admissionModel;

    public function __construct($db) {
        $this->db = $db;
        $this->admissionModel = new AdmissionModel($db);
    }

    /**
     * Generate unique Student ID
     * Format: STU-YYYYMMDD-XXXXX
     */
    private function generateStudentId() {
        $prefix = 'STU-' . date('Ymd') . '-';
        $suffix = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5));
        return $prefix . $suffix;
    }

    /**
     * Validate Aadhar number format
     */
    private function isValidAadhar($aadhar) {
        return preg_match('/^\d{12}$/', preg_replace('/\s/', '', $aadhar));
    }

    /**
     * Hash password
     */
    private function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
    }

    /**
     * Verify password
     */
    private function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * Show student registration form
     */
    public function showRegistration() {
        include __DIR__ . '/../views/public/student_registration.php';
    }

    /**
     * Process student registration
     */
    public function processRegistration() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'student-register&error=invalid_request');
            exit();
        }

        // Validate inputs
        $fullName = trim($_POST['full_name'] ?? '');
        $fatherName = trim($_POST['father_name'] ?? '');
        $studentId = strtoupper(trim($_POST['student_id'] ?? ''));
        $password = $_POST['password'] ?? '';

        if ($studentId === '') {
            $studentId = $this->generateStudentId();
        }
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validation
        if ($fullName === '' || $fatherName === '' || $studentId === '' || $password === '') {
            $_SESSION['error'] = 'All fields are required';
            header('Location: ' . BASE_URL . 'student-register&error=missing_fields');
            exit();
        }

        if ($password !== $confirmPassword) {
            $_SESSION['error'] = 'Passwords do not match';
            header('Location: ' . BASE_URL . 'student-register&error=password_mismatch');
            exit();
        }

        if (strlen($password) < 8) {
            $_SESSION['error'] = 'Password must be at least 8 characters long';
            header('Location: ' . BASE_URL . 'student-register&error=weak_password');
            exit();
        }

        // Check if Student ID already exists
        try {
            $query = "SELECT student_id FROM admissions WHERE student_id = :student_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':student_id', $studentId);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['error'] = 'This Student ID already exists. Please try again.';
                header('Location: ' . BASE_URL . 'student-register&error=student_id_exists');
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Database error: ' . $e->getMessage();
            header('Location: ' . BASE_URL . 'student-register&error=db_error');
            exit();
        }

        // Create registration record
        try {
            $uuid = bin2hex(random_bytes(16));
            $aadharNumber = 'TEMP-' . $studentId; // Temporary aadhar placeholder
            $hashedPassword = $this->hashPassword($password);

            $registrationData = [
                'aadhar_number' => $aadharNumber,
                'student_id' => $studentId,
                'uuid' => $uuid,
                'full_name' => $fullName,
                'father_name' => $fatherName,
                'password' => $hashedPassword,
                'payment_method' => 'none',
                'payment_status' => 'pending',
                'status' => 'payment_in_progress',
            ];

            $query = "INSERT INTO admissions 
                     (aadhar_number, student_id, uuid, full_name, father_name, password, 
                      payment_method, payment_status, status, created_at, updated_at)
                     VALUES 
                     (:aadhar, :student_id, :uuid, :full_name, :father_name, :password, 
                      :payment_method, :payment_status, :status, NOW(), NOW())";

            $stmt = $this->db->prepare($query);
            $stmt->execute($registrationData);

            $_SESSION['success'] = 'Registration successful! Your Student ID is: ' . $studentId;
            $_SESSION['student_id'] = $studentId;
            $_SESSION['aadhar'] = $aadharNumber;

            // Redirect to payment page
            header('Location: ' . BASE_URL . 'student-admission-payment&uuid=' . urlencode($uuid));
            exit();

        } catch (Exception $e) {
            $_SESSION['error'] = 'Registration failed: ' . $e->getMessage();
            header('Location: ' . BASE_URL . 'student-register&error=registration_failed');
            exit();
        }
    }

    /**
     * Show student login form
     */
    public function showLogin() {
        // If already logged in, redirect to admission form
        if (isset($_SESSION['student_id']) && isset($_SESSION['student_name'])) {
            header('Location: ' . BASE_URL . 'student-admission-form');
            exit();
        }
        include __DIR__ . '/../views/public/student_login.php';
    }

    /**
     * Process student login
     */
    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'student-login&error=invalid_request');
            exit();
        }

        $studentId = strtoupper(trim($_POST['student_id'] ?? $_SESSION['student_id'] ?? ''));
        $password = $_POST['password'] ?? '';

        if ($studentId === '' || $password === '') {
            $_SESSION['error'] = 'Student ID and password are required';
            header('Location: ' . BASE_URL . 'student-login&error=missing_fields');
            exit();
        }

        try {
            $query = "SELECT aadhar_number, student_id, full_name, password, payment_status, status 
                     FROM admissions WHERE student_id = :student_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':student_id', $studentId);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                $_SESSION['error'] = 'Invalid Student ID or password';
                header('Location: ' . BASE_URL . 'student-login&error=invalid_credentials');
                exit();
            }

            $student = $stmt->fetch(PDO::FETCH_ASSOC);

            $storedPassword = $student['password'] ?? '';
            $passwordValid = $this->verifyPassword($password, $storedPassword) || $password === $storedPassword;

            if (!$passwordValid) {
                $_SESSION['error'] = 'Invalid Student ID or password';
                header('Location: ' . BASE_URL . 'student-login&error=invalid_credentials');
                exit();
            }

            // Set session
            $_SESSION['student_id'] = $student['student_id'];
            $_SESSION['student_name'] = $student['full_name'];
            $_SESSION['aadhar'] = $student['aadhar_number'];
            $_SESSION['payment_status'] = $student['payment_status'];
            $_SESSION['student_status'] = $student['status'];

            $_SESSION['success'] = 'Welcome ' . $student['full_name'] . '! Login successful.';

            // Redirect to admission form
            header('Location: ' . BASE_URL . 'student-admission-form');
            exit();

        } catch (Exception $e) {
            $_SESSION['error'] = 'Login error: ' . $e->getMessage();
            header('Location: ' . BASE_URL . 'student-login&error=login_failed');
            exit();
        }
    }

    /**
     * Get student data
     */
    public function getStudentData($aadharNumber) {
        try {
            $query = "SELECT * FROM admissions WHERE aadhar_number = :aadhar";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':aadhar', $aadharNumber);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Logout student
     */
    public function logout() {
        session_destroy();
        $_SESSION = [];
        header('Location: ' . BASE_URL . 'student-login?success=logout');
        exit();
    }
}
