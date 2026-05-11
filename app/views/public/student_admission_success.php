<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA & BCA College | Admission Submitted</title>
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
            --success: #10b981;
            --text-primary: #0b1b35;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-container {
            width: 100%;
            max-width: 600px;
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
            box-shadow: 0 30px 90px rgba(9, 26, 51, 0.25);
            background: white;
        }

        .success-header {
            background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
            padding: 60px 30px;
            text-align: center;
            color: white;
        }

        .success-icon {
            font-size: 80px;
            margin-bottom: 20px;
            display: block;
            animation: bounce 0.8s ease-out;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-15px) scale(1.05);
            }
        }

        .success-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .success-subtitle {
            font-size: 16px;
            opacity: 0.95;
        }

        .card-body {
            padding: 50px 40px;
            text-align: center;
        }

        .next-steps {
            background: #f0fdf4;
            border: 2px solid var(--success);
            border-radius: 16px;
            padding: 24px;
            margin: 30px 0;
            text-align: left;
        }

        .next-steps-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step {
            display: flex;
            gap: 12px;
            margin: 12px 0;
            align-items: flex-start;
        }

        .step-number {
            background: var(--success);
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        .step-text {
            flex: 1;
            font-size: 14px;
            color: var(--text-primary);
            line-height: 1.6;
        }

        .info-box {
            background: #dbeafe;
            border-left: 4px solid var(--brand-light);
            padding: 16px;
            border-radius: 12px;
            margin: 24px 0;
            font-size: 14px;
            color: var(--text-primary);
        }

        .info-box i {
            color: var(--brand-light);
            margin-right: 8px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-primary,
        .btn-secondary {
            padding: 14px 28px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--brand-mid) 0%, var(--brand-light) 100%);
            color: white;
            box-shadow: 0 8px 24px rgba(29, 63, 122, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 36px rgba(29, 63, 122, 0.35);
            color: white;
            text-decoration: none;
        }

        .btn-secondary {
            background: transparent;
            color: var(--brand-mid);
            border: 2px solid var(--brand-mid);
        }

        .btn-secondary:hover {
            background: var(--brand-mid);
            color: white;
            text-decoration: none;
        }

        .student-id-box {
            background: var(--brand-soft);
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .student-id-label {
            font-size: 12px;
            color: var(--text-primary);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .student-id-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--brand-mid);
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
        }

        @media (max-width: 480px) {
            .success-header {
                padding: 40px 20px;
            }

            .card-body {
                padding: 30px 20px;
            }

            .success-title {
                font-size: 24px;
            }

            .success-icon {
                font-size: 60px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
            }

            .next-steps {
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="card">
            <div class="success-header">
                <i class="bi bi-check-circle success-icon"></i>
                <h1 class="success-title">Submission Successful!</h1>
                <p class="success-subtitle">Your admission form has been submitted</p>
            </div>

            <div class="card-body">
                <p style="font-size: 16px; color: var(--text-primary); margin-bottom: 20px;">
                    Thank you for completing your admission form. Your application is now in progress.
                </p>

                <!-- Student ID Display -->
                <div class="student-id-box">
                    <div class="student-id-label">Your Student ID</div>
                    <div class="student-id-value"><?= htmlspecialchars($_SESSION['student_id']) ?></div>
                    <small style="color: var(--text-primary); margin-top: 8px;">
                        Please save this for future reference
                    </small>
                </div>

                <!-- Next Steps -->
                <div class="next-steps">
                    <div class="next-steps-title">
                        <i class="bi bi-list-check"></i>
                        What's Next?
                    </div>
                    <div class="step">
                        <div class="step-number">1</div>
                        <div class="step-text">
                            <strong>Complete Payment:</strong> Pay the admission fee to finalize your registration
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-text">
                            <strong>Verify Documents:</strong> Our admin team will verify your submitted documents
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-text">
                            <strong>Get Admission Letter:</strong> Receive your admission confirmation via email
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    <strong>Important:</strong> Please complete the admission fee payment within 7 days to secure your seat.
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <a href="<?= BASE_URL ?>student-admission-form" class="btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Form
                    </a>
                    <a href="<?= BASE_URL ?>home" class="btn-primary">
                        <i class="bi bi-house"></i> Go to Home
                    </a>
                </div>

                <p style="font-size: 12px; color: #6b7280; margin-top: 20px; line-height: 1.6;">
                    <i class="bi bi-shield-check"></i> Your data is secure and encrypted. We never share your information with third parties.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
