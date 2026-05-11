<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $challan_no = $_POST['challan_no'] ?? '';
    $student_name = trim($_POST['student_name'] ?? '');
    $student_id = trim($_POST['student_id'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $academic_year = trim($_POST['academic_year'] ?? '');
    $college_total_fees = (float)($_POST['college_total_fees'] ?? 0);
    $has_concession = $_POST['has_concession'] ?? 'no';
    $concession_member_name = trim($_POST['concession_member_name'] ?? '');
    $concession_date = $_POST['concession_date'] ?? null;
    $concession_fees = (float)($_POST['concession_fees'] ?? 0);
    $finalized_fees = (float)($_POST['finalized_fees'] ?? 0);
    $installment_1 = (float)($_POST['installment_1'] ?? 0);
    $installment_2 = (float)($_POST['installment_2'] ?? 0);
    $installment_3 = (float)($_POST['installment_3'] ?? 0);
    $installment_4 = (float)($_POST['installment_4'] ?? 0);
    $installment_5 = (float)($_POST['installment_5'] ?? 0);
    $fees_paid_date = $_POST['fees_paid_date'] ?? null;

    if ($has_concession !== 'yes') {
        $concession_member_name = null;
        $concession_date = null;
        $concession_fees = 0;
    }

    if ($concession_fees > $college_total_fees) {
        die('Invalid data: concession fees cannot exceed total fees.');
    }

    $total_paid = $installment_1 + $installment_2 + $installment_3 + $installment_4 + $installment_5;
    $balance_fees = $finalized_fees - $total_paid;
    if ($balance_fees < 0) {
        die('Invalid data: installment total cannot exceed finalized fees.');
    }

    $sql = "INSERT INTO fees_master (
        challan_no, student_name, student_id, course, academic_year,
        college_total_fees, has_concession, concession_member_name, concession_date,
        concession_fees, finalized_fees,
        installment_1, installment_2, installment_3, installment_4, installment_5,
        total_paid, balance_fees, fees_paid_date
    ) VALUES (
        :challan_no, :student_name, :student_id, :course, :academic_year,
        :college_total_fees, :has_concession, :concession_member_name, :concession_date,
        :concession_fees, :finalized_fees,
        :installment_1, :installment_2, :installment_3, :installment_4, :installment_5,
        :total_paid, :balance_fees, :fees_paid_date
    )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':challan_no' => $challan_no,
        ':student_name' => $student_name,
        ':student_id' => $student_id,
        ':course' => $course,
        ':academic_year' => $academic_year,
        ':college_total_fees' => $college_total_fees,
        ':has_concession' => $has_concession,
        ':concession_member_name' => $concession_member_name,
        ':concession_date' => $concession_date ?: null,
        ':concession_fees' => $concession_fees,
        ':finalized_fees' => $finalized_fees,
        ':installment_1' => $installment_1,
        ':installment_2' => $installment_2,
        ':installment_3' => $installment_3,
        ':installment_4' => $installment_4,
        ':installment_5' => $installment_5,
        ':total_paid' => $total_paid,
        ':balance_fees' => $balance_fees,
        ':fees_paid_date' => $fees_paid_date ?: null,
    ]);

    header('Location: fees_form.php?success=1');
    exit;
}
?>