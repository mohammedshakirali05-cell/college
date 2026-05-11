<?php
$pageTitle = 'Faculty';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';
?>

<div class="container-fluid">
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'created_and_emailed'): ?>
        <div class="alert alert-success">Faculty created and credentials emailed successfully.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'created_but_email_failed'): ?>
        <div class="alert alert-warning">Faculty created, but email sending failed.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'create_failed'): ?>
        <div class="alert alert-danger">Faculty creation failed. Email may already exist.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'invalid_input'): ?>
        <div class="alert alert-danger">Fill all required fields properly.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
        <div class="alert alert-success">Faculty updated successfully.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <div class="alert alert-success">Faculty deleted successfully.</div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-header">Add Faculty</div>
                <div class="card-body">
                    <form action="/college/public/index.php?url=create-user" method="POST">
                        <input type="hidden" name="role_id" value="2">
                        <input type="hidden" name="redirect_to" value="faculty">

                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email / Login ID</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <input type="text" name="department" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Create Faculty</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card stat-card">
                <div class="card-header">All Faculty</div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th style="width: 170px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['id']) ?></td>
                                        <td><?= htmlspecialchars(trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''))) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td><?= htmlspecialchars($user['phone'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($user['department'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($user['status']) ?></td>
                                        <td>
                                            <a href="/college/public/index.php?url=edit-user&id=<?= $user['id'] ?>&from=faculty" class="btn btn-sm btn-warning">Edit</a>

                                            <form action="/college/public/index.php?url=delete-user" method="POST" class="d-inline" onsubmit="return confirm('Delete this faculty member?');">
                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                <input type="hidden" name="redirect_to" value="faculty">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No faculty found.</td>
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