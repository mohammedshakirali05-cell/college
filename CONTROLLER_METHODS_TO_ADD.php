<?php
/**
 * Add this method to your existing FeesController class
 * This handles the Admin Manage Installments functionality
 */

// Add this method to app/controllers/FeesController.php

public function manageInstallments()
{
    // Check if user is admin
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: ' . BASE_URL . 'login?msg=unauthorized');
        exit();
    }

    $feeId = (int)($_GET['fee_id'] ?? 0);
    if (!$feeId) {
        header('Location: ' . BASE_URL . 'admin-fees&msg=invalid_fee');
        exit();
    }

    // Get fee record
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

    // Get all installment payments for this fee
    $query = "SELECT * FROM installment_payments 
              WHERE fee_id = :fee_id
              ORDER BY installment_number ASC";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
    $stmt->execute();
    $installments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Include the view
    include __DIR__ . '/../views/admin/installments_management.php';
}

/**
 * Handle marking installment as paid (for admin)
 */
public function markInstallmentAsPaid()
{
    // Check authorization
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: ' . BASE_URL . 'login?msg=unauthorized');
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

    // Get installment data
    $query = "SELECT * FROM installment_payments WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $installmentId, PDO::PARAM_INT);
    $stmt->execute();
    $installment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$installment) {
        header('Location: ' . BASE_URL . 'admin-fees&msg=installment_not_found');
        exit();
    }

    // Update installment to paid
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
        // Recalculate fee totals
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
 * Get installments for specific fee ID (API endpoint)
 */
public function getInstallmentsAPI()
{
    if (!isset($_GET['fee_id'])) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'fee_id required']);
        exit();
    }

    $feeId = (int)$_GET['fee_id'];
    
    $query = "SELECT * FROM installment_payments 
              WHERE fee_id = :fee_id
              ORDER BY installment_number ASC";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
    $stmt->execute();
    $installments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($installments);
    exit();
}
?>
