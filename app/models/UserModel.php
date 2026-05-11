<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function authenticate($email, $password) {
        $query = "SELECT
                    u.id,
                    u.uuid,
                    u.email,
                    u.password_hash,
                    u.role_id,
                    u.status,
                    u.last_login,
                    u.created_at,
                    u.updated_at,
                    r.role_name,
                    COALESCE(p.first_name, 'User') AS first_name,
                    p.last_name,
                    p.phone,
                    p.department,
                    p.avatar_url
                  FROM users u
                  JOIN roles r ON u.role_id = r.id
                  LEFT JOIN profiles p ON u.id = p.user_id
                  WHERE u.email = :email
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (
            $user &&
            strtolower($user['status']) === 'active' &&
            !empty($user['password_hash']) &&
            password_verify($password, $user['password_hash'])
        ) {
            $updateQuery = "UPDATE users SET last_login = NOW(), updated_at = NOW() WHERE id = :id";
            $updateStmt = $this->conn->prepare($updateQuery);
            $updateStmt->bindParam(':id', $user['id'], PDO::PARAM_INT);
            $updateStmt->execute();

            return $user;
        }

        return false;
    }

    public function emailExists($email, $excludeId = null) {
        $query = "SELECT id FROM users WHERE email = :email";
        if ($excludeId !== null) {
            $query .= " AND id != :exclude_id";
        }
        $query .= " LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        if ($excludeId !== null) {
            $stmt->bindParam(':exclude_id', $excludeId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    public function getRoleNameById($roleId) {
        $query = "SELECT role_name FROM roles WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $roleId, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['role_name'] : null;
    }

    public function createUser($firstName, $lastName, $email, $password, $roleId, $department, $phone = null) {
        if ($this->emailExists($email)) {
            return false;
        }

        $this->conn->beginTransaction();

        try {
            $uuid = bin2hex(random_bytes(8));
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $userQuery = "INSERT INTO users (
                            uuid,
                            email,
                            password_hash,
                            role_id,
                            status,
                            last_login,
                            created_at,
                            updated_at
                          ) VALUES (
                            :uuid,
                            :email,
                            :password_hash,
                            :role_id,
                            'active',
                            NULL,
                            NOW(),
                            NOW()
                          )";

            $userStmt = $this->conn->prepare($userQuery);
            $userStmt->bindParam(':uuid', $uuid);
            $userStmt->bindParam(':email', $email);
            $userStmt->bindParam(':password_hash', $passwordHash);
            $userStmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
            $userStmt->execute();

            $userId = $this->conn->lastInsertId();

            $profileQuery = "INSERT INTO profiles (
                                user_id,
                                first_name,
                                last_name,
                                phone,
                                department,
                                avatar_url
                             ) VALUES (
                                :user_id,
                                :first_name,
                                :last_name,
                                :phone,
                                :department,
                                NULL
                             )";

            $profileStmt = $this->conn->prepare($profileQuery);
            $profileStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $profileStmt->bindParam(':first_name', $firstName);
            $profileStmt->bindParam(':last_name', $lastName);
            $profileStmt->bindParam(':phone', $phone);
            $profileStmt->bindParam(':department', $department);
            $profileStmt->execute();

            $this->conn->commit();

            return [
                'id' => $userId,
                'email' => $email,
                'first_name' => $firstName,
                'role_id' => $roleId,
                'plain_password' => $password
            ];
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function getAllUsers() {
        $query = "SELECT
                    u.id,
                    u.email,
                    u.status,
                    r.role_name,
                    p.first_name,
                    p.last_name,
                    p.phone,
                    p.department
                  FROM users u
                  JOIN roles r ON u.role_id = r.id
                  LEFT JOIN profiles p ON u.id = p.user_id
                  ORDER BY u.id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersByRole($roleName) {
        $query = "SELECT
                    u.id,
                    u.email,
                    u.status,
                    r.role_name,
                    p.first_name,
                    p.last_name,
                    p.phone,
                    p.department
                  FROM users u
                  JOIN roles r ON u.role_id = r.id
                  LEFT JOIN profiles p ON u.id = p.user_id
                  WHERE r.role_name = :role_name
                  ORDER BY u.id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':role_name', $roleName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $query = "SELECT
                    u.id,
                    u.email,
                    u.status,
                    u.role_id,
                    r.role_name,
                    p.first_name,
                    p.last_name,
                    p.phone,
                    p.department
                  FROM users u
                  JOIN roles r ON u.role_id = r.id
                  LEFT JOIN profiles p ON u.id = p.user_id
                  WHERE u.id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $firstName, $lastName, $phone, $email, $department, $status) {
        if ($this->emailExists($email, $id)) {
            return false;
        }

        try {
            $this->conn->beginTransaction();

            $userQuery = "UPDATE users
                          SET email = :email,
                              status = :status,
                              updated_at = NOW()
                          WHERE id = :id";

            $userStmt = $this->conn->prepare($userQuery);
            $userStmt->bindParam(':email', $email);
            $userStmt->bindParam(':status', $status);
            $userStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $userStmt->execute();

            $profileQuery = "UPDATE profiles
                             SET first_name = :first_name,
                                 last_name = :last_name,
                                 phone = :phone,
                                 department = :department
                             WHERE user_id = :id";

            $profileStmt = $this->conn->prepare($profileQuery);
            $profileStmt->bindParam(':first_name', $firstName);
            $profileStmt->bindParam(':last_name', $lastName);
            $profileStmt->bindParam(':phone', $phone);
            $profileStmt->bindParam(':department', $department);
            $profileStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $profileStmt->execute();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id AND role_id IN (2, 3)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function adminExists() {
    $query = "SELECT COUNT(*) AS total
              FROM users u
              JOIN roles r ON u.role_id = r.id
              WHERE r.role_name = 'Admin'";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return ((int)($row['total'] ?? 0)) > 0;
}

    public function countAllUsers() {
    $query = "SELECT COUNT(*) AS total FROM users";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int)($row['total'] ?? 0);
}

public function countUsersByRole($roleName) {
    $query = "SELECT COUNT(*) AS total
              FROM users u
              JOIN roles r ON u.role_id = r.id
              WHERE r.role_name = :role_name";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':role_name', $roleName, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int)($row['total'] ?? 0);
}

public function countActiveUsers() {
    $query = "SELECT COUNT(*) AS total FROM users WHERE status = 'active'";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int)($row['total'] ?? 0);
}

public function getRecentUsers($limit = 5) {
    $limit = (int)$limit;

    $query = "SELECT
                u.id,
                u.email,
                r.role_name,
                p.first_name,
                p.last_name
              FROM users u
              JOIN roles r ON u.role_id = r.id
              LEFT JOIN profiles p ON u.id = p.user_id
              ORDER BY u.created_at DESC
              LIMIT $limit";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function updateOwnProfile($id, $firstName, $lastName, $phone, $email, $department) {
    if ($this->emailExists($email, $id)) {
        return false;
    }

    try {
        $this->conn->beginTransaction();

        $userQuery = "UPDATE users
                      SET email = :email,
                          updated_at = NOW()
                      WHERE id = :id";

        $userStmt = $this->conn->prepare($userQuery);
        $userStmt->bindParam(':email', $email);
        $userStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $userStmt->execute();

        $profileQuery = "UPDATE profiles
                         SET first_name = :first_name,
                             last_name = :last_name,
                             phone = :phone,
                             department = :department
                         WHERE user_id = :id";

        $profileStmt = $this->conn->prepare($profileQuery);
        $profileStmt->bindParam(':first_name', $firstName);
        $profileStmt->bindParam(':last_name', $lastName);
        $profileStmt->bindParam(':phone', $phone);
        $profileStmt->bindParam(':department', $department);
        $profileStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $profileStmt->execute();

        $this->conn->commit();
        return true;
    } catch (Exception $e) {
        $this->conn->rollBack();
        return false;
    }
}
}