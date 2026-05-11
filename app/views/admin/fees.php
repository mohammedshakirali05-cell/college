<?php
$pageTitle = 'Fees Management';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';
?>

<style>
    :root {
        --primary-blue: #1d3f7a;
        --accent-cyan: #22c3e3;
        --success-green: #10b981;
        --warning-orange: #f59e0b;
        --danger-red: #ef4444;
        --surface-dark: #0f172a;
        --card-white: #ffffff;
        --text-main: #1f2937;
        --text-secondary: #6b7280;
        --border-light: #e5e7eb;
        --bg-light: #f9fafb;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .fees-container {
        padding: 2.5rem;
        background: var(--bg-light);
        min-height: 100vh;
    }

    /* Header Section - Premium Style */
    .fees-header-premium {
        background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
        color: white;
        padding: 3rem;
        border-radius: 16px;
        margin-bottom: 2.5rem;
        animation: slideDown 0.5s ease-out;
        box-shadow: 0 10px 35px rgba(29, 63, 122, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .fees-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
    }

    .fees-header-text h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .fees-header-text p {
        opacity: 0.9;
        font-size: 0.95rem;
    }

    .fees-header-stats {
        display: flex;
        gap: 2rem;
    }

    .header-stat {
        text-align: right;
        padding: 1rem 1.5rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
    }

    .header-stat-label {
        font-size: 0.8rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .header-stat-value {
        font-size: 1.5rem;
        font-weight: 700;
    }

    /* Analytics Cards */
    .analytics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        animation: fadeIn 0.6s ease-out;
    }

    .analytics-card {
        background: var(--card-white);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--border-light);
        transition: all 0.3s ease;
    }

    .analytics-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        border-color: var(--accent-cyan);
    }

    .analytics-card-icon {
        font-size: 2rem;
        margin-bottom: 0.75rem;
    }

    .analytics-card-label {
        font-size: 0.85rem;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .analytics-card-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 0.5rem;
    }

    .analytics-card-meta {
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    /* Navigation Tabs */
    .fees-nav {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 2rem;
        background: var(--card-white);
        padding: 12px;
        border-radius: 12px;
        width: fit-content;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        border: 1px solid var(--border-light);
        animation: fadeIn 0.5s ease-out;
    }

    .nav-btn {
        padding: 10px 24px;
        border-radius: 8px;
        border: none;
        background: transparent;
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-btn:hover {
        color: var(--primary-blue);
        background: var(--bg-light);
    }

    .nav-btn.active {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-cyan) 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(29, 63, 122, 0.2);
    }

    /* Premium White Card */
    .glass-card {
        background: var(--card-white);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        animation: fadeIn 0.5s ease-out;
        border: 1px solid var(--border-light);
    }

    .glass-card.hidden {
        display: none;
    }

    .glass-card-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, #16325d 100%);
        color: white;
        padding: 1.5rem;
        border-bottom: 2px solid rgba(0, 0, 0, 0.1);
    }

    .glass-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Professional Table */
    .table-pro {
        width: 100%;
        border-collapse: collapse;
    }

    .table-pro thead {
        background: var(--bg-light);
    }

    .table-pro thead th {
        color: var(--primary-blue);
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1.5px;
        padding: 1rem;
        text-align: left;
        font-weight: 700;
        border: none;
        border-bottom: 2px solid var(--border-light);
    }

    .table-pro tbody td {
        padding: 1rem;
        border-bottom: 1px solid var(--border-light);
        color: var(--text-main);
        font-size: 0.95rem;
    }

    .table-pro tbody tr {
        transition: all 0.2s ease;
    }

    .table-pro tbody tr:hover {
        background: rgba(34, 195, 227, 0.03);
    }

    .table-pro tbody tr:last-child td {
        border-bottom: none;
    }

    /* Status Badges */
    .pill {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: capitalize;
        letter-spacing: 0.5px;
    }

    .pill-pending {
        background: rgba(245, 158, 11, 0.15);
        color: #92400e;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .pill-paid {
        background: rgba(16, 185, 129, 0.15);
        color: #065f46;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    /* Amount Styling */
    .amount-pending {
        color: var(--danger-red);
        font-weight: 700;
    }

    .amount-paid {
        color: var(--success-green);
        font-weight: 700;
    }

    /* Reference ID */
    .ref-id {
        color: var(--accent-cyan);
        font-weight: 700;
        font-family: 'Monaco', 'Courier New', monospace;
    }

    /* Admission Number */
    .code {
        background: var(--bg-light);
        padding: 3px 8px;
        border-radius: 4px;
        font-family: 'Monaco', 'Courier New', monospace;
        font-size: 0.85rem;
        color: var(--primary-blue);
        font-weight: 600;
    }

    /* Action Buttons */
    .btn-action {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-cyan) 100%);
        color: white;
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(29, 63, 122, 0.3);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-secondary);
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .empty-state h3 {
        color: var(--text-main);
        margin: 1rem 0 0.5rem 0;
        font-size: 1.1rem;
    }

    /* Animations */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .fees-container {
            padding: 1.5rem;
        }

        .fees-header-premium {
            padding: 2rem;
        }

        .fees-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .fees-header-stats {
            width: 100%;
            flex-wrap: wrap;
        }

        .analytics-grid {
            grid-template-columns: 1fr;
        }

        .table-pro {
            font-size: 0.85rem;
        }

        .table-pro thead th,
        .table-pro tbody td {
            padding: 10px;
        }

        .btn-action {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
    }

    .hidden {
        display: none;
    }

        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: capitalize;
        letter-spacing: 0.5px;
    }

    .pill-pending {
        background: rgba(245, 158, 11, 0.15);
        color: #92400e;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .pill-paid {
        background: rgba(16, 185, 129, 0.15);
        color: #065f46;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .pill-failed {
        background: rgba(239, 68, 68, 0.15);
        color: #7f1d1d;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    /* Amount Styling */
    .amount-pending {
        color: var(--danger-red);
        font-weight: 700;
    }

    .amount-paid {
        color: var(--success-green);
        font-weight: 700;
    }

    /* Reference ID */
    .ref-id {
        color: var(--accent-cyan);
        font-weight: 700;
        font-family: 'Monaco', 'Courier New', monospace;
    }

    /* Admission Number */
    .code {
        background: var(--bg-light);
        padding: 3px 8px;
        border-radius: 4px;
        font-family: 'Monaco', 'Courier New', monospace;
        font-size: 0.85rem;
        color: var(--primary-blue);
        font-weight: 600;
    }

    /* Action Buttons */
    .btn-action {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-cyan) 100%);
        color: white;
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(29, 63, 122, 0.3);
    }

    .btn-secondary {
        background: var(--bg-light);
        color: var(--primary-blue);
        border: 1px solid var(--border-light);
    }

    .btn-secondary:hover {
        background: var(--border-light);
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-secondary);
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .empty-state h3 {
        color: var(--text-main);
        margin: 1rem 0 0.5rem 0;
        font-size: 1.1rem;
    }

    /* Animations */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .fees-container {
            padding: 1.5rem;
        }

        .fees-header h1 {
            font-size: 1.5rem;
        }

        .fees-nav {
            flex-wrap: wrap;
        }

        .table-pro {
            font-size: 0.85rem;
        }

        .table-pro thead th,
        .table-pro tbody td {
            padding: 10px;
        }

        .btn-action {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
    }

    .hidden {
        display: none;
    }
