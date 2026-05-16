<?php
$pageTitle = 'Students';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';
?>

<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="m-0">Students</h2>
        <div>
            <a href="/college/public/index.php?url=students" class="btn btn-outline-secondary me-2">Refresh</a>
            <a href="/college/public/index.php?url=create-user&role=student" class="btn btn-primary">Add Student</a>
        </div>
    </div>

    <?php if (!empty($_GET['msg'])): ?>
        <?php $msg = $_GET['msg']; ?>
        <?php if ($msg === 'created_and_emailed'): ?><div class="alert alert-success">Student created and credentials emailed successfully.</div><?php endif; ?>
        <?php if ($msg === 'created_but_email_failed'): ?><div class="alert alert-warning">Student created, but email sending failed.</div><?php endif; ?>
        <?php if ($msg === 'create_failed'): ?><div class="alert alert-danger">Student creation failed. Email may already exist.</div><?php endif; ?>
        <?php if ($msg === 'invalid_input'): ?><div class="alert alert-danger">Fill all required fields properly.</div><?php endif; ?>
        <?php if ($msg === 'updated'): ?><div class="alert alert-success">Student updated successfully.</div><?php endif; ?>
        <?php if ($msg === 'deleted'): ?><div class="alert alert-success">Student deleted successfully.</div><?php endif; ?>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input id="studentSearch" type="text" class="form-control" placeholder="Search by name, email or ID">
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="btn-group">
                        <button id="exportCsv" class="btn btn-outline-primary">Export CSV</button>
                        <button id="exportExcel" class="btn btn-outline-secondary">Export Excel</button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="studentsTable" class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th class="text-end" style="width:150px">Actions</th>
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
                                    <td>
                                        <?php $status = strtolower($user['status'] ?? 'inactive'); ?>
                                        <?php if ($status === 'active'): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= htmlspecialchars(ucfirst($status)) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="/college/public/index.php?url=edit-user&id=<?= $user['id'] ?>&from=students" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil-fill"></i></a>
                                        <form action="/college/public/index.php?url=delete-user" method="POST" class="d-inline" onsubmit="return confirm('Delete this student?');">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <input type="hidden" name="redirect_to" value="students">
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">No students found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Simple client-side search
document.getElementById('studentSearch').addEventListener('input', function(e) {
    const q = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#studentsTable tbody tr');
    rows.forEach(r => {
        const text = r.innerText.toLowerCase();
        r.style.display = text.indexOf(q) === -1 ? 'none' : '';
    });
});

// Export CSV (simple)
document.getElementById('exportCsv').addEventListener('click', function() {
    const rows = Array.from(document.querySelectorAll('#studentsTable tr'));
    const csv = rows.map(r => Array.from(r.querySelectorAll('th,td')).map(c => '"' + c.innerText.replace(/"/g,'""') + '"').join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url; a.download = 'students.csv'; document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url);
});

// Export Excel fallback (CSV)
document.getElementById('exportExcel').addEventListener('click', function() { document.getElementById('exportCsv').click(); });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
