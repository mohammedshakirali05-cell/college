<?php
/**
 * QUICK SETUP - Copy these 4 methods directly into your FeesController
 * 
 * Location: app/controllers/FeesController.php
 * 
 * Just paste these methods into the class (before the closing brace)
 */

// ============================================
// METHOD 1: Display Manage Installments Page
// ============================================
public function manageInstallments()
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: ' . BASE_URL . 'login?msg=unauthorized');
        exit();
    }

    $feeId = (int)($_GET['fee_id'] ?? 0);
    if (!$feeId) {
        header('Location: ' . BASE_URL . 'admin-fees&msg=invalid_fee');
        exit();
    }

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

    $query = "SELECT * FROM installment_payments 
              WHERE fee_id = :fee_id
              ORDER BY installment_number ASC";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':fee_id', $feeId, PDO::PARAM_INT);
    $stmt->execute();
    $installments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include __DIR__ . '/../views/admin/installments_management.php';
}

// ============================================
// METHOD 2: Mark Installment as Paid
// ============================================
public function markInstallmentAsPaid()
{
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

    $query = "SELECT * FROM installment_payments WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $installmentId, PDO::PARAM_INT);
    $stmt->execute();
    $installment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$installment) {
        header('Location: ' . BASE_URL . 'admin-fees&msg=installment_not_found');
        exit();
    }

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
        $this->recalculateFeeTotals($installment['fee_id']);
        header('Location: ' . BASE_URL . 'admin-manage-installments&fee_id=' . $installment['fee_id'] . '&msg=marked_paid');
        exit();
    }

    header('Location: ' . BASE_URL . 'admin-manage-installments&fee_id=' . $installment['fee_id'] . '&msg=error');
    exit();
}

// ============================================
// METHOD 3: Recalculate Fee Totals
// ============================================
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

// ============================================
// METHOD 4: Get Installments API (Optional)
// ============================================
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

// ============================================
// ROUTES TO ADD (in your routing file)
// ============================================

// If you use URL routing like ?url=...
/*
case 'admin-manage-installments':
    $controller = new FeesController($db);
    $controller->manageInstallments();
    break;

case 'admin-mark-installment-paid':
    $controller = new FeesController($db);
    $controller->markInstallmentAsPaid();
    break;

case 'api-get-installments':
    $controller = new FeesController($db);
    $controller->getInstallmentsAPI();
    break;
*/

// If you use a router (like FastRoute or custom Router class)
/*
$router->get('/admin-manage-installments', [FeesController::class, 'manageInstallments']);
$router->post('/admin-mark-installment-paid', [FeesController::class, 'markInstallmentAsPaid']);
$router->get('/api-get-installments', [FeesController::class, 'getInstallmentsAPI']);
*/
?>
