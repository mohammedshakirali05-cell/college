<?php
class FeesModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->ensureFeesTableExists();
        $this->ensureInstallmentsTableExists();
    }

    private function ensureFeesTableExists()
    {
        $query = "CREATE TABLE IF NOT EXISTS fees_master (
            id INT NOT NULL AUTO_INCREMENT,
            admission_id INT NULL,
            challan_no VARCHAR(80) NOT NULL,
            student_name VARCHAR(255) NOT NULL,
            student_id VARCHAR(100) NULL,
            course VARCHAR(100) NULL,
            academic_year VARCHAR(30) NULL,
            college_total_fees DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            has_concession ENUM('yes','no') NOT NULL DEFAULT 'no',
            concession_member_name VARCHAR(255) NULL,
            concession_date DATE NULL,
            concession_fees DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            finalized_fees DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            total_paid DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            balance_fees DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            fees_paid_date DATE NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY unique_challan (challan_no),
            INDEX idx_admission_id (admission_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        $this->conn->exec($query);
    }

    private function ensureInstallmentsTableExists()
    {
        $query = "CREATE TABLE IF NOT EXISTS fee_installments (
            id INT NOT NULL AUTO_INCREMENT,
            fee_id INT NOT NULL,
            installment_no INT NOT NULL,
            amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            paid_date DATE NOT NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX idx_fee_id (fee_id),
            CONSTRAINT fk_fee_installments_fee
                FOREIGN KEY (fee_id) REFERENCES fees_master(id)
                ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        $this->conn->exec($query);
    }

    public function getAdmittedAdmissionsWithoutFees()
    {
        $query = "SELECT a.* FROM admissions a
            LEFT JOIN fees_master f ON f.admission_id = a.id
            WHERE a.status = 'admitted' AND f.id IS NULL
            ORDER BY a.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllFees()
    {
        $query = "SELECT f.*, a.full_name, a.admission_number, a.status
            FROM fees_master f
            LEFT JOIN admissions a ON a.id = f.admission_id
            ORDER BY f.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFeesByAdmissionId($admissionId)
    {
        $query = "SELECT * FROM fees_master WHERE admission_id = :admission_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':admission_id', $admissionId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getInstallmentsByFeeId($feeId)
    {
        $query = "SELECT * FROM fee_installments WHERE fee_id = :fee_id ORDER BY installment_no ASC, paid_date ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':fee_id', $feeId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createFeesForAdmission($admissionId, array $data)
    {
        $query = "INSERT INTO fees_master (
            admission_id, challan_no, student_name, student_id, course, academic_year,
            college_total_fees, has_concession, concession_member_name, concession_date,
            concession_fees, finalized_fees, total_paid, balance_fees, fees_paid_date
        ) VALUES (
            :admission_id, :challan_no, :student_name, :student_id, :course, :academic_year,
            :college_total_fees, :has_concession, :concession_member_name, :concession_date,
            :concession_fees, :finalized_fees, :total_paid, :balance_fees, :fees_paid_date
        )";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':admission_id' => $admissionId,
            ':challan_no' => $data['challan_no'],
            ':student_name' => $data['student_name'],
            ':student_id' => $data['student_id'],
            ':course' => $data['course'],
            ':academic_year' => $data['academic_year'],
            ':college_total_fees' => $data['college_total_fees'],
            ':has_concession' => $data['has_concession'],
            ':concession_member_name' => $data['concession_member_name'],
            ':concession_date' => $data['concession_date'] ?: null,
            ':concession_fees' => $data['concession_fees'],
            ':finalized_fees' => $data['finalized_fees'],
            ':total_paid' => 0,
            ':balance_fees' => $data['finalized_fees'],
            ':fees_paid_date' => null,
        ]);

        return $this->conn->lastInsertId();
    }

    public function addInstallment($feeId, $amount, $paidDate)
    {
        $installmentNo = $this->getNextInstallmentNo($feeId);

        $query = "INSERT INTO fee_installments (fee_id, installment_no, amount, paid_date)
                  VALUES (:fee_id, :installment_no, :amount, :paid_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':fee_id' => $feeId,
            ':installment_no' => $installmentNo,
            ':amount' => $amount,
            ':paid_date' => $paidDate,
        ]);

        $this->recalculateFeeTotals($feeId);
        return true;
    }

    public function getNextInstallmentNo($feeId)
    {
        $stmt = $this->conn->prepare("SELECT COALESCE(MAX(installment_no), 0) + 1 FROM fee_installments WHERE fee_id = :fee_id");
        $stmt->bindValue(':fee_id', $feeId, PDO::PARAM_INT);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function recalculateFeeTotals($feeId)
    {
        $query = "SELECT finalized_fees FROM fees_master WHERE id = :fee_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':fee_id', $feeId, PDO::PARAM_INT);
        $stmt->execute();
        $fee = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$fee) {
            return false;
        }

        $stmt = $this->conn->prepare("SELECT COALESCE(SUM(amount), 0) FROM fee_installments WHERE fee_id = :fee_id");
        $stmt->bindValue(':fee_id', $feeId, PDO::PARAM_INT);
        $stmt->execute();

        $totalPaid = (float)$stmt->fetchColumn();
        $balance = max(0, (float)$fee['finalized_fees'] - $totalPaid);

        $stmt = $this->conn->prepare("
            UPDATE fees_master
            SET total_paid = :total_paid,
                balance_fees = :balance_fees,
                fees_paid_date = CURDATE()
            WHERE id = :fee_id
        ");

        return $stmt->execute([
            ':total_paid' => $totalPaid,
            ':balance_fees' => $balance,
            ':fee_id' => $feeId,
        ]);
    }

    public function getOverallReport()
    {
        $query = "SELECT f.*, a.admission_number, a.full_name AS candidate_name
            FROM fees_master f
            LEFT JOIN admissions a ON a.id = f.admission_id
            ORDER BY f.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}