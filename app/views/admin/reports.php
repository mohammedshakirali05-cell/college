<?php
$pageTitle = 'Overall Report';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';

// Message handling
$msg = $_GET['msg'] ?? '';
$courses = array_values(array_filter(array_unique(array_map(function ($student) {
    return $student['course'];
}, $students))));
sort($courses, SORT_NATURAL | SORT_FLAG_CASE);

$classes = array_values(array_filter(array_unique(array_map(function ($student) {
    return $student['class_label'];
}, $students))));
sort($classes, SORT_NATURAL | SORT_FLAG_CASE);
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

    /* Filter Controls */
    .filter-controls {
        background: var(--card-white);
        border: 1px solid var(--border-light);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
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
    <?php if ($msg === 'installment_saved'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 1rem;">
            <strong>Success!</strong> Installment payment recorded successfully. Redirecting to challan...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($msg === 'installment_invalid'): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 1rem;">
            <strong>Error!</strong> Invalid installment details or amount exceeds pending balance.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row mb-4" style="padding: 2rem 1rem 0 1rem;">
        <div class="col-12">
            <div class="card surface-card overall-report-hero">
                <div class="card-body py-5 px-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <p class="report-label-animated">📊 Overall Report</p>
                            <h1 class="report-title-animated">Fees Performance Analytics</h1>
                            <p class="report-description-animated mb-4">Comprehensive view of all student fee payments, including total fees, concessions, installments, and pending balances. Manage installment payments directly from this page.</p>
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
                        <p class="text-muted mb-0">Complete fee tracking with payment status, balance details, and installment management.</p>
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
                    <!-- Filter Controls -->
                    <div class="filter-controls mb-4">
                        <div class="row g-3 align-items-end">
                            <div class="col-lg-4 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input id="studentSearch" type="search" class="form-control" placeholder="Name, Reg No, Mobile, Course, Year...">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <select id="courseFilter" class="form-select">
                                    <option value="">All Courses</option>
                                    <?php foreach ($courses as $course): ?>
                                        <option value="<?= htmlspecialchars(strtolower($course), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($course) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <select id="classFilter" class="form-select">
                                    <option value="">All Years</option>
                                    <?php foreach ($classes as $class): ?>
                                        <option value="<?= htmlspecialchars(strtolower($class), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($class) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <select id="statusFilter" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="paid">Paid</option>
                                    <option value="part paid">Part Paid</option>
                                    <option value="pending">Pending</option>
                                    <option value="no fees">No Fees</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <button id="clearFiltersBtn" class="btn btn-outline-secondary w-100">Clear Filters</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                        <div class="search-result-info">
                            Showing <span id="visibleRowCount"><?= count($students) ?></span>
                            of <?= count($students) ?> records
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
                                    <th>Paid Amount</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($students)): ?>
                                    <?php $slNo = 1; foreach ($students as $student): ?>
                                        <?php
                                            $detailsJson = htmlspecialchars(json_encode($student), ENT_QUOTES, 'UTF-8');
                                            $feeId = $student['fee_id'] ?? null;
                                            $status = $student['fee_status'] ?? 'No Fees';
                                            
                                            if ($status === 'Paid') {
                                                $badgeClass = 'bg-success';
                                            } elseif ($status === 'Part Paid') {
                                                $badgeClass = 'bg-warning';
                                            } elseif ($status === 'Pending') {
                                                $badgeClass = 'bg-info';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        ?>
                                        <tr class="student-row"
                                            data-search="<?= htmlspecialchars(strtolower($student['full_name'] . ' ' . $student['student_id'] . ' ' . $student['contact_mobile'] . ' ' . $student['course'] . ' ' . $student['class_label'] . ' ' . $status), ENT_QUOTES, 'UTF-8') ?>"
                                            data-course="<?= htmlspecialchars(strtolower($student['course']), ENT_QUOTES, 'UTF-8') ?>"
                                            data-class="<?= htmlspecialchars(strtolower($student['class_label']), ENT_QUOTES, 'UTF-8') ?>"
                                            data-status="<?= htmlspecialchars(strtolower($status), ENT_QUOTES, 'UTF-8') ?>"
                                            data-details="<?= $detailsJson ?>"
                                        >
                                            <td><?= $slNo++ ?></td>
                                            <td style="font-weight: 600; color: var(--accent-cyan);"><?= htmlspecialchars($student['student_id']) ?></td>
                                            <td style="font-weight: 600;"><?= htmlspecialchars($student['full_name']) ?></td>
                                            <td><?= htmlspecialchars($student['course']) ?></td>
                                            <td><?= htmlspecialchars($student['class_label']) ?></td>
                                            <td>₹<?= number_format($student['total_fees'], 2) ?></td>
                                            <td>₹<?= number_format($student['concession_fees'] ?? 0, 2) ?></td>
                                            <td style="font-weight: 600;">₹<?= number_format($student['finalized_fees'] ?? $student['total_fees'], 2) ?></td>
                                            <td>₹<?= number_format($student['paid_fees'], 2) ?></td>
                                            <td style="color: var(--danger-red); font-weight: 600;">₹<?= number_format($student['pending_fees'], 2) ?></td>
                                            <td><span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($status) ?></span></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-primary view-student-btn" data-bs-toggle="modal" data-bs-target="#studentDetailsModal">
                                                    <i class="bi bi-eye"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="12" class="text-center text-muted py-5">
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

<!-- Student Details Modal -->
<div class="modal fade" id="studentDetailsModal" tabindex="-1" aria-labelledby="studentDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="studentDetailsModalLabel">Student Fee Details</h5>
                    <small class="text-muted" id="modalSubtitle">Complete fee record and installment management</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Student Profile</h6>
                                <span class="badge bg-secondary" id="detailFeeStatus">Status</span>
                            </div>
                            <div class="row g-2">
                                <div class="col-sm-6"><strong>Name</strong><p id="detailFullName" class="mb-0"></p></div>
                                <div class="col-sm-6"><strong>Student ID</strong><p id="detailStudentId" class="mb-0"></p></div>
                                <div class="col-sm-6"><strong>Course</strong><p id="detailCourse" class="mb-0"></p></div>
                                <div class="col-sm-6"><strong>Year</strong><p id="detailClass" class="mb-0"></p></div>
                                <div class="col-sm-6"><strong>Mobile</strong><p id="detailMobile" class="mb-0"></p></div>
                                <div class="col-sm-6"><strong>Email</strong><p id="detailEmail" class="mb-0"></p></div>
                                <div class="col-sm-6"><strong>Parent Name</strong><p id="detailParent" class="mb-0"></p></div>
                                <div class="col-sm-6"><strong>Challan No</strong><p id="detailChallan" class="mb-0"></p></div>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm p-3 mb-3">
                            <h6 class="mb-3">Fee Summary</h6>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="small text-muted">Total Fees</div>
                                    <h5 id="detailTotalFees" class="mb-0"></h5>
                                </div>
                                <div class="col-sm-6">
                                    <div class="small text-muted">Concession</div>
                                    <h5 id="detailConcessionFees" class="mb-0"></h5>
                                </div>
                                <div class="col-sm-6">
                                    <div class="small text-muted">Finalized Fees</div>
                                    <h5 id="detailFinalizedFees" class="mb-0"></h5>
                                </div>
                                <div class="col-sm-6">
                                    <div class="small text-muted">Paid Amount</div>
                                    <h5 id="detailPaidFees" class="mb-0"></h5>
                                </div>
                                <div class="col-sm-12">
                                    <div class="small text-muted">Pending Balance</div>
                                    <h4 id="detailPendingFees" class="mb-0"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Payment History</h6>
                                <span class="badge bg-info" id="installmentCount">0</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover mb-0">
                                    <thead class="table-light">
                                        <tr><th>#</th><th>Amount</th><th>Date</th><th>Mode</th><th>Receipt</th></tr>
                                    </thead>
                                    <tbody id="installmentHistoryBody"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm p-3 mb-3">
                            <h6 class="mb-3">Record New Installment</h6>
                            <form id="installmentForm" action="<?= BASE_URL ?>reports-installment" method="POST">
                                <input type="hidden" name="fee_id" id="formFeeId" value="">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" min="0" max="99999.99" name="amount" id="installmentAmount" class="form-control" required>
                                        <small class="text-muted" id="maxAmountHint"></small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Payment Date</label>
                                        <input type="date" name="paid_date" id="installmentDate" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Payment Mode</label>
                                        <select name="payment_mode" class="form-select" id="paymentMode">
                                            <option value="cash">Cash</option>
                                            <option value="online">Online</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="cheque">Cheque</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Receipt Number</label>
                                        <input type="text" name="receipt_number" id="receiptNumber" class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Remarks</label>
                                        <textarea name="notes" id="installmentNotes" class="form-control" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="mt-3 d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="saveInstallmentBtn">Save & Proceed to Challan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const rows = Array.from(document.querySelectorAll('#feesReportTable tbody tr.student-row'));
    const searchInput = document.getElementById('studentSearch');
    const courseFilter = document.getElementById('courseFilter');
    const classFilter = document.getElementById('classFilter');
    const statusFilter = document.getElementById('statusFilter');
    const clearFiltersBtn = document.getElementById('clearFiltersBtn');
    const tableBody = document.querySelector('#feesReportTable tbody');
    const visibleCount = document.getElementById('visibleRowCount');

    function filterAndRender() {
        const query = searchInput.value.trim().toLowerCase();
        const course = courseFilter.value;
        const classValue = classFilter.value;
        const status = statusFilter.value;

        let visibleRows = rows.filter(row => {
            const matchesSearch = query === '' || row.dataset.search.includes(query);
            const matchesCourse = course === '' || row.dataset.course === course;
            const matchesClass = classValue === '' || row.dataset.class === classValue;
            const matchesStatus = status === '' || row.dataset.status === status;
            return matchesSearch && matchesCourse && matchesClass && matchesStatus;
        });

        tableBody.innerHTML = '';
        visibleRows.forEach((row, index) => {
            row.querySelector('td').textContent = index + 1;
            tableBody.appendChild(row);
        });

        visibleCount.textContent = visibleRows.length;

        if (visibleRows.length === 0) {
            const noDataRow = document.createElement('tr');
            noDataRow.innerHTML = '<td colspan="12" class="text-center py-4">No matching records found.</td>';
            tableBody.appendChild(noDataRow);
        }
    }

    searchInput.addEventListener('input', filterAndRender);
    courseFilter.addEventListener('change', filterAndRender);
    classFilter.addEventListener('change', filterAndRender);
    statusFilter.addEventListener('change', filterAndRender);

    clearFiltersBtn.addEventListener('click', () => {
        searchInput.value = '';
        courseFilter.value = '';
        classFilter.value = '';
        statusFilter.value = '';
        filterAndRender();
    });

    // Modal and form handling
    document.querySelectorAll('.view-student-btn').forEach(button => {
        button.addEventListener('click', event => {
            const row = event.target.closest('tr');
            const details = JSON.parse(row.dataset.details || '{}');
            updateModal(details);
        });
    });

    function updateModal(details) {
        document.getElementById('detailFullName').textContent = details.full_name || 'N/A';
        document.getElementById('detailStudentId').textContent = details.student_id || 'N/A';
        document.getElementById('detailCourse').textContent = details.course || 'N/A';
        document.getElementById('detailClass').textContent = details.class_label || 'N/A';
        document.getElementById('detailMobile').textContent = details.contact_mobile || 'N/A';
        document.getElementById('detailEmail').textContent = details.contact_email || 'N/A';
        document.getElementById('detailParent').textContent = details.parent_name || 'N/A';
        document.getElementById('detailChallan').textContent = details.challan_no || 'N/A';
        document.getElementById('detailTotalFees').textContent = '₹' + (parseFloat(details.total_fees) || 0).toFixed(2);
        document.getElementById('detailConcessionFees').textContent = '₹' + (parseFloat(details.concession_fees) || 0).toFixed(2);
        document.getElementById('detailFinalizedFees').textContent = '₹' + (parseFloat(details.finalized_fees) || details.total_fees || 0).toFixed(2);
        document.getElementById('detailPaidFees').textContent = '₹' + (parseFloat(details.paid_fees) || 0).toFixed(2);
        document.getElementById('detailPendingFees').textContent = '₹' + (parseFloat(details.pending_fees) || 0).toFixed(2);
        document.getElementById('detailFeeStatus').textContent = details.fee_status || 'N/A';
        document.getElementById('formFeeId').value = details.fee_id || '';
        document.getElementById('installmentAmount').max = parseFloat(details.pending_fees) || 0;
        document.getElementById('maxAmountHint').textContent = 'Max: ₹' + (parseFloat(details.pending_fees) || 0).toFixed(2);
        document.getElementById('installmentDate').valueAsDate = new Date();

        // Update installment history
        const historyBody = document.getElementById('installmentHistoryBody');
        historyBody.innerHTML = '';
        const installments = details.installments || [];
        document.getElementById('installmentCount').textContent = installments.length;

        if (installments.length) {
            installments.forEach((inst, idx) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${idx + 1}</td>
                    <td>₹${parseFloat(inst.amount).toFixed(2)}</td>
                    <td>${inst.paid_date || 'N/A'}</td>
                    <td>${inst.payment_mode || 'N/A'}</td>
                    <td>${inst.receipt_number || 'N/A'}</td>
                `;
                historyBody.appendChild(row);
            });
        } else {
            const row = document.createElement('tr');
            row.innerHTML = '<td colspan="5" class="text-center text-muted py-3">No installments recorded yet.</td>';
            historyBody.appendChild(row);
        }
    }

    // Form submission
    document.getElementById('installmentForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const feeId = document.getElementById('formFeeId').value;
        const amount = parseFloat(document.getElementById('installmentAmount').value);
        const maxAmount = parseFloat(document.getElementById('installmentAmount').max);

        if (!feeId) {
            alert('No fee record selected. Please select a student with fees.');
            return;
        }

        if (amount <= 0 || amount > maxAmount) {
            alert('Invalid amount. Please enter an amount between ₹0 and ₹' + maxAmount.toFixed(2));
            return;
        }

        this.submit();
    });
});

function exportToCSV() {
    const table = document.getElementById('feesReportTable');
    const visibleRows = Array.from(table.querySelectorAll('tbody tr')).filter(row => row.style.display !== 'none');
    
    if (visibleRows.length === 0) {
        alert('No records to export.');
        return;
    }

    const headers = [];
    for (let i = 0; i < table.rows[0].cells.length - 1; i++) {
        headers.push(table.rows[0].cells[i].innerText.trim());
    }

    const csv = [headers.join(',')];
    visibleRows.forEach(row => {
        const cells = [];
        for (let i = 0; i < row.cells.length - 1; i++) {
            let cellText = row.cells[i].innerText.trim().replace(/\n/g, ' ').replace(/"/g, '""');
            cells.push('"' + cellText + '"');
        }
        csv.push(cells.join(','));
    });

    const blob = new Blob([csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'fees_report_' + new Date().toISOString().split('T')[0] + '.csv';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>