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
        .admission-type-card {
            background: var(--surface);
            cursor: pointer;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }
        .admission-type-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(34, 195, 227, 0.25);
        }
        .admission-type-card button:hover {
            transform: scale(1.05);
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
        .admission-logo {
            display: block;
            max-width: 140px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 18px;
            background: rgba(255,255,255,0.14);
            padding: 0.8rem;
            box-shadow: 0 16px 30px rgba(0,0,0,0.08);
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
        .fee-status-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid rgba(34, 195, 227, 0.2);
            padding: 1.5rem;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
        }
        .public-footer {
            background: linear-gradient(135deg, #06112a 0%, #1d3f7a 100%);
            color: rgba(255,255,255,0.88);
        }
        @media (max-width: 991.98px) {
            .admission-info { min-height: auto; padding: 2rem 0; }
            .progress-steps { flex-direction: column; gap: 1rem; }
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
                <li class="nav-item"><a class="nav-link" href="/college/public/index.php"><i class="bi bi-house-door me-1"></i>Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/college/public/index.php?url=admission_payment"><i class="bi bi-cash-stack me-1"></i>Fees</a></li>
                <li class="nav-item"><a class="nav-link" href="/college/public/index.php?url=login"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a></li>
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
    <div class="container text-center">
        <div class="progress-steps">
            <div class="step active"><div class="step-circle">1</div><small>Application Form</small></div>
            <div class="step"><div class="step-circle">2</div><small>Payment</small></div>
            <div class="step"><div class="step-circle">3</div><small>Admission Issued</small></div>
        </div>
        <h2 class="fw-bold mb-0">Start Your Admission Journey</h2>
    </div>
</section>

<!-- Admission Type Selection -->
<section class="py-4" style="background: linear-gradient(135deg, rgba(34, 195, 227, 0.08) 0%, rgba(29, 79, 122, 0.04) 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <h4 class="fw-bold mb-4 text-center">Select Your Admission Type</h4>
                <div class="row g-3">
                    <!-- First Year Admission -->
                    <div class="col-md-6">
                        <div class="card admission-type-card" style="border: 2px solid #22c3e3; border-radius: 16px; cursor: pointer; transition: all 0.3s ease;">
                            <div class="card-body p-4 text-center">
                                <i class="bi bi-mortarboard" style="font-size: 3rem; color: #1d3f7a; margin-bottom: 1rem;"></i>
                                <h5 class="fw-bold mb-2">1st Year Admission</h5>
                                <p class="text-muted mb-3">Start your BBA/BCA journey from the beginning</p>
                                <button type="button" class="btn btn-primary rounded-pill" onclick="selectAdmissionType('first_year')">
                                    <i class="bi bi-arrow-right me-2"></i> Select
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 2nd/3rd Year Admission -->
                    <div class="col-md-6">
                        <div class="card admission-type-card" style="border: 2px solid #1d3f7a; border-radius: 16px; cursor: pointer; transition: all 0.3s ease;">
                            <div class="card-body p-4 text-center">
                                <i class="bi bi-arrow-repeat" style="font-size: 3rem; color: #22c3e3; margin-bottom: 1rem;"></i>
                                <h5 class="fw-bold mb-2">2nd/3rd Year Transfer</h5>
                                <p class="text-muted mb-3">Transfer to BBA/BCA 2nd or 3rd Year</p>
                                <button type="button" class="btn btn-outline-primary rounded-pill" onclick="selectAdmissionType('transfer')">
                                    <i class="bi bi-arrow-right me-2"></i> Select
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- First Year Admission Form -->
<section class="py-5" id="firstYearSection" style="display: none;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card admission-form-card">
                    <div class="row g-0">
                        <div class="col-lg-5 admission-info p-4 p-lg-5 text-white text-center">
                            <div class="info-badge">Admission Portal</div>
                            <h3 class="fw-bold mb-3">Join Nehru BBA & BCA College</h3>
                            <p class="mb-4 opacity-75">Take the first step towards your future. Complete your application securely.</p>
                            
                            <div class="highlight-box mb-4">
                                <i class="bi bi-shield-check fs-1 mb-2"></i>
                                <h5>Secure & Fast</h5>
                                <p class="mb-0 small">Your data is protected with industry-standard security</p>
                            </div>

                            <div class="text-start">
                                <h6 class="fw-bold mb-3">Application Process:</h6>
                                <div class="step-item"><i class="bi bi-1-circle me-2"></i>Enter your basic details</div>
                                <div class="step-item"><i class="bi bi-2-circle me-2"></i>Pay ₹200 form fee</div>
                                <div class="step-item"><i class="bi bi-3-circle me-2"></i>Complete admission form</div>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <form action="/college/public/index.php?url=admission-process" method="POST" id="admissionForm" novalidate>
                                <input type="hidden" name="admission_type" id="admissionTypeInput" value="">
                                <div class="form-section">
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="bi bi-person-fill fs-4 me-3 text-primary"></i>
                                        <div>
                                            <h4 class="fw-bold mb-0">Basic Details</h4>
                                            <small class="text-muted">Only name, father name and email are required.</small>
                                        </div>
                                    </div>

                                    <?php if (isset($_GET['error'])): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                            <?php echo ($_GET['error'] === 'missing_fields') ? 'Please complete all fields.' : 'Something went wrong.'; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Father Name <span class="text-danger">*</span></label>
                                            <input type="text" name="father_name" class="form-control" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Email ID <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="fee-status-card">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h6 class="fw-bold mb-0">Application Fee</h6>
                                                <small class="text-muted">Payable once per application</small>
                                            </div>
                                            <div class="text-end">
                                                <div class="text-primary fw-bold fs-4">₹200</div>
                                            </div>
                                        </div>
                                        <div class="alert alert-info py-2 px-3 rounded-3 mb-0" style="font-size: 0.85rem; border: none; background: rgba(34, 195, 227, 0.1);">
                                            <i class="bi bi-info-circle me-1"></i> You will be redirected to the secure payment page after clicking proceed.
                                        </div>
                                    </div>

                                    <div class="d-grid mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg glow-button rounded-pill py-3">
                                            <i class="bi bi-credit-card me-2"></i> Pay ₹200 & Proceed
                                        </button>
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

<footer class="public-footer py-4">
    <div class="container text-center text-white-50">
        <small><i class="bi bi-shield-lock me-1"></i> Secure admission processing | All data encrypted</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function selectAdmissionType(type) {
    if (type === 'first_year') {
        // Show first year form and hide transfer form
        document.getElementById('firstYearSection').style.display = 'block';
        document.getElementById('admissionTypeInput').value = 'first_year';
        window.scrollTo({ top: document.getElementById('firstYearSection').offsetTop - 100, behavior: 'smooth' });
    } else if (type === 'transfer') {
        // Redirect to transfer admission page
        window.location.href = '/college/public/index.php?url=admission-transfer';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('admissionForm');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // Hover effects for admission type cards
    const cards = document.querySelectorAll('.admission-type-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
            this.style.boxShadow = '0 12px 24px rgba(34, 195, 227, 0.2)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
});
</script>
</body>
</html>