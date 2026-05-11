<?php
/**
 * Installment Payment Processing Controller
 * Handles payment submission, validation, and receipt generation
 */

require_once __DIR__ . '/../models/InstallmentPaymentModel.php';
require_once __DIR__ . '/../helpers/ChallanHelper.php';

class PaymentProcessingController
{
    private $db;
    private $installmentModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->installmentModel = new InstallmentPaymentModel($db);
    }

    /**
     * Process installment payment submission
     */
    public function processPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin-fees&msg=invalid_request');
        }

        // Validate user is logged in
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('login?msg=session_expired');
        }

        $installmentId = (int)($_POST['installment_id'] ?? 0);
        $paymentMethod = trim($_POST['payment_method'] ?? '');
        $transactionId = trim($_POST['transaction_id'] ?? '');
        $paymentDate = trim($_POST['payment_date'] ?? date('Y-m-d'));

        // Validate inputs
        if (!$installmentId) {
            $this->redirect('my-fees&msg=invalid_installment');
        }

        if (!in_array($paymentMethod, ['online', 'bank_transfer', 'cheque', 'cash'])) {
            $this->redirect('my-fees&msg=invalid_payment_method');
        }

        if (empty($transactionId)) {
            $this->redirect('my-fees&msg=transaction_id_required');
        }

        // Get installment details
        $query = "SELECT ip.*, f.student_name, f.student_id, f.challan_no, f.finalized_fees
                  FROM installment_payments ip
                  JOIN fees_master f ON f.id = ip.fee_id
                  WHERE ip.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $installmentId, PDO::PARAM_INT);
        $stmt->execute();
        $installment = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$installment) {
            $this->redirect('my-fees&msg=installment_not_found');
        }

        // Check if already paid
        if ($installment['status'] === 'paid') {
            $this->redirect('my-fees&msg=already_paid');
        }

        // Process payment
        try {
            // Update installment payment record
            $updateQuery = "UPDATE installment_payments 
                          SET status = 'paid',
                              payment_date = :payment_date,
                              payment_method = :payment_method,
                              transaction_id = :transaction_id,
                              updated_at = NOW()
                          WHERE id = :id";

            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->execute([
                ':id' => $installmentId,
                ':payment_date' => $paymentDate,
                ':payment_method' => $paymentMethod,
                ':transaction_id' => $transactionId
            ]);

            // Update fees_master total_paid and balance_fees
            $this->updateFeesTotal($installment['fee_id']);

            // Generate receipt
            $this->generateReceipt($installmentId, $paymentMethod, $transactionId);

            // Redirect to success page
            $this->redirect('my-fees&msg=payment_success&receipt=' . $installmentId);

        } catch (Exception $e) {
            error_log('Payment Processing Error: ' . $e->getMessage());
            $this->redirect('my-fees&msg=payment_failed');
        }
    }

    /**
     * Update fees total paid and balance
     */
    private function updateFeesTotal($feeId)
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
                  )
                  WHERE id = :fee_id";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':fee_id' => $feeId]);
    }

    /**
     * Generate payment receipt
     */
    private function generateReceipt($installmentId, $paymentMethod, $transactionId)
    {
        $query = "SELECT ip.*, f.student_name, f.student_id, f.challan_no, f.finalized_fees
                  FROM installment_payments ip
                  JOIN fees_master f ON f.id = ip.fee_id
                  WHERE ip.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $installmentId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return;

        // Create receipt in session/database
        $_SESSION['receipt_data'] = [
            'receipt_id' => 'RCP' . date('YmdHis'),
            'installment_id' => $installmentId,
            'student_name' => $data['student_name'],
            'student_id' => $data['student_id'],
            'challan_no' => $data['challan_no'],
            'installment_number' => $data['installment_number'],
            'amount' => $data['installment_amount'],
            'payment_method' => $paymentMethod,
            'transaction_id' => $transactionId,
            'payment_date' => date('Y-m-d H:i:s'),
            'due_date' => $data['due_date'],
            'total_fees' => $data['finalized_fees'],
        ];

        // Optional: Store in database for audit trail
        $insertQuery = "INSERT INTO payment_receipts 
                       (receipt_number, installment_id, fee_id, student_id, amount, 
                        payment_method, transaction_id, receipt_date)
                       VALUES (:receipt_num, :installment_id, :fee_id, :student_id, 
                               :amount, :payment_method, :transaction_id, NOW())";

        $insertStmt = $this->db->prepare($insertQuery);
        $insertStmt->execute([
            ':receipt_num' => 'RCP' . date('YmdHis'),
            ':installment_id' => $installmentId,
            ':fee_id' => $data['fee_id'],
            ':student_id' => $data['student_id'],
            ':amount' => $data['installment_amount'],
            ':payment_method' => $paymentMethod,
            ':transaction_id' => $transactionId
        ]);
    }

    /**
     * Display payment receipt
     */
    public function viewReceipt()
    {
        $installmentId = (int)($_GET['id'] ?? 0);

        if (!$installmentId) {
            $this->redirect('my-fees');
        }

        $query = "SELECT ip.*, f.student_name, f.student_id, f.challan_no, f.finalized_fees,
                         (SELECT COUNT(*) FROM installment_payments WHERE fee_id = f.id AND status = 'paid') as paid_count,
                         (SELECT SUM(installment_amount) FROM installment_payments WHERE fee_id = f.id AND status = 'paid') as total_paid
                  FROM installment_payments ip
                  JOIN fees_master f ON f.id = ip.fee_id
                  WHERE ip.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $installmentId, PDO::PARAM_INT);
        $stmt->execute();
        $receipt = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$receipt) {
            $this->redirect('my-fees&msg=receipt_not_found');
        }

        include __DIR__ . '/../views/student/payment_receipt.php';
    }

    /**
     * Download receipt as PDF
     */
    public function downloadReceipt()
    {
        $installmentId = (int)($_GET['id'] ?? 0);

        if (!$installmentId) {
            $this->redirect('my-fees');
        }

        $query = "SELECT ip.*, f.student_name, f.student_id, f.challan_no
                  FROM installment_payments ip
                  JOIN fees_master f ON f.id = ip.fee_id
                  WHERE ip.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $installmentId, PDO::PARAM_INT);
        $stmt->execute();
        $receipt = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$receipt) {
            $this->redirect('my-fees');
        }

        // Generate simple text file for download
        $filename = 'receipt_' . $receipt['student_id'] . '_inst' . $receipt['installment_number'] . '.txt';
        
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        echo "INSTALLMENT PAYMENT RECEIPT\n";
        echo "=" . str_repeat("=", 50) . "\n\n";
        echo "Receipt Date: " . date('d-m-Y H:i') . "\n";
        echo "Student Name: " . $receipt['student_name'] . "\n";
        echo "Student ID: " . $receipt['student_id'] . "\n";
        echo "Challan No: " . $receipt['challan_no'] . "\n\n";
        echo "Installment Number: " . $receipt['installment_number'] . "\n";
        echo "Amount Paid: ₹" . number_format($receipt['installment_amount'], 2) . "\n";
        echo "Payment Method: " . ucfirst($receipt['payment_method']) . "\n";
        echo "Transaction ID: " . $receipt['transaction_id'] . "\n";
        echo "Payment Date: " . date('d-m-Y', strtotime($receipt['payment_date'])) . "\n\n";
        echo "Status: PAID\n";
        echo "=" . str_repeat("=", 50) . "\n";
        
        exit();
    }

    /**
     * Print installment challan
     */
    public function printChallan()
    {
        $installmentId = (int)($_GET['id'] ?? 0);

        if (!$installmentId) {
            die('Invalid installment ID');
        }

        $query = "SELECT ip.*, f.*, 
                         (SELECT COUNT(*) FROM installment_payments WHERE fee_id = f.id AND status = 'paid') as paid_count,
                         (SELECT SUM(installment_amount) FROM installment_payments WHERE fee_id = f.id AND status = 'paid') as total_paid
                  FROM installment_payments ip
                  JOIN fees_master f ON f.id = ip.fee_id
                  WHERE ip.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $installmentId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            die('Installment not found');
        }

        include __DIR__ . '/../views/student/installment_challan_print.php';
    }

    /**
     * Helper: Redirect
     */
    private function redirect($url)
    {
        header('Location: ' . BASE_URL . $url);
        exit();
    }

    /**
     * Get payment statistics
     */
    public function getPaymentStats()
    {
        $query = "SELECT 
                    COUNT(*) as total_payments,
                    SUM(CASE WHEN status = 'paid' THEN 1 ELSE 0 END) as paid_payments,
                    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_payments,
                    SUM(CASE WHEN status = 'paid' THEN installment_amount ELSE 0 END) as total_amount_paid,
                    SUM(CASE WHEN status = 'pending' THEN installment_amount ELSE 0 END) as total_amount_pending
                  FROM installment_payments";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get overdue payments
     */
    public function getOverduePayments()
    {
        $query = "SELECT ip.*, f.student_name, f.student_id, f.challan_no,
                         DATEDIFF(NOW(), ip.due_date) as days_overdue
                  FROM installment_payments ip
                  JOIN fees_master f ON f.id = ip.fee_id
                  WHERE ip.status = 'pending' AND ip.due_date < NOW()
                  ORDER BY ip.due_date ASC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Send payment reminder
     */
    public function sendPaymentReminder($installmentId)
    {
        $query = "SELECT ip.*, f.student_name, f.student_id, u.email
                  FROM installment_payments ip
                  JOIN fees_master f ON f.id = ip.fee_id
                  JOIN admissions a ON a.id = f.admission_id
                  JOIN users u ON u.id = a.user_id
                  WHERE ip.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $installmentId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data || !$data['email']) {
            return false;
        }

        // Send email reminder
        $subject = "Payment Reminder - Installment #{$data['installment_number']}";
        $dueDate = date('d-m-Y', strtotime($data['due_date']));
        $amount = number_format($data['installment_amount'], 2);

        $message = "Dear {$data['student_name']},\n\n";
        $message .= "This is a reminder that Installment #{$data['installment_number']} ";
        $message .= "of ₹{$amount} is due on {$dueDate}.\n\n";
        $message .= "Please complete the payment before the due date.\n\n";
        $message .= "Best regards,\nCollege Administration";

        mail($data['email'], $subject, $message);

        return true;
    }
}
?>
