<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA and BCA College | Transfer Admission Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/college/public/assets/css/public.css" rel="stylesheet">
    <style>
        :root {
            --page-bg: linear-gradient(135deg, #0f1419 0%, #1a2332 100%);
            --card-bg: rgba(255, 255, 255, 0.97);
            --accent-1: #22c3e3;
            --accent-2: #1d3f7a;
            --accent-3: #06112a;
            --text-primary: #0b1b35;
            --success-green: #10b981;
            --shadow-premium: 0 40px 80px rgba(9, 26, 51, 0.18);
            --shadow-glow: 0 0 40px rgba(34, 195, 227, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--page-bg);
            color: var(--text-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(34, 195, 227, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(29, 63, 122, 0.1) 0%, transparent 50%);
            animation: bgShift 15s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes bgShift {
            0%, 100% {
                background: 
                    radial-gradient(circle at 20% 50%, rgba(34, 195, 227, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(29, 63, 122, 0.1) 0%, transparent 50%);
            }
            50% {
                background: 
                    radial-gradient(circle at 80% 50%, rgba(34, 195, 227, 0.08) 0%, transparent 50%),
                    radial-gradient(circle at 20% 80%, rgba(29, 63, 122, 0.12) 0%, transparent 50%);
            }
        }

        body > * {
            position: relative;
            z-index: 1;
        }

        /* Navbar */
        .navbar {
            background: rgba(9, 17, 42, 0.92) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 18px 45px rgba(9, 26, 51, 0.25);
            border-bottom: 1px solid rgba(34, 195, 227, 0.15);
        }

        .navbar-brand {
            font-weight: 800 !important;
            font-size: 1.35rem;
            letter-spacing: -0.5px;
            color: #ffffff !important;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--accent-1) !important;
            transform: translateX(2px);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 6px;
        }

        .navbar-nav .nav-link:hover {
            color: var(--accent-1) !important;
        }

        /* Main Container */
        .payment-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }

        .payment-wrapper {
            width: 100%;
        }

        /* Payment Card Container */
        .payment-card-container {
            background: var(--card-bg);
            border-radius: 32px;
            overflow: hidden;
            box-shadow: var(--shadow-premium);
            animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 1px solid rgba(34, 195, 227, 0.1);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Left Panel - Info */
        .payment-info-panel {
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            color: #ffffff;
            padding: 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 600px;
            position: relative;
            overflow: hidden;
        }

        .payment-info-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1), transparent);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -30px); }
        }

        .payment-info-content {
            position: relative;
            z-index: 1;
        }

        .badge-transfer {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(10px);
        }

        .payment-info-panel h2 {
            font-size: 2.4rem;
            font-weight: 800;
            margin: 1rem 0 1.2rem 0;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .payment-info-panel p {
            font-size: 1.02rem;
            opacity: 0.95;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .payment-details {
            margin-top: 3rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .detail-item {
            display: flex;
            gap: 1rem;
        }

        .detail-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .detail-text h5 {
            font-size: 0.85rem;
            opacity: 0.85;
            margin-bottom: 0.2rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .detail-text p {
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0;
        }

        /* Right Panel - Payment Form */
        .payment-form-panel {
            padding: 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.99), rgba(248, 251, 255, 0.99));
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-header h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #556f91;
            font-size: 0.95rem;
        }

        /* Fee Display Box */
        .fee-display {
            background: linear-gradient(135deg, rgba(34, 195, 227, 0.08) 0%, rgba(29, 63, 122, 0.08) 100%);
            border: 2px solid rgba(34, 195, 227, 0.25);
            border-radius: 20px;
            padding: 1.8rem;
            margin-bottom: 2rem;
            text-align: center;
            animation: fadeInScale 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .fee-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            color: #556f91;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .fee-amount {
            font-size: 2.8rem;
            font-weight: 900;
            color: var(--accent-2);
            margin: 0.5rem 0;
        }

        .fee-currency {
            font-size: 1.2rem;
            color: var(--accent-1);
        }

        .fee-note {
            font-size: 0.85rem;
            color: #556f91;
            margin-top: 0.8rem;
        }

        /* Payment Methods */
        .payment-methods {
            margin-bottom: 2rem;
        }

        .method-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            color: #556f91;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
        }

        .method-option {
            position: relative;
            margin-bottom: 1rem;
        }

        .method-option input[type="radio"] {
            display: none;
        }

        .method-card {
            position: relative;
            padding: 1.3rem;
            border: 2px solid rgba(34, 195, 227, 0.25);
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .method-card:hover {
            border-color: var(--accent-1);
            background: rgba(34, 195, 227, 0.04);
            transform: translateX(4px);
        }

        .method-option input[type="radio"]:checked + .method-card {
            border-color: var(--accent-1);
            background: linear-gradient(135deg, rgba(34, 195, 227, 0.1) 0%, rgba(34, 195, 227, 0.05) 100%);
            box-shadow: 0 0 20px rgba(34, 195, 227, 0.2);
            transform: scale(1.02);
        }

        .method-icon {
            font-size: 1.4rem;
            color: var(--accent-2);
            margin-bottom: 0.5rem;
            display: inline-block;
        }

        .method-title {
            font-weight: 700;
            color: var(--text-primary);
            font-size: 0.95rem;
            margin-bottom: 0.3rem;
        }

        .method-desc {
            font-size: 0.8rem;
            color: #556f91;
            margin: 0;
        }

        /* QR Code Scanner Panel */
        .qr-scanner-panel {
            background: linear-gradient(135deg, rgba(34, 195, 227, 0.08) 0%, rgba(29, 63, 122, 0.08) 100%);
            border: 2px dashed rgba(34, 195, 227, 0.35);
            border-radius: 24px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeIn 0.6s ease 0.3s both;
            display: none;
        }

        .qr-scanner-panel.active {
            display: block;
            animation: slideInDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .qr-circle {
            width: 180px;
            height: 180px;
            border-radius: 24px;
            background: linear-gradient(135deg, #eaf6ff, #dbeeff);
            border: 2px solid rgba(34, 195, 227, 0.45);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(34, 195, 227, 0.3); }
            50% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(34, 195, 227, 0.1); }
        }

        .qr-circle i {
            font-size: 3rem;
            color: var(--accent-2);
        }

        .qr-text {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .qr-subtext {
            font-size: 0.9rem;
            color: #556f91;
        }

        /* Button */
        .btn-pay-now {
            background: linear-gradient(135deg, var(--accent-2) 0%, var(--accent-1) 100%);
            border: none;
            color: #ffffff;
            padding: 1rem 2rem;
            font-size: 1.05rem;
            font-weight: 700;
            border-radius: 16px;
            width: 100%;
            margin-top: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(29, 63, 122, 0.3);
        }

        .btn-pay-now::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-pay-now:hover::before {
            left: 100%;
        }

        .btn-pay-now:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 50px rgba(29, 63, 122, 0.4);
        }

        .btn-pay-now:active {
            transform: translateY(0);
        }

        /* Error Alert */
        .alert-error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(185, 28, 28, 0.05) 100%);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #b91c1c;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: slideInDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .payment-card-container {
                margin-bottom: 2rem;
            }

            .payment-info-panel {
                min-height: auto;
                padding: 2.5rem;
            }

            .payment-form-panel {
                padding: 2.5rem;
            }

            .payment-info-panel h2 {
                font-size: 2rem;
            }

            .fee-amount {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 768px) {
            .payment-section {
                padding: 1rem 0;
            }

            .payment-info-panel {
                padding: 2rem;
            }

            .payment-form-panel {
                padding: 2rem;
            }

            .payment-info-panel h2 {
                font-size: 1.6rem;
            }

            .payment-details {
                margin-top: 2rem;
                gap: 1rem;
            }

            .detail-text h5 {
                font-size: 0.75rem;
            }

            .detail-text p {
                font-size: 0.9rem;
            }

            .fee-amount {
                font-size: 2rem;
            }

            .form-header h3 {
                font-size: 1.25rem;
            }
        }

        /* Success State */
        .success-checkmark {
            display: none;
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
        }

        .success-checkmark.show {
            display: block;
            animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .success-checkmark svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 4px 12px rgba(16, 185, 129, 0.3));
        }

        /* Smooth Transitions */
        .payment-methods {
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
        }

        /* Footer */
        .payment-footer {
            text-align: center;
            padding: 2rem 0 1rem 0;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<!-- Navigation -->
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
                    <a class="nav-link" href="/college/public/index.php?url=admission-transfer">Back to Transfer Form</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-primary" href="/college/public/index.php?url=login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Payment Section -->
<section class="payment-section">
    <div class="container payment-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="payment-card-container">
                    <div class="row g-0">
                        <!-- Left Panel -->
                        <div class="col-lg-5 payment-info-panel">
                            <div class="payment-info-content">
                                <div>
                                    <span class="badge-transfer">Transfer Admission</span>
                                    <h2>Secure Payment Gateway</h2>
                                    <p>Complete your 2nd/3rd year admission with instant online confirmation or traditional cash payment method.</p>
                                </div>
                                <div class="payment-details">
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="bi bi-file-text-fill"></i>
                                        </div>
                                        <div class="detail-text">
                                            <h5>Application Number</h5>
                                            <p><?= htmlspecialchars($admission['admission_number']) ?></p>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        <div class="detail-text">
                                            <h5>Student Name</h5>
                                            <p><?= htmlspecialchars($admission['full_name']) ?></p>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                        <div class="detail-text">
                                            <h5>Status</h5>
                                            <p>Payment Required</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Panel -->
                        <div class="col-lg-7 payment-form-panel">
                            <div class="form-header">
                                <h3><i class="bi bi-credit-card-fill me-2" style="color: var(--accent-1);"></i>Payment Details</h3>
                                <p>Choose your preferred payment method and proceed</p>
                            </div>

                            <!-- Fee Display -->
                            <div class="fee-display">
                                <div class="fee-label">Transfer Admission Fee</div>
                                <div>
                                    <span class="fee-currency">₹</span><span class="fee-amount">200</span>
                                </div>
                                <div class="fee-note">One-time payment to activate your admission form</div>
                            </div>

                            <!-- Form -->
                            <form action="/college/public/index.php?url=transfer-admission-payment-process" method="POST" id="transferPaymentForm" novalidate>
                                <input type="hidden" name="uuid" value="<?= htmlspecialchars($admission['uuid']) ?>">

                                <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_payment_method'): ?>
                                    <div class="alert-error">
                                        <i class="bi bi-exclamation-circle me-2"></i>
                                        Please select a valid payment option before proceeding.
                                    </div>
                                <?php endif; ?>

                                <div class="payment-methods">
                                    <div class="method-label">Select Payment Method</div>

                                    <!-- Online Payment Option -->
                                    <div class="method-option">
                                        <input type="radio" id="methodOnline" name="payment_method" value="online" checked>
                                        <label for="methodOnline" class="method-card">
                                            <div class="method-icon">
                                                <i class="bi bi-qr-code-scan"></i>
                                            </div>
                                            <div class="method-title">QR Scanner (Instant Payment)</div>
                                            <p class="method-desc">Scan QR code and pay instantly. Your form will be ready immediately.</p>
                                        </label>
                                    </div>

                                    <!-- Cash Payment Option -->
                                    <div class="method-option">
                                        <input type="radio" id="methodCash" name="payment_method" value="cash">
                                        <label for="methodCash" class="method-card">
                                            <div class="method-icon">
                                                <i class="bi bi-cash-stack"></i>
                                            </div>
                                            <div class="method-title">Cash Payment</div>
                                            <p class="method-desc">Pay at reception. Admin will confirm and activate your form.</p>
                                        </label>
                                    </div>
                                </div>

                                <!-- QR Panel -->
                                <div class="qr-scanner-panel" id="qrPanel">
                                    <div class="qr-circle">
                                        <i class="bi bi-qr-code-scan"></i>
                                    </div>
                                    <div class="qr-text">Scan to Pay ₹200</div>
                                    <div class="qr-subtext">Use any UPI app or QR scanner to complete payment</div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn-pay-now">
                                    <span id="btnText">Proceed to Payment</span>
                                </button>
                            </form>

                            <div class="payment-footer">
                                <small><i class="bi bi-shield-lock me-1"></i> Your payment is 100% secure and encrypted</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Dynamic QR Panel
    const methodOnline = document.getElementById('methodOnline');
    const methodCash = document.getElementById('methodCash');
    const qrPanel = document.getElementById('qrPanel');
    const btnText = document.getElementById('btnText');

    function updateQRPanel() {
        if (methodOnline.checked) {
            qrPanel.classList.add('active');
            btnText.textContent = 'Scan & Pay Now';
        } else {
            qrPanel.classList.remove('active');
            btnText.textContent = 'Request Cash Payment';
        }
    }

    methodOnline.addEventListener('change', updateQRPanel);
    methodCash.addEventListener('change', updateQRPanel);

    // Form Validation
    document.getElementById('transferPaymentForm').addEventListener('submit', function(e) {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
        if (!selectedMethod) {
            e.preventDefault();
            alert('Please select a payment method');
            return false;
        }
    });

    // Initialize on page load
    window.addEventListener('load', function() {
        updateQRPanel();
        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    });

    // Ripple effect on button click
    document.querySelectorAll('.method-card').forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'scale(1.02)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
</script>

</body>
</html>
