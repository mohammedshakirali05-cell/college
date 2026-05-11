<?php
$pageTitle = 'Overall Report';
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

    .overall-report-hero {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-cyan) 100%) !important;
        color: white !important;
        border-radius: 16px !important;
        overflow: visible !important;
        position: relative !important;
        box-shadow: 0 20px 50px rgba(29, 63, 122, 0.15) !important;
        min-height: 280px !important;
        display: flex !important;
        align-items: center !important;
    }

    .overall-report-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top left, rgba(255,255,255,0.08), transparent 30%),
            radial-gradient(circle at bottom right, rgba(255,255,255,0.03), transparent 22%);
        pointer-events: none;
        border-radius: 16px;
    }

    .overall-report-hero .card-body {
        position: relative;
        z-index: 2 !important;
        width: 100% !important;
        visibility: visible !important;
        display: block !important;
    }

    .overall-report-hero .row {
        position: relative !important;
        z-index: 2 !important;
    }

    .overall-report-hero .col-lg-8,
    .overall-report-hero .col-lg-4 {
        position: relative !important;
        z-index: 2 !important;
        visibility: visible !important;
    }

    .overall-report-hero .col-lg-8 p,
    .overall-report-hero .col-lg-8 h1 {
        visibility: visible !important;
        opacity: 1 !important;
        display: block !important;
    }

    .overall-report-hero .d-flex {
        position: relative !important;
        z-index: 2 !important;
    }

    /* Report Title */
    .report-title-animated {
        font-size: 2.5rem !important;
        font-weight: 700 !important;
        letter-spacing: 0.5px !important;
        margin-bottom: 0.5rem !important;
        color: white !important;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3) !important;
        visibility: visible !important;
        display: block !important;
        opacity: 1 !important;
        line-height: 1.2 !important;
    }

    /* Report Label */
    .report-label-animated {
        text-transform: uppercase !important;
        letter-spacing: 2px !important;
        font-size: 1rem !important;
        font-weight: 700 !important;
        color: rgba(255, 255, 255, 0.95) !important;
        margin-bottom: 1rem !important;
        visibility: visible !important;
        display: block !important;
        opacity: 1 !important;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2) !important;
    }

    /* Report Description */
    .report-description-animated {
        color: rgba(255, 255, 255, 0.95) !important;
        font-size: 1rem !important;
        line-height: 1.6 !important;
        visibility: visible !important;
        display: block !important;
        opacity: 1 !important;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2) !important;
        margin-bottom: 1rem !important;
    }

    /* Summary Cards */
    .report-summary-card {
        border: 2px solid rgba(255,255,255,0.3) !important;
        background: rgba(255,255,255,0.12) !important;
        backdrop-filter: blur(10px) !important;
        border-radius: 12px !important;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1), inset 0 0 0 1px rgba(255,255,255,0.15) !important;
        transition: all 0.3s ease !important;
        padding: 1.5rem !important;
        min-height: 110px !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .report-summary-card:hover {
        transform: translateY(-5px) !important;
        background: rgba(255,255,255,0.18) !important;
        box-shadow: 0 12px 40px rgba(0,0,0,0.15), inset 0 0 0 1px rgba(255,255,255,0.2) !important;
    }

    .report-summary-card small {
        color: rgba(255,255,255,0.85) !important;
        font-size: 0.9rem !important;
        font-weight: 600 !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .report-summary-card h3 {
        color: white !important;
        font-weight: 700 !important;
        margin-top: 0.75rem !important;
        font-size: 2rem !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Report Container */
    .container-fluid {
        background: var(--bg-light);
        padding: 2rem 0;
    }

    /* Card Styling */
    .surface-card {
        background: var(--card-white);
        border: 1px solid var(--border-light);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .card-header {
        border-bottom: 1px solid var(--border-light);
        background: linear-gradient(135deg, rgba(29, 63, 122, 0.05) 0%, rgba(34, 195, 227, 0.05) 100%);
        padding: 1.5rem;
    }

    .card-header h5 {
        color: var(--primary-blue);
        font-weight: 700;
    }

    .card-header .text-muted {
        color: var(--text-secondary) !important;
        font-size: 0.9rem;
    }

    /* Table Styling */
    .table-report {
        margin: 0;
    }

    .table-report thead th {
        background: linear-gradient(135deg, var(--primary-blue) 0%, #16325d 100%);
        color: white;
        border-color: var(--primary-blue);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 12px;
        border: none;
    }

    .table-report tbody td {
        padding: 12px;
        border-color: var(--border-light);
        color: var(--text-main);
        vertical-align: middle;
    }

    .table-report tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid var(--border-light);
    }

    .table-report tbody tr:hover {
        background: linear-gradient(90deg, rgba(34, 195, 227, 0.05) 0%, rgba(29, 63, 122, 0.02) 100%);
        transform: translateX(1px);
    }

    /* Status Badges */
    .remark-badge {
        display: inline-block;
        min-width: 110px;
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-align: center;
        text-transform: capitalize;
    }

    .bg-success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(16, 185, 129, 0.1) 100%) !important;
        color: #065f46 !important;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .bg-warning {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(245, 158, 11, 0.1) 100%) !important;
        color: #92400e !important;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .bg-info {
        background: linear-gradient(135deg, rgba(34, 195, 227, 0.2) 0%, rgba(34, 195, 227, 0.1) 100%) !important;
        color: #164e63 !important;
        border: 1px solid rgba(34, 195, 227, 0.3);
    }

    .bg-primary {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-cyan) 100%) !important;
        color: white !important;
        border: none !important;
    }

    /* Export Buttons */
    .export-btn {
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 16px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: 1px solid var(--border-light);
        background: var(--card-white);
        color: var(--text-main);
    }

    .export-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        border-color: var(--accent-cyan);
        color: var(--primary-blue);
    }
