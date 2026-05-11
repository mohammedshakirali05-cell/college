<?php
class AdminController
{
    private $userModel;
    private $mailService;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
        $this->mailService = new MailService();
    }

    public function getAllUsers()
    {
        return $this->userModel->getAllUsers();
    }

    public function getUsersByRole($roleName)
    {
        return $this->userModel->getUsersByRole($roleName);
    }

    public function getUserById($id)
    {
        return $this->userModel->getUserById($id);
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'dashboard');
            exit();
        }

        $firstName  = trim($_POST['first_name'] ?? '');
        $lastName   = trim($_POST['last_name'] ?? '');
        $phone      = trim($_POST['phone'] ?? '');
        $email      = trim($_POST['email'] ?? '');
        $password   = trim($_POST['password'] ?? '');
        $department = trim($_POST['department'] ?? '');
        $roleId     = (int)($_POST['role_id'] ?? 0);
        $redirect   = trim($_POST['redirect_to'] ?? 'dashboard');

        // First Name
        // First Name
        if (!preg_match("/^[A-Za-z ]+$/", $firstName)) {
            header('Location: ' . BASE_URL . $redirect . '&msg=invalid_input');
            exit();
        }

        // Last Name
        if (!empty($lastName) && !preg_match("/^[A-Za-z ]+$/", $lastName)) {
            header('Location: ' . BASE_URL . $redirect . '&msg=invalid_input');
            exit();
        }

        // Phone
        if (!empty($phone) && !preg_match("/^[0-9]{10}$/", $phone)) {
            header('Location: ' . BASE_URL . $redirect . '&msg=invalid_input');
            exit();
        }

        // Email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: ' . BASE_URL . $redirect . '&msg=invalid_input');
            exit();
        }

        // Password
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
            header('Location: ' . BASE_URL . $redirect . '&msg=invalid_input');
            exit();
        }

        // Department (manual)
        if (
            !empty($_POST['department_custom']) &&
            !preg_match("/^[A-Za-z ]+$/", $_POST['department_custom'])
        ) {
            header('Location: ' . BASE_URL . $redirect . '&msg=invalid_input');
            exit();
        } {
            header('Location: ' . BASE_URL . $redirect . '&msg=invalid_input');
            exit();
        }

        $createdUser = $this->userModel->createUser(
            $firstName,
            $lastName,
            $email,
            $password,
            $roleId,
            $department,
            $phone !== '' ? $phone : null
        );

        if (!$createdUser) {
            header('Location: ' . BASE_URL . $redirect . '&msg=create_failed');
            exit();
        }

        $roleName = $this->userModel->getRoleNameById($roleId);

        $mailResult = $this->mailService->sendCredentialsEmail(
            $email,
            $firstName,
            $roleName,
            $email,
            $password
        );

        if ($mailResult['success']) {
            header('Location: ' . BASE_URL . $redirect . '&msg=created_and_emailed');
        } else {
            $error = urlencode($mailResult['error'] ?? 'Unknown mail error');
            header('Location: ' . BASE_URL . $redirect . '&msg=created_but_email_failed&mail_error=' . $error);
        }
        exit();
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'dashboard');
            exit();
        }

        $id         = (int)($_POST['id'] ?? 0);
        $firstName  = trim($_POST['first_name'] ?? '');
        $lastName   = trim($_POST['last_name'] ?? '');
        $phone      = trim($_POST['phone'] ?? '');
        $email      = trim($_POST['email'] ?? '');
        $department = trim($_POST['department'] ?? '');
        $status     = trim($_POST['status'] ?? 'active');
        $redirect   = trim($_POST['redirect_to'] ?? 'dashboard');

        $updated = $this->userModel->updateUser(
            $id,
            $firstName,
            $lastName,
            $phone,
            $email,
            $department,
            $status
        );

        if ($updated) {
            header('Location: ' . BASE_URL . $redirect . '&msg=updated');
        } else {
            header('Location: ' . BASE_URL . $redirect . '&msg=update_failed');
        }
        exit();
    }

    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'dashboard');
            exit();
        }

        $id       = (int)($_POST['id'] ?? 0);
        $redirect = trim($_POST['redirect_to'] ?? 'dashboard');

        $deleted = $this->userModel->deleteUser($id);

        if ($deleted) {
            header('Location: ' . BASE_URL . $redirect . '&msg=deleted');
        } else {
            header('Location: ' . BASE_URL . $redirect . '&msg=delete_failed');
        }
        exit();
    }
}
