<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA and BCA College | Transfer Admission Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/college/public/assets/css/public.css" rel="stylesheet">
    <style>
        :root {
            --page-bg: linear-gradient(180deg, #f5f8ff 0%, #e8efff 100%);
            --surface: #ffffff;
            --brand-dark: #06112a;
            --brand-mid: #1d3f7a;
            --brand-light: #22c3e3;
            --shadow-soft: 0 24px 60px rgba(9, 26, 51, 0.08);
            --shadow-strong: 0 28px 70px rgba(9, 26, 51, 0.14);
        }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: var(--page-bg);
            color: var(--brand-dark);
        }
        .navbar {
            background: rgba(9, 17, 42, 0.95) !important;
            box-shadow: 0 18px 45px rgba(9, 26, 51, 0.16);
        }
        .navbar-brand, .navbar-nav .nav-link { color: #ffffff !important; }
        .navbar-nav .nav-link:hover { color: var(--brand-light) !important; }
        .form-card {
            border-radius: 24px;
            box-shadow: var(--shadow-soft);
            border: none;
        }
        .section-title {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            margin-bottom: 1.3rem;
        }
        .section-title .icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: rgba(34, 195, 227, 0.12);
            color: var(--brand-mid);
        }
        .passport-box {
            border: 2px dashed rgba(34, 195, 227, 0.45);
            border-radius: 18px;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 1.5rem;
            background: rgba(34, 195, 227, 0.04);
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .passport-box:hover {
            border-color: var(--brand-mid);
            background: rgba(34, 195, 227, 0.1);
        }
        .passport-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px;
            margin-top: 1rem;
        }
        .border-dashed {
            border-style: dashed !important;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/college/public/index.php">
            <i class="bi bi-mortarboard-fill me-2"></i> Nehru BBA & BCA College
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="/college/public/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/college/public/index.php?url=admission">1st Year Admission</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/college/public/index.php?url=admission-transfer">Transfer Admission</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <?php if (isset($_SESSION['payment_success'])): ?>
                <div class="alert alert-success shadow-sm rounded-4 border-0 py-3 mb-4">
                    <i class="bi bi-bell-fill me-2"></i>
                    <?= htmlspecialchars($_SESSION['payment_success']) ?>
                </div>
                <?php unset($_SESSION['payment_success']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['admission_email_message'])): ?>
                <div class="alert alert-info shadow-sm rounded-4 border-0 py-3 mb-4">
                    <i class="bi bi-envelope-check me-2"></i>
                    <?= htmlspecialchars($_SESSION['admission_email_message']) ?>
                </div>
                <?php unset($_SESSION['admission_email_message']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['payment_warning'])): ?>
                <div class="alert alert-warning shadow-sm rounded-4 border-0 py-3 mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= htmlspecialchars($_SESSION['payment_warning']) ?>
                </div>
                <?php unset($_SESSION['payment_warning']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['admission_credentials'])): ?>
                <div class="alert alert-light shadow-sm rounded-4 border-0 py-3 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="bi bi-award-fill text-primary fs-2"></i>
                        </div>
                        <div>
                            <h5 class="mb-2">Your Student Portal Credentials</h5>
                            <p class="mb-2">Your student login details were generated successfully. Use them to login if the email does not arrive.</p>
                            <div class="bg-white p-3 rounded-4 border">
                                <p class="mb-1"><strong>Student ID:</strong> <span class="text-primary"><?= htmlspecialchars($_SESSION['admission_credentials']['student_id']) ?></span></p>
                                <p class="mb-1"><strong>Password:</strong> <span class="text-primary"><?= htmlspecialchars($_SESSION['admission_credentials']['password']) ?></span></p>
                                <p class="mb-0"><strong>Sent to Email:</strong> <span class="text-secondary"><?= htmlspecialchars($_SESSION['admission_credentials']['email']) ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php unset($_SESSION['admission_credentials']); ?>
            <?php endif; ?>
            <div class="card form-card overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-4 bg-primary text-white p-5 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge bg-white text-primary mb-3">Transfer Admission</span>
                            <h2 class="fw-bold">2nd / 3rd Year Admission</h2>
                            <p class="opacity-75 mt-3">Complete the transfer admission details after your fee payment is confirmed.</p>
                        </div>
                        <div class="mt-4">
                            <div class="mb-3">
                                <small class="d-block text-white-75">Application No.</small>
                                <strong><?= htmlspecialchars($admission['admission_number']) ?></strong>
                            </div>
                            <div>
                                <small class="d-block text-white-75">Student</small>
                                <strong><?= htmlspecialchars($admission['full_name']) ?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 p-5">
                        <div class="section-title">
                            <div class="icon"><i class="bi bi-file-earmark-text-fill"></i></div>
                            <div>
                                <h4 class="mb-1">Complete Transfer Admission Form</h4>
                                <small class="text-muted">This form is the next step after payment confirmation.</small>
                            </div>
                        </div>

                        <form action="/college/public/index.php?url=admission-submit" method="POST" id="transferFinalForm" enctype="multipart/form-data" novalidate>
                            <input type="hidden" name="application_no" value="<?= htmlspecialchars($admission['admission_number']) ?>">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($admission['full_name']) ?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Father's Name</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($admission['father_name']) ?>" disabled>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Course</label>
                                    <select name="course_applied" class="form-select" required>
                                        <option value="">Select</option>
                                        <option value="BBA">BBA</option>
                                        <option value="BCA">BCA</option>
                                    </select>
                                    <div class="invalid-feedback">Please select the program.</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Study Year</label>
                                    <select name="year_of_admission" class="form-select" required>
                                        <option value="">Select</option>
                                        <option value="2nd Year">2nd Year</option>
                                        <option value="3rd Year">3rd Year</option>
                                    </select>
                                    <div class="invalid-feedback">Please select the study year.</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Stage</label>
                                    <input type="text" class="form-control" value="Transfer Admission" disabled>
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" for="transfer_institute">Previous Institute</label>
                                    <input type="text" id="transfer_institute" name="last_attended_institution" class="form-control" placeholder="Previous college/institute" required>
                                    <div class="invalid-feedback">Please provide the previous institute.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" for="transfer_subjects">Core Subjects</label>
                                    <input type="text" id="transfer_subjects" name="puc_subjects" class="form-control" placeholder="Eg. Accounting, Maths, Computer Science" required>
                                    <div class="invalid-feedback">Please enter the qualifying subjects.</div>
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" for="tc_document">Transfer Certificate</label>
                                    <input type="file" id="tc_document" name="sslc_marks_card" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" for="marks_document">Previous Semester Marks</label>
                                    <input type="file" id="marks_document" name="puc_marks_card" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Aadhar Card</label>
                                    <input type="file" class="form-control" name="aadhar_card" accept=".pdf,.jpg,.jpeg,.png" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Candidate Signature</label>
                                    <input type="file" class="form-control" name="candidate_signature" accept="image/*" required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-4">
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold">Photograph</label>
                                    <div class="passport-box" onclick="document.getElementById('transferPhotoFinal').click();">
                                        <i class="bi bi-camera-fill fs-1 text-primary"></i>
                                        <p class="mb-1 fw-semibold">Affix your Photograph here</p>
                                        <p class="text-secondary small">Passport size 3x4 cm</p>
                                        <input type="file" id="transferPhotoFinal" name="photo" accept="image/*" class="d-none" onchange="previewTransferPhoto(event)">
                                        <img id="transferPhotoPreview" class="passport-preview" style="display:none;" alt="Photo Preview">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-4 rounded-4 border border-dashed border-secondary bg-light h-100">
                                        <p class="mb-2 fw-semibold">Photo guidelines</p>
                                        <ul class="small text-secondary mb-0" style="padding-left: 1rem;">
                                            <li>Clear face</li>
                                            <li>Light background</li>
                                            <li>Formal attire</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="confirmDetails" required>
                                <label class="form-check-label" for="confirmDetails">I confirm that the information provided is correct.</label>
                                <div class="invalid-feedback">You must confirm before submitting.</div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">Submit Transfer Admission</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function previewTransferPhoto(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('transferPhotoPreview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('transferFinalForm');
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
</script>
</body>
</html>