/* Search Bar */
.report-search-wrapper {
    position: relative;
    width: 100%;
    max-width: 420px;
}

.report-search-input {
    width: 100%;
    height: 52px;
    border-radius: 14px;
    border: 1px solid var(--border-light);
    background: #fff;
    padding: 0 52px 0 48px;
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--text-main);
    transition: all 0.25s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.report-search-input:focus {
    outline: none;
    border-color: var(--accent-cyan);
    box-shadow: 0 0 0 4px rgba(34,195,227,0.12);
}

.report-search-icon {
    position: absolute;
    top: 50%;
    left: 16px;
    transform: translateY(-50%);
    color: var(--text-secondary);
    font-size: 1rem;
}

.report-search-clear {
    position: absolute;
    top: 50%;
    right: 14px;
    transform: translateY(-50%);
    border: none;
    background: transparent;
    color: var(--text-secondary);
    cursor: pointer;
    display: none;
    font-size: 1rem;
}

.report-search-clear:hover {
    color: var(--danger-red);
}

.search-result-info {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin-top: 10px;
    font-weight: 500;
}
    /* Summary Badges */
    .summary-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin: 16px 0;
    }

    .summary-badges .badge {
        font-size: 0.85rem;
        padding: 8px 14px;
        border-radius: 50px;
        font-weight: 700;
        text-transform: capitalize;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .report-title-animated {
            font-size: 2rem !important;
            margin-bottom: 0.75rem !important;
        }

        .report-label-animated {
            font-size: 0.9rem !important;
            margin-bottom: 0.75rem !important;
        }

        .report-description-animated {
            font-size: 0.9rem !important;
        }
        
        .d-flex.flex-column.flex-md-row {
            flex-direction: column !important;
        }

        .overall-report-hero .card-body {
            min-height: 240px !important;
        }
    }

    @media (max-width: 768px) {
        .card-header {
            padding: 1rem;
        }

        .table-report {
            font-size: 0.85rem;
        }

        .table-report thead th,
        .table-report tbody td {
            padding: 8px;
        }

        .report-title-animated {
            font-size: 1.5rem !important;
            margin-bottom: 0.75rem !important;
        }

        .report-label-animated {
            font-size: 0.8rem !important;
            margin-bottom: 0.5rem !important;
        }

        .report-description-animated {
            font-size: 0.85rem !important;
            margin-bottom: 0.75rem !important;
        }

        .report-summary-card {
            min-height: 90px !important;
            padding: 1rem !important;
        }

        .report-summary-card h3 {
            font-size: 1.5rem !important;
            margin-top: 0.5rem !important;
        }

        .overall-report-hero .card-body {
            padding: 2rem 1rem !important;
            min-height: auto !important;
        }
    }
