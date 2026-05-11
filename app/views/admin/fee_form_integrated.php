<?php
$pageTitle = 'Issue Fees - WITH INSTALLMENTS PLAN';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';

function generateChallanNo()
{
    return 'NBBACOL-' . date('Ymd') . '-' . rand(1000, 9999);
}

$challanNo = generateChallanNo();
?>

<style>
    :root {
        --primary: #1d3f7a;
        --accent: #22c3e3;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --bg-light: #f9fafb;
        --border: #e5e7eb;
    }

    .form-container {
        padding: 2.5rem;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(29, 63, 122, 0.85) 100%);
        min-height: 100vh;
    }

    .form-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }

    .form-header {
        background: white;
        padding: 2rem;
        border-radius: 12px 12px 0 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-bottom: 3px solid var(--accent);
    }

    .form-header h2 {
        color: var(--primary);
        margin-bottom: 0.5rem;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .form-header p {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .form-card {
        background: white;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-body {
        padding: 2rem;
    }

    /* Sections */
    .form-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--accent);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-icon {
        font-size: 1.3rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control,
    .form-select {
        padding: 0.75rem;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(34, 195, 227, 0.1);
    }

    .readonly-box {
        min-height: 46px;
        display: flex;
        align-items: center;
        border-radius: 8px;
        padding: 0.75rem;
        background: #f3f4f6;
        border: 2px solid var(--border);
        font-weight: 600;
        color: var(--primary);
    }

    /* Currency Display */
    .amount-display {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--accent);
    }

    /* Installments Section */
    .installments-section {
        background: linear-gradient(135deg, #f0f9ff 0%, #f0fdff 100%);
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 4px solid var(--accent);
    }

    .installment-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .installment-input-group {
        display: flex;
        flex-direction: column;
    }

    .installment-input-group label {
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
    }

    .installment-input-group input {
        padding: 0.75rem;
        border: 2px solid var(--accent);
        border-radius: 6px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .installment-input-group input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(34, 195, 227, 0.2);
    }

    .installment-input-group input::placeholder {
        color: #9ca3af;
    }

    /* Summary Box */
    .summary-box {
        background: #fef3c7;
        border: 2px solid #fbbf24;
        padding: 1.5rem;
        border-radius: 8px;
        margin-top: 1.5rem;
    }

    .summary-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 0.75rem;
    }

    .summary-label {
        color: #92400e;
        font-weight: 600;
    }

    .summary-value {
        text-align: right;
        font-weight: 700;
        color: #78350f;
        font-size: 1rem;
    }

    .summary-row.total {
        padding-top: 0.75rem;
        border-top: 2px solid #fbbf24;
        margin-top: 1rem;
    }

    .summary-row.total .summary-value {
        color: var(--primary);
        font-size: 1.2rem;
    }

    /* Buttons */
    .form-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.85rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--accent) 0%, #1da4c0 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(34, 195, 227, 0.3);
    }

    .btn-secondary {
        background: var(--border);
        color: var(--primary);
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    /* Alert Messages */
    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideDown 0.3s ease;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        border: 2px solid #fca5a5;
    }

    .alert-warning {
        background: #fef3c7;
        color: #92400e;
        border: 2px solid #fcd34d;
    }

    .alert-info {
        background: #dbeafe;
        color: #1e40af;
        border: 2px solid #93c5fd;
    }

    /* Info Box */
    .info-box {
        background: #eff6ff;
        border: 2px solid var(--accent);
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        color: #1e40af;
        font-size: 0.9rem;
    }

    .info-box strong {
        color: var(--primary);
    }

    @keyframes slideDown {
        from {
            transform: translateY(-10px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 1rem;
        }

        .form-body {
            padding: 1rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .summary-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="form-container">
    <div class="form-wrapper">
        <!-- Alerts -->
        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] === 'invalid_installments'): ?>
                <div class="alert alert-danger">⚠️ Installment total cannot be greater than finalized fees.</div>
            <?php elseif ($_GET['msg'] === 'invalid_concession'): ?>
                <div class="alert alert-danger">⚠️ Concession amount cannot exceed total fees.</div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Header -->
        <div class="form-header">
            <h2>💳 Issue Fees & Create Installment Plan</h2>
            <p>for <?php echo htmlspecialchars($admission['full_name']); ?></p>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <form action="<?php echo BASE_URL; ?>admin-fees-save" method="POST" id="feesForm" class="form-body">
                <input type="hidden" name="admission_id" value="<?php echo htmlspecialchars($admission['id']); ?>">
                <input type="hidden" name="challan_no" value="<?php echo htmlspecialchars($challanNo); ?>">

                <!-- SECTION 1: STUDENT INFO -->
                <div class="form-section">
                    <div class="section-title">
                        <span class="section-icon">👤</span>
                        Student Information
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <div class="readonly-box"><?php echo htmlspecialchars($admission['full_name']); ?></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Admission Number</label>
                            <div class="readonly-box"><?php echo htmlspecialchars($admission['admission_number']); ?></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Course</label>
                            <select name="course" class="form-select" required>
                                <option value="">Select Course</option>
                                <option value="BBA">BBA</option>
                                <option value="BCA">BCA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Academic Year</label>
                            <input type="text" name="academic_year" class="form-control" placeholder="2026-27" required>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: FEES CALCULATION -->
                <div class="form-section">
                    <div class="section-title">
                        <span class="section-icon">💰</span>
                        Fees Calculation
                    </div>
                    
                    <div class="info-box">
                        💡 Enter the total college fees, apply concession if any, and the system will calculate finalized fees for installment creation.
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">1️⃣ College Total Fees</label>
                            <input type="number" step="0.01" min="0" name="college_total_fees" id="college_total_fees" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">✓ Finalized Fees</label>
                            <div class="readonly-box" id="finalized_fees_view">₹0.00</div>
                            <input type="hidden" name="finalized_fees" id="finalized_fees" value="0">
                        </div>
                        <div class="form-group">
                            <label class="form-label">📊 Balance (Not Yet Paid)</label>
                            <div class="readonly-box" id="balance_fees_view">₹0.00</div>
                        </div>
                    </div>

                    <!-- Concession Section -->
                    <div style="margin-top: 1rem;">
                        <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 1rem; cursor: pointer;">
                            <input type="radio" name="has_concession" value="no" id="concessionNo" checked> No Concession
                        </label>
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="radio" name="has_concession" value="yes" id="concessionYes"> Apply Concession
                        </label>
                    </div>

                    <div id="concessionFields" style="display: none; background: #fff7ed; padding: 1rem; border-radius: 8px; margin-top: 1rem; border-left: 4px solid var(--warning);">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Concession By (Member Name)</label>
                                <input type="text" name="concession_member_name" id="concession_member_name" class="form-control" placeholder="Principal / Management Member">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Concession Date</label>
                                <input type="date" name="concession_date" id="concession_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">2️⃣ Concession Amount</label>
                                <input type="number" step="0.01" min="0" name="concession_fees" id="concession_fees" class="form-control" value="0">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: INSTALLMENT PLAN -->
                <div class="form-section">
                    <div class="section-title">
                        <span class="section-icon">💳</span>
                        5-Installment Payment Plan
                    </div>

                    <div class="info-box">
                        📅 <strong>Payment Schedule:</strong> Installment 1 due immediately. Subsequent installments due ~2.5 months apart (automatic calculation).
                    </div>

                    <div class="installments-section">
                        <div class="installment-grid">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <div class="installment-input-group">
                                    <label>Installment <?php echo $i; ?></label>
                                    <input 
                                        type="number" 
                                        step="0.01" 
                                        min="0" 
                                        name="installment_<?php echo $i; ?>" 
                                        id="installment_<?php echo $i; ?>" 
                                        class="installment-input" 
                                        value="0"
                                        placeholder="₹0.00"
                                    >
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <!-- Quick Split Options -->
                    <div style="margin-top: 1rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                        <button type="button" class="btn btn-secondary" onclick="splitEqual()">
                            ⚖️ Split Equally
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="split50_50()">
                            📊 50-50 Split
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="clearInstallments()">
                            🗑️ Clear
                        </button>
                    </div>
                </div>

                <!-- SUMMARY -->
                <div class="summary-box">
                    <div class="summary-row">
                        <span class="summary-label">College Total Fees:</span>
                        <span class="summary-value" id="summary-total">₹0.00</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Concession Applied:</span>
                        <span class="summary-value" id="summary-concession">₹0.00</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Finalized Fees:</span>
                        <span class="summary-value" id="summary-finalized">₹0.00</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Total Installments:</span>
                        <span class="summary-value" id="summary-installments">₹0.00</span>
                    </div>
                    <div class="summary-row total">
                        <span class="summary-label">Balance (Unallocated):</span>
                        <span class="summary-value" id="summary-balance">₹0.00</span>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="form-actions">
                    <a href="<?php echo BASE_URL; ?>admin-fees" class="btn btn-secondary">← Back</a>
                    <button type="submit" class="btn btn-primary">✓ Save Fees & Create Installments</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function currencyFormat(value) {
        const amount = parseFloat(value || 0);
        return '₹' + amount.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function updateConcessionVisibility() {
        const concessionYes = document.getElementById('concessionYes').checked;
        const concessionFields = document.getElementById('concessionFields');

        if (concessionYes) {
            concessionFields.style.display = 'block';
        } else {
            concessionFields.style.display = 'none';
            document.getElementById('concession_fees').value = 0;
            document.getElementById('concession_member_name').value = '';
            document.getElementById('concession_date').value = '';
        }
        calculateAllFees();
    }

    function calculateAllFees() {
        const totalFees = parseFloat(document.getElementById('college_total_fees').value || 0);
        const hasConcession = document.getElementById('concessionYes').checked;
        const concessionFees = hasConcession ? parseFloat(document.getElementById('concession_fees').value || 0) : 0;

        let finalizedFees = totalFees - concessionFees;
        if (finalizedFees < 0) finalizedFees = 0;

        let installmentTotal = 0;
        document.querySelectorAll('.installment-input').forEach(input => {
            installmentTotal += parseFloat(input.value || 0);
        });

        let balanceFees = finalizedFees - installmentTotal;
        if (balanceFees < 0) balanceFees = 0;

        // Update hidden field
        document.getElementById('finalized_fees').value = finalizedFees.toFixed(2);

        // Update displays
        document.getElementById('finalized_fees_view').textContent = currencyFormat(finalizedFees);
        document.getElementById('balance_fees_view').textContent = currencyFormat(balanceFees);

        // Update summary
        document.getElementById('summary-total').textContent = currencyFormat(totalFees);
        document.getElementById('summary-concession').textContent = currencyFormat(concessionFees);
        document.getElementById('summary-finalized').textContent = currencyFormat(finalizedFees);
        document.getElementById('summary-installments').textContent = currencyFormat(installmentTotal);
        document.getElementById('summary-balance').textContent = currencyFormat(balanceFees);
    }

    function splitEqual() {
        const finalizedFees = parseFloat(document.getElementById('finalized_fees').value || 0);
        const perInstallment = finalizedFees / 5;

        for (let i = 1; i <= 5; i++) {
            document.getElementById(`installment_${i}`).value = perInstallment.toFixed(2);
        }
        calculateAllFees();
    }

    function split50_50() {
        const finalizedFees = parseFloat(document.getElementById('finalized_fees').value || 0);
        document.getElementById('installment_1').value = (finalizedFees / 2).toFixed(2);

        for (let i = 2; i <= 5; i++) {
            document.getElementById(`installment_${i}`).value = (finalizedFees / 8).toFixed(2);
        }
        calculateAllFees();
    }

    function clearInstallments() {
        for (let i = 1; i <= 5; i++) {
            document.getElementById(`installment_${i}`).value = 0;
        }
        calculateAllFees();
    }

    // Event listeners
    document.getElementById('concessionYes').addEventListener('change', updateConcessionVisibility);
    document.getElementById('concessionNo').addEventListener('change', updateConcessionVisibility);
    document.getElementById('college_total_fees').addEventListener('input', calculateAllFees);
    document.getElementById('concession_fees').addEventListener('input', calculateAllFees);
    document.querySelectorAll('.installment-input').forEach(input => {
        input.addEventListener('input', calculateAllFees);
    });

    // Form validation
    document.getElementById('feesForm').addEventListener('submit', function(event) {
        const totalFees = parseFloat(document.getElementById('college_total_fees').value || 0);
        const finalizedFees = parseFloat(document.getElementById('finalized_fees').value || 0);
        const concessionFees = parseFloat(document.getElementById('concession_fees').value || 0);
        let installmentTotal = 0;

        document.querySelectorAll('.installment-input').forEach(input => {
            installmentTotal += parseFloat(input.value || 0);
        });

        if (concessionFees > totalFees) {
            alert('❌ Concession amount cannot exceed total fees.');
            event.preventDefault();
            return;
        }

        if (installmentTotal > finalizedFees) {
            alert('❌ Installment total cannot exceed finalized fees.');
            event.preventDefault();
            return;
        }

        // All good!
        return true;
    });

    // Initialize
    updateConcessionVisibility();
    calculateAllFees();
</script>
