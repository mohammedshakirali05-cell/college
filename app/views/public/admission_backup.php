<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA & BCA College | Admission Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/college/public/assets/css/public.css" rel="stylesheet">
    <style>
        :root {
            --page-bg: linear-gradient(180deg, #eef6ff 0%, #dbeeff 100%);
            --surface: #ffffff;
            --surface-soft: rgba(255, 255, 255, 0.92);
            --brand-dark: #06112a;
            --brand-mid: #1d3f7a;
            --brand-light: #22c3e3;
            --brand-soft: #e4f5ff;
            --text-primary: #0b1b35;
            --text-secondary: #556f91;
            --shadow-soft: 0 24px 60px rgba(9, 26, 51, 0.08);
            --shadow-strong: 0 28px 70px rgba(9, 26, 51, 0.14);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: radial-gradient(circle at top left, rgba(34, 195, 227, 0.15), transparent 32%),
                        radial-gradient(circle at bottom right, rgba(29, 79, 122, 0.08), transparent 26%),
                        var(--page-bg);
            color: var(--text-primary);
        }

        .navbar {
            background: rgba(9, 17, 42, 0.95) !important;
            box-shadow: 0 18px 45px rgba(9, 26, 51, 0.16);
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .navbar-nav .nav-link:hover {
            color: var(--brand-light) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%) !important;
            border: none !important;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #16325d 0%, #18a4c0 100%) !important;
        }

        .admission-progress {
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            color: white;
            padding: 2.5rem 0;
        }
        .progress-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin-bottom: 1rem;
        }
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }
        .step.active {
            opacity: 1;
        }
        .step-circle {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255,255,255,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            font-weight: 800;
            color: rgba(255,255,255,0.88);
        }
        .step.active .step-circle {
            background: #ffffff;
            color: var(--brand-mid);
            box-shadow: 0 8px 20px rgba(9, 26, 51, 0.15);
        }
        .admission-form-card {
            border: none;
            border-radius: 26px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(29, 79, 122, 0.08);
        }
        .form-section {
            padding: 2rem;
            background: rgba(243, 248, 255, 0.95);
            border-bottom: 1px solid rgba(29, 79, 122, 0.08);
        }
        .form-section:last-child {
            border-bottom: none;
        }
        .subject-row {
            background: white;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .btn-add-subject {
            border: 2px dashed rgba(34, 195, 227, 0.6);
            background: transparent;
            color: var(--brand-dark);
            transition: all 0.3s ease;
        }
        .btn-add-subject:hover {
            border-color: rgba(34, 195, 227, 1);
            color: #1d3f7a;
            background: rgba(34, 195, 227, 0.08);
        }
        .glow-button {
            box-shadow: 0 0 24px rgba(34, 195, 227, 0.28);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .glow-button:hover {
            box-shadow: 0 0 38px rgba(34, 195, 227, 0.42);
            transform: translateY(-2px);
        }
        .admission-info {
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .admission-info::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.16);
            top: 16px;
            right: -60px;
        }
        .info-badge {
            background: rgba(255, 255, 255, 0.18);
            color: #ffffff;
            padding: 0.65rem 1.1rem;
            border-radius: 999px;
            display: inline-block;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255,255,255,0.25);
        }
        .step-item {
            background: rgba(255, 255, 255, 0.16);
            padding: 0.85rem 1rem;
            border-radius: 12px;
            margin-bottom: 0.7rem;
            border-left: 4px solid rgba(255, 255, 255, 0.35);
            color: rgba(255,255,255,0.9);
        }
        .highlight-box {
            background: rgba(255, 255, 255, 0.14);
            padding: 1.1rem;
            border-radius: 16px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .public-footer {
            background: linear-gradient(135deg, #06112a 0%, #1d3f7a 100%);
            color: rgba(255,255,255,0.88);
        }
        .public-footer small,
        .public-footer a {
            color: rgba(255,255,255,0.82) !important;
        }
        @media (max-width: 991.98px) {
            .admission-info {
                min-height: auto;
                padding: 2rem 0;
            }
            .progress-steps {
                flex-direction: column;
                gap: 1rem;
            }
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
                    <a class="nav-link" href="/college/public/index.php?url=login">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-primary rounded-pill px-3" href="/college/public/index.php?url=admission">
                        <i class="bi bi-plus-circle me-1"></i>New Admission
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="admission-progress">
    <div class="container">
        <div class="progress-steps">
            <div class="step active">
                <div class="step-circle">1</div>
                <small>Application Form</small>
            </div>
            <div class="step">
                <div class="step-circle">2</div>
                <small>Payment</small>
            </div>
            <div class="step">
                <div class="step-circle">3</div>
                <small>Admission Issued</small>
            </div>
        </div>
        <div class="text-center">
            <h2 class="fw-bold mb-0">Start Your Admission Journey</h2>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card admission-form-card">
                    <div class="row g-0">
                        <div class="col-lg-5 admission-info p-4 p-lg-5 text-white text-center">
                            <div class="info-badge">Admission Portal</div>
                            <h3 class="fw-bold mb-3">Join Nehru BBA & BCA College</h3>
                            <p class="mb-4 opacity-75">
                                Take the first step towards your future. Complete your application and secure your admission with our streamlined process.
                            </p>
                            <div class="highlight-box mb-4">
                                <i class="bi bi-shield-check fs-1 mb-2"></i>
                                <h5>Secure & Fast</h5>
                                <p class="mb-0 small">Your data is protected with industry-standard security</p>
                            </div>
                            <div class="text-start">
                                <h6 class="fw-bold mb-3">Application Process:</h6>
                                <div class="step-item">
                                    <i class="bi bi-1-circle me-2"></i>
                                    Fill out your personal and academic details
                                </div>
                                <div class="step-item">
                                    <i class="bi bi-2-circle me-2"></i>
                                    Complete secure payment of ₹200
                                </div>
                                <div class="step-item">
                                    <i class="bi bi-3-circle me-2"></i>
                                    Receive your official admission form instantly
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form action="/college/public/index.php?url=admission-process" method="POST" id="admissionForm" novalidate>
                                <div class="form-section">
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="bi bi-person-fill fs-4 me-3 text-primary"></i>
                                        <div>
                                            <h4 class="fw-bold mb-0">Candidate Information</h4>
                                            <small class="text-muted">Please provide your personal details as per official documents</small>
                                        </div>
                                    </div>

                                    <?php if (isset($_GET['error'])): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                            <?php if ($_GET['error'] === 'missing_fields'): ?>
                                                Please complete all required fields before continuing.
                                            <?php elseif ($_GET['error'] === 'missing_subjects'): ?>
                                                Please add at least one PUC subject with marks.
                                            <?php elseif ($_GET['error'] === 'invalid_aadhar'): ?>
                                                Please enter a valid 12-digit Aadhar number.
                                            <?php else: ?>
                                                Something went wrong. Please try again.
                                            <?php endif; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Full Name -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-12">
                                            <label for="full_name" class="form-label fw-semibold">Name of the Candidate (In Capital letters) <span class="text-danger">*</span></label>
                                            <input type="text" id="full_name" name="full_name" class="form-control form-control-lg" placeholder="Enter your name" style="text-transform: uppercase;" required>
                                            <div class="invalid-feedback">Please provide your full name.</div>
                                        </div>
                                    </div>

                                    <!-- Father, Mother, Surname -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="father_name" class="form-label fw-semibold">Father's Name <span class="text-danger">*</span></label>
                                            <input type="text" id="father_name" name="father_name" class="form-control" placeholder="Father's name" required>
                                            <div class="invalid-feedback">Please provide father's name.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mother_name" class="form-label fw-semibold">Mother's Name <span class="text-danger">*</span></label>
                                            <input type="text" id="mother_name" name="mother_name" class="form-control" placeholder="Mother's name" required>
                                            <div class="invalid-feedback">Please provide mother's name.</div>
                                        </div>
                                    </div>

                                    <!-- Surname and Gender -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="surname" class="form-label fw-semibold">Surname / Initial (if any)</label>
                                            <input type="text" id="surname" name="surname" class="form-control" placeholder="Surname or initial">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gender" class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                                            <select id="gender" name="gender" class="form-select" required>
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <div class="invalid-feedback">Please select gender.</div>
                                        </div>
                                    </div>

                                    <!-- Date of Birth and Category -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="dob" class="form-label fw-semibold">Date of Birth (DD/MM/YYYY) <span class="text-danger">*</span></label>
                                            <input type="date" id="dob" name="dob" class="form-control" required>
                                            <div class="invalid-feedback">Please provide date of birth.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category" class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                            <select id="category" name="category" class="form-select" required>
                                                <option value="">Select Category</option>
                                                <option value="GM">General Meritorious (GM)</option>
                                                <option value="IIA">IIA Category</option>
                                                <option value="IIB">IIB Category</option>
                                                <option value="IIIA">IIIA Category</option>
                                                <option value="IIIB">IIIB Category</option>
                                                <option value="SC">SC</option>
                                                <option value="ST">ST</option>
                                                <option value="Cat-1">Category 1</option>
                                            </select>
                                            <div class="invalid-feedback">Please select category.</div>
                                        </div>
                                    </div>

                                    <!-- Category Certificate and Annual Income -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="category_cert_number" class="form-label fw-semibold">Category Certificate Number</label>
                                            <input type="text" id="category_cert_number" name="category_cert_number" class="form-control" placeholder="Certificate number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="annual_income" class="form-label fw-semibold">Annual Income (₹) <span class="text-danger">*</span></label>
                                            <input type="number" id="annual_income" name="annual_income" class="form-control" placeholder="Enter annual income" required>
                                            <div class="invalid-feedback">Please provide annual income.</div>
                                        </div>
                                    </div>

                                    <!-- PUC Details -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="puc_register" class="form-label fw-semibold">PUC/ITI/Diploma/JOC Reg No. <span class="text-danger">*</span></label>
                                            <input type="text" id="puc_register" name="puc_register" class="form-control" placeholder="Registration number" required>
                                            <div class="invalid-feedback">Please provide registration number.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="puc_institute" class="form-label fw-semibold">PUC Institute <span class="text-danger">*</span></label>
                                            <input type="text" id="puc_institute" name="puc_institute" class="form-control" placeholder="PUC College/Institute name" required>
                                            <div class="invalid-feedback">Please enter your PUC institute name.</div>
                                        </div>
                                    </div>

                                    <!-- Last Attended School -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-12">
                                            <label for="last_attended" class="form-label fw-semibold">Last Attended School/College <span class="text-danger">*</span></label>
                                            <input type="text" id="last_attended" name="last_attended" class="form-control" placeholder="School/College name" required>
                                            <div class="invalid-feedback">Please enter your last attended institution.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-book-fill fs-4 me-3 text-primary"></i>
                                            <div>
                                                <h4 class="fw-bold mb-0">Academic Details</h4>
                                                <small class="text-muted">Add your PUC subjects and marks</small>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-add-subject rounded-pill px-3" onclick="addSubjectRow()">
                                            <i class="bi bi-plus-circle me-1"></i>Add Subject
                                        </button>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table mb-0" id="subjectsTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="border-0 fw-semibold">Subject Name</th>
                                                    <th class="border-0 fw-semibold">Marks (0-100)</th>
                                                    <th class="border-0 text-end fw-semibold">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="subjectsBody">
                                                <tr class="subject-row">
                                                    <td class="border-0">
                                                        <input type="text" name="subject_name[]" class="form-control" placeholder="e.g., Mathematics" required>
                                                    </td>
                                                    <td class="border-0">
                                                        <input type="number" name="subject_marks[]" class="form-control" min="0" max="100" placeholder="85" required>
                                                    </td>
                                                    <td class="border-0 text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill" onclick="removeSubjectRow(this)">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="alert alert-info mt-3" role="alert">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <small>Minimum 1 subject required. You can add multiple subjects by clicking "Add Subject".</small>
                                    </div>
                                </div>

                                <div class="p-4 bg-light">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="fw-bold mb-1">Ready to Submit?</h5>
                                            <small class="text-muted">Review your information and proceed to payment</small>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-bold text-primary fs-5">₹200</div>
                                            <small class="text-muted">One-time fee</small>
                                        </div>
                                    </div>
                                    <div class="d-grid mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg glow-button rounded-pill">
                                            <i class="bi bi-send me-2"></i>Submit Application
                                        </button>
                                    </div>
                                    <div class="text-center mt-3">
                                        <small class="text-muted">
                                            By submitting, you agree to our terms and conditions. Your data will be processed securely.
                                        </small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="public-footer py-4 bg-dark text-light">
    <div class="container text-center">
        <small class="opacity-75">
            <i class="bi bi-shield-lock me-1"></i>
            Secure admission processing | All data encrypted and protected
        </small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('admissionForm');

    // Bootstrap form validation
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // Aadhar number formatting and validation
    const aadharInput = document.getElementById('aadhar_number');
    aadharInput.addEventListener('input', function(e) {
        // Remove non-digits
        let value = e.target.value.replace(/\D/g, '');
        // Limit to 12 digits
        if (value.length > 12) value = value.slice(0, 12);
        e.target.value = value;
    });

    // Mark input validation
    document.querySelectorAll('input[type="number"][name="subject_marks[]"]').forEach(input => {
        input.addEventListener('input', function(e) {
            const value = parseInt(e.target.value);
            if (value < 0) e.target.value = 0;
            if (value > 100) e.target.value = 100;
        });
    });
});

function addSubjectRow() {
    const tbody = document.getElementById('subjectsBody');
    const rowCount = tbody.querySelectorAll('tr').length;

    if (rowCount >= 10) {
        alert('Maximum 10 subjects allowed.');
        return;
    }

    const row = document.createElement('tr');
    row.className = 'subject-row';
    row.innerHTML = `
        <td class="border-0">
            <input type="text" name="subject_name[]" class="form-control" placeholder="e.g., Physics" required>
        </td>
        <td class="border-0">
            <input type="number" name="subject_marks[]" class="form-control" min="0" max="100" placeholder="85" required>
        </td>
        <td class="border-0 text-end">
            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill" onclick="removeSubjectRow(this)">
                <i class="bi bi-trash"></i>
            </button>
        </td>
    `;
    tbody.appendChild(row);

    // Add validation to new mark input
    const newMarkInput = row.querySelector('input[type="number"]');
    newMarkInput.addEventListener('input', function(e) {
        const value = parseInt(e.target.value);
        if (value < 0) e.target.value = 0;
        if (value > 100) e.target.value = 100;
    });
}

function removeSubjectRow(button) {
    const tbody = document.getElementById('subjectsBody');
    const rows = tbody.querySelectorAll('tr');

    if (rows.length > 1) {
        button.closest('tr').remove();
    } else {
        alert('At least one subject is required.');
    }
}
</script>
</body>
</html>
