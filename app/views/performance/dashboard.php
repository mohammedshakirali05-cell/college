<?php include __DIR__ . '/../layouts/header.php'; ?>

<style>
.fade-in {
    animation: fadeIn 0.8s ease-in;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="container py-4 fade-in" id="reportContent">

    <!-- TITLE -->
    <div class="mb-4">
        <h2 class="fw-bold">📊 Student Performance Dashboard</h2>
        <p class="text-muted">Analyze student progress, attendance, and performance trends</p>
    </div>

    <!-- FILTER -->
    <div class="card shadow-sm border-0 mb-4 p-3">
        <form method="GET" action="<?= BASE_URL ?>student-performance">
            <input type="hidden" name="url" value="student-performance">

            <div class="row align-items-center">
                <div class="col-md-4">
                    <select name="student_id" class="form-select">
                        <option value="">Select Student</option>
                        <?php foreach ($students as $s): ?>
                            <option value="<?= $s['id'] ?>"
                                <?= (isset($_GET['student_id']) && $_GET['student_id'] == $s['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($s['candidate_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-dark w-100">View</button>
                </div>
            </div>
        </form>
    </div>

    <?php if ($overview): ?>

    <?php
    $avg = $overview['avg_marks'] ?? 0;

    if ($avg >= 75) {
        $status = "Excellent";
        $color = "success";
    } elseif ($avg >= 50) {
        $status = "Average";
        $color = "warning";
    } else {
        $status = "Needs Improvement";
        $color = "danger";
    }
    ?>

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>👨‍🎓 <?= htmlspecialchars($overview['candidate_name']) ?></h4>

        <!-- PDF BUTTON -->
        <button type="button" onclick="downloadPDF()" class="btn btn-success">
            📄 Download Report
        </button>
    </div>

    <!-- CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Average Marks</h6>
                    <h2><?= $overview['avg_marks'] ?? 0 ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Attendance</h6>
                    <h2><?= $attendance['attendance_percentage'] ?? 0 ?>%</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Status</h6>
                    <span class="badge bg-<?= $color ?>">
                        <?= $status ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="row g-4">

        <!-- WEAK SUBJECTS -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">⚠️ Weak Subjects</div>
                <div class="card-body">
                    <?php if (!empty($weakSubjects)): ?>
                        <ul>
                            <?php foreach ($weakSubjects as $subject): ?>
                                <li>
                                    <?= htmlspecialchars($subject['subject_name']) ?>
                                    (<?= $subject['percentage'] ?>%)
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No weak subjects 🎉</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- CHART -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">📈 Performance Trend</div>
                <div class="card-body">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- CHART -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const labels = <?= json_encode(array_column($trend, 'exam_name')) ?>;
    const data = <?= json_encode(array_column($trend, 'avg_marks')) ?>;

    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Marks',
                data: data,
                borderWidth: 2
            }]
        }
    });
    </script>

    <?php else: ?>
        <p class="text-center mt-5">Select a student to view performance</p>
    <?php endif; ?>

</div>

<!-- ✅ PDF SCRIPT (FINAL FIXED) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<<script>
async function downloadPDF() {
    const { jsPDF } = window.jspdf;

    const element = document.getElementById('reportContent');

    if (!element) {
        alert("Content not found ❌");
        return;
    }

    // Convert HTML to canvas
    const canvas = await html2canvas(element, {
        scale: 2,
        useCORS: true
    });

    const imgData = canvas.toDataURL('image/png');

    const pdf = new jsPDF('p', 'mm', 'a4');

    const imgWidth = 210; // A4 width
    const pageHeight = 295;
    const imgHeight = (canvas.height * imgWidth) / canvas.width;

    let heightLeft = imgHeight;
    let position = 0;

    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
    heightLeft -= pageHeight;

    // Multi-page support
    while (heightLeft > 0) {
        position = heightLeft - imgHeight;
        pdf.addPage();
        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;
    }

    pdf.save('student-report.pdf');
}
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>