</style>

<div class="fees-container">
    
    <!-- Premium Header Section -->
    <div class="fees-header-premium">
        <div class="fees-header-content">
            <div class="fees-header-text">
                <h1>💰 Fees Management</h1>
                <p>Complete view of all students fee payments, installments, and balances</p>
            </div>
            <div class="fees-header-stats">
                <div class="header-stat">
                    <div class="header-stat-label">Total Students</div>
                    <div class="header-stat-value"><?php echo count($fees) ?? 0; ?></div>
                </div>
                <div class="header-stat">
                    <div class="header-stat-label">Total Fees</div>
                    <div class="header-stat-value">₹ <?php 
                        $totalFees = array_sum(array_map(function($f) { return (float)$f['finalized_fees']; }, $fees ?? []));
                        echo number_format($totalFees, 0);
                    ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Cards -->
    <div class="analytics-grid">
        <div class="analytics-card">
            <div class="analytics-card-icon">📋</div>
            <div class="analytics-card-label">Admissions Ready</div>
            <div class="analytics-card-value"><?php echo count($pendingAdmissions) ?? 0; ?></div>
            <div class="analytics-card-meta">Waiting for fee issuance</div>
        </div>

        <div class="analytics-card">
            <div class="analytics-card-icon">📊</div>
            <div class="analytics-card-label">Fee Records</div>
            <div class="analytics-card-value"><?php echo count($fees) ?? 0; ?></div>
            <div class="analytics-card-meta">Total fee records created</div>
        </div>

        <div class="analytics-card">
            <div class="analytics-card-icon">✅</div>
            <div class="analytics-card-label">Fully Paid</div>
            <div class="analytics-card-value"><?php 
                $fullyPaid = 0;
                foreach ($fees ?? [] as $f) {
                    if ((float)$f['balance_fees'] <= 0) $fullyPaid++;
                }
                echo $fullyPaid;
            ?></div>
            <div class="analytics-card-meta">Complete payments received</div>
        </div>

        <div class="analytics-card">
            <div class="analytics-card-icon">⏳</div>
            <div class="analytics-card-label">Pending Payments</div>
            <div class="analytics-card-value"><?php 
                $pending = 0;
                $pendingAmount = 0;
                foreach ($fees ?? [] as $f) {
                    if ((float)$f['balance_fees'] > 0) $pending++;
                    $pendingAmount += (float)$f['balance_fees'];
                }
                echo $pending;
            ?></div>
            <div class="analytics-card-meta">₹ <?php echo number_format($pendingAmount, 0); ?> remaining</div>
        </div>
    </div>
    
    <!-- Navigation Tabs -->
    <div class="fees-nav">
        <button class="nav-btn active" onclick="switchTab('admissions', this)">📋 Admissions Ready</button>
        <button class="nav-btn" onclick="switchTab('records', this)">📊 Fee Records</button>
    </div>

    <!-- Tab: Admissions Ready -->
    <div id="tab-admissions" class="glass-card">
        <div class="glass-card-header">
            <div class="glass-card-title">📋 Admissions Ready for Fee Issuance</div>
        </div>
        <table class="table-pro">
            <thead>
                <tr>
                    <th>Reference ID</th>
                    <th>Candidate Name</th>
                    <th>Admission Number</th>
                    <th>Date Received</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($pendingAdmissions)): foreach($pendingAdmissions as $row): ?>
                <tr>
                    <td><span class="ref-id">#<?= $row['id'] ?></span></td>
                    <td style="font-weight: 600; color: var(--text-main);"><?= htmlspecialchars(strtoupper($row['full_name'])) ?></td>
                    <td><span class="code"><?= htmlspecialchars($row['admission_number']) ?></span></td>
                    <td><?= date('d M, Y', strtotime($row['created_at'])) ?></td>
                    <td><a href="?url=admin-fees-create&id=<?= $row['id'] ?>" class="btn-action btn-primary">➕ Issue Fees</a></td>
                </tr>
                <?php endforeach; else: ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-state-icon">📭</div>
                                <h3>No Admissions Pending</h3>
                                <p>All admissions have fees issued or no new admissions available.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Tab: Fee Records -->
    <div id="tab-records" class="glass-card hidden">
        <div class="glass-card-header">
            <div class="glass-card-title">📊 All Fee Records</div>
        </div>
        <table class="table-pro">
            <thead>
                <tr>
                    <th>Challan Number</th>
                    <th>Student Name</th>
                    <th>Total Fees</th>
                    <th>Paid Amount</th>
                    <th>Balance</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($fees)): foreach($fees as $fee): ?>
                <tr>
                    <td><span style="color: var(--accent-cyan); font-weight: 600;"><?= htmlspecialchars($fee['challan_no']) ?></span></td>
                  <td style="font-weight: 600; color: var(--text-main);">
    <a href="?url=admin-fees-create&id=<?= urlencode($fee['admission_id']) ?>"
       style="color: var(--text-main); text-decoration:none;">
        <?= htmlspecialchars(strtoupper($fee['student_name'])) ?>
    </a>
</td>
                    <td>₹ <?= number_format($fee['finalized_fees'], 2) ?></td>
                    <td><span class="amount-paid">₹ <?= number_format($fee['total_paid'], 2) ?></span></td>
                    <td><span class="amount-pending">₹ <?= number_format($fee['balance_fees'], 2) ?></span></td>
                    <td>
                        <span class="pill <?= ((float)$fee['balance_fees'] <= 0) ? 'pill-paid' : 'pill-pending' ?>">
                            <?= ((float)$fee['balance_fees'] <= 0) ? '✓ Paid in Full' : '⏳ Pending' ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon">📊</div>
                                <h3>No Fee Records</h3>
                                <p>No fee records have been created yet.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
function switchTab(tabName, btn) {
    // Hide all tabs
    document.getElementById('tab-admissions').classList.add('hidden');
    document.getElementById('tab-records').classList.add('hidden');
    
    // Remove active class from buttons
    const buttons = document.querySelectorAll('.nav-btn');
    buttons.forEach(b => b.classList.remove('active'));

    // Show selected tab and activate button
    document.getElementById('tab-' + tabName).classList.remove('hidden');
    btn.classList.add('active');
}
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>