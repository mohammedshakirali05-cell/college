<?php
require_once __DIR__ . '/../helpers/ChallanHelper.php';

class ChallanController
{
    private $feesModel;
    private $admissionModel;

    public function __construct($db)
    {
        $this->feesModel = new FeesModel($db);
        $this->db = $db;
    }

    /**
     * Display challan for a specific fee record
     */
    public function displayChallan()
    {
        $challanNo = trim($_GET['challan'] ?? '');
        $feeId = (int)($_GET['fee_id'] ?? 0);
        $installment = (int)($_GET['installment'] ?? 0);

        if (!$challanNo && !$feeId) {
            header('Location: ' . BASE_URL . 'student-dashboard');
            exit();
        }

        // Fetch fee record
        $fee = null;
        if ($feeId) {
            $query = "SELECT f.*, a.full_name, a.admission_number, a.course, a.academic_year 
                      FROM fees_master f
                      LEFT JOIN admissions a ON a.id = f.admission_id
                      WHERE f.id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $feeId, PDO::PARAM_INT);
            $stmt->execute();
            $fee = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $query = "SELECT f.*, a.full_name, a.admission_number, a.course, a.academic_year 
                      FROM fees_master f
                      LEFT JOIN admissions a ON a.id = f.admission_id
                      WHERE f.challan_no = :challan_no";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':challan_no', $challanNo);
            $stmt->execute();
            $fee = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if (!$fee) {
            header('Location: ' . BASE_URL . 'student-dashboard&msg=challan_not_found');
            exit();
        }

        // Get installment amount if specified
        $amount = (float)$fee['finalized_fees'];
        $installmentLabel = '';
        if ($installment > 0 && $installment <= 5) {
            $installmentField = 'installment_' . $installment;
            $amount = (float)($fee[$installmentField] ?? $fee['finalized_fees']);
            $installmentLabel = 'Installment ' . $installment;
        }

        // Prepare challan data with program from fees_master.course
        $challanData = [
            'challan_no' => $fee['challan_no'],
            'student_name' => $fee['full_name'],
            'admission_number' => $fee['admission_number'],
            'course' => $fee['course'] ?? 'BBA',
            'program' => $fee['course'] ?? 'BBA',
            'academic_year' => $fee['academic_year'] ?? date('Y') . '-' . (date('Y') + 1),
            'amount_figures' => $amount,
            'amount_words' => ChallanHelper::numberToWords($amount),
            'installment_label' => $installmentLabel,
            'date' => date('d-m-Y', strtotime($fee['created_at'])),
            'class' => $fee['course'] ?? 'BBA',
        ];

        include __DIR__ . '/../views/public/challan.php';
    }

    /**
     * Generate challan after fees submission
     */
    public function generateChallan($admissionId, $feesData)
    {
        // This is called from FeesController after fees are saved
        // Returns challan number and redirects user
        $query = "SELECT id, challan_no FROM fees_master WHERE admission_id = :admission_id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':admission_id', $admissionId, PDO::PARAM_INT);
        $stmt->execute();
        $fee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fee) {
            return $fee['challan_no'];
        }
        return null;
    }
}
