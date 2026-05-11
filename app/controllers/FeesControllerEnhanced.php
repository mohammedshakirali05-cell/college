<?php
/**
 * Enhanced FeesController with Installments Integration
 * 
 * This controller now automatically creates installment records
 * when fees are issued for a student
 */

require_once __DIR__ . '/../helpers/ChallanHelper.php';
require_once __DIR__ . '/../models/InstallmentPaymentModel.php';

class FeesControllerEnhanced extends FeesController
{
    private $installmentModel;

    public function __construct($db)
    {
        parent::__construct($db);
        $this->installmentModel = new InstallmentPaymentModel($db);
    }

    /**
     * Enhanced submitFees with automatic installment creation
     */
    public function submitFeesWithInstallments()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin-fees');
            exit();
        }

        $admissionId = (int)($_POST['admission_id'] ?? 0);
        if ($admissionId <= 0) {
            header('Location: ' . BASE_URL . 'admin-fees&msg=invalid_submission');
            exit();
        }

        $admission = $this->admissionModel->getAdmissionById($admissionId);
        if (!$admission || $admission['status'] !== 'admitted') {
            header('Location: ' . BASE_URL . 'admin-fees&msg=invalid_admission');
            exit();
        }

        if ($this->feesModel->getFeesByAdmissionId($admissionId)) {
            header('Location: ' . BASE_URL . 'admin-fees&msg=fees_exists');
            exit();
        }

        // Get and validate POST data
        $collegeTotalFees = (float)($_POST['college_total_fees'] ?? 0);
        $hasConcession = $_POST['has_concession'] ?? 'no';
        $concessionMemberName = trim($_POST['concession_member_name'] ?? '');
        $concessionDate = trim($_POST['concession_date'] ?? '');
        $concessionFees = (float)($_POST['concession_fees'] ?? 0);
        $finalizedFees = (float)($_POST['finalized_fees'] ?? 0);

        $installments = [];
        for ($i = 1; $i <= 5; $i++) {
            $installments[$i] = (float)($_POST["installment_$i"] ?? 0);
        }

        $feesPaidDate = trim($_POST['fees_paid_date'] ?? '');
        $studentName = trim($_POST['student_name'] ?? $admission['full_name']);
        $studentId = trim($_POST['student_id'] ?? $admission['admission_number']);
        $course = trim($_POST['course'] ?? '');
        $academicYear = trim($_POST['academic_year'] ?? '');
        $challanNo = trim($_POST['challan_no'] ?? '');

        // Auto-generate challan if not provided
        if (!$challanNo) {
            $challanNo = ChallanHelper::generateChallanNumber($this->db);
        }

        // Validate concession
        if ($hasConcession !== 'yes') {
            $concessionFees = 0;
            $concessionMemberName = null;
            $concessionDate = null;
        }

        if ($concessionFees > $collegeTotalFees) {
            header('Location: ' . BASE_URL . 'admin-fees-create&id=' . $admissionId . '&msg=invalid_concession');
            exit();
        }

        // Validate installments
        $totalPaid = array_sum($installments);
        $balanceFees = $finalizedFees - $totalPaid;
        if ($balanceFees < 0) {
            header('Location: ' . BASE_URL . 'admin-fees-create&id=' . $admissionId . '&msg=invalid_installments');
            exit();
        }

        // Create fees record
        $created = $this->feesModel->createFeesForAdmission($admissionId, [
            'challan_no' => $challanNo,
            'student_name' => $studentName,
            'student_id' => $studentId,
            'course' => $course,
            'academic_year' => $academicYear,
            'college_total_fees' => $collegeTotalFees,
            'has_concession' => $hasConcession,
            'concession_member_name' => $concessionMemberName,
            'concession_date' => $concessionDate,
            'concession_fees' => $concessionFees,
            'finalized_fees' => $finalizedFees,
            'installment_1' => $installments[1],
            'installment_2' => $installments[2],
            'installment_3' => $installments[3],
            'installment_4' => $installments[4],
            'installment_5' => $installments[5],
            'total_paid' => $totalPaid,
            'balance_fees' => $balanceFees,
            'fees_paid_date' => $feesPaidDate,
        ]);

        if ($created) {
            // Get the created fee record
            $feeRecord = $this->feesModel->getFeesByAdmissionId($admissionId);

            // 🎯 AUTO-CREATE INSTALLMENT PAYMENTS
            $this->createInstallmentsForFee($feeRecord, $admission);

            // Redirect to challan view
            header('Location: ' . BASE_URL . 'view-challan&challan=' . urlencode($challanNo) . '&msg=fees_created_with_installments');
            exit();
        }

        header('Location: ' . BASE_URL . 'admin-fees&msg=save_failed');
        exit();
    }

    /**
     * Auto-create installment payment records
     */
    private function createInstallmentsForFee($feeRecord, $admission)
    {
        $baseDate = new DateTime(date('Y-m-d'));
        
        // Create installment records for each non-zero installment
        for ($i = 1; $i <= 5; $i++) {
            $amount = (float)$feeRecord["installment_$i"];
            
            if ($amount > 0) {
                // Due date calculation: 0 days for 1st, then ~75 days (~2.5 months) for each subsequent
                $daysToAdd = ($i - 1) * 75;
                $dueDate = clone $baseDate;
                $dueDate->add(new DateInterval("P{$daysToAdd}D"));

                // Insert installment payment record
                $query = "INSERT INTO installment_payments 
                        (fee_id, student_id, admission_number, installment_number, 
                         installment_amount, due_date, status)
                        VALUES (:fee_id, :student_id, :admission_number, :installment_number,
                                :installment_amount, :due_date, :status)
                        ON DUPLICATE KEY UPDATE updated_at = NOW()";

                $stmt = $this->db->prepare($query);
                $stmt->execute([
                    ':fee_id' => $feeRecord['id'],
                    ':student_id' => $admission['id'],
                    ':admission_number' => $feeRecord['student_id'],
                    ':installment_number' => $i,
                    ':installment_amount' => $amount,
                    ':due_date' => $dueDate->format('Y-m-d'),
                    ':status' => 'pending'
                ]);
            }
        }
    }

    /**
     * List fees with installment data
     */
    public function listFeesWithInstallments()
    {
        // Get pending admissions
        $pendingAdmissions = $this->feesModel->getAdmittedAdmissionsWithoutFees();
        
        // Get all fees
        $fees = $this->feesModel->getAllFees();
        
        // Get all installments
        $allInstallments = [];
        $query = "SELECT ip.*, f.student_name, f.challan_no 
                  FROM installment_payments ip
                  LEFT JOIN fees_master f ON f.id = ip.fee_id
                  ORDER BY ip.created_at DESC
                  LIMIT 500";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $allInstallments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Use the integrated view
        include __DIR__ . '/../views/admin/fees_integrated.php';
    }

    /**
     * Show enhanced fee creation form
     */
    public function showCreateFeesFormEnhanced()
    {
        $admissionId = (int)($_GET['id'] ?? 0);
        if ($admissionId <= 0) {
            header('Location: ' . BASE_URL . 'admin-fees&msg=invalid_admission');
            exit();
        }

        $admission = $this->admissionModel->getAdmissionById($admissionId);
        if (!$admission || $admission['status'] !== 'admitted') {
            header('Location: ' . BASE_URL . 'admin-fees&msg=not_admitted');
            exit();
        }

        $existingFee = $this->feesModel->getFeesByAdmissionId($admissionId);
        if ($existingFee) {
            header('Location: ' . BASE_URL . 'admin-fees&msg=fees_exists');
            exit();
        }

        // Use the integrated form view
        include __DIR__ . '/../views/admin/fee_form_integrated.php';
    }

    /**
     * Get fees with installment summary
     */
    public function getFeesWithInstallmentSummary($feeId)
    {
        $query = "SELECT f.*, 
                         (SELECT COUNT(*) FROM installment_payments WHERE fee_id = f.id) as total_installments,
                         (SELECT COUNT(*) FROM installment_payments WHERE fee_id = f.id AND status = 'paid') as paid_installments,
                         (SELECT SUM(installment_amount) FROM installment_payments WHERE fee_id = f.id AND status = 'paid') as installment_paid,
                         (SELECT SUM(installment_amount) FROM installment_payments WHERE fee_id = f.id AND status = 'pending') as installment_pending
                  FROM fees_master f
                  WHERE f.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $feeId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Export fees with installment report
     */
    public function generateCollectionReport()
    {
        $query = "SELECT 
                    f.challan_no,
                    f.student_name,
                    f.student_id,
                    f.finalized_fees,
                    COUNT(ip.id) as total_installments,
                    SUM(CASE WHEN ip.status = 'paid' THEN 1 ELSE 0 END) as paid_count,
                    SUM(CASE WHEN ip.status = 'pending' THEN 1 ELSE 0 END) as pending_count,
                    SUM(CASE WHEN ip.status = 'paid' THEN ip.installment_amount ELSE 0 END) as total_paid,
                    SUM(CASE WHEN ip.status = 'pending' THEN ip.installment_amount ELSE 0 END) as total_pending
                  FROM fees_master f
                  LEFT JOIN installment_payments ip ON ip.fee_id = f.id
                  GROUP BY f.id
                  ORDER BY f.created_at DESC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
