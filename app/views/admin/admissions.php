<?php
$pageTitle = 'Admission Requests';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';
?>

<div class="container-fluid">
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'cash_approved'): ?>
        <div class="alert alert-success">Cash payment approved and admission issued.</div>
    <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'approval_failed'): ?>
        <div class="alert alert-danger">Cash approval failed. Please try again.</div>
    <?php endif; ?>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card surface-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Admission Application Tracker</span>
                    <a href="/college/public/index.php?url=admission" class="btn btn-sm btn-primary">New Admission</a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Applicant</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($admissions)): ?>
                                <?php foreach ($admissions as $admission): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($admission['id']) ?></td>
                                        <td><?= htmlspecialchars($admission['full_name']) ?></td>
                                        <td><?= htmlspecialchars(ucfirst($admission['payment_method'] ?: 'none')) ?></td>
                                        <td>
                                            <span class="badge <?= $admission['status'] === 'admitted' ? 'bg-success' : ($admission['status'] === 'cash_request_sent' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                                                <?= htmlspecialchars(str_replace('_', ' ', ucfirst($admission['status']))) ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars(date('d M Y', strtotime($admission['created_at']))) ?></td>
                                        <td>
                                            <?php if ($admission['status'] === 'cash_request_sent'): ?>
                                                <form action="/college/public/index.php?url=admission-approve" method="POST" class="d-inline">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($admission['id']) ?>">
                                                    <button type="submit" class="btn btn-sm btn-success">Approve Cash</button>
                                                </form>
                                            <?php elseif ($admission['status'] === 'admitted' || $admission['status'] === 'form_completed'): ?>
                                                <a href="/college/public/index.php?url=admin-admission-review&id=<?= urlencode($admission['id']) ?>" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-file-check"></i> Review & Approve
                                                </a>
                                            <?php else: ?>
                                                <a href="/college/public/index.php?url=admission-payment&uuid=<?= urlencode($admission['uuid']) ?>" class="btn btn-sm btn-outline-primary">View</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No admission applications found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card surface-card">
                <div class="card-header">Admissions Summary</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Applications
                            <span class="badge bg-primary rounded-pill"><?= htmlspecialchars(count($admissions)) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Cash Pending
                            <span class="badge bg-warning rounded-pill"><?= htmlspecialchars(count(array_filter($admissions, fn($item) => $item['status'] === 'cash_request_sent'))) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Fully Admitted
                            <span class="badge bg-success rounded-pill"><?= htmlspecialchars(count(array_filter($admissions, fn($item) => $item['status'] === 'admitted'))) ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
