<?php
include 'database.php';
<button class="btn btn-primary" onclick="window.location.href='fees_form.php'">
    Open Fees Module
</button>
function generateChallanNo() {
    return 'NBBACOL-' . date('Ymd') . '-' . rand(1000, 9999);
}

$challan_no = generateChallanNo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #eef2ff, #f8fafc, #ecfeff);
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }
         .page-wrap {
            padding: 30px 12px;
        }
        .fees-card {
            max-width: 1200px;
            margin: auto;
            border: 0;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.12);
            background: #fff;
        }
        .fees-header {
            background: linear-gradient(135deg, #0f172a, #1e293b, #334155);
            color: #fff;
            padding: 28px;
        }
        .fees-header h2 {
            font-weight: 700;
            margin-bottom: 6px;
        }
        .fees-header p {
            margin-bottom: 0;
            color: #cbd5e1;
        }
        .section-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            padding: 22px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
        }
        .section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 18px;
            color: #0f172a;
        }
        .form-label {
            font-weight: 600;
            color: #334155;
        }
        .form-control, .form-select {
            border-radius: 14px;
            min-height: 46px;
        }
        .readonly-box {
            min-height: 46px;
            display: flex;
             align-items: center;
            border-radius: 14px;
            padding: 0 14px;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            font-weight: 700;
        }
        .summary-chip {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 999px;
            padding: 10px 16px;
            display: inline-block;
            margin-top: 10px;
            margin-right: 10px;
            font-size: 14px;
        }
        .installment-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 16px;
            height: 100%;
        }
        .btn-main {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
            border: 0;
            border-radius: 14px;
            padding: 12px 20px;
            font-weight: 600;
        }
        .btn-main:hover {
            color: #fff;
            opacity: 0.95;
        }
        .btn-print {
            border-radius: 14px;
            padding: 12px 20px;
            font-weight: 600;
        }
        .concession-wrap {
            display: none;
        }
        .small-note {
            color: #64748b;
            font-size: 13px;
        }
         @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: #fff !important;
            }
            .fees-card {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
<div class="page-wrap">
    <div class="fees-card">
        <div class="fees-header">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                <div>
                    <div class="text-uppercase small fw-bold mb-2" style="letter-spacing: 2px; color: #94a3b8;">Fees Module</div>
                    <h2>Nehru BBA and BCA College</h2>
                    <p>Ghantikeri, Hubli - 580 020</p>
                </div>
                <div>
                     <div class="summary-chip">Master Challan No: <strong id="masterChallanText"><?php echo $challan_no; ?></strong></div>
                    <div class="summary-chip">Live Balance: <strong id="headerBalance">0</strong></div>
                </div>
            </div>
        </div>

        <div class="p-4 p-lg-5">
            <form action="save_fees.php" method="POST" id="feesForm">
                <input type="hidden" name="challan_no" value="<?php echo $challan_no; ?>">

                <div class="row g-4">
                    <div class="col-12 col-xl-8">
                        <div class="section-box mb-4">
                            <div class="section-title">Student & Academic Details</div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Student Name</label>
                                    <input type="text" name="student_name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Student ID / Register No</label>
                                    <input type="text" name="student_id" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Course</label>
                                    <select name="course" class="form-select" required>
                                        <option value="">Select Course</option>
                                        <option value="BBA">BBA</option>
                                        <option value="BCA">BCA</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Academic Year</label>
                                    <input type="text" name="academic_year" class="form-control" placeholder="2026-27" required>
                                </div>
                            </div>
                        </div>

                        <div class="section-box mb-4">
                            <div class="section-title">Fees Details</div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">1) College Total Fees</label>
                                    <input type="number" step="0.01" min="0" name="college_total_fees" id="college_total_fees" class="form-control" required>
                                </div>
                                                                <div class="col-md-6">
                                    <label class="form-label">2) Management/Principal Concession</label>
                                    <div class="d-flex gap-4 pt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="has_concession" value="yes" id="concessionYes">
                                            <label class="form-check-label" for="concessionYes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="has_concession" value="no" id="concessionNo" checked>
                                            <label class="form-check-label" for="concessionNo">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mt-1 concession-wrap" id="concessionFields">
                                <div class="col-md-4">
                                    <label class="form-label">Member Name</label>
                                    <input type="text" name="concession_member_name" id="concession_member_name" class="form-control" placeholder="Principal / Management Member">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="concession_date" id="concession_date" class="form-control">
                                </div>
                                 <div class="col-md-4">
                                    <label class="form-label">3) Concession Fees</label>
                                    <input type="number" step="0.01" min="0" name="concession_fees" id="concession_fees" class="form-control" value="0">
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-4">
                                    <label class="form-label">4) Finalized Fees</label>
                                    <div class="readonly-box" id="finalized_fees_view">0</div>
                                    <input type="hidden" name="finalized_fees" id="finalized_fees" value="0">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">6) Balance Fees</label>
                                    <div class="readonly-box" id="balance_fees_view">0</div>
                                    <input type="hidden" name="balance_fees" id="balance_fees" value="0">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">7) Fees Paid Date</label>
                                    <input type="date" name="fees_paid_date" class="form-control">
                                </div>
                            </div>
                        </div>
                         <div class="section-box">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                                <div class="section-title mb-0">5) Installments (1 to 5)</div>
                                <div class="small-note">Each installment can generate its own challan.</div>
                            </div>

                            <div class="row g-3">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <div class="col-md-6 col-xl-4">
                                        <div class="installment-card">
                                            <div class="fw-bold mb-3">Installment <?php echo $i; ?></div>
                                            <div class="mb-3">
                                                <label class="form-label">Amount</label>
                                                <input type="number" step="0.01" min="0" name="installment_<?php echo $i; ?>" id="installment_<?php echo $i; ?>" class="form-control installment-input" value="0">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Installment Challan No</label>
                                                <input type="text" id="installment_challan_<?php echo $i; ?>" class="form-control" readonly>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-outline-primary btn-print" onclick="generateInstallmentChallan(<?php echo $i; ?>)">Generate Challan</button>
                                                <button type="button" class="btn btn-outline-dark btn-print" onclick="printInstallmentChallan(<?php echo $i; ?>)">Print Challan</button>
                                            </div>
                                        </div>
                                          </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-4">
                        <div class="section-box sticky-top" style="top: 20px;">
                            <div class="section-title">8) Challan & Summary</div>
                            <div class="mb-3">
                                <label class="form-label">Master Challan Print (Auto No)</label>
                                <div class="readonly-box"><?php echo $challan_no; ?></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Total Installment Amount</label>
                                <div class="readonly-box" id="installment_total_view">0</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Finalized Fees</label>
                                <div class="readonly-box" id="side_finalized_fees_view">0</div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Balance Fees</label>
                                <div class="readonly-box text-danger" id="side_balance_fees_view">0</div>
                            </div>
     <div class="d-grid gap-3 no-print">
                                <button type="submit" class="btn btn-main">Save Fees Record</button>
                                <button type="button" class="btn btn-outline-secondary btn-print" onclick="window.print()">Print Master Challan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function currencyFormat(value) {
    let amount = parseFloat(value || 0);
    return amount.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function updateConcessionVisibility() {
    const concessionYes = document.getElementById('concessionYes').checked;
    const concessionFields = document.getElementById('concessionFields');
    const member = document.getElementById('concession_member_name');
      const date = document.getElementById('concession_date');

    if (concessionYes) {
        concessionFields.style.display = 'flex';
        member.required = true;
        date.required = true;
    } else {
        concessionFields.style.display = 'none';
        member.required = false;
        date.required = false;
        document.getElementById('concession_fees').value = 0;
        member.value = '';
        date.value = '';
    }
    calculateFees();
}

function calculateFees() {
    const totalFees = parseFloat(document.getElementById('college_total_fees').value || 0);
    const hasConcession = document.getElementById('concessionYes').checked;
    const concessionFees = hasConcession ? parseFloat(document.getElementById('concession_fees').value || 0) : 0;

    let finalizedFees = totalFees - concessionFees;
    if (finalizedFees < 0) finalizedFees = 0;
      let installmentTotal = 0;
    document.querySelectorAll('.installment-input').forEach(function(input) {
        installmentTotal += parseFloat(input.value || 0);
    });

    let balanceFees = finalizedFees - installmentTotal;
    if (balanceFees < 0) balanceFees = 0;

    document.getElementById('finalized_fees').value = finalizedFees.toFixed(2);
    document.getElementById('balance_fees').value = balanceFees.toFixed(2);

    document.getElementById('finalized_fees_view').innerText = currencyFormat(finalizedFees);
    document.getElementById('balance_fees_view').innerText = currencyFormat(balanceFees);
    document.getElementById('side_finalized_fees_view').innerText = currencyFormat(finalizedFees);
    document.getElementById('side_balance_fees_view').innerText = currencyFormat(balanceFees);
    document.getElementById('installment_total_view').innerText = currencyFormat(installmentTotal);
    document.getElementById('headerBalance').innerText = currencyFormat(balanceFees);
}

function generateInstallmentChallan(i) {
    const masterChallan = document.getElementById('masterChallanText').innerText;
    document.getElementById('installment_challan_' + i).value = masterChallan + '-I' + i;
}
function printInstallmentChallan(i) {
    const challanNo = document.getElementById('installment_challan_' + i).value || ('Installment-' + i);
    const amount = document.getElementById('installment_' + i).value || '0';
    const studentName = document.querySelector('input[name="student_name"]').value || '-';
    const course = document.querySelector('select[name="course"]').value || '-';
    const academicYear = document.querySelector('input[name="academic_year"]').value || '-';

    const html = `
        <html>
        <head>
            <title>${challanNo}</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 24px; }
                .box { border: 1px solid #ccc; border-radius: 20px; padding: 24px; }
                .row { display: flex; justify-content: space-between; margin-bottom: 12px; }
                h2, h3, p { margin: 0 0 12px; }
            </style>
        </head>
        <body>
            <div class="box">
                <h2>Nehru BBA and BCA College</h2>
                <p>Ghantikeri, Hubli - 580 020</p>
                <h3>Installment Challan</h3>
                <div class="row"><strong>Challan No</strong><span>${challanNo}</span></div>
                   <div class="row"><strong>Student Name</strong><span>${studentName}</span></div>
                <div class="row"><strong>Course</strong><span>${course}</span></div>
                <div class="row"><strong>Academic Year</strong><span>${academicYear}</span></div>
                <div class="row"><strong>Installment</strong><span>${i}</span></div>
                <div class="row"><strong>Amount</strong><span>₹ ${parseFloat(amount).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span></div>
            </div>
            <script>window.onload = function(){ window.print(); };</script>
        </body>
        </html>
    `;

    const win = window.open('', '', 'width=900,height=700');
    win.document.write(html);
    win.document.close();
}

document.getElementById('concessionYes').addEventListener('change', updateConcessionVisibility);
document.getElementById('concessionNo').addEventListener('change', updateConcessionVisibility);
document.getElementById('college_total_fees').addEventListener('input', calculateFees);
document.getElementById('concession_fees').addEventListener('input', calculateFees);

document.querySelectorAll('.installment-input').forEach(function(input) {
    input.addEventListener('input', calculateFees);
});
document.getElementById('feesForm').addEventListener('submit', function(e) {
    const totalFees = parseFloat(document.getElementById('college_total_fees').value || 0);
    const finalized = parseFloat(document.getElementById('finalized_fees').value || 0);
    let installmentTotal = 0;

    document.querySelectorAll('.installment-input').forEach(function(input) {
        installmentTotal += parseFloat(input.value || 0);
    });

    const hasConcession = document.getElementById('concessionYes').checked;
    const concession = parseFloat(document.getElementById('concession_fees').value || 0);

    if (hasConcession && concession > totalFees) {
        alert('Concession fees cannot be greater than total fees.');
        e.preventDefault();
        return;
    }

    if (installmentTotal > finalized) {
        alert('Installment total cannot be greater than finalized fees.');
        e.preventDefault();
        return;
    }
    });

updateConcessionVisibility();
calculateFees();
</script>
</body>
</html>