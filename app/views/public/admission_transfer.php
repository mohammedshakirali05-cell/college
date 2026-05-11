<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA and BCA College | 2nd/3rd Year Admission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/college/public/assets/css/public.css" rel="stylesheet">
    <style>
        :root {
            --page-bg: linear-gradient(180deg, #f8fbff 0%, #eef6ff 100%);
            --surface: #ffffff;
            --brand-dark: #06112a;
            --brand-mid: #1d3f7a;
            --brand-light: #22c3e3;
            --brand-soft: #dbeeff;
            --text-primary: #0b1b35;
            --text-secondary: #556f91;
            --shadow-soft: 0 24px 60px rgba(9, 26, 51, 0.08);
            --shadow-strong: 0 28px 70px rgba(9, 26, 51, 0.14);
        }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: var(--page-bg);
            color: var(--text-primary);
        }
        .navbar {
            background: rgba(9, 17, 42, 0.95) !important;
            box-shadow: 0 18px 45px rgba(9, 26, 51, 0.16);
        }
        .navbar-brand, .navbar-nav .nav-link { color: #ffffff !important; }
        .navbar-nav .nav-link:hover { color: var(--brand-light) !important; }
        .hero-section {
            padding: 4rem 0 2rem;
        }
        .hero-card {
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            background: white;
        }
        .hero-side {
            background: linear-gradient(180deg, rgba(34, 195, 227, 0.12), rgba(9, 17, 42, 0.04));
            padding: 3rem 2.5rem;
            position: relative;
        }
        .hero-side::before {
            content: '';
            position: absolute;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(34, 195, 227, 0.16);
            top: 20px;
            right: -40px;
        }
        .hero-side::after {
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(29, 63, 122, 0.12);
            bottom: -30px;
            left: 20px;
        }
        .hero-title {
            font-size: clamp(2rem, 2.6vw, 2.6rem);
            line-height: 1.05;
            color: var(--brand-dark);
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #ffffff;
            color: var(--brand-dark);
            padding: 0.7rem 1rem;
            border-radius: 999px;
            font-weight: 700;
            border: 1px solid rgba(29, 63, 122, 0.12);
            box-shadow: 0 12px 30px rgba(9, 26, 51, 0.06);
        }
        .form-card {
            border: none;
            border-radius: 2rem;
            box-shadow: var(--shadow-soft);
        }
        .section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }
        .section-header .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: rgba(34, 195, 227, 0.12);
            color: var(--brand-mid);
        }
        .section-subtitle {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin: 0;
        }
        .photo-slot {
            border: 2px dashed rgba(34, 195, 227, 0.45);
            border-radius: 18px;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.25s ease;
            background: rgba(34, 195, 227, 0.03);
        }
        .photo-slot:hover {
            border-color: var(--brand-mid);
            background: rgba(34, 195, 227, 0.08);
        }
        .photo-slot input[type="file"] {
            display: none;
        }
        .photo-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px;
            margin-top: 1rem;
        }
        .info-panel {
            background: rgba(29, 63, 122, 0.04);
            border-radius: 1.5rem;
            padding: 1.75rem;
            margin-top: 1.5rem;
        }
        .info-panel h5 {
            margin-bottom: 1rem;
        }
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            margin-bottom: 1rem;
        }
        .feature-item .dot {
            width: 10px;
            height: 10px;
            margin-top: 0.55rem;
            background: var(--brand-light);
            border-radius: 50%;
        }
        .course-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }
        .border-dashed {
            border-style: dashed !important;
        }
        @media (max-width: 991.98px) {
            .hero-card { border-radius: 1.5rem; }
            .hero-side { padding: 2rem; }
            .course-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/college/public/index.php">
            <i class="bi bi-mortarboard-fill me-2"></i>
            Nehru BBA & BCA College
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="/college/public/index.php">
                        <i class="bi bi-house-door me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/college/public/index.php?url=admission">
                        <i class="bi bi-person-plus-fill me-1"></i>1st Year Admission
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/college/public/index.php?url=admission-payment">
                        <i class="bi bi-cash-stack me-1"></i>Fees
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero-section">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5">
                <div class="hero-side h-100">
                    <div class="hero-badge mb-4">
                        <i class="bi bi-award-fill"></i>
                        <span>2nd / 3rd Year Admission</span>
                    </div>
                    <h1 class="hero-title mb-4">Upgrade Your Journey with a premium transfer form</h1>
                    <p class="text-secondary mb-4">Designed for 2nd and 3rd year BBA/BCA candidates, this form brings a mature professional style with live image previews and powerful document visuals.</p>
                    <div class="feature-item">
                        <div class="dot"></div>
                        <div>
                            <strong>Smart transfer workflow</strong><br>
                            Detailed student history and semester info.
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="dot"></div>
                        <div>
                            <strong>Visual-first layout</strong><br>
                            Real college form feel with photo area and data panels.
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="dot"></div>
                        <div>
                            <strong>Fast admission flow</strong><br>
                            Works with the same payment and approval backend.
                        </div>
                    </div>
                    <div class="info-panel">
                        <h5>Key details</h5>
                        <p class="small text-secondary mb-0">Use this form for lateral entry, transfer, or higher-semester admission requests in the BBA/BCA program.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card form-card p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="fw-bold mb-1">Student Information</h3>
                            <p class="text-secondary mb-0">Fill the transfer admission form and proceed with the ₹200 application fee.</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary text-white">BBA / BCA</span>
                        </div>
                    </div>

                    <form action="/college/public/index.php?url=admission-process" method="POST" id="transferAdmissionForm" novalidate>
                        <input type="hidden" name="admission_type" value="transfer">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="transfer_name">Name of Candidate <span class="text-danger">*</span></label>
                                <input type="text" id="transfer_name" name="full_name" class="form-control" required>
                                <div class="invalid-feedback">Please enter the candidate name.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="transfer_father">Father's Name <span class="text-danger">*</span></label>
                                <input type="text" id="transfer_father" name="father_name" class="form-control" required>
                                <div class="invalid-feedback">Please enter the father's name.</div>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="transfer_email">Email ID <span class="text-danger">*</span></label>
                                <input type="email" id="transfer_email" name="email" class="form-control" placeholder="Enter email address" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="transfer_mobile">Mobile Number <span class="text-danger">*</span></label>
                                <input type="tel" id="transfer_mobile" name="mobile_no" class="form-control" pattern="[0-9]{10}" placeholder="10-digit mobile" required>
                                <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Program</label>
                                <select class="form-select" name="course_applied" required>
                                    <option value="">Select program</option>
                                    <option value="BBA">BBA</option>
                                    <option value="BCA">BCA</option>
                                </select>
                                <div class="invalid-feedback">Please select a program.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Admission Year</label>
                                <select class="form-select" name="admission_year" required>
                                    <option value="">Select year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                </select>
                                <div class="invalid-feedback">Please select the year of study.</div>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="exchange_institute">Previous Institute</label>
                                <input type="text" id="exchange_institute" name="last_attended_institution" class="form-control" placeholder="Previous college/institute">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="transfer_reg">University Reg. Number</label>
                                <input type="text" id="transfer_reg" name="registration_no" class="form-control" placeholder="UOCMS / PRN number">
                            </div>
                        </div>
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">Proceed to Fee Payment</button>
                            <a href="/college/public/index.php?url=admission" class="btn btn-outline-secondary rounded-pill">Back to 1st Year Form</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

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
        const form = document.getElementById('transferAdmissionForm');
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
