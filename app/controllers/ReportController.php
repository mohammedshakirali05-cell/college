<?php
class ReportController
{
    private $feesModel;

    public function __construct($db)
    {
        $this->feesModel = new FeesModel($db);
    }

    public function overallReport()
    {
        $reportRows = $this->feesModel->getOverallReport();
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
}
