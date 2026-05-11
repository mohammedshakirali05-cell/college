<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA & BCA College | Student Login</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background */
        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            left: -100px;
            animation: float 6s ease-in-out infinite;
            z-index: 1;
        }

        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -50px;
            right: -50px;
            animation: float 8s ease-in-out infinite reverse;
            z-index: 1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            animation: slideUp 0.8s ease-out forwards;
            position: relative;
            z-index: 10;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(10px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--brand-mid) 0%, var(--brand-light) 100%);
            padding: 50px 30px 40px;
            text-align: center;
            color: white;
        }

        .header-icon {
            font-size: 56px;
            margin-bottom: 20px;
            display: block;
            animation: pulseIcon 2s ease-in-out infinite;
        }

        @keyframes pulseIcon {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .header-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .header-subtitle {
            font-size: 14px;
            opacity: 0.95;
            font-weight: 400;
        }

        .card-body {
            padding: 40px 30px;
            background: #ffffff;
        }

        .form-group {
            margin-bottom: 22px;
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }

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
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-control:focus {
            border-color: var(--brand-light);
            box-shadow: 0 0 0 4px rgba(34, 195, 227, 0.1);
            background: #ffffff;
            outline: none;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        .password-toggle-icon:hover {
            color: var(--brand-light);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
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
            margin-top: 8px;
            box-shadow: 0 8px 24px rgba(29, 63, 122, 0.25);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 36px rgba(29, 63, 122, 0.35);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 28px 0;
            color: var(--text-secondary);
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            padding: 0 12px;
        }

        .register-link {
            text-align: center;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .register-link a {
            color: var(--brand-light);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            display: inline-block;
            margin-left: 4px;
        }

        .register-link a:hover {
            color: var(--brand-mid);
            text-decoration: underline;
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 22px;
            font-size: 14px;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border-left: 4px solid #10b981;
        }

        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }

        .aadhar-input {
            letter-spacing: 1px;
            font-weight: 500;
        }

        .feature-list {
            background: var(--brand-soft);
            border-radius: 12px;
            padding: 16px;
            margin-top: 24px;
            font-size: 13px;
            color: var(--text-primary);
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin: 8px 0;
        }

        .feature-item i {
            color: var(--brand-light);
            margin-right: 10px;
            font-size: 16px;
        }

        @media (max-width: 480px) {
            .card-header {
                padding: 35px 20px 30px;
            }

            .card-body {
                padding: 28px 20px;
            }

            .header-title {
                font-size: 24px;
            }

            .header-icon {
                font-size: 44px;
                margin-bottom: 15px;
            }

            .btn-login {
                font-size: 14px;
                padding: 12px;
            }

            .feature-list {
                margin-top: 20px;
                padding: 12px;
                font-size: 12px;
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
        // Get Student ID from URL parameter (passed after payment)
        $autoStudentId = trim($_GET['student_id'] ?? $_SESSION['student_id'] ?? ''); 
    ?>
    <div class="login-container">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-check header-icon"></i>
                <h1 class="header-title">Student Login</h1>
                <p class="header-subtitle">Access your admission portal</p>
            </div>

            <div class="card-body">
                <!-- Error Messages -->
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle"></i>
                        <?php
                        $errors = [
                            'missing_fields' => 'Student ID and password are required',
                            'invalid_credentials' => 'Invalid Student ID or password',
                            'login_failed' => 'Login failed. Please try again.',
                            'invalid_request' => 'Invalid request. Please try again.',
                        ];
                        echo $errors[$_GET['error']] ?? 'An error occurred';
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Success Message -->
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i>
                        <?php if ($_GET['success'] === 'logout'): ?>
                            You have been logged out successfully.
                        <?php else: ?>
                            Welcome! You have logged in successfully.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Payment Success Message -->
                <?php if (isset($_SESSION['payment_success'])): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i>
                        <strong>Payment Processed!</strong> <?= htmlspecialchars($_SESSION['payment_success']) ?>
                    </div>
                    <?php unset($_SESSION['payment_success']); ?>
                <?php endif; ?>

                <!-- Login Form -->
                <form method="POST" action="<?= BASE_URL ?>student-login-submit" id="loginForm" autocomplete="off">
                    <?php if ($autoStudentId): ?>
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i>
                            Your Student ID is auto-filled from registration. Enter your password to login.
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-person-badge"></i> Student ID
                            </label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($autoStudentId) ?>" disabled autocomplete="off">
                            <input type="hidden" name="student_id" value="<?= htmlspecialchars($autoStudentId) ?>">
                        </div>
                    <?php else: ?>
                        <div class="form-group">
                            <label for="student_id" class="form-label">
                                <i class="bi bi-person-badge"></i> Student ID
                            </label>
                            <input type="text" class="form-control" id="student_id" 
                                   name="student_id" placeholder="STU-XXXXXXXX-XXXXX" 
                                   required autocomplete="username" autofocus>
                        </div>
                    <?php endif; ?>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock"></i> Password
                        </label>
                        <div class="password-toggle">
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Enter your password" required autocomplete="current-password">
                            <span class="password-toggle-icon" onclick="togglePassword('password')">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn-login" id="submitBtn">
                        <i class="bi bi-box-arrow-in-right"></i> Login Now
                    </button>
                </form>

                <div class="divider">
                    <span>NEW HERE?</span>
                </div>

                <div class="register-link">
                    <p>Don't have an account yet?</p>
                    <a href="<?= BASE_URL ?>student-register">Register here to get started →</a>
                </div>

                <!-- Feature List -->
                <div class="feature-list">
                    <div class="feature-item">
                        <i class="bi bi-shield-check"></i>
                        <span>Secure login with auto-generated Student ID</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-clock-history"></i>
                        <span>Track your admission status in real-time</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-file-text"></i>
                        <span>Download your admission documents</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password visibility toggle
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = event.target.closest('.password-toggle-icon');
            const iconElement = icon.querySelector('i');

            if (field.type === 'password') {
                field.type = 'text';
                iconElement.classList.remove('bi-eye');
                iconElement.classList.add('bi-eye-slash');
            } else {
                field.type = 'password';
                iconElement.classList.remove('bi-eye-slash');
                iconElement.classList.add('bi-eye');
            }
        }

        // Form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<span class="spinner"></span>Logging in...';
            submitBtn.disabled = true;
        });

        // Focus animation
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
