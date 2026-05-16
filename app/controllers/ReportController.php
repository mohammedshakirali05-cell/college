<?php
require_once __DIR__ . '/../models/AdmissionModel.php';

class ReportController
{
    private $db;
    private $feesModel;
    private $admissionModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->feesModel = new FeesModel($db);
        $this->admissionModel = new AdmissionModel($db);
    }

    public function overallReport()
    {
        $reportRows = $this->feesModel->getOverallReport();
        $students = $this->fetchEnhancedStudentRows();
        
        $reportSummary = [
            'total_records' => count($reportRows),
            'total_finalized' => 0.0,
            'total_paid' => 0.0,
            'total_balance' => 0.0,
            'paid_count' => 0,
            'pending_count' => 0,
        ];

        foreach ($reportRows as $row) {
            $reportSummary['total_finalized'] += (float)$row['finalized_fees'];
            $reportSummary['total_paid'] += (float)$row['total_paid'];
            $reportSummary['total_balance'] += (float)$row['balance_fees'];
            if ((float)$row['balance_fees'] <= 0) {
                $reportSummary['paid_count']++;
            } else {
                $reportSummary['pending_count']++;
            }
        }

        include __DIR__ . '/../views/admin/reports.php';
    }

    /**
     * Fetch enhanced student rows with detailed fee and admission information
     */
    private function fetchEnhancedStudentRows()
    {
        $query = "SELECT 
                    a.id AS admission_id,
                    a.admission_number,
                    a.full_name,
                    a.father_name,
                    a.mobile_no,
                    a.email,
                    a.course_applied AS course,
                    a.admission_type AS class,
                    a.status AS admission_status,
                    f.id AS fee_id,
                    f.college_total_fees AS total_fees,
                    f.concession_fees,
                    f.finalized_fees,
                    f.total_paid AS paid_fees,
                    f.balance_fees AS pending_fees,
                    f.challan_no,
                    f.student_id AS student_identifier,
                    CASE 
                        WHEN f.balance_fees <= 0 AND f.id IS NOT NULL THEN 'Paid'
                        WHEN f.total_paid > 0 AND f.balance_fees > 0 THEN 'Part Paid'
                        WHEN f.total_paid = 0 AND f.id IS NOT NULL THEN 'Pending'
                        ELSE 'No Fees'
                    END AS fee_status
                FROM admissions a
                LEFT JOIN fees_master f ON f.admission_id = a.id
                ORDER BY a.created_at DESC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as &$row) {
            $feeId = (int)($row['fee_id'] ?? 0);
            $row['class_label'] = $this->mapClassLabel($row['class']);
            $row['student_id'] = $row['student_identifier'] ?: $row['admission_number'];
            $row['installments'] = $feeId ? $this->feesModel->getInstallmentsByFeeId($feeId) : [];
            $row['parent_name'] = $row['father_name'] ?: 'N/A';
            $row['contact_email'] = $row['email'] ?: 'N/A';
            $row['contact_mobile'] = $row['mobile_no'] ?: 'N/A';
            $row['course'] = $row['course'] ?: 'N/A';
            $row['pending_fees'] = (float)($row['pending_fees'] ?? 0);
            $row['paid_fees'] = (float)($row['paid_fees'] ?? 0);
            $row['total_fees'] = (float)($row['total_fees'] ?? 0);
            $row['concession_fees'] = (float)($row['concession_fees'] ?? 0);
            $row['finalized_fees'] = (float)($row['finalized_fees'] ?? 0);
        }

        return $rows;
    }

    /**
     * Handle installment submission from Reports page
     */
    public function submitReportsInstallment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirectTo('reports');
        }

        $feeId = (int)($_POST['fee_id'] ?? 0);
        $amount = (float)($_POST['amount'] ?? 0);
        $paidDate = trim($_POST['paid_date'] ?? '');
        $paymentMode = trim($_POST['payment_mode'] ?? 'cash');
        $receiptNumber = trim($_POST['receipt_number'] ?? '');
        $notes = trim($_POST['notes'] ?? '');

        if ($feeId <= 0 || $amount <= 0) {
            redirectTo('reports&msg=installment_invalid');
        }

        $fee = $this->feesModel->getFeeById($feeId);
        if (!$fee || (float)$amount > (float)$fee['balance_fees']) {
            redirectTo('reports&msg=installment_invalid');
        }

        $this->feesModel->addInstallment(
            $feeId, 
            $amount, 
            $paidDate ?: date('Y-m-d'), 
            $paymentMode, 
            $receiptNumber, 
            $notes
        );

        // Redirect to challan page with the paid amount
        redirectTo('view-challan&fee_id=' . $feeId . '&paid_amount=' . $amount . '&msg=installment_saved');
    }

    /**
     * Map class/admission type labels
     */
    private function mapClassLabel($class)
    {
        if (!$class) {
            return 'N/A';
        }

        if ($class === 'transfer') {
            return 'Transfer';
        }

        if ($class === 'first_year') {
            return 'First Year';
        }

        return ucfirst(str_replace('_', ' ', $class));
    }
}
