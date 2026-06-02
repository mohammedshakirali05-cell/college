<?php

$pageTitle = 'Issue Fees';

include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';

function generateChallanNo()
{
    return 'NBBACOL-' . date('Ymd') . '-' . rand(1000, 9999);
}

$challanNo = generateChallanNo();

$isEditMode = !empty($existingFee);

if ($isEditMode) {
    $challanNo = $existingFee['challan_no'];
}

?>

<div class="container-fluid">

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'invalid_installments'): ?>
        <div class="alert alert-danger">
            Installment amount cannot exceed balance fees.
        </div>
    <?php endif; ?>

    <div class="card surface-card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <span>
                Issue Fees for <?= htmlspecialchars($admission['full_name']) ?>
            </span>

            <a href="/college/public/index.php?url=admin-fees"
               class="btn btn-sm btn-outline-secondary">
                Back to Fees
            </a>

        </div>

        <div class="card-body">

            <form action="/college/public/index.php?url=admin-fees-save"
                  method="POST"
                  id="feesForm">

                <input type="hidden"
                       name="admission_id"
                       value="<?= htmlspecialchars($admission['id']) ?>">

                <input type="hidden"
                       name="challan_no"
                       value="<?= htmlspecialchars($challanNo) ?>">

                <div class="row g-4">

                    <div class="col-lg-6">
                        <div class="mb-3">

                            <label class="form-label">
                                Student Name
                            </label>

                            <input type="text"
                                   name="student_name"
                                   class="form-control"
                                   value="<?= htmlspecialchars($admission['full_name']) ?>"
                                   readonly>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">

                            <label class="form-label">
                                Admission Number
                            </label>

                            <input type="text"
                                   name="student_id"
                                   class="form-control"
                                   value="<?= htmlspecialchars($admission['admission_number']) ?>"
                                   readonly>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">

                            <label class="form-label">
                                Course
                            </label>

                            <select name="course"
                                    class="form-select"
                                    <?= $isEditMode ? 'disabled' : 'required' ?>>

                                <option value="">Select Course</option>

                                <option value="BBA"
                                    <?= (($existingFee['course'] ?? '') === 'BBA') ? 'selected' : '' ?>>
                                    BBA
                                </option>

                                <option value="BCA"
                                    <?= (($existingFee['course'] ?? '') === 'BCA') ? 'selected' : '' ?>>
                                    BCA
                                </option>

                            </select>

                            <?php if ($isEditMode): ?>
                                <input type="hidden"
                                       name="course"
                                       value="<?= htmlspecialchars($existingFee['course']) ?>">
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">

                            <label class="form-label">
                                Academic Year
                            </label>

                            <input type="text"
                                   name="academic_year"
                                   class="form-control"
                                   placeholder="2026-27"
                                   value="<?= htmlspecialchars($existingFee['academic_year'] ?? '') ?>"
                                   <?= $isEditMode ? 'readonly' : 'required' ?>>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">

                            <label class="form-label">
                                1) College Total Fees
                            </label>

                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="college_total_fees"
                                   id="college_total_fees"
                                   class="form-control"
                                   value="<?= htmlspecialchars($existingFee['college_total_fees'] ?? '') ?>"
                                   <?= $isEditMode ? 'readonly' : 'required' ?>>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">

                            <label class="form-label">
                                2) Management / Principal Concession
                            </label>

                            <div class="d-flex gap-3 pt-2">

                                <div class="form-check">

                                    <input class="form-check-input"
                                           type="radio"
                                           name="has_concession"
                                           value="yes"
                                           id="concessionYes"
                                           <?= (($existingFee['has_concession'] ?? 'no') === 'yes') ? 'checked' : '' ?>>

                                    <label class="form-check-label"
                                           for="concessionYes">
                                        Yes
                                    </label>

                                </div>

                                <div class="form-check">

                                    <input class="form-check-input"
                                           type="radio"
                                           name="has_concession"
                                           value="no"
                                           id="concessionNo"
                                           <?= (($existingFee['has_concession'] ?? 'no') === 'no') ? 'checked' : '' ?>>

                                    <label class="form-check-label"
                                           for="concessionNo">
                                        No
                                    </label>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="row g-3 concession-wrap"
                         id="concessionFields"
                         style="<?= (($existingFee['has_concession'] ?? 'no') === 'yes') ? 'display:flex;' : 'display:none;' ?>">

                        <div class="col-md-4">

                            <label class="form-label">
                                Member Name
                            </label>

                            <input type="text"
                                   name="concession_member_name"
                                   id="concession_member_name"
                                   class="form-control"
                                   value="<?= htmlspecialchars($existingFee['concession_member_name'] ?? '') ?>">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Date
                            </label>

                            <input type="date"
                                   name="concession_date"
                                   id="concession_date"
                                   class="form-control"
                                   value="<?= htmlspecialchars($existingFee['concession_date'] ?? '') ?>">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                3) Concession Fees
                            </label>

                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="concession_fees"
                                   id="concession_fees"
                                   class="form-control"
                                   value="<?= htmlspecialchars($existingFee['concession_fees'] ?? 0) ?>"
                                   <?= $isEditMode ? 'readonly' : '' ?>>

                        </div>

                    </div>

                    <div class="row g-3 mt-3">

                        <div class="col-md-4">

                            <label class="form-label">
                                4) Finalized Fees
                            </label>

                            <div class="form-control readonly-box"
                                 id="finalized_fees_view">

                                <?= number_format($existingFee['finalized_fees'] ?? 0, 2) ?>

                            </div>

                            <input type="hidden"
                                   name="finalized_fees"
                                   id="finalized_fees"
                                   value="<?= htmlspecialchars($existingFee['finalized_fees'] ?? 0) ?>">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Balance Fees
                            </label>

                            <div class="form-control readonly-box"
                                 id="balance_fees_view">

                                <?= number_format($existingFee['balance_fees'] ?? 0, 2) ?>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Fees Paid Date
                            </label>

                            <input type="date"
                                   name="fees_paid_date"
                                   class="form-control"
                                   value="<?= date('Y-m-d') ?>">

                        </div>

                    </div>

                    <div class="col-12">

                        <div class="card mt-4">

                            <div class="card-body">

                                <h5 class="mb-3">
                                    Add New Installment
                                </h5>

                                <div class="row g-3">

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Installment Amount
                                        </label>

                                        <input type="number"
                                               step="0.01"
                                               min="0"
                                               name="new_installment_amount"
                                               id="new_installment_amount"
                                               class="form-control"
                                               value="0">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Installment Paid Date
                                        </label>

                                        <input type="date"
                                               name="new_installment_date"
                                               class="form-control"
                                               value="<?= date('Y-m-d') ?>">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-12 mt-4">

                        <button type="submit"
                                class="btn btn-primary">

                            Save Fees Record

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<div id="submissionOverlay" class="submission-overlay">
    <div class="submission-card">
        <div class="submission-icon">✓</div>
        <h3>Creating Challan</h3>
        <p>Saving the fees record and opening the challan page now.</p>
        <div class="loader-ring"><span></span><span></span><span></span><span></span></div>
    </div>
