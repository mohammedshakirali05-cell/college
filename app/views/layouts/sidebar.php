<?php
$currentPage = $_GET['url'] ?? 'dashboard';
$role = strtolower($_SESSION['role'] ?? 'admin');
?>

<div class="main-wrapper">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-mortarboard-fill"></i>
            <span class="sidebar-brand-text">College CMS</span>
        </div>

        <nav class="sidebar-nav">
            <a href="/college/public/index.php?url=dashboard" class="<?= $currentPage === 'dashboard' ? 'active' : '' ?>" title="Dashboard">
                <i class="bi bi-house-door-fill"></i>
                <span class="link-text">Dashboard</span>
            </a>

            <a href="/college/public/index.php?url=profile" class="<?= $currentPage === 'profile' ? 'active' : '' ?>" title="My Profile">
                <i class="bi bi-person-circle"></i>
                <span class="link-text">My Profile</span>
            </a>

            <?php if ($role === 'admin'): ?>
                <div class="section-title">Management</div>

                <a href="/college/public/index.php?url=students" class="<?= $currentPage === 'students' ? 'active' : '' ?>" title="Manage Students">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span class="link-text">Students</span>
                </a>

                <a href="/college/public/index.php?url=faculty" class="<?= $currentPage === 'faculty' ? 'active' : '' ?>" title="Manage Faculty">
                    <i class="bi bi-person-workspace"></i>
                    <span class="link-text">Faculty</span>
                </a>

                <a href="/college/public/index.php?url=admin-admissions" class="<?= $currentPage === 'admin-admissions' ? 'active' : '' ?>" title="Manage Admissions">
                    <i class="bi bi-journal-text"></i>
                    <span class="link-text">Admissions</span>
                </a>

                <div class="section-title">Operations</div>

                <a href="#" title="Attendance" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-calendar-check-fill"></i>
                    <span class="link-text">Attendance</span>
                </a>

                <a href="/college/public/index.php?url=admin-fees" class="<?= $currentPage === 'admin-fees' ? 'active' : '' ?>" title="Manage Fees">
                    <i class="bi bi-cash-stack"></i>
                    <span class="link-text">Fees</span>
                </a>

                <a href="/college/public/index.php?url=reports" class="<?= $currentPage === 'reports' ? 'active' : '' ?>" title="View Reports">
                    <i class="bi bi-bar-chart-line-fill"></i>
                    <span class="link-text">Reports</span>
                </a>

                <a href="#" title="Results" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-card-checklist"></i>
                    <span class="link-text">Results</span>
                </a>

                <a href="#" title="Timetable" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-clock-history"></i>
                    <span class="link-text">Timetable</span>
                </a>

            <?php elseif ($role === 'faculty'): ?>
                <div class="section-title">Academic</div>

                <a href="#" title="Attendance" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-calendar-check-fill"></i>
                    <span class="link-text">Attendance</span>
                </a>

                <a href="#" title="Students" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-people-fill"></i>
                    <span class="link-text">Students</span>
                </a>

                <a href="#" title="Timetable" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-clock-history"></i>
                    <span class="link-text">Timetable</span>
                </a>

                <a href="#" title="Assignments" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-journal-text"></i>
                    <span class="link-text">Assignments</span>
                </a>

                <a href="#" title="Results" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-card-checklist"></i>
                    <span class="link-text">Results</span>
                </a>

            <?php elseif ($role === 'student'): ?>
                <div class="section-title">Academic</div>

                <a href="#" title="Attendance" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-calendar-check-fill"></i>
                    <span class="link-text">Attendance</span>
                </a>

                <a href="#" title="Results" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-card-checklist"></i>
                    <span class="link-text">Results</span>
                </a>

                <a href="#" title="Timetable" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-clock-history"></i>
                    <span class="link-text">Timetable</span>
                </a>

                <a href="#" title="Fees" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-cash-stack"></i>
                    <span class="link-text">Fees</span>
                </a>

                <a href="#" title="Notices" style="cursor: not-allowed; opacity: 0.6;">
                    <i class="bi bi-megaphone-fill"></i>
                    <span class="link-text">Notices</span>
                </a>
            <?php endif; ?>

            <div style="flex: 1;"></div>

            <a href="/college/public/index.php?url=logout" title="Logout" style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 16px; margin-top: 16px;">
                <i class="bi bi-box-arrow-right"></i>
                <span class="link-text">Logout</span>
            </a>
        </nav>
    </aside>

    <div class="content-area">
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="toggle-btn" id="sidebarToggle" type="button" aria-label="Toggle Sidebar">
                    <i class="bi bi-list"></i>
                </button>

                <div style="display: flex; flex-direction: column;">
                    <h5 class="mb-0" style="margin: 0;"><?= htmlspecialchars($pageTitle ?? 'Dashboard') ?></h5>
                    <small class="text-muted" style="margin-top: 4px;">Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></small>
                </div>
            </div>

            <div class="dropdown">
                <button 
                    class="btn admin-menu-btn" 
                    type="button" 
                    id="adminDropdown" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false"
                    style="margin: 0; border: none;"
                >
                    <i class="bi bi-person-circle me-2"></i><?= htmlspecialchars($_SESSION['role'] ?? 'User') ?>
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                    <li>
                        <a class="dropdown-item" href="/college/public/index.php?url=profile">
                            <i class="bi bi-person-circle me-2"></i> Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="/college/public/index.php?url=logout">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <main class="page-content">
            