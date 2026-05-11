<?php
$pageTitle = 'Student Dashboard';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';
?>

<div class="container-fluid">
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="text-muted">Attendance</h6>
                    <h2>0%</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="text-muted">Semester</h6>
                    <h2>4</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="text-muted">Pending Fees</h6>
                    <h2>₹0</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="text-muted">Subjects</h6>
                    <h2>6</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card stat-card">
                <div class="card-header">Latest Results</div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Marks</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>DBMS</td>
                                <td>78</td>
                                <td>Pass</td>
                            </tr>
                            <tr>
                                <td>Java</td>
                                <td>82</td>
                                <td>Pass</td>
                            </tr>
                            <tr>
                                <td>Web Technology</td>
                                <td>80</td>
                                <td>Pass</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card mb-4">
                <div class="card-header">Notices</div>
                <div class="card-body">
                    <p class="mb-2">Internal exams start next Monday.</p>
                    <p class="mb-0">Submit fees receipt by month end.</p>
                </div>
            </div>

            <div class="card stat-card">
                <div class="card-header">Today's Timetable</div>
                <div class="card-body">
                    <p class="mb-2">10:00 AM - DBMS</p>
                    <p class="mb-2">12:00 PM - Java</p>
                    <p class="mb-0">02:00 PM - Web Tech</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>