</style>

<div class="container-fluid">
    <div class="row mb-4" style="padding: 2rem 1rem 0 1rem;">
        <div class="col-12">
            <div class="card surface-card overall-report-hero">
                <div class="card-body py-5 px-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <p class="report-label-animated">📊 Overall Report</p>
                            <h1 class="report-title-animated">Fees Performance Analytics</h1>
                            <p class="report-description-animated mb-4">Comprehensive view of all student fee payments, including total fees, concessions, installments, and pending balances. Updated in real-time from the fees module.</p>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex flex-column gap-3">
                                <div class="report-summary-card">
                                    <small>📋 Total Entries</small>
                                    <h3 class="mb-0"><?= number_format($reportSummary['total_records']) ?></h3>
                                </div>
                                <div class="report-summary-card">
                                    <small>✓ Completed Payments</small>
                                    <h3 class="mb-0"><?= number_format($reportSummary['paid_count']) ?></h3>
                                </div>
                                <div class="report-summary-card">
                                    <small>⏳ Pending Balances</small>
                                    <h3 class="mb-0"><?= number_format($reportSummary['pending_count']) ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4" style="padding: 0 1rem;">
        <div class="col-12">
            <div class="card surface-card">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <div>
                        <h5 class="mb-1">💰 Overall Fees Report</h5>
                        <p class="text-muted mb-0">Complete fee tracking with payment status and balance details.</p>
                    </div>
                    <div class="d-flex flex-column flex-md-row gap-2 mt-3 mt-md-0">
                        <button class="btn export-btn" onclick="window.print()">
                            <i class="bi bi-printer"></i> Print Report
                        </button>
                        <button class="btn export-btn" onclick="exportToCSV()">
                            <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV
                        </button>
                    </div>
                </div>
                <div class="card-body">
              <!-- Professional Live Search -->
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div class="report-search-wrapper">
        <i class="bi bi-search report-search-icon"></i>

        <input
            type="text"
            id="reportSearch"
            class="report-search-input"
            placeholder="Search by Reg No, Candidate Name, Balance or Status..."
            autocomplete="off"
        >

        <button
            type="button"
            id="clearSearch"
            class="report-search-clear"
        >
            <i class="bi bi-x-circle-fill"></i>
        </button>
    </div>

    <div class="search-result-info">
        Showing <span id="visibleRowCount"><?= count($reportRows) ?></span>
        of <?= count($reportRows) ?> records
    </div>

</div>
                <div class="summary-badges">
                        <span class="badge bg-primary">💵 Total Fees: ₹<?= number_format($reportSummary['total_finalized'], 2) ?></span>
                        <span class="badge bg-success">✓ Paid: ₹<?= number_format($reportSummary['total_paid'], 2) ?></span>
                        <span class="badge bg-warning">⏳ Balance: ₹<?= number_format($reportSummary['total_balance'], 2) ?></span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle table-report" id="feesReportTable">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Reg No</th>
                                    <th>Name of Candidate</th>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Total Fees</th>
                                    <th>Concession Fees</th>
                                    <th>Finalized Fees</th>
                                    <th>Fees Paid<br><small style="font-weight: 500;">Installments 1-5</small></th>
                                    <th>Balance</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reportRows)): ?>
                                    <?php foreach ($reportRows as $index => $fee): ?>
                                        <?php
                                            $installments = sprintf(
                                                '₹%s / ₹%s / ₹%s / ₹%s / ₹%s',
                                                number_format($fee['installment_1'], 2),
                                                number_format($fee['installment_2'], 2),
                                                number_format($fee['installment_3'], 2),
                                                number_format($fee['installment_4'], 2),
                                                number_format($fee['installment_5'], 2)
                                            );

                                            $balance = (float)$fee['balance_fees'];
                                            if ($balance <= 0) {
                                                $status = '✓ Paid in Full';
                                                $badgeClass = 'badge bg-success';
                                            } elseif ((float)$fee['total_paid'] <= 0) {
                                                $status = '⏳ Awaiting Payment';
                                                $badgeClass = 'badge bg-info';
                                            } else {
                                                $status = '⏳ Pending Balance';
                                                $badgeClass = 'badge bg-warning';
                                            }
                                        ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td style="font-weight: 600; color: var(--accent-cyan);"><?= htmlspecialchars($fee['admission_number'] ?: $fee['student_id']) ?></td>
                                           <td style="font-weight: 600;">
    <?= htmlspecialchars($fee['candidate_name'] ?: $fee['student_name']) ?>
