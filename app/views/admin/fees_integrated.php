<?php
$pageTitle = 'Fees Management - WITH INSTALLMENTS';
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
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(29, 63, 122, 0.8) 100%);
        min-height: 100vh;
    }

    .fees-header {
        margin-bottom: 2.5rem;
        animation: slideDown 0.4s ease-out;
    }

    .fees-header h1 {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .fees-header p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
    }

    /* Navigation Tabs */
    .fees-nav {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 2rem;
        background: rgba(255, 255, 255, 0.08);
        padding: 8px;
        border-radius: 12px;
        width: fit-content;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        flex-wrap: wrap;
    }

    .nav-btn {
        padding: 10px 24px;
        border-radius: 8px;
        border: none;
        background: transparent;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-btn:hover {
        color: white;
        background: rgba(255, 255, 255, 0.1);
    }

    .nav-btn.active {
        background: linear-gradient(135deg, var(--accent-cyan) 0%, #1da4c0 100%);
        color: white;
        box-shadow: 0 8px 20px rgba(34, 195, 227, 0.3);
    }

    /* Glass Card */
    .glass-card {
        background: var(--card-white);
        border-radius: 16px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        animation: fadeIn 0.4s ease-out;
        border: 1px solid var(--border-light);
    }

    .glass-card.hidden {
        display: none;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-white);
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-top: 4px solid var(--accent-cyan);
        animation: fadeInUp 0.5s ease-out;
    }

    .stat-label {
        font-size: 0.8rem;
        color: var(--text-secondary);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-blue);
    }

    /* Professional Table */
    .table-pro {
        width: 100%;
        border-collapse: collapse;
    }

    .table-pro thead {
        background: linear-gradient(135deg, var(--primary-blue) 0%, #16325d 100%);
    }

    .table-pro thead th {
        color: white;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1.5px;
        padding: 16px;
        text-align: left;
        font-weight: 700;
        border: none;
    }

    .table-pro tbody td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--border-light);
        color: var(--text-main);
        font-size: 0.95rem;
    }

    .table-pro tbody tr {
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .table-pro tbody tr:hover {
        background: var(--bg-light);
        box-shadow: inset 0 0 8px rgba(34, 195, 227, 0.08);
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

    .pill-overdue {
        background: rgba(239, 68, 68, 0.15);
        color: #7f1d1d;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    /* Installment Details */
    .installment-details {
        background: var(--bg-light);
        padding: 1.5rem;
        border-radius: 12px;
        margin-top: 1.5rem;
        border-left: 4px solid var(--accent-cyan);
    }

    .installment-item {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        padding: 1rem;
        background: white;
        border-radius: 8px;
        margin-bottom: 0.75rem;
        border-left: 3px solid var(--accent-cyan);
    }

    .installment-item.paid {
        border-left-color: var(--success-green);
        background: rgba(16, 185, 129, 0.02);
    }

    .installment-item.overdue {
        border-left-color: var(--danger-red);
        background: rgba(239, 68, 68, 0.02);
    }

    .inst-header {
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 0.5rem;
    }

    .inst-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .inst-label {
        color: var(--text-secondary);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .inst-value {
        color: var(--text-main);
        font-weight: 600;
    }

    .inst-amount {
        color: var(--accent-cyan);
        font-size: 1.2rem;
        font-weight: 700;
    }

    .inst-paid {
        color: var(--success-green);
        font-weight: 700;
    }

    .inst-overdue {
        color: var(--danger-red);
        font-weight: 700;
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
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-primary-action {
        background: linear-gradient(135deg, var(--accent-cyan) 0%, #1da4c0 100%);
        color: white;
    }

    .btn-primary-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(34, 195, 227, 0.3);
    }

    .btn-secondary-action {
        background: var(--border-light);
        color: var(--text-main);
    }

    .btn-secondary-action:hover {
        background: #d1d5db;
    }

    .btn-small {
        padding: 6px 12px;
        font-size: 0.8rem;
    }

    /* Progress Bar */
    .progress-bar-container {
        background: var(--border-light);
        height: 8px;
        border-radius: 10px;
        overflow: hidden;
        margin: 0.75rem 0;
    }

    .progress-fill {
        background: linear-gradient(90deg, var(--accent-cyan) 0%, var(--success-green) 100%);
        height: 100%;
        transition: width 0.5s ease;
        border-radius: 10px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--text-secondary);
    }

    /* Animations */
    @keyframes slideDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .fees-container {
            padding: 1.5rem;
        }

        .fees-nav {
            flex-direction: column;
        }

        .nav-btn {
            justify-content: center;
        }

        .table-pro {
            font-size: 0.85rem;
        }

        .table-pro thead th,
        .table-pro tbody td {
            padding: 10px;
        }
    }
</style>

<div class="fees-container">
    <!-- Header -->
    <div class="fees-header">
        <h1>💰 Fees Management</h1>
        <p>Manage student fees with integrated installment payment tracking</p>
    </div>

    <!-- Stats Grid (if installment data available) -->
    <?php if (!empty($allInstallments)): 
        $totalAmount = array_sum(array_column($allInstallments, 'installment_amount'));
        $paidAmount = array_sum(array_map(function($i) { return $i['status'] === 'paid' ? $i['installment_amount'] : 0; }, $allInstallments));
        $pendingAmount = array_sum(array_map(function($i) { return $i['status'] !== 'paid' ? $i['installment_amount'] : 0; }, $allInstallments));
        $paymentPercentage = $totalAmount > 0 ? ($paidAmount / $totalAmount * 100) : 0;
    ?>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Installments</div>
            <div class="stat-value"><?php echo count($allInstallments); ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Amount</div>
            <div class="stat-value">₹<?php echo number_format($totalAmount, 0); ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Collected</div>
            <div class="stat-value">₹<?php echo number_format($paidAmount, 0); ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Collection Rate</div>
            <div class="stat-value"><?php echo round($paymentPercentage, 1); ?>%</div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Navigation Tabs -->
    <div class="fees-nav">
        <button class="nav-btn active" onclick="switchTab('admissions')">🎓 Admissions Ready</button>
        <button class="nav-btn" onclick="switchTab('fees-list')">📋 Fee Records</button>
        <button class="nav-btn" onclick="switchTab('installments-tab')">💳 All Installments</button>
    </div>

    <!-- Tab 1: Admissions Ready for Fees -->
    <div id="admissions" class="glass-card tab-pane active">
        <div class="table-responsive">
            <table class="table-pro">
                <thead>
                    <tr>
                        <th>REFERENCE ID</th>
                        <th>CANDIDATE NAME</th>
                        <th>ADMISSION NUMBER</th>
                        <th>DATE RECEIVED</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendingAdmissions)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No pending admissions</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pendingAdmissions as $admission): ?>
                            <tr onclick="openFeesForm(<?php echo $admission['id']; ?>)">
                                <td><span class="ref-id">#<?php echo $admission['id']; ?></span></td>
                                <td><?php echo htmlspecialchars($admission['full_name']); ?></td>
                                <td><span class="code"><?php echo htmlspecialchars($admission['admission_number']); ?></span></td>
                                <td><?php echo date('d M, Y', strtotime($admission['created_at'])); ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>admin-fees-create&id=<?php echo $admission['id']; ?>" class="btn-action btn-primary-action btn-small">
                                        📝 Issue Fees
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab 2: Fees Records -->
    <div id="fees-list" class="glass-card tab-pane hidden">
        <div class="table-responsive">
            <table class="table-pro">
                <thead>
                    <tr>
                        <th>CHALLAN NO</th>
                        <th>STUDENT NAME</th>
                        <th>ADMISSION #</th>
                        <th>TOTAL FEES</th>
                        <th>TOTAL PAID</th>
                        <th>BALANCE</th>
                        <th>INSTALLMENTS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($fees)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No fee records found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($fees as $fee): ?>
                            <tr onclick="expandFeeDetails(<?php echo $fee['id']; ?>)">
                                <td><span class="ref-id"><?php echo htmlspecialchars($fee['challan_no']); ?></span></td>
                                <td><?php echo htmlspecialchars($fee['full_name'] ?? $fee['student_name']); ?></td>
                                <td><span class="code"><?php echo htmlspecialchars($fee['admission_number'] ?? $fee['student_id']); ?></span></td>
                                <td>₹<?php echo number_format($fee['finalized_fees'], 2); ?></td>
                                <td><span class="pill pill-paid">₹<?php echo number_format($fee['total_paid'], 2); ?></span></td>
                                <td><span class="pill pill-pending">₹<?php echo number_format($fee['balance_fees'], 2); ?></span></td>
                                <td>
                                    <span class="pill" style="background: #dbeafe; color: #1e40af;">
                                        5 Installments
                                    </span>
                                </td>
                                <td>
                                    <button class="btn-action btn-primary-action btn-small" onclick="viewInstallments(event, <?php echo $fee['id']; ?>)">
                                        💳 View
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab 3: All Installments -->
    <div id="installments-tab" class="glass-card tab-pane hidden">
        <?php if (empty($allInstallments)): ?>
            <div class="empty-state">
                <div style="font-size: 2rem; margin-bottom: 1rem;">📭</div>
                <p>No installment records found. Create fees to generate installments.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table-pro">
                    <thead>
                        <tr>
                            <th>STUDENT</th>
                            <th>ADMISSION #</th>
                            <th>INST #</th>
                            <th>AMOUNT</th>
                            <th>DUE DATE</th>
                            <th>STATUS</th>
                            <th>PAID DATE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allInstallments as $inst): ?>
                            <tr>
                                <td><?php echo htmlspecialchars(substr($inst['student_name'] ?? 'N/A', 0, 20)); ?></td>
                                <td><span class="code"><?php echo htmlspecialchars($inst['admission_number']); ?></span></td>
                                <td><strong>#<?php echo $inst['installment_number']; ?></strong></td>
                                <td>₹<?php echo number_format($inst['installment_amount'], 2); ?></td>
                                <td><?php echo date('d M Y', strtotime($inst['due_date'])); ?></td>
                                <td>
                                    <?php 
                                    $status = $inst['status'];
                                    $pillClass = 'pill-pending';
                                    if ($status === 'paid') {
                                        $pillClass = 'pill-paid';
                                    } elseif ($status === 'overdue') {
                                        $pillClass = 'pill-overdue';
                                    }
                                    ?>
                                    <span class="pill <?php echo $pillClass; ?>">
                                        <?php echo ucfirst($status); ?>
                                    </span>
                                </td>
                                <td><?php echo $inst['paid_date'] ? date('d M Y', strtotime($inst['paid_date'])) : '—'; ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>installment-challan&id=<?php echo $inst['id']; ?>" class="btn-action btn-secondary-action btn-small">
                                        📄 Challan
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Fee Details Modal / Expandable Section -->
<div id="fee-details-container"></div>

<script>
    function switchTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-pane').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Remove active from all buttons
        document.querySelectorAll('.nav-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Show selected tab
        document.getElementById(tabName).classList.remove('hidden');
        
        // Add active to clicked button
        event.target.classList.add('active');
    }

    function openFeesForm(admissionId) {
        window.location.href = `<?php echo BASE_URL; ?>admin-fees-create&id=${admissionId}`;
    }

    function viewInstallments(event, feeId) {
        event.stopPropagation();
        // Fetch and display installments for this fee
        fetch(`<?php echo BASE_URL; ?>api/fee-installments&fee_id=${feeId}`)
            .then(r => r.json())
            .then(data => {
                showInstallmentsModal(data);
            });
    }

    function expandFeeDetails(feeId) {
        // In a real app, this would expand inline or open a modal
        console.log('Expanding fee details for:', feeId);
    }

    function showInstallmentsModal(installments) {
        // Display installments in a modal or expanded view
        console.log('Showing installments:', installments);
    }
</script>

</div>
