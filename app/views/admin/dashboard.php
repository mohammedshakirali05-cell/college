<?php
$pageTitle = 'Admin Dashboard';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';
?>

<!-- Dashboard Content Container -->
<div class="main-content" style="animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);">
    <!-- Alert Messages -->
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="animation: slideDown 0.35s ease;">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong>Success!</strong> User updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="animation: slideDown 0.35s ease;">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong>Success!</strong> User deleted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Dashboard Header -->
    <div class="dashboard-header mb-5" style="animation: fadeInUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.1s both;">
        <div class="header-content">
            <h1 class="header-title">📊 Dashboard Overview</h1>
            <p class="header-subtitle">Welcome back! Here's your comprehensive system overview and statistics.</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6" style="animation: fadeInUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;">
            <div class="card stat-card stat-card-users">
                <div class="stat-card-bg"></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label">Total Users</p>
                            <h2 class="stat-number"><?= htmlspecialchars($totalUsers) ?></h2>
                        </div>
                        <div class="stat-icon users-icon"><i class="bi bi-people-fill"></i></div>
                    </div>
                    <div class="stat-trend">
                        <span class="trend-badge">
                            <i class="bi bi-arrow-up-short"></i> Active
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card stat-card stat-card-students">
                <div class="stat-card-bg"></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label">Students</p>
                            <h2 class="stat-number"><?= htmlspecialchars($totalStudents) ?></h2>
                        </div>
                        <div class="stat-icon students-icon"><i class="bi bi-mortarboard-fill"></i></div>
                    </div>
                    <div class="stat-trend">
                        <span class="trend-badge">
                            <i class="bi bi-arrow-up-short"></i> Enrolled
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card stat-card stat-card-faculty">
                <div class="stat-card-bg"></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label">Faculty</p>
                            <h2 class="stat-number"><?= htmlspecialchars($totalFaculty) ?></h2>
                        </div>
                        <div class="stat-icon faculty-icon"><i class="bi bi-person-workspace"></i></div>
                    </div>
                    <div class="stat-trend">
                        <span class="trend-badge">
                            <i class="bi bi-arrow-up-short"></i> Available
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card stat-card stat-card-active">
                <div class="stat-card-bg"></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label">Active Users</p>
                            <h2 class="stat-number"><?= htmlspecialchars($activeUsers) ?></h2>
                        </div>
                        <div class="stat-icon active-icon"><i class="bi bi-check-circle-fill"></i></div>
                    </div>
                    <div class="stat-trend">
                        <span class="trend-badge">
                            <i class="bi bi-arrow-up-short"></i> Online
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row g-4">
        <!-- Recent Users Table -->
        <div class="col-lg-8">
            <div class="card surface-card recent-users-card">
                <div class="card-header-premium">
                    <div>
                        <h5 class="card-title-premium">Recent Users</h5>
                        <p class="card-subtitle">Latest user registrations and activities</p>
                    </div>
                    <a href="/college/public/index.php?url=students" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-arrow-right"></i> View All
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentUsers)): ?>
                                <?php foreach ($recentUsers as $user): ?>
                                    <tr class="table-row-hover">
                                        <td>
                                            <span class="badge bg-light text-dark"><?= htmlspecialchars($user['id']) ?></span>
                                        </td>
                                        <td>
                                            <div class="user-name-cell">
                                                <div class="user-avatar">
                                                    <?= strtoupper(substr($user['first_name'][0] ?? 'U', 0, 1)) ?>
                                                </div>
                                                <span><?= htmlspecialchars(trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''))) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="role-badge role-<?= strtolower(str_replace(' ', '-', $user['role_name'])) ?>">
                                                <?= htmlspecialchars($user['role_name']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="mailto:<?= htmlspecialchars($user['email']) ?>" class="email-link">
                                                <?= htmlspecialchars($user['email']) ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="bi bi-inbox" style="font-size: 2rem; color: #ccc;"></i>
                                        <p class="mt-3 text-muted">No users found.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Content -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card surface-card quick-actions-card mb-4">
                <div class="card-header-premium">
                    <h5 class="card-title-premium mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="/college/public/index.php?url=students" class="action-link-btn mb-3">
                        <div class="action-icon students">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <div class="action-content">
                            <h6>Manage Students</h6>
                            <p>View and manage all students</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="/college/public/index.php?url=faculty" class="action-link-btn mb-3">
                        <div class="action-icon faculty">
                            <i class="bi bi-person-workspace"></i>
                        </div>
                        <div class="action-content">
                            <h6>Manage Faculty</h6>
                            <p>View and manage faculty members</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="/college/public/index.php?url=reports" class="action-link-btn">
                        <div class="action-icon reports">
                            <i class="bi bi-bar-chart-fill"></i>
                        </div>
                        <div class="action-content">
                            <h6>View Reports</h6>
                            <p>Access system reports and analytics</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>

            <!-- Activity Feed -->
            <div class="card surface-card activity-card">
                <div class="card-header-premium">
                    <h5 class="card-title-premium mb-0">System Activity</h5>
                </div>
                <div class="card-body">
                    <div class="activity-item">
                        <div class="activity-badge success">
                            <i class="bi bi-check"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Admin Logged In</p>
                            <p class="activity-time">Just now</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-badge info">
                            <i class="bi bi-database"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Database Synced</p>
                            <p class="activity-time">All counts updated</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-badge primary">
                            <i class="bi bi-gear"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">System Status</p>
                            <p class="activity-time">All systems operational</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>