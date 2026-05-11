<?php
$pageTitle = 'My Profile';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';

$firstLetter = strtoupper(substr($user['first_name'] ?? 'U', 0, 1));
?>

<div class="container-fluid">
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
        <div class="alert alert-success">Profile updated successfully.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'update_failed'): ?>
        <div class="alert alert-danger">Profile update failed. Email may already exist.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'invalid_input'): ?>
        <div class="alert alert-danger">First name and email are required.</div>
    <?php endif; ?>

    <div class="col-lg-4">
    <div class="card surface-card">
        <div class="card-body text-center p-4">
            <div class="avatar-circle mx-auto mb-3">
                <?= htmlspecialchars($firstLetter) ?>
            </div>

            <h4 class="mb-1">
                <?= htmlspecialchars(trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''))) ?>
            </h4>

            <p class="text-muted mb-3"><?= htmlspecialchars($user['email'] ?? '') ?></p>

            <span class="badge bg-dark mb-3"><?= htmlspecialchars($user['role_name'] ?? '') ?></span>

            <div class="profile-meta text-start mt-3">
                <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone'] ?? '') ?></p>
                <p><strong>Department:</strong> <?= htmlspecialchars($user['department'] ?? '') ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($user['status'] ?? '') ?></p>
            </div>

            <a href="/college/public/index.php?url=logout" class="btn btn-outline-danger w-100 mt-3">Logout</a>
        </div>
    </div>
</div>

        <div class="col-lg-8">
            <div class="card stat-card">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    <form action="/college/public/index.php?url=update-profile" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control"
                                       value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control"
                                       value="<?= htmlspecialchars($user['last_name'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                       value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control"
                                       value="<?= htmlspecialchars($user['department'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="/college/public/index.php?url=dashboard" class="btn btn-secondary">Back to Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>