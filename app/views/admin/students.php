<?php
$pageTitle = 'Students';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';
?>

<div class="container-fluid">
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'created_and_emailed'): ?>
        <div class="alert alert-success">Student created and credentials emailed successfully.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'created_but_email_failed'): ?>
        <div class="alert alert-warning">Student created, but email sending failed.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'create_failed'): ?>
        <div class="alert alert-danger">Student creation failed. Email may already exist.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'invalid_input'): ?>
        <div class="alert alert-danger">Fill all required fields properly.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
        <div class="alert alert-success">Student updated successfully.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <div class="alert alert-success">Student deleted successfully.</div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-header">Add Student</div>
                <div class="card-body">
                    <form action="/college/public/index.php?url=create-user" method="POST">
                        <input type="hidden" name="role_id" value="3">
                        <input type="hidden" name="redirect_to" value="students">

                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                pattern="[A-Za-z ]+"
                                title="Only letters allowed"
                                oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                pattern="[A-Za-z ]+"
                                oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"
                                title="Only letters allowed">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" class="form-control"
                                pattern="[0-9]{10}"
                                maxlength="10"
                                Oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                title="Enter exactly 10 digits">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email / Login ID</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}"
                                title="Must contain 8 characters, 1 uppercase, 1 lowercase, 1 number, 1 special character"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department" class="form-control" required>
                                <option value="">Select Department</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="BCA">BCA</option>
                                <option value="BBA">BBA</option>
                                <option value="Commerce">Commerce</option>
                                <option value="Science">Science</option>
                            </select>

                            <!-- Optional manual entry -->
                            <input type="text" name="department_custom" class="form-control mt-2"
                                placeholder="Or enter manually"
                                pattern="[A-Za-z ]+"
                                title="Only letters allowed">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Create Student</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card stat-card">
                <div class="card-header">All Students</div>
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
                                            <a href="/college/public/index.php?url=edit-user&id=<?= $user['id'] ?>&from=students" class="btn btn-sm btn-warning">Edit</a>

                                            <form action="/college/public/index.php?url=delete-user" method="POST" class="d-inline" onsubmit="return confirm('Delete this student?');">
                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                <input type="hidden" name="redirect_to" value="students">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No students found.</td>
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