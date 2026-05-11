<?php
$pageTitle = 'Faculty Dashboard';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';
?>

<div class="container-fluid">
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="text-muted">Subjects</h6>
                    <h2>5</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="text-muted">Today's Classes</h6>
                    <h2>3</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="text-muted">Pending Attendance</h6>
                    <h2>2</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="text-muted">Marks Entry</h6>
                    <h2>1</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card stat-card">
                <div class="card-header">Today's Timetable</div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10:00 AM</td>
                                <td>BCA-1</td>
                                <td>DBMS</td>
                                <td>Room 201</td>
                            </tr>
                            <tr>
                                <td>12:00 PM</td>
                                <td>BCA-2</td>
                                <td>PHP</td>
                                <td>Room 204</td>
                            </tr>
                            <tr>
                                <td>02:00 PM</td>
                                <td>BCA-3</td>
                                <td>Web Tech</td>
                                <td>Room 105</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card mb-4">
                <div class="card-header">Faculty Notices</div>
                <div class="card-body">
                    <p class="mb-2">Submit internal marks by Friday.</p>
                    <p class="mb-0">Meeting at 4:00 PM in seminar hall.</p>
                </div>
            </div>

            <div class="card stat-card">
                <div class="card-header">Recent Actions</div>
                <div class="card-body">
                    <p class="mb-2">Attendance marked for BCA-1.</p>
                    <p class="mb-2">Assignment uploaded.</p>
                    <p class="mb-0">Results updated.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>