<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA and BCA College | Cash Payment Pending</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/college/public/assets/css/public.css" rel="stylesheet">
    <style>
        /* Smooth animations and transitions */
        * {
            transition: all 0.3s ease;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .admission-page {
            padding: 60px 20px !important;
        }

        .admission-card {
            border: none !important;
            border-radius: 20px !important;
            background: white;
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(255, 193, 7, 0.3);
            }
            50% {
                box-shadow: 0 0 40px rgba(255, 193, 7, 0.6);
            }
        }

        @keyframes spin-circle {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes bounce-check {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        @keyframes success-pop {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes confetti-fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .badge {
            animation: pulse-glow 2s infinite;
            padding: 8px 16px !important;
            font-size: 13px !important;
            font-weight: 600;
        }

        .status-spinner {
            animation: spin-circle 1.5s linear infinite;
            display: inline-block;
        }

        .admission-summary {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%) !important;
            border-radius: 15px !important;
            animation: slideInUp 0.8s ease-out 0.2s both;
        }

        .card {
            animation: slideInUp 0.8s ease-out 0.4s both;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: none !important;
            border-radius: 10px !important;
            padding: 12px 28px !important;
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-outline-primary {
            border: 2px solid #667eea !important;
            color: #667eea !important;
            border-radius: 10px !important;
            padding: 12px 28px !important;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background: #667eea !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover, .btn-primary:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.5);
        }

        .status-check {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 20px;
            display: none;
        }

        .status-check.active {
            display: block;
            animation: slideInUp 0.4s ease-out;
        }

        .check-status-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        .check-status-btn:hover {
            transform: scale(1.05);
        }

        .check-status-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .success-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .success-modal.active {
            display: flex;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .success-modal-content {
            background: white;
            padding: 60px 40px;
            border-radius: 25px;
            text-align: center;
            animation: success-pop 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
        }

        .success-checkmark {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: bounce-check 0.6s ease-out;
        }

        .success-checkmark i {
            color: white;
            font-size: 50px;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            animation: confetti-fall 3s ease-out forwards;
        }

        .navbar {
            background: rgba(0, 0, 0, 0.8) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Loading spinner */
        .spinner {
            border: 4px solid rgba(102, 126, 234, 0.1);
            border-top: 4px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin-circle 1s linear infinite;
            margin: 0 auto 15px;
        }

        /* Pulse animation for pending status */
        .pending-pulse {
            animation: pulse-glow 2s infinite;
        }

        h1 {
            color: #333;
            font-weight: 700;
            margin: 15px 0;
        }

        h5 {
            color: #667eea;
            font-weight: 700;
            margin-top: 15px;
        }

        p {
            color: #666;
            line-height: 1.6;
        }

        ul li {
            color: #555;
            margin-bottom: 12px;
            line-height: 1.7;
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .admission-page {
                padding: 30px 15px !important;
            }

            .admission-card {
                border-radius: 15px !important;
            }

            .success-modal-content {
                padding: 40px 30px;
                margin: 20px;
            }

            .d-flex {
                flex-direction: column !important;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px !important;
            }
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

<!-- Success Modal -->
<div id="successModal" class="success-modal">
    <div class="success-modal-content">
        <div class="success-checkmark">
            <i class="bi bi-check-lg"></i>
        </div>
        <h2 style="color: #28a745; font-weight: 700; margin-bottom: 10px;">Admission Approved!</h2>
        <p style="color: #666; margin-bottom: 30px;">Your cash payment has been verified and your admission has been approved. Redirecting you now...</p>
        <div class="spinner"></div>
    </div>
</div>

<section class="admission-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card admission-card shadow-lg">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <span class="badge bg-warning pending-pulse">
                                <i class="bi bi-hourglass-split"></i> Pending
                            </span>
                            <h1 class="mt-3 fw-bold">Cash Payment Pending</h1>
                            <p class="text-muted">Your admission application is waiting for cash collection confirmation from the administration.</p>
                        </div>

                        <div class="admission-summary p-4 mb-4 rounded-4 border border-2 border-white bg-white text-start">
                            <h5 class="fw-bold">
                                <i class="bi bi-file-earmark-text"></i> Application Summary
                            </h5>
                            <div style="border-left: 4px solid #667eea; padding-left: 15px; margin-top: 15px;">
                                <p class="mb-2">
                                    <strong><i class="bi bi-hash"></i> Application ID:</strong> 
                                    <span style="background: #f0f0f0; padding: 2px 8px; border-radius: 5px;">
                                        <?= htmlspecialchars($admission['admission_number']) ?>
                                    </span>
                                </p>
                                <p class="mb-2">
                                    <strong><i class="bi bi-person"></i> Student Name:</strong> 
                                    <?= htmlspecialchars($admission['full_name']) ?>
                                </p>
                                <p class="mb-2">
                                    <strong><i class="bi bi-credit-card"></i> Payment Method:</strong> 
                                    <span class="badge bg-info">Cash</span>
                                </p>
                                <p class="mb-0">
                                    <strong><i class="bi bi-info-circle"></i> Current Status:</strong> 
                                    <span class="badge bg-warning text-dark pending-pulse">
                                        <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $admission['status']))) ?>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body text-start">
                                <h5 class="fw-bold">
                                    <i class="bi bi-list-check"></i> What Happens Next?
                                </h5>
                                <ul class="mb-0" style="list-style: none; padding-left: 0;">
                                    <li style="padding-left: 30px; position: relative; margin-bottom: 12px;">
                                        <i class="bi bi-1-circle-fill" style="position: absolute; left: 0; color: #667eea;"></i>
                                        <strong>Admin Verification:</strong> The admin will verify your cash payment and confirm the receipt.
                                    </li>
                                    <li style="padding-left: 30px; position: relative; margin-bottom: 12px;">
                                        <i class="bi bi-2-circle-fill" style="position: absolute; left: 0; color: #667eea;"></i>
                                        <strong>Automatic Update:</strong> This page will automatically check for updates every 10 seconds.
                                    </li>
                                    <li style="padding-left: 30px; position: relative; margin-bottom: 12px;">
                                        <i class="bi bi-3-circle-fill" style="position: absolute; left: 0; color: #667eea;"></i>
                                        <strong>Success Notification:</strong> Once approved, you'll see a success message and be redirected.
                                    </li>
                                    <li style="padding-left: 30px; position: relative;">
                                        <i class="bi bi-4-circle-fill" style="position: absolute; left: 0; color: #667eea;"></i>
                                        <strong>Admission Form:</strong> You'll need to complete your full admission form after approval.
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Status Check Section -->
                        <div class="status-check active">
                            <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                                <div class="spinner" style="width: 20px; height: 20px; margin: 0;"></div>
                                <span id="checkStatusText">Checking status... (auto-check every 10s)</span>
                            </div>
                        </div>

                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <button id="manualCheckBtn" class="btn btn-primary" onclick="checkAdmissionStatus()">
                                <i class="bi bi-arrow-clockwise"></i> Check Status Now
                            </button>
                            <a href="/college/public/index.php?url=admission" class="btn btn-outline-primary">
                                <i class="bi bi-plus-circle"></i> Start Another Application
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="card mt-4 shadow-sm" style="border: none; border-left: 4px solid #667eea;">
                    <div class="card-body">
                        <h6 class="fw-bold" style="color: #667eea;">
                            <i class="bi bi-lightbulb"></i> Need Help?
                        </h6>
                        <small class="text-muted">
                            The admin team will validate your cash payment within 2-4 hours during office hours. 
                            You can keep this page open and it will automatically update when your payment is approved.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="public-footer py-3">
    <div class="container text-center">
        <small style="color: rgba(255, 255, 255, 0.7);">
            <i class="bi bi-shield-check"></i> 
            The administration team is processing your cash payment. You'll be notified automatically once it's approved.
        </small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Get UUID from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const uuid = urlParams.get('uuid');
    let checkInterval = null;
    let isChecking = false;

    // Function to check admission status
    async function checkAdmissionStatus() {
        if (isChecking) return;
        
        isChecking = true;
        const checkBtn = document.getElementById('manualCheckBtn');
        const originalText = checkBtn.innerHTML;
        checkBtn.disabled = true;
        checkBtn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 16px; height: 16px; margin-right: 8px;"></span> Checking...';

        try {
            const response = await fetch('/college/public/index.php?url=api-check-admission-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ uuid: uuid })
            });

            const data = await response.json();

            if (data.success && data.status === 'admitted') {
                showSuccessModal();
                clearInterval(checkInterval);
                setTimeout(() => {
                    window.location.href = '/college/public/index.php?url=admission-success&uuid=' + uuid;
                }, 2000);
            } else if (data.success && data.status === 'cash_request_sent') {
                document.getElementById('checkStatusText').textContent = 'Still pending... (auto-check every 10s)';
            } else if (data.error) {
                alert('Error: ' + data.error);
            }
        } catch (error) {
            console.error('Error checking status:', error);
            document.getElementById('checkStatusText').textContent = 'Error checking status. Please try again.';
        }

        checkBtn.disabled = false;
        checkBtn.innerHTML = originalText;
        isChecking = false;
    }

    // Function to show success modal with confetti
    function showSuccessModal() {
        document.getElementById('successModal').classList.add('active');
        createConfetti();
    }

    // Function to create confetti animation
    function createConfetti() {
        const modal = document.getElementById('successModal');
        const colors = ['#667eea', '#764ba2', '#28a745', '#ffc107', '#17a2b8'];
        
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.animationDelay = Math.random() * 0.5 + 's';
            confetti.style.animationDuration = (Math.random() * 2 + 2.5) + 's';
            modal.appendChild(confetti);
        }
    }

    // Auto-check status every 10 seconds
    function startAutoCheck() {
        checkInterval = setInterval(() => {
            checkAdmissionStatus();
        }, 10000); // Check every 10 seconds
    }

    // Initial check on page load
    document.addEventListener('DOMContentLoaded', () => {
        // Check immediately on load
        setTimeout(() => {
            checkAdmissionStatus();
            // Then set up auto-check
            startAutoCheck();
        }, 1000);
    });

    // Clean up interval on page unload
    window.addEventListener('beforeunload', () => {
        if (checkInterval) {
            clearInterval(checkInterval);
        }
    });
</script>
</body>
</html>
