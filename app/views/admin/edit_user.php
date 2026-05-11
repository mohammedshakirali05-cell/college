<?php
$pageTitle = 'Edit User';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';

$redirectTo = $_GET['from'] ?? 'dashboard';
?>

<div class="container-fluid">
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'update_failed'): ?>
        <div class="alert alert-danger">Update failed. Email may already exist.</div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card stat-card">
                <div class="card-header">Edit <?= htmlspecialchars($user['role_name'] ?? 'User') ?></div>
                <div class="card-body">
                    <?php if ($user): ?>
                        <form action="/college/public/index.php?url=update-user" method="POST">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                            <input type="hidden" name="redirect_to" value="<?= htmlspecialchars($redirectTo) ?>">

                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control" value="<?= htmlspecialchars($user['department'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active" <?= ($user['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= ($user['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    <option value="suspended" <?= ($user['status'] ?? '') === 'suspended' ? 'selected' : '' ?>>Suspended</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update User</button>
                            <a href="/college/public/index.php?url=<?= htmlspecialchars($redirectTo) ?>" class="btn btn-secondary">Cancel</a>
                        </form>
                    <?php else: ?>
                        <p>User not found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>