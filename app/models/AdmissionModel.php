<?php
class AdmissionModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->ensureAdmissionTableExists();
    }

    private function ensureAdmissionTableExists()
    {
        $query = "CREATE TABLE IF NOT EXISTS admissions (
            id INT NOT NULL AUTO_INCREMENT,
            uuid CHAR(32) NOT NULL,
            admission_number VARCHAR(50) NOT NULL,
            full_name VARCHAR(255) NOT NULL,
            father_name VARCHAR(255) NULL,
            aadhar_number VARCHAR(20) NOT NULL,
            student_id VARCHAR(20) UNIQUE NULL COMMENT 'Auto-generated student ID',
            password VARCHAR(255) NULL COMMENT 'Hashed password for student login',
            admission_type ENUM('first_year','transfer') NOT NULL DEFAULT 'first_year',
            registration_no VARCHAR(100) NULL,
            email VARCHAR(255) NULL,
            mobile_no VARCHAR(15) NULL,
            course_applied ENUM('BBA','BCA') NULL,
            photo VARCHAR(500) NULL,
            sslc_marks_card VARCHAR(500) NULL,
            puc_marks_card VARCHAR(500) NULL,
            aadhar_card VARCHAR(500) NULL,
            candidate_signature VARCHAR(500) NULL,
            parent_signature VARCHAR(500) NULL,
            puc_institute VARCHAR(255) NOT NULL,
            last_attended VARCHAR(255) NOT NULL,
            puc_subjects TEXT NOT NULL,
            payment_method ENUM('none','online','cash') NOT NULL DEFAULT 'none',
            payment_status ENUM('pending','paid') NOT NULL DEFAULT 'pending',
            status VARCHAR(50) NOT NULL DEFAULT 'payment_in_progress',
            admin_notes TEXT DEFAULT NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY uuid (uuid),
            UNIQUE KEY admission_number (admission_number),
            UNIQUE KEY student_id (student_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        $this->conn->exec($query);

        // Add missing columns
        $columnsToAdd = [
            'father_name' => "VARCHAR(255) NULL AFTER full_name",
            'student_id' => "VARCHAR(20) UNIQUE NULL COMMENT 'Auto-generated student ID' AFTER aadhar_number",
            'password' => "VARCHAR(255) NULL COMMENT 'Hashed password for student login' AFTER student_id",
            'admission_type' => "ENUM('first_year','transfer') NOT NULL DEFAULT 'first_year' AFTER aadhar_number",
            'registration_no' => 'VARCHAR(100) NULL AFTER admission_type',
            'email' => 'VARCHAR(255) NULL AFTER registration_no',
            'mobile_no' => 'VARCHAR(15) NULL AFTER email',
            'course_applied' => "ENUM('BBA','BCA') NULL AFTER mobile_no",
            'photo' => 'VARCHAR(500) NULL AFTER course_applied',
            'sslc_marks_card' => 'VARCHAR(500) NULL AFTER photo',
            'puc_marks_card' => 'VARCHAR(500) NULL AFTER sslc_marks_card',
            'aadhar_card' => 'VARCHAR(500) NULL AFTER puc_marks_card',
            'candidate_signature' => 'VARCHAR(500) NULL AFTER aadhar_card',
            'parent_signature' => 'VARCHAR(500) NULL AFTER candidate_signature'
        ];

        foreach ($columnsToAdd as $columnName => $columnType) {
            $columnCheck = $this->conn->prepare(
                "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS " .
                "WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'admissions' " .
                "AND COLUMN_NAME = ?"
            );
            $columnCheck->execute([$columnName]);

            if ($columnCheck->fetchColumn() == 0) {
                try {
                    $this->conn->exec("ALTER TABLE admissions ADD COLUMN $columnName $columnType");
                } catch (Exception $e) {
                    // Column might already exist, continue
                }
            }
        }
    }

    public function createAdmission(array $data)
    {
        $uuid = bin2hex(random_bytes(16));
        $admissionNumber = 'ADM-' . strtoupper(substr(hash('sha256', $uuid . time()), 0, 10));

        $query = "INSERT INTO admissions (
            uuid,
            admission_number,
            full_name,
            father_name,
            aadhar_number,
            admission_type,
            registration_no,
            email,
            mobile_no,
            course_applied,
            photo,
            sslc_marks_card,
            puc_marks_card,
            aadhar_card,
            candidate_signature,
            parent_signature,
            puc_institute,
            last_attended,
            puc_subjects,
            payment_method,
            payment_status,
            status,
            created_at,
            updated_at
        ) VALUES (
            :uuid,
            :admission_number,
            :full_name,
            :father_name,
            :aadhar_number,
            :admission_type,
            :registration_no,
            :email,
            :mobile_no,
            :course_applied,
            :photo,
            :sslc_marks_card,
            :puc_marks_card,
            :aadhar_card,
            :candidate_signature,
            :parent_signature,
            :puc_institute,
            :last_attended,
            :puc_subjects,
            :payment_method,
            :payment_status,
            :status,
            NOW(),
            NOW()
        )";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':uuid', $uuid);
        $stmt->bindParam(':admission_number', $admissionNumber);
        $stmt->bindParam(':full_name', $data['full_name']);
        $stmt->bindParam(':father_name', $data['father_name']);
        $stmt->bindParam(':aadhar_number', $data['aadhar_number']);
        $stmt->bindParam(':admission_type', $data['admission_type']);
        $stmt->bindValue(':registration_no', $data['registration_no'] ?? null);
        $stmt->bindValue(':email', $data['email'] ?? null);
        $stmt->bindValue(':mobile_no', $data['mobile_no'] ?? null);
        $stmt->bindValue(':course_applied', $data['course_applied'] ?? null);
        $stmt->bindValue(':photo', $data['photo'] ?? null);
        $stmt->bindValue(':sslc_marks_card', $data['sslc_marks_card'] ?? null);
        $stmt->bindValue(':puc_marks_card', $data['puc_marks_card'] ?? null);
        $stmt->bindValue(':aadhar_card', $data['aadhar_card'] ?? null);
        $stmt->bindValue(':candidate_signature', $data['candidate_signature'] ?? null);
        $stmt->bindValue(':parent_signature', $data['parent_signature'] ?? null);
        $stmt->bindParam(':puc_institute', $data['puc_institute']);
        $stmt->bindParam(':last_attended', $data['last_attended']);
        $stmt->bindParam(':puc_subjects', $data['puc_subjects']);
        $stmt->bindValue(':payment_method', $data['payment_method']);
        $stmt->bindValue(':payment_status', $data['payment_status']);
        $stmt->bindValue(':status', $data['status']);



        if ($stmt->execute()) {
            return $this->getAdmissionByUuid($uuid);
        }

        $uploadedFiles = [
            'photo' => $data['photo'] ?? null,
            'sslc_marks_card' => $data['sslc_marks_card'] ?? null,
            'puc_marks_card' => $data['puc_marks_card'] ?? null,
            'aadhar_card' => $data['aadhar_card'] ?? null,
            'candidate_signature' => $data['candidate_signature'] ?? null,
            'parent_signature' => $data['parent_signature'] ?? null,
        ];

        $uploadedFileNames = array_filter($uploadedFiles, function ($value) {
            return !empty($value);
        });

        error_log('Admission insert failed. Uploaded files: ' . implode(', ', array_map(
            function ($key, $value) {
                return "$key={$value}";
            },
            array_keys($uploadedFileNames),
            $uploadedFileNames
        )) . '. SQL error: ' . implode(' | ', $stmt->errorInfo()));

        return false;
    }

    public function getAdmissionByUuid($uuid)
    {
        $query = "SELECT * FROM admissions WHERE uuid = :uuid LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':uuid', $uuid);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAdmissionById($id)
    {
        $query = "SELECT * FROM admissions WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAdmissionByAadhar($aadhar)
    {
        $query = "SELECT * FROM admissions WHERE aadhar_number = :aadhar LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':aadhar', $aadhar, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAdmissions($status = null)
    {
        $query = "SELECT * FROM admissions";

        if ($status !== null) {
            $query .= " WHERE status = :status";
        }

        $query .= " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);

        if ($status !== null) {
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateAdmissionStatus($id, array $data)
    {
        $fields = [];
        $params = [':id' => $id];

        if (isset($data['payment_method'])) {
            $fields[] = 'payment_method = :payment_method';
            $params[':payment_method'] = $data['payment_method'];
        }
        if (isset($data['payment_status'])) {
            $fields[] = 'payment_status = :payment_status';
            $params[':payment_status'] = $data['payment_status'];
        }
        if (isset($data['status'])) {
            $fields[] = 'status = :status';
            $params[':status'] = $data['status'];
        }
        if (isset($data['admin_notes'])) {
            $fields[] = 'admin_notes = :admin_notes';
            $params[':admin_notes'] = $data['admin_notes'];
        }
        if (isset($data['student_id'])) {
            $fields[] = 'student_id = :student_id';
            $params[':student_id'] = $data['student_id'];
        }
        if (isset($data['password'])) {
            $fields[] = 'password = :password';
            $params[':password'] = $data['password'];
        }

        if (empty($fields)) {
            return false;
        }

        $query = "UPDATE admissions SET " . implode(', ', $fields) . ", updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        return $stmt->execute();
    }

    public function approveCashAdmission($id)
    {
        return $this->updateAdmissionStatus($id, [
            'payment_method' => 'cash',
            'payment_status' => 'paid',
            'status' => 'admitted',
            'admin_notes' => 'Cash collected and approved by the administration.',
        ]);
    }

    public function updateAdmissionWithFullDetails(array $data)
    {
        // First ensure all required columns exist
        $this->ensureFullAdmissionColumnsExist();

        // Support older form field naming for Aadhaar input
        if (isset($data['aadhar_no']) && !isset($data['aadhar_number'])) {
            $data['aadhar_number'] = $data['aadhar_no'];
        }
        // Candidate name mapping
        if (isset($data['candidate_name']) && !isset($data['full_name'])) {
            $data['full_name'] = $data['candidate_name'];
        }

        // Subject/Marks mapping
        for ($i = 1; $i <= 6; $i++) {

            // Subject Name
            if (isset($data["subject_$i"])) {
                $data["marks_subject_$i"] = $data["subject_$i"];
            }

            // Total Marks
            if (isset($data["total_$i"])) {
                $data["marks_max_$i"] = $data["total_$i"];
            }

            // Obtained Marks
            if (isset($data["marks_$i"])) {
                $data["marks_obtained_$i"] = $data["marks_$i"];
            }
        }

        // Candidate name mapping
        

        // Try to find admission by admission_number first
        $query = "SELECT id FROM admissions WHERE admission_number = :application_no LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':application_no', $data['application_no']);
        $stmt->execute();
        $admission = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fallback: try registration_no if admission not found
        if (!$admission && isset($data['registration_no'])) {

            $query = "SELECT id FROM admissions WHERE registration_no = :registration_no LIMIT 1";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':registration_no', $data['registration_no']);

            $stmt->execute();

            $admission = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if (!$admission) {
            error_log('No admission found with application number: ' . $data['application_no']);
            return false;
        }

        $id = $admission['id'];

        // Build update query dynamically
        $fields = [];
        $params = [':id' => $id];

        $updatableFields = [
            'registration_no',
            'candidate_name',
            'father_name',
            'mother_name',
            'surname',
            'gender',
            'date_of_birth',
            'aadhar_number',
            'category',
            'category_cert_no',
            'annual_income',
            'income_caste_certificate_no',
            'sslc_reg_no',
            'address',
            'permanent_address',
            'city',
            'state',
            'postal_code',
            'district',
            'taluk',
            'area_type',
            'ward_no',
            'mobile_no',
            'parent_mobile_no',
            'email',
            'overall_percentage',
            'course_applied',
            'last_attended_institution',
            'year_of_admission',
            'year_of_passing',
            'declaration_1',
            'declaration_2',
            'declaration_3',
            'photo',
            'sslc_marks_card',
            'puc_marks_card',
            'aadhar_card',
            'candidate_signature',
            'parent_signature'
        ];

        foreach ($updatableFields as $field) {
            if (isset($data[$field])) {
                $fields[] = "$field = :$field";
                $params[":$field"] = $data[$field];
            }
        }

        // Add marks fields
        for ($i = 1; $i <= 8; $i++) {
            if (isset($data["marks_subject_$i"])) {
                $fields[] = "marks_subject_$i = :marks_subject_$i";
                $params[":marks_subject_$i"] = $data["marks_subject_$i"];
            }
            if (isset($data["marks_max_$i"])) {
                $fields[] = "marks_max_$i = :marks_max_$i";
                $params[":marks_max_$i"] = $data["marks_max_$i"];
            }
            if (isset($data["marks_obtained_$i"])) {
                $fields[] = "marks_obtained_$i = :marks_obtained_$i";
                $params[":marks_obtained_$i"] = $data["marks_obtained_$i"];
            }
        }

        if (isset($data['total_marks_obtained'])) {
            $fields[] = "total_marks_obtained = :total_marks_obtained";
            $params[':total_marks_obtained'] = $data['total_marks_obtained'];
        }
        if (isset($data['table_percentage'])) {
            $fields[] = "table_percentage = :table_percentage";
            $params[':table_percentage'] = $data['table_percentage'];
        }

        // Add semester subject fields
        for ($i = 1; $i <= 10; $i++) {
            if (isset($data["semester_subject_code_$i"])) {
                $fields[] = "semester_subject_code_$i = :semester_subject_code_$i";
                $params[":semester_subject_code_$i"] = $data["semester_subject_code_$i"];
            }
            if (isset($data["semester_subject_title_$i"])) {
                $fields[] = "semester_subject_title_$i = :semester_subject_title_$i";
                $params[":semester_subject_title_$i"] = $data["semester_subject_title_$i"];
            }
        }

        if (empty($fields)) {
            error_log('No fields to update for admission ID: ' . $id);
            return false;
        }

        $query = "UPDATE admissions SET " . implode(', ', $fields) . ", status = 'application_submitted', updated_at = NOW() WHERE id = :id";

        error_log($query . ' | Params: ' . json_encode($params));
        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        return $stmt->execute();
    }

    private function ensureFullAdmissionColumnsExist()
    {
        $columns = [
            'registration_no' => 'VARCHAR(100) NULL',
            'candidate_name' => 'VARCHAR(255) NULL',
            'mother_name' => 'VARCHAR(255) NULL',
            'surname' => 'VARCHAR(100) NULL',
            'gender' => "ENUM('Male','Female') NULL",
            'date_of_birth' => 'DATE NULL',
            'category' => "ENUM('GM','IIA','IIB','IIIA','IIIB','SC','ST','Cat-1') NULL",
            'category_cert_no' => 'VARCHAR(100) NULL',
            'annual_income' => 'DECIMAL(10,2) NULL',
            'income_caste_certificate_no' => 'VARCHAR(100) NULL',
            'sslc_reg_no' => 'VARCHAR(100) NULL',
            'address' => 'TEXT NULL',
            'permanent_address' => 'TEXT NULL',
            'city' => 'VARCHAR(100) NULL',
            'state' => 'VARCHAR(100) NULL',
            'postal_code' => 'VARCHAR(10) NULL',
            'district' => 'VARCHAR(100) NULL',
            'taluk' => 'VARCHAR(100) NULL',
            'area_type' => "ENUM('Urban','Rural') NULL",
            'ward_no' => 'VARCHAR(50) NULL',
            'mobile_no' => 'VARCHAR(15) NULL',
            'parent_mobile_no' => 'VARCHAR(15) NULL',
            'email' => 'VARCHAR(255) NULL',
            'overall_percentage' => 'DECIMAL(5,2) NULL',
            'course_applied' => "ENUM('BBA','BCA') NULL",
            'last_attended_institution' => 'VARCHAR(255) NULL',
            'year_of_admission' => 'YEAR NULL',
            'year_of_passing' => 'YEAR NULL',
            'declaration_1' => 'TINYINT(1) DEFAULT 0',
            'declaration_2' => 'TINYINT(1) DEFAULT 0',
            'declaration_3' => 'TINYINT(1) DEFAULT 0',
            'photo' => 'VARCHAR(500) NULL',
            'sslc_marks_card' => 'VARCHAR(500) NULL',
            'puc_marks_card' => 'VARCHAR(500) NULL',
            'aadhar_card' => 'VARCHAR(500) NULL',
            'candidate_signature' => 'VARCHAR(500) NULL',
            'parent_signature' => 'VARCHAR(500) NULL',
            'total_marks_obtained' => 'DECIMAL(8,2) NULL',
            'table_percentage' => 'DECIMAL(5,2) NULL'
        ];

        // Add marks columns
        for ($i = 1; $i <= 8; $i++) {
            $columns["marks_subject_$i"] = 'VARCHAR(255) NULL';
            $columns["marks_max_$i"] = 'DECIMAL(6,2) NULL';
            $columns["marks_obtained_$i"] = 'DECIMAL(6,2) NULL';
        }

        // Add semester subject columns
        for ($i = 1; $i <= 10; $i++) {
            $columns["semester_subject_code_$i"] = 'VARCHAR(20) NULL';
            $columns["semester_subject_title_$i"] = 'VARCHAR(255) NULL';
        }

        foreach ($columns as $columnName => $columnType) {
            $columnCheck = $this->conn->prepare(
                "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS " .
                "WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'admissions' " .
                "AND COLUMN_NAME = ?"
            );
            $columnCheck->execute([$columnName]);

            if ($columnCheck->fetchColumn() == 0) {
                $this->conn->exec("ALTER TABLE admissions ADD COLUMN $columnName $columnType");
            }
        }

        // Add approval status columns
        $approvalColumns = [
            'admin_approval_status' => "ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending'",
            'admin_approval_notes' => 'TEXT NULL',
            'admin_payment_schedule' => 'VARCHAR(100) NULL',
            'admin_approved_by' => 'INT NULL',
            'admin_approved_at' => 'TIMESTAMP NULL'
        ];

        foreach ($approvalColumns as $columnName => $columnType) {
            $columnCheck = $this->conn->prepare(
                "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS " .
                "WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'admissions' " .
                "AND COLUMN_NAME = ?"
            );
            $columnCheck->execute([$columnName]);

            if ($columnCheck->fetchColumn() == 0) {
                $this->conn->exec("ALTER TABLE admissions ADD COLUMN $columnName $columnType");
            }
        }
    }

   public function updateAdmissionApprovalStatus($id, $status, $notes = '', $approvedBy = null, $paymentSchedule = null)
{
    try {

        // IMPORTANT:
        // When admin approves admission,
        // also move system status to 'admitted'
        $systemStatus = ($status === 'approved') ? 'admitted' : 'rejected';

        $fields = [
            'admin_approval_status = :status',
            'status = :system_status',
            'admin_approval_notes = :notes',
            'admin_approved_by = :approved_by',
            'admin_approved_at = NOW()'
        ];

        $params = [
            ':status' => $status,
            ':system_status' => $systemStatus,
            ':notes' => $notes,
            ':approved_by' => $approvedBy,
            ':id' => $id
        ];

        if ($paymentSchedule !== null) {
            $fields[] = 'admin_payment_schedule = :admin_payment_schedule';
            $params[':admin_payment_schedule'] = $paymentSchedule;
        }

        $query = "UPDATE admissions 
                  SET " . implode(', ', $fields) . ", 
                  updated_at = NOW() 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute($params);

    } catch (Exception $e) {

        error_log(
            'AdmissionModel::updateAdmissionApprovalStatus - ' 
            . $e->getMessage()
        );

        return false;
    }
}
}