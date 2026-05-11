<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA & BCA College | Student Registration</title>
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
        }

        .registration-container {
            width: 100%;
            max-width: 500px;
            animation: slideUp 0.8s ease-out forwards;
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
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .header-icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
            animation: bounce 0.8s ease-out;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .header-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }

        .card-body {
            padding: 40px 30px;
            background: #ffffff;
        }

        .form-group {
            margin-bottom: 20px;
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
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
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-control:focus {
            border-color: var(--brand-light);
            box-shadow: 0 0 0 3px rgba(34, 195, 227, 0.1);
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

        .requirements {
            background: #f3f4f6;
            border-left: 4px solid var(--brand-light);
            padding: 12px 16px;
            border-radius: 8px;
            margin-top: -10px;
            margin-bottom: 15px;
            font-size: 12px;
            color: var(--text-secondary);
        }

        .requirement-item {
            margin: 5px 0;
        }

        .requirement-item.met {
            color: var(--success);
        }

        .requirement-item i {
            margin-right: 6px;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--brand-mid) 0%, var(--brand-light) 100%);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(29, 63, 122, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .login-link a {
            color: var(--brand-light);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: var(--brand-mid);
            text-decoration: underline;
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 20px;
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

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border-left: 4px solid var(--brand-light);
        }

        /* Aadhar input formatting */
        .aadhar-input {
            letter-spacing: 2px;
            font-weight: 500;
        }

        @media (max-width: 480px) {
            .card-header {
                padding: 30px 20px;
            }

            .card-body {
                padding: 25px 20px;
            }

            .header-title {
                font-size: 20px;
            }

            .btn-register {
                font-size: 14px;
                padding: 12px;
            }
        }

        /* Loading state */
        .btn-register.loading {
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
    <div class="registration-container">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-check-fill header-icon"></i>
                <h1 class="header-title">Student Registration</h1>
                <p class="header-subtitle">Create your account to proceed with admission</p>
            </div>

            <div class="card-body">
                <!-- Error Messages -->
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle"></i>
                        <?php
                        $errors = [
                            'missing_fields' => 'All fields are required',
                            'password_mismatch' => 'Passwords do not match',
                            'weak_password' => 'Password must be at least 8 characters',
                            'student_id_exists' => 'This Student ID already exists',
                            'registration_failed' => 'Registration failed. Please try again.',
                        ];
                        echo $errors[$_GET['error']] ?? 'An error occurred';
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Success Message -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i>
                        <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <!-- Info Message -->
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i>
                    Your Student ID will be automatically generated from your basic details
                </div>

                <form method="POST" action="<?= BASE_URL ?>student-register-submit" id="registrationForm">
                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="full_name" class="form-label">
                            <i class="bi bi-person"></i> Full Name
                        </label>
                        <input type="text" class="form-control" id="full_name" name="full_name" 
                               placeholder="Enter your full name" required autocomplete="name">
                    </div>

                    <!-- Father Name -->
                    <div class="form-group">
                        <label for="father_name" class="form-label">
                            <i class="bi bi-person"></i> Father's Name
                        </label>
                        <input type="text" class="form-control" id="father_name" name="father_name" 
                               placeholder="Enter father's name" required>
                    </div>

                    <!-- Auto-Generated Student ID Display -->
                    <div class="form-group" id="studentIdGroup" style="display: none; animation: fadeIn 0.6s ease-out;">
                        <div style="background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%); color: white; padding: 16px; border-radius: 12px; text-align: center;">
                            <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.9; margin-bottom: 8px;">
                                <i class="bi bi-check-circle"></i> Your Generated Student ID
                            </div>
                            <div id="generatedStudentId" style="font-size: 22px; font-weight: 700; font-family: 'Courier New', monospace; letter-spacing: 2px;">
                                STU-XXXXXXXX-XXXXX
                            </div>
                            <div style="font-size: 11px; opacity: 0.85; margin-top: 8px;">
                                This ID will be your unique identifier throughout your admission
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hidden field to store generated student ID -->
                    <input type="hidden" id="student_id_hidden" name="student_id">

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock"></i> Password
                        </label>
                        <div class="password-toggle">
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Create a strong password" required autocomplete="new-password">
                            <span class="password-toggle-icon" onclick="togglePassword('password')">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                        <div class="requirements">
                            <div class="requirement-item" id="req-length">
                                <i class="bi bi-x-circle"></i> At least 8 characters
                            </div>
                            <div class="requirement-item" id="req-upper">
                                <i class="bi bi-x-circle"></i> Uppercase letter (A-Z)
                            </div>
                            <div class="requirement-item" id="req-lower">
                                <i class="bi bi-x-circle"></i> Lowercase letter (a-z)
                            </div>
                            <div class="requirement-item" id="req-number">
                                <i class="bi bi-x-circle"></i> Number (0-9)
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="confirm_password" class="form-label">
                            <i class="bi bi-lock-check"></i> Confirm Password
                        </label>
                        <div class="password-toggle">
                            <input type="password" class="form-control" id="confirm_password" 
                                   name="confirm_password" placeholder="Re-enter your password" 
                                   required autocomplete="new-password">
                            <span class="password-toggle-icon" onclick="togglePassword('confirm_password')">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn-register" id="submitBtn">
                        Create Account
                    </button>

                    <div class="login-link">
                        Already registered? <a href="<?= BASE_URL ?>student-login">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-generate Student ID based on only basic details (Name + Father Name)
        function generateStudentIdPreview() {
            const fullName = document.getElementById('full_name').value.trim();
            const fatherName = document.getElementById('father_name').value.trim();

            // Show ID only when both fields have valid values (min 3 characters each)
            if (fullName.length >= 3 && fatherName.length >= 3) {
                // Generate Student ID: STU-YYYYMMDD-XXXXX
                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');
                const dateStr = `${year}${month}${day}`;
                
                // Create unique suffix from names using hash
                const combinedNames = fullName + fatherName;
                const hash = combinedNames.split('').reduce((acc, char) => {
                    return ((acc << 5) - acc) + char.charCodeAt(0);
                }, 0);
                
                // Generate random component for uniqueness
                const randomSuffix = Math.random().toString(36).substring(2, 7).toUpperCase();
                
                const studentId = `STU-${dateStr}-${randomSuffix}`;
                
                // Display the generated ID
                document.getElementById('generatedStudentId').textContent = studentId;
                document.getElementById('studentIdGroup').style.display = 'block';
                
                // Store in hidden field for form submission
                document.getElementById('student_id_hidden').value = studentId;
                
                return true;
            } else {
                document.getElementById('studentIdGroup').style.display = 'none';
                document.getElementById('student_id_hidden').value = '';
                return false;
            }
        }

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

        // Listen to name changes for ID generation
        document.getElementById('full_name').addEventListener('input', generateStudentIdPreview);
        document.getElementById('father_name').addEventListener('input', generateStudentIdPreview);

        // Password validation
        const passwordField = document.getElementById('password');
        const confirmField = document.getElementById('confirm_password');

        function validatePassword(password) {
            const requirements = {
                length: password.length >= 8,
                upper: /[A-Z]/.test(password),
                lower: /[a-z]/.test(password),
                number: /[0-9]/.test(password)
            };

            document.getElementById('req-length').classList.toggle('met', requirements.length);
            document.getElementById('req-upper').classList.toggle('met', requirements.upper);
            document.getElementById('req-lower').classList.toggle('met', requirements.lower);
            document.getElementById('req-number').classList.toggle('met', requirements.number);

            return Object.values(requirements).every(Boolean);
        }

        passwordField.addEventListener('input', function() {
            validatePassword(this.value);
            checkPasswordMatch();
        });

        confirmField.addEventListener('input', checkPasswordMatch);

        function checkPasswordMatch() {
            if (confirmField.value && passwordField.value !== confirmField.value) {
                confirmField.style.borderColor = 'var(--error)';
            } else {
                confirmField.style.borderColor = '';
            }
        }

        // Form submission
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const password = passwordField.value;
            const confirm = confirmField.value;

            if (!validatePassword(password)) {
                e.preventDefault();
                alert('Please meet all password requirements');
                return;
            }

            if (password !== confirm) {
                e.preventDefault();
                alert('Passwords do not match');
                return;
            }

            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<span class="spinner"></span>Creating Account...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>
