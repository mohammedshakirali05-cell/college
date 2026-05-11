<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA and BCA College | Admission Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/college/public/assets/css/public.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top left, rgba(33, 150, 243, 0.16), transparent 35%),
                        radial-gradient(circle at bottom right, rgba(88, 101, 242, 0.14), transparent 30%),
                        #f8fbff;
        }

        .admission-page {
            position: relative;
            z-index: 1;
        }

        .admission-card {
            overflow: hidden;
            border-radius: 32px;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 35px 90px rgba(26, 110, 233, 0.12);
            backdrop-filter: blur(18px);
        }

        .admission-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.12), rgba(75, 192, 210, 0.08));
            pointer-events: none;
        }

        .payment-card {
            border-radius: 28px;
            border: none;
            background: linear-gradient(180deg, #ffffff, #eef7ff);
            box-shadow: 0 20px 60px rgba(32, 124, 229, 0.1);
        }

        .option-card {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 1rem;
            align-items: center;
            border: 1px solid rgba(99, 126, 255, 0.18);
            border-radius: 20px;
            padding: 1rem 1.2rem;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.9);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease, background-color 0.25s ease;
            cursor: pointer;
        }

        .option-card:hover,
        .option-card input[type='radio']:checked + div {
            transform: translateY(-4px);
            box-shadow: 0 28px 45px rgba(63, 114, 245, 0.14);
            border-color: rgba(33, 150, 243, 0.5);
            background: rgba(238, 247, 255, 0.95);
        }

        .option-card input[type="radio"] {
            width: 1.4rem;
            height: 1.4rem;
            accent-color: #1d4ed8;
        }

        .option-title {
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .option-subtext {
            color: #5b6d91;
            font-size: 0.95rem;
        }

        .scanner-panel {
            background: radial-gradient(circle at top, rgba(34, 195, 227, 0.16), rgba(255, 255, 255, 0.96));
            border: 1px dashed rgba(34, 195, 227, 0.35);
            border-radius: 28px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .scanner-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.2), transparent 35%);
            pointer-events: none;
        }

        .scanner-circle {
            width: 170px;
            height: 170px;
            border-radius: 32px;
            background: linear-gradient(135deg, #dbeeff, #e6f4ff);
            border: 2px dashed rgba(34, 195, 227, 0.45);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            animation: float 3s ease-in-out infinite;
        }

        .glow-button {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 40%, #3b82f6 100%);
            color: #ffffff;
            border: none;
            box-shadow: 0 16px 45px rgba(59, 130, 246, 0.28);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .glow-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 22px 50px rgba(59, 130, 246, 0.34);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .payment-option input[type='radio'] {
            margin-top: 4px;
        }

        .payment-option div {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .payment-option label {
            cursor: pointer;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/college/public/index.php">Nehru BBA and BCA College</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="/college/public/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/college/public/index.php?url=admission">Back to Admission</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-primary" href="/college/public/index.php?url=login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="admission-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card admission-card shadow-lg border-0">
                    <div class="row g-0">
                        <div class="col-lg-6 p-5">
                            <div class="mb-4">
                                <span class="badge bg-primary">Step 2</span>
                                <h2 class="mt-3">Admission Form Fees</h2>
                                <p class="text-muted">Complete payment to confirm your admission application. Choose online for instant confirmation or cash for manual approval.</p>
                            </div>

                            <div class="card payment-card mb-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <div class="small text-uppercase text-muted">Admission form fee</div>
                                            <h3 class="fw-bold">₹200</h3>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-success">Demo Payment</span>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-0">This is a demo payment flow. After payment, your admission form will be issued immediately. Once gateway integration is ready, this same flow will connect to your payment provider.</p>
                                </div>
                            </div>

                            <div class="list-group">
                                <a href="#paymentOptions" class="list-group-item list-group-item-action active">
                                    <i class="bi bi-wallet2 me-2"></i> Select Payment Method
                                </a>
                                <a class="list-group-item list-group-item-action" href="#onlineOption">
                                    <i class="bi bi-credit-card-fill me-2"></i> Pay Online for instant approval
                                </a>
                                <a class="list-group-item list-group-item-action" href="#cashOption">
                                    <i class="bi bi-cash-stack me-2"></i> Pay Cash and wait for admin approval
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-6 p-5 bg-light rounded-end">
                            <form action="/college/public/index.php?url=admission-payment-process" method="POST" class="payment-form">
                                <input type="hidden" name="uuid" value="<?= htmlspecialchars($admission['uuid']) ?>">

                                <div class="mb-4">
                                    <h5 class="fw-bold">Application Summary</h5>
                                    <p class="text-muted mb-1">Applicant</p>
                                    <p class="mb-2 fw-semibold"><?= htmlspecialchars($admission['full_name']) ?></p>
                                    <p class="text-muted mb-1">Admission No.</p>
                                    <p class="mb-0"><?= htmlspecialchars($admission['admission_number']) ?></p>
                                </div>

                                <div class="mb-4 payment-option" id="onlineOption">
                                    <label class="option-card">
                                        <input type="radio" name="payment_method" value="online" checked>
                                        <div>
                                            <div class="option-title">Pay with QR Scanner</div>
                                            <div class="option-subtext">Scan the code below and complete payment instantly.</div>
                                        </div>
                                    </label>
                                </div>

                                <div class="scanner-panel mb-4">
                                    <div class="scanner-circle mb-3">
                                        <i class="bi bi-qr-code-scan fs-1 text-primary"></i>
                                    </div>
                                    <p class="fw-semibold mb-2">Scan this code to pay ₹200</p>
                                    <p class="text-muted mb-0">After payment is successful, your admission form will be activated instantly and login credentials will be emailed to the address you provided.</p>
                                </div>

                                <div class="mb-4 payment-option" id="cashOption">
                                    <label class="option-card">
                                        <input type="radio" name="payment_method" value="cash">
                                        <div>
                                            <div class="option-title">Cash Payment</div>
                                            <div class="option-subtext">A message is sent to administration. Admission will be approved once cash is collected.</div>
                                        </div>
                                    </label>
                                </div>

                                <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_payment_method'): ?>
                                    <div class="alert alert-danger">Select a valid payment option before proceeding.</div>
                                <?php endif; ?>

                                <button type="submit" class="btn btn-primary btn-lg w-100 glow-button">Proceed to Pay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="public-footer py-3">
    <div class="container text-center">
        <small>All admission records are handled with priority support from the admin panel.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.option-card').forEach(card => {
        card.addEventListener('click', function () {
            const radio = this.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
            }
        });
    });
</script>
</body>
</html>
