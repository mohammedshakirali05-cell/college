<?php
$pageTitle = 'Admission Requests';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-content admission-page">
    <div class="page-content">
        <!-- Alert Messages -->
        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'cash_approved'): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
                style="animation: slideDown 0.35s ease;">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Success!</strong> Cash payment approved and admission issued.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'approval_failed'): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert"
                style="animation: slideDown 0.35s ease;">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                <strong>Error!</strong> Cash approval failed. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Admissions Summary Hero Section -->
        <div class="admissions-hero mb-5" style="animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);">
            <div class="admissions-hero-header">
                <h1 class="admissions-title">Admission Management</h1>
                <p class="admissions-subtitle">Track, review and manage all admission applications in one place.</p>
            </div>

            <!-- KPI Cards -->
            <div class="admissions-kpi-grid">
                <div class="kpi-card kpi-total"
                    style="animation: fadeInUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.1s both;">
                    <div class="kpi-icon"><i class="bi bi-file-earmark-check"></i></div>
                    <div class="kpi-content">
                        <p class="kpi-label">Total Applications</p>
                        <h2 class="kpi-value"><?= htmlspecialchars(count($admissions)) ?></h2>
                        <span class="kpi-trend">All submissions</span>
                    </div>
                </div>

                <div class="kpi-card kpi-pending"
                    style="animation: fadeInUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.15s both;">
                    <div class="kpi-icon"><i class="bi bi-clock-history"></i></div>
                    <div class="kpi-content">
                        <p class="kpi-label">Cash Pending</p>
                        <h2 class="kpi-value">
                            <?= htmlspecialchars(count(array_filter($admissions, fn($item) => $item['status'] === 'cash_request_sent'))) ?>
                        </h2>
                        <span class="kpi-trend">Awaiting payment</span>
                    </div>
                </div>

                <div class="kpi-card kpi-admitted"
                    style="animation: fadeInUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;">
                    <div class="kpi-icon"><i class="bi bi-check-circle-fill"></i></div>
                    <div class="kpi-content">
                        <p class="kpi-label">Fully Admitted</p>
                        <h2 class="kpi-value">
                            <?= htmlspecialchars(count(array_filter($admissions, fn($item) => $item['status'] === 'admitted'))) ?>
                        </h2>
                        <span class="kpi-trend">Approved</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admission Application Tracker Table -->
        <div class="admissions-tracker-section"
            style="animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.25s both;">
            <div class="card surface-card tracker-card">
                <div class="card-header-premium">
                    <div>
                        <h5 class="card-title-premium">Admission Application Tracker</h5>
                        <p class="card-subtitle">Manage and process all admission requests</p>
                    </div>
                    <a href="/college/public/index.php?url=admission" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle-fill me-2"></i>New Admission
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table admissions-table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Applicant</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($admissions)): ?>
                                <?php foreach ($admissions as $index => $admission): ?>
                                    <tr class="table-row-hover"
                                        style="animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) <?= ($index * 0.05) ?>s both;">
                                        <td>
                                            <span
                                                class="badge bg-light text-dark"><?= htmlspecialchars($admission['id']) ?></span>
                                        </td>
                                        <td>
                                            <div class="applicant-cell">
                                                <div class="applicant-avatar">
                                                    <?= strtoupper(substr($admission['full_name'][0] ?? 'A', 0, 1)) ?>
                                                </div>
                                                <span><?= htmlspecialchars($admission['full_name']) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="payment-badge payment-<?= strtolower(str_replace(' ', '-', $admission['payment_method'] ?: 'none')) ?>">
                                                <?= htmlspecialchars(ucfirst($admission['payment_method'] ?: 'None')) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="status-badge status-<?= strtolower(str_replace('_', '-', $admission['status'])) ?>">
                                                <?= htmlspecialchars(str_replace('_', ' ', ucfirst($admission['status']))) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small
                                                class="text-secondary"><?= htmlspecialchars(date('d M Y', strtotime($admission['created_at']))) ?></small>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <?php if ($admission['status'] === 'cash_request_sent'): ?>
                                                    <form action="/college/public/index.php?url=admission-approve" method="POST"
                                                        class="d-inline">
                                                        <input type="hidden" name="id"
                                                            value="<?= htmlspecialchars($admission['id']) ?>">
                                                        <button type="submit" class="btn btn-sm btn-success action-btn">
                                                            <i class="bi bi-check"></i> Approve Cash
                                                        </button>
                                                    </form>
                                                <?php elseif ($admission['status'] === 'admitted' || $admission['status'] === 'form_completed'): ?>
                                                    <a href="/college/public/index.php?url=admin-admission-review&id=<?= urlencode($admission['id']) ?>"
                                                        class="btn btn-sm btn-primary action-btn">
                                                        <i class="bi bi-file-check"></i> Review
                                                    </a>
                                                <?php else: ?>
                                                    <a href="/college/public/index.php?url=admin-admission-review&id=<?= urlencode($admission['id']) ?>"
                                                        class="btn btn-sm btn-outline-primary action-btn">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-inbox" style="font-size: 2rem; color: #ccc;"></i>
                                        <p class="mt-3 text-muted">No admission applications found.</p>
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

<?php include __DIR__ . '/../layouts/footer.php'; ?>