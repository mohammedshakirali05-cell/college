<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA & BCA College | Admission Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --brand-dark: #06112a;
            --brand-mid: #1d3f7a;
            --brand-light: #22c3e3;
            --brand-soft: #e4f5ff;
            --success: #10b981;
            --error: #ef4444;
            --text-primary: #0b1b35;
            --text-secondary: #556f91;
            --shadow: 0 20px 60px rgba(9, 26, 51, 0.15);
            --shadow-lg: 0 30px 90px rgba(9, 26, 51, 0.25);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #eef6ff 0%, #dbeeff 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .header {
            background: linear-gradient(135deg, var(--brand-mid) 0%, var(--brand-light) 100%);
            color: white;
            padding: 50px 30px;
            border-radius: 24px;
            margin-bottom: 40px;
            text-align: center;
            animation: slideDown 0.8s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .header p {
            font-size: 16px;
            opacity: 0.95;
            margin-bottom: 0;
        }

        .success-banner {
            background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
            color: white;
            padding: 20px 24px;
            border-radius: 16px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-icon {
            font-size: 28px;
            animation: bounce 0.8s ease-out;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .container-max {
            max-width: 900px;
            margin: 0 auto;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            padding: 40px;
            animation: slideUp 0.8s ease-out 0.2s forwards;
            opacity: 0;
        }

        .form-section {
            margin-bottom: 40px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 3px solid var(--brand-light);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            color: var(--brand-light);
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 24px;
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        .form-card .form-group:nth-child(1) { animation-delay: 0.3s; }
        .form-card .form-group:nth-child(2) { animation-delay: 0.35s; }
        .form-card .form-group:nth-child(3) { animation-delay: 0.4s; }
        .form-card .form-group:nth-child(4) { animation-delay: 0.45s; }
        .form-card .form-group:nth-child(5) { animation-delay: 0.5s; }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 10px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label .required {
            color: var(--error);
            margin-left: 4px;
        }

        .form-control,
        .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--brand-light);
            box-shadow: 0 0 0 4px rgba(34, 195, 227, 0.1);
            background: #ffffff;
            outline: none;
        }

        .form-control:disabled {
            background: #f3f4f6;
            color: #6b7280;
            border-color: #e5e7eb;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .info-box {
            background: var(--brand-soft);
            border-left: 4px solid var(--brand-light);
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .info-box i {
            color: var(--brand-light);
            font-size: 20px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .info-box p {
            margin: 0;
            font-size: 14px;
            color: var(--text-primary);
        }

        .row {
            margin-right: -12px;
            margin-left: -12px;
        }

        .col,
        [class*="col-"] {
            padding-right: 12px;
            padding-left: 12px;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            font-size: 16px;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--brand-mid) 0%, var(--brand-light) 100%);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
            box-shadow: 0 8px 24px rgba(29, 63, 122, 0.25);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 36px rgba(29, 63, 122, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-logout {
            float: right;
            padding: 8px 16px;
            font-size: 12px;
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .student-info {
            background: var(--brand-soft);
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-label {
            font-size: 12px;
            color: var(--text-secondary);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 16px;
            color: var(--text-primary);
            font-weight: 600;
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 22px;
            font-size: 14px;
            animation: slideDown 0.4s ease-out;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 25px;
            }

            .header {
                padding: 30px 20px;
                margin-bottom: 30px;
            }

            .header h1 {
                font-size: 24px;
            }

            .section-title {
                font-size: 18px;
            }

            .student-info {
                grid-template-columns: 1fr;
            }
        }

        .loading {
            opacity: 0.8;
            pointer-events: none;
        }

        .spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <?php
    // Check if student is logged in
    if (!isset($_SESSION['student_id'])) {
        header('Location: ' . BASE_URL . 'student-login');
        exit();
    }
    ?>

    <div class="container-max">
        <!-- Header -->
        <div class="header">
            <a href="<?= BASE_URL ?>student-logout" class="btn-logout">
                <i class="bi bi-box-arrow-left"></i> Logout
            </a>
            <h1><i class="bi bi-file-earmark-pdf"></i> Complete Your Admission Form</h1>
            <p>Fill in the remaining details to proceed with your admission</p>
        </div>

        <!-- Success Message -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-banner">
                <i class="bi bi-check-circle-fill success-icon"></i>
                <div>
                    <strong>Welcome <?= htmlspecialchars($_SESSION['student_name']) ?>!</strong>
                    <p style="margin: 0; font-size: 14px; opacity: 0.95;">
                        <?= htmlspecialchars($_SESSION['success']) ?>
                    </p>
                </div>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Error/Warning Messages -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle"></i>
                An error occurred. Please try again.
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['payment_status']) && $_SESSION['payment_status'] === 'pending'): ?>
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i>
                <strong>Payment Pending:</strong> Please complete the admission fee payment to finalize your registration.
            </div>
        <?php endif; ?>

        <!-- Student Information Card -->
        <div class="student-info">
            <div class="info-item">
                <span class="info-label"><i class="bi bi-person-badge"></i> Student ID</span>
                <span class="info-value"><?= htmlspecialchars($_SESSION['student_id']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label"><i class="bi bi-person-circle"></i> Student Name</span>
                <span class="info-value"><?= htmlspecialchars($_SESSION['student_name']) ?></span>
            </div>
        </div>

        <!-- Admission Form -->
        <form method="POST" action="<?= BASE_URL ?>student-admission-submit" class="form-card" id="admissionForm">
            <!-- Academic Details Section -->
            <div class="form-section">
                <h2 class="section-title">
                    <i class="bi bi-book"></i> Academic Details
                </h2>

                <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    <p>Please provide information about your previous academic institution and subjects studied.</p>
                </div>

                <!-- PUC Institute -->
                <div class="form-group">
                    <label for="puc_institute" class="form-label">
                        <i class="bi bi-building"></i> PUC Institute / College Name
                        <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control" id="puc_institute" name="puc_institute" 
                           placeholder="Enter name of your previous institution" required>
                </div>

                <!-- Row for Last Attended and PUC Subjects -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- Last Attended -->
                        <div class="form-group">
                            <label for="last_attended" class="form-label">
                                <i class="bi bi-calendar3"></i> Year Last Attended
                                <span class="required">*</span>
                            </label>
                            <select class="form-select" id="last_attended" name="last_attended" required>
                                <option value="">Select year</option>
                                <?php
                                $currentYear = date('Y');
                                for ($y = $currentYear; $y >= $currentYear - 10; $y--) {
                                    echo "<option value='$y'>$y</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- PUC Subjects -->
                        <div class="form-group">
                            <label for="puc_subjects" class="form-label">
                                <i class="bi bi-list-check"></i> Subjects Studied
                                <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control" id="puc_subjects" name="puc_subjects" 
                                   placeholder="e.g., Math, Physics, Chemistry, Biology" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Selection Section -->
            <div class="form-section">
                <h2 class="section-title">
                    <i class="bi bi-mortarboard"></i> Course Selection
                </h2>

                <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    <p>Select the course you wish to pursue at Nehru BBA & BCA College.</p>
                </div>

                <!-- Course Selection -->
                <div class="form-group">
                    <label for="course_applied" class="form-label">
                        <i class="bi bi-graduation-cap"></i> Preferred Course
                        <span class="required">*</span>
                    </label>
                    <select class="form-select" id="course_applied" name="course_applied" required>
                        <option value="">-- Select a course --</option>
                        <option value="BBA">Bachelor of Business Administration (BBA)</option>
                        <option value="BCA">Bachelor of Computer Applications (BCA)</option>
                        <option value="B.COM">Bachelor of Commerce (B.COM)</option>
                    </select>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="form-section">
                <div class="info-box">
                    <i class="bi bi-shield-check"></i>
                    <p>By submitting this form, you confirm that all information provided is accurate and true.</p>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="bi bi-check-circle"></i> Submit Admission Form
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('admissionForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<span class="spinner"></span>Submitting...';
            submitBtn.disabled = true;
        });

        // Form validation on input
        const courseSelect = document.getElementById('course_applied');
        const lastAttendedSelect = document.getElementById('last_attended');

        [courseSelect, lastAttendedSelect].forEach(select => {
            select.addEventListener('change', function() {
                if (this.value) {
                    this.style.borderColor = '';
                }
            });
        });
    </script>
</body>
</html>
