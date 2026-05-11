<?php
class AuthController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            header('Location: ' . BASE_URL . 'login&error=missing_fields');
            exit();
        }

        $user = $this->userModel->authenticate($email, $password);

        if (!$user) {
            header('Location: ' . BASE_URL . 'login&error=invalid_credentials');
            exit();
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['first_name'] ?? 'User';
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role_name'];

        header('Location: ' . BASE_URL . 'dashboard');
        exit();
    }

    public function registerAdmin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        if ($this->userModel->adminExists()) {
            header('Location: ' . BASE_URL . 'login&error=admin_registration_closed');
            exit();
        }

        $firstName = trim($_POST['first_name'] ?? '');
        $lastName = trim($_POST['last_name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirmPassword = trim($_POST['confirm_password'] ?? '');

        if ($firstName === '' || $email === '' || $password === '' || $confirmPassword === '') {
            header('Location: ' . BASE_URL . 'register-admin&error=invalid_input');
            exit();
        }

        if ($password !== $confirmPassword) {
            header('Location: ' . BASE_URL . 'register-admin&error=password_mismatch');
            exit();
        }

        $created = $this->userModel->createUser(
            $firstName,
            $lastName,
            $email,
            $password,
            1,
            'Administration',
            $phone !== '' ? $phone : null
        );

        if ($created) {
            header('Location: ' . BASE_URL . 'login&success=admin_registered');
        } else {
            header('Location: ' . BASE_URL . 'register-admin&error=register_failed');
        }
        exit();
    }
}