</td>

<td>
   <?= htmlspecialchars($fee['course'] ?? 'N/A') ?>
</td>

<td>
    <?= htmlspecialchars($fee['academic_year'] ?? 'N/A') ?>
</td>

<td>₹<?= number_format($fee['college_total_fees'], 2) ?></td>
                                            <td>₹<?= number_format($fee['concession_fees'], 2) ?></td>
                                            <td style="font-weight: 600;">₹<?= number_format($fee['finalized_fees'], 2) ?></td>
                                            <td>
                                                <div class="small mb-1" style="color: var(--text-secondary);">Total Paid: ₹<?= number_format($fee['total_paid'], 2) ?></div>
                                                <div class="text-wrap" style="max-width: 240px; font-size: 0.85rem;"><?= htmlspecialchars($installments) ?></div>
                                            </td>
                                            <td style="color: var(--danger-red); font-weight: 600;">₹<?= number_format($fee['balance_fees'], 2) ?></td>
                                            <td><span class="remark-badge <?= $badgeClass ?>"><?= $status ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-5">
                                            <div style="font-size: 2rem; opacity: 0.3; margin-bottom: 0.5rem;">📊</div>
                                            <strong>No fee report data available yet.</strong><br>
                                            <small>Fee records will appear here once created in the Fees module.</small>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('reportSearch');
    const clearButton = document.getElementById('clearSearch');
    const table = document.getElementById('feesReportTable');
    const tbody = table.querySelector('tbody');
    const rows = tbody.querySelectorAll('tr');
    const visibleCount = document.getElementById('visibleRowCount');

    function filterTable() {

        const search = searchInput.value.toLowerCase().trim();
        let visibleRows = 0;

        rows.forEach(row => {

            const rowText = row.innerText.toLowerCase();

            if (rowText.includes(search)) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }

        });

        visibleCount.textContent = visibleRows;

        clearButton.style.display = search.length > 0 ? 'block' : 'none';
    }

    searchInput.addEventListener('keyup', filterTable);

    clearButton.addEventListener('click', function () {
        searchInput.value = '';
        filterTable();
        searchInput.focus();
    });

});

function exportToCSV() {

    const table = document.getElementById('feesReportTable');
    let csv = [];

    const headers = [];

    for (let i = 0; i < table.rows[0].cells.length; i++) {

        headers.push(
            table.rows[0].cells[i].innerText
                .replace(/\n/g, ' ')
                .replace(/<[^>]*>/g, '')
        );
    }

    csv.push(headers.join(','));

    for (let i = 1; i < table.rows.length; i++) {

        if (table.rows[i].style.display === 'none') {
            continue;
        }

        const row = [];

        for (let j = 0; j < table.rows[i].cells.length; j++) {

            let cellText = table.rows[i].cells[j].innerText
                .replace(/\n/g, ' ')
                .replace(/<[^>]*>/g, '');

            cellText = cellText.replace(/₹/g, '').trim();

            row.push('"' + cellText + '"');
        }

        csv.push(row.join(','));
    }

    const csvContent = csv.join('\n');

    const blob = new Blob(
        [csvContent],
        { type: 'text/csv;charset=utf-8;' }
    );

    const link = document.createElement('a');

    const url = URL.createObjectURL(blob);

    link.setAttribute('href', url);

    link.setAttribute(
        'download',
        'fees_report_' + new Date().toISOString().split('T')[0] + '.csv'
    );

    link.style.visibility = 'hidden';

    document.body.appendChild(link);

    link.click();

    document.body.removeChild(link);
}
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>