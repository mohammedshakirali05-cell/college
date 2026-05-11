<?php
class ProfileController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function getCurrentUser($id) {
        return $this->userModel->getUserById($id);
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'profile');
            exit();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        $id         = (int)$_SESSION['user_id'];
        $firstName  = trim($_POST['first_name'] ?? '');
        $lastName   = trim($_POST['last_name'] ?? '');
        $phone      = trim($_POST['phone'] ?? '');
        $email      = trim($_POST['email'] ?? '');
        $department = trim($_POST['department'] ?? '');

        if ($firstName === '' || $email === '') {
            header('Location: ' . BASE_URL . 'profile&msg=invalid_input');
            exit();
        }

        $updated = $this->userModel->updateOwnProfile(
            $id,
            $firstName,
            $lastName,
            $phone,
            $email,
            $department
        );

        if ($updated) {
            $_SESSION['user_name'] = $firstName;
            $_SESSION['email'] = $email;
            header('Location: ' . BASE_URL . 'profile&msg=updated');
        } else {
            header('Location: ' . BASE_URL . 'profile&msg=update_failed');
        }
        exit();
    }
}