</div>

<style>

.readonly-box {
    min-height: 46px;
    display: flex;
    align-items: center;
    border-radius: 6px;
    padding: 0 12px;
    background: #f8fafc;
    border: 1px solid #ced4da;
    font-weight: 600;
}

.submission-overlay {
    position: fixed;
    inset: 0;
    background: rgba(10, 25, 47, 0.75);
    backdrop-filter: blur(6px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    animation: fadeInOverlay 0.4s ease forwards;
}

.submission-overlay.active {
    display: flex;
}

.submission-card {
    width: min(440px, 90%);
    padding: 32px;
    border-radius: 22px;
    background: linear-gradient(180deg, rgba(16,115,234,0.95) 0%, rgba(10,25,47,0.95) 100%);
    box-shadow: 0 28px 80px rgba(0, 0, 0, 0.25);
    text-align: center;
    color: #ffffff;
    transform: translateY(20px);
    opacity: 0;
    animation: slideUpCard 0.55s ease forwards;
}

.submission-icon {
    width: 72px;
    height: 72px;
    margin: 0 auto 20px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.15);
    display: grid;
    place-items: center;
    font-size: 32px;
    border: 1px solid rgba(255, 255, 255, 0.18);
    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.08);
}

.submission-card h3 {
    margin-bottom: 10px;
    font-size: 1.85rem;
    letter-spacing: 0.5px;
}

.submission-card p {
    margin-bottom: 24px;
    line-height: 1.65;
    color: rgba(255, 255, 255, 0.82);
}

.loader-ring {
    display: inline-grid;
    place-items: center;
    width: 72px;
    height: 72px;
    position: relative;
}

.loader-ring span {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    border: 4px solid transparent;
    border-top-color: rgba(255,255,255,0.95);
    animation: spinRing 1.2s linear infinite;
}

.loader-ring span:nth-child(2) {
    border-top-color: rgba(255,255,255,0.75);
    animation-duration: 1.4s;
}

.loader-ring span:nth-child(3) {
    border-top-color: rgba(255,255,255,0.55);
    animation-duration: 1.6s;
}

.loader-ring span:nth-child(4) {
    border-top-color: rgba(255,255,255,0.35);
    animation-duration: 1.8s;
}

@keyframes spinRing {
    to { transform: rotate(360deg); }
}

@keyframes slideUpCard {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInOverlay {
    from { opacity: 0; }
    to { opacity: 1; }
}

</style>

<script>

function updateConcessionVisibility() {

    const concessionYes =
        document.getElementById('concessionYes').checked;

    const concessionFields =
        document.getElementById('concessionFields');

    if (concessionYes) {
        concessionFields.style.display = 'flex';
    } else {
        concessionFields.style.display = 'none';
    }

    calculateFees();
}

function currencyFormat(value) {

    const amount = parseFloat(value || 0);

    return amount.toLocaleString(
        'en-IN',
        {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }
    );
}

function calculateFees() {

    const totalFees =
        parseFloat(
            document.getElementById('college_total_fees').value || 0
        );

    const hasConcession =
        document.getElementById('concessionYes').checked;

    const concessionFees =
        hasConcession
            ? parseFloat(document.getElementById('concession_fees').value || 0)
            : 0;

    let finalizedFees = totalFees - concessionFees;

    if (finalizedFees < 0) {
        finalizedFees = 0;
    }

    const newInstallment =
        parseFloat(
            document.getElementById('new_installment_amount').value || 0
        );

    const oldBalance =
        parseFloat("<?= $existingFee['balance_fees'] ?? 0 ?>");

    let balanceFees =
        <?= $isEditMode ? 'oldBalance - newInstallment' : 'finalizedFees - newInstallment' ?>;

    if (balanceFees < 0) {
        balanceFees = 0;
    }

    document.getElementById('finalized_fees').value =
        finalizedFees.toFixed(2);

    document.getElementById('finalized_fees_view').innerText =
        currencyFormat(finalizedFees);

    document.getElementById('balance_fees_view').innerText =
        currencyFormat(balanceFees);
}

function validateForm(event) {

    const balance =
        parseFloat(
            document.getElementById('balance_fees_view')
                .innerText
                .replace(/,/g, '')
        );

    if (balance < 0) {

        alert('Installment cannot exceed balance fees.');

        event.preventDefault();

        return false;
    }

    showSubmissionOverlay();
    return true;
}

function showSubmissionOverlay() {
    const overlay = document.getElementById('submissionOverlay');

    if (!overlay) {
        return;
    }

    overlay.classList.add('active');

    const submitButton = document.querySelector('#feesForm button[type="submit"]');
    if (submitButton) {
        submitButton.disabled = true;
        submitButton.innerText = 'Saving...';
    }
}

updateConcessionVisibility();

calculateFees();

document.getElementById('concessionYes')
    .addEventListener('change', updateConcessionVisibility);

document.getElementById('concessionNo')
    .addEventListener('change', updateConcessionVisibility);

document.getElementById('college_total_fees')
    .addEventListener('input', calculateFees);

document.getElementById('concession_fees')
    .addEventListener('input', calculateFees);

document.getElementById('new_installment_amount')
    .addEventListener('input', calculateFees);

document.getElementById('feesForm')
    .addEventListener('submit', function (event) {
        if (!validateForm(event)) {
            event.preventDefault();
        }
    });

</script>