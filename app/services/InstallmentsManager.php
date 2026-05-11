<?php
/**
 * InstallmentsManager Service
 * Handles all installment-related operations
 * Works with fees_master table (installment_1 to installment_5 columns)
 */
class InstallmentsManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Get installment breakdown for a fee record
     * Returns array of installments with payment status
     */
    public function getInstallmentBreakdown($feeId)
    {
        $query = "SELECT 
                    id,
                    admission_id,
                    challan_no,
                    student_name,
                    course,
                    finalized_fees,
                    installment_1,
                    installment_2,
                    installment_3,
                    installment_4,
                    installment_5,
                    total_paid,
                    balance_fees,
                    fees_paid_date,
                    created_at
                  FROM fees_master 
                  WHERE id = :fee_id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
        $stmt->execute();
        $fee = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$fee) {
            return null;
        }

        // Get payment tracking record
        $paymentTracking = $this->getPaymentTracking($feeId);

        // Build installments array
        $installments = [];
        for ($i = 1; $i <= 5; $i++) {
            $installmentKey = "installment_$i";
            if ($fee[$installmentKey] > 0) {
                $status = $paymentTracking["installment_{$i}_status"] ?? 'pending';
                $paidDate = $paymentTracking["installment_{$i}_paid_date"] ?? null;

                $installments[] = [
                    'number' => $i,
                    'amount' => (float)$fee[$installmentKey],
                    'status' => $status,
                    'paid_date' => $paidDate,
                    'is_paid' => $status === 'paid'
                ];
            }
        }

        return [
            'fee_id' => $fee['id'],
            'challan_no' => $fee['challan_no'],
            'student_name' => $fee['student_name'],
            'course' => $fee['course'],
            'finalized_fees' => (float)$fee['finalized_fees'],
            'total_paid' => (float)$fee['total_paid'],
            'balance_fees' => (float)$fee['balance_fees'],
            'installments' => $installments,
            'all_paid' => (float)$fee['balance_fees'] <= 0
        ];
    }

    /**
     * Get payment tracking data for a fee
     */
    private function getPaymentTracking($feeId)
    {
        $query = "SELECT * FROM fee_installment_tracking WHERE fee_id = :fee_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    /**
     * Record installment payment
     */
    public function recordInstallmentPayment($feeId, $installmentNumber, $paymentData)
    {
        try {
            $this->db->beginTransaction();

            // Get current fee record
            $query = "SELECT * FROM fees_master WHERE id = :fee_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
            $stmt->execute();
            $fee = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$fee) {
                throw new Exception('Fee record not found');
            }

            $installmentKey = "installment_$installmentNumber";
            $installmentAmount = (float)$fee[$installmentKey];

            // Update tracking table
            $this->updatePaymentTracking($feeId, $installmentNumber, $paymentData);

            // Calculate total paid
            $totalPaid = (float)$fee['total_paid'] + $installmentAmount;
            $balanceFees = (float)$fee['finalized_fees'] - $totalPaid;
            $feesPaidDate = $balanceFees <= 0 ? date('Y-m-d') : $fee['fees_paid_date'];

            // Update fees_master record
            $updateQuery = "UPDATE fees_master 
                           SET total_paid = :total_paid,
                               balance_fees = :balance_fees,
                               fees_paid_date = :fees_paid_date,
                               updated_at = NOW()
                           WHERE id = :fee_id";
            
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->bindParam(':total_paid', $totalPaid);
            $updateStmt->bindParam(':balance_fees', $balanceFees);
            $updateStmt->bindParam(':fees_paid_date', $feesPaidDate);
            $updateStmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
            
            if (!$updateStmt->execute()) {
                throw new Exception('Failed to update fee record');
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    /**
     * Update payment tracking table
     */
    private function updatePaymentTracking($feeId, $installmentNumber, $paymentData)
    {
        // Check if tracking record exists
        $query = "SELECT id FROM fee_installment_tracking WHERE fee_id = :fee_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
        $stmt->execute();
        $exists = $stmt->fetch(PDO::FETCH_ASSOC);

        $statusField = "installment_{$installmentNumber}_status";
        $dateField = "installment_{$installmentNumber}_paid_date";
        $methodField = "installment_{$installmentNumber}_payment_method";
        $transactionField = "installment_{$installmentNumber}_transaction_id";

        if ($exists) {
            $updateQuery = "UPDATE fee_installment_tracking 
                           SET `$statusField` = :status,
                               `$dateField` = :paid_date,
                               `$methodField` = :payment_method,
                               `$transactionField` = :transaction_id,
                               updated_at = NOW()
                           WHERE fee_id = :fee_id";
            
            $updateStmt = $this->db->prepare($updateQuery);
        } else {
            $insertQuery = "INSERT INTO fee_installment_tracking 
                           (fee_id, `$statusField`, `$dateField`, `$methodField`, `$transactionField`, created_at, updated_at)
                           VALUES 
                           (:fee_id, :status, :paid_date, :payment_method, :transaction_id, NOW(), NOW())";
            
            $updateStmt = $this->db->prepare($insertQuery);
        }

        $updateStmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
        $updateStmt->bindParam(':status', 'paid');
        $updateStmt->bindParam(':paid_date', $paymentData['paid_date']);
        $updateStmt->bindParam(':payment_method', $paymentData['payment_method']);
        $updateStmt->bindParam(':transaction_id', $paymentData['transaction_id'] ?? '');

        return $updateStmt->execute();
    }

    /**
     * Ensure tracking table exists
     */
    public function ensureTrackingTableExists()
    {
        $query = "CREATE TABLE IF NOT EXISTS `fee_installment_tracking` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `fee_id` INT NOT NULL,
            
            `installment_1_status` ENUM('pending', 'paid', 'overdue') DEFAULT 'pending',
            `installment_1_paid_date` DATE NULL,
            `installment_1_payment_method` VARCHAR(50) NULL,
            `installment_1_transaction_id` VARCHAR(100) NULL,
            
            `installment_2_status` ENUM('pending', 'paid', 'overdue') DEFAULT 'pending',
            `installment_2_paid_date` DATE NULL,
            `installment_2_payment_method` VARCHAR(50) NULL,
            `installment_2_transaction_id` VARCHAR(100) NULL,
            
            `installment_3_status` ENUM('pending', 'paid', 'overdue') DEFAULT 'pending',
            `installment_3_paid_date` DATE NULL,
            `installment_3_payment_method` VARCHAR(50) NULL,
            `installment_3_transaction_id` VARCHAR(100) NULL,
            
            `installment_4_status` ENUM('pending', 'paid', 'overdue') DEFAULT 'pending',
            `installment_4_paid_date` DATE NULL,
            `installment_4_payment_method` VARCHAR(50) NULL,
            `installment_4_transaction_id` VARCHAR(100) NULL,
            
            `installment_5_status` ENUM('pending', 'paid', 'overdue') DEFAULT 'pending',
            `installment_5_paid_date` DATE NULL,
            `installment_5_payment_method` VARCHAR(50) NULL,
            `installment_5_transaction_id` VARCHAR(100) NULL,
            
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            
            PRIMARY KEY (`id`),
            UNIQUE KEY `unique_fee` (`fee_id`),
            FOREIGN KEY (`fee_id`) REFERENCES `fees_master`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        try {
            $this->db->exec($query);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get overall report with installment info
     */
    public function getOverallReportWithInstallments()
    {
        $query = "SELECT 
                    f.*,
                    a.full_name as candidate_name,
                    a.admission_number,
                    a.course_applied as course_applied,
                    a.email,
                    COALESCE(t.installment_1_status, 'pending') as inst1_status,
                    COALESCE(t.installment_2_status, 'pending') as inst2_status,
                    COALESCE(t.installment_3_status, 'pending') as inst3_status,
                    COALESCE(t.installment_4_status, 'pending') as inst4_status,
                    COALESCE(t.installment_5_status, 'pending') as inst5_status
                  FROM fees_master f
                  LEFT JOIN admissions a ON a.id = f.admission_id
                  LEFT JOIN fee_installment_tracking t ON t.fee_id = f.id
                  ORDER BY f.created_at DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get installment summary stats
     */
    public function getInstallmentStats($feeId)
    {
        $query = "SELECT 
                    COUNT(CASE WHEN installment_1 > 0 OR installment_2 > 0 OR installment_3 > 0 OR installment_4 > 0 OR installment_5 > 0 THEN 1 END) as total_installments,
                    COUNT(CASE WHEN t.installment_1_status = 'paid' OR t.installment_2_status = 'paid' OR t.installment_3_status = 'paid' OR t.installment_4_status = 'paid' OR t.installment_5_status = 'paid' THEN 1 END) as paid_count,
                    (SELECT COUNT(*) FROM fee_installment_tracking WHERE fee_id = :fee_id AND (installment_1_status = 'paid' OR installment_2_status = 'paid' OR installment_3_status = 'paid' OR installment_4_status = 'paid' OR installment_5_status = 'paid')) as actual_paid
                  FROM fees_master f
                  LEFT JOIN fee_installment_tracking t ON t.fee_id = f.id
                  WHERE f.id = :fee_id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
