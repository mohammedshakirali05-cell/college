<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA and BCA College | Official Admission Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="/college/public/assets/css/public.css" rel="stylesheet">
    <style>
        :root {
            --page-bg: linear-gradient(180deg, #fafbff 0%, #f3f8ff 100%);
            --surface: #ffffff;
            --brand-dark: #06112a;
            --brand-mid: #1d3f7a;
            --brand-light: #22c3e3;
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

        /* Success Section */
        .success-banner {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 2rem 0;
            color: white;
            margin-bottom: 3rem;
            border-radius: 16px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .success-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .success-banner h2 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .form-container {
            background: var(--surface);
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            margin-bottom: 3rem;
        }

        /* College Header in Form */
        .college-header {
            background: linear-gradient(135deg, #06112a 0%, #1d3f7a 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .college-header::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            top: -50px;
            left: -50px;
        }

        .college-logo-badge {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: rgba(34, 195, 227, 0.15);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            border: 2px solid rgba(34, 195, 227, 0.3);
        }

        .college-header h1 {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 0.3rem;
        }

        .college-header p {
            font-size: 0.95rem;
            opacity: 0.92;
            margin-bottom: 0;
        }

        .form-header {
            background: rgba(34, 195, 227, 0.08);
            border-bottom: 2px solid rgba(34, 195, 227, 0.3);
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .form-header-icon {
            font-size: 2rem;
            color: var(--brand-light);
        }

        .form-section {
            padding: 2.5rem 2rem;
            border-bottom: 1px solid rgba(29, 79, 122, 0.1);
        }

        .form-section:last-of-type {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--brand-mid);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .section-title i {
            color: var(--brand-light);
            font-size: 1.4rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.6rem;
            font-size: 0.95rem;
        }

        .form-group label .required {
            color: #ef4444;
            font-weight: 700;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border: 1.5px solid rgba(29, 79, 122, 0.15);
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: 'Inter', system-ui;
        }

        .form-control:focus {
            border-color: var(--brand-light);
            box-shadow: 0 0 0 3px rgba(34, 195, 227, 0.1);
        }

        .form-control::placeholder {
            color: rgba(85, 111, 145, 0.6);
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%231d3f7a' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-check {
            margin-bottom: 0.8rem;
        }

        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            border: 1.5px solid rgba(29, 79, 122, 0.3);
            border-radius: 4px;
            cursor: pointer;
            margin-top: 0.25rem;
        }

        .form-check-input:checked {
            background-color: var(--brand-light);
            border-color: var(--brand-light);
            box-shadow: 0 0 0 3px rgba(34, 195, 227, 0.1);
        }

        .form-check-label {
            margin-left: 0.8rem;
            cursor: pointer;
            color: var(--text-secondary);
        }

        .category-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 1rem;
        }

        .category-item {
            position: relative;
        }

        .category-item input[type="radio"] {
            display: none;
        }

        .category-item label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1rem;
            border: 2px solid rgba(29, 79, 122, 0.2);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        .category-item input[type="radio"]:checked + label {
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            color: white;
            border-color: var(--brand-light);
            box-shadow: 0 4px 12px rgba(34, 195, 227, 0.3);
        }

        .marks-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .subject-grid {
            display: grid;
            grid-template-columns: 1fr 100px 100px 100px;
            gap: 1rem;
            align-items: end;
            margin-bottom: 1rem;
            padding: 1rem;
            background: rgba(243, 248, 255, 0.8);
            border-radius: 10px;
            border: 1px solid rgba(34, 195, 227, 0.1);
        }

        .subject-grid input {
            font-size: 0.9rem;
        }

        .document-upload {
            border: 2px dashed rgba(34, 195, 227, 0.4);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: rgba(34, 195, 227, 0.02);
            margin-bottom: 1rem;
        }

        .document-upload:hover {
            border-color: var(--brand-light);
            background: rgba(34, 195, 227, 0.08);
        }

        .document-upload input[type="file"] {
            display: none;
        }

        .signature-upload {
            border: 2px dashed rgba(34, 195, 227, 0.4);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: rgba(34, 195, 227, 0.02);
            min-height: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .signature-upload:hover {
            border-color: var(--brand-light);
            background: rgba(34, 195, 227, 0.08);
        }

        .signature-upload input[type="file"] {
            display: none;
        }

        .signature-preview {
            max-width: 200px;
            max-height: 80px;
            margin-top: 0.5rem;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .signature-preview.visible {
            display: block;
        }

        .upload-file-name {
            margin-top: 0.75rem;
            font-size: 0.8rem;
            color: #0b1b35;
            font-weight: 600;
            text-align: center;
            word-break: break-word;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .photo-upload-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 2rem;
            margin-top: 1.5rem;
        }

        .passport-photo-frame {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .photo-upload {
            width: 190px;
            height: 230px;
            min-width: 190px;
            min-height: 230px;
            border: 3px dashed var(--brand-light);
            border-radius: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: linear-gradient(135deg, rgba(34, 195, 227, 0.03) 0%, rgba(34, 195, 227, 0.08) 100%);
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 24px rgba(34, 195, 227, 0.12);
        }

        .photo-upload:hover {
            border-color: var(--brand-mid);
            border-style: solid;
            background: linear-gradient(135deg, rgba(34, 195, 227, 0.12) 0%, rgba(34, 195, 227, 0.16) 100%);
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(34, 195, 227, 0.25);
        }

        .photo-upload:active {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(34, 195, 227, 0.15);
        }

        .photo-placeholder {
            text-align: center;
            padding: 0.8rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .photo-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
            position: absolute;
            top: 0;
            left: 0;
            display: none;
        }

        .upload-file-name {
            margin-top: 12px;
            font-size: 0.8rem;
            color: #0b1b35;
            font-weight: 600;
            text-align: center;
            word-break: break-word;
            width: 100%;
            max-height: 3rem;
            overflow: hidden;
        }

        .document-upload .upload-file-name {
            color: #2563eb;
            font-weight: 600;
            min-height: 1.2rem;
        }

        .photo-preview.visible {
            display: block;
            animation: fadeInImage 0.5s ease-out;
        }

        @keyframes fadeInImage {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .photo-instructions {
            text-align: center;
            max-width: 150px;
        }

        .form-actions {
            background: linear-gradient(135deg, rgba(34, 195, 227, 0.08) 0%, rgba(34, 195, 227, 0.04) 100%);
            padding: 2.5rem;
            border-top: 2px solid rgba(34, 195, 227, 0.15);
            border-radius: 0 0 16px 16px;
            display: flex;
            gap: 1.2rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: slideUpIn 0.6s ease-out;
        }

        @keyframes slideUpIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-submit {
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            color: white;
            border: none;
            padding: 1rem 3rem;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            font-size: 1rem;
            box-shadow: 0 6px 20px rgba(34, 195, 227, 0.35);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            min-width: 220px;
            justify-content: center;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.4s ease;
            z-index: -1;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(34, 195, 227, 0.45);
        }

        .btn-submit:active {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(34, 195, 227, 0.35);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-submit i {
            font-size: 1.1rem;
            animation-duration: 2s;
        }

        .btn-submit.loading i {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .btn-draft {
            background: rgba(34, 195, 227, 0.1);
            color: var(--brand-mid);
            border: 2px solid var(--brand-light);
            padding: 0.9rem 2.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-draft:hover {
            background: rgba(34, 195, 227, 0.2);
            border-color: var(--brand-mid);
            transform: translateY(-2px);
        }

        .btn-draft:active {
            transform: translateY(0);
        }

        .btn-draft {
            background: transparent;
            color: var(--brand-mid);
            border: 2px solid rgba(29, 79, 122, 0.3);
            padding: 0.9rem 2.5rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-draft:hover {
            border-color: var(--brand-mid);
            background: rgba(29, 79, 122, 0.05);
        }

        .info-note {
            background: rgba(59, 130, 246, 0.08);
            border-left: 4px solid #3b82f6;
            padding: 1rem;
            border-radius: 8px;
            margin: 1.5rem 0;
            color: #1e40af;
            font-size: 0.95rem;
        }

        .required-note {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .academic-table-card {
            border: 1px solid rgba(29, 79, 122, 0.12);
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
            margin-top: 1rem;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .custom-table th,
        .custom-table td {
            border: 1px solid rgba(29, 79, 122, 0.15);
            padding: 0.85rem 0.75rem;
            font-size: 0.92rem;
            vertical-align: middle;
        }

        .custom-table th {
            background: rgba(34, 195, 227, 0.08);
            color: var(--brand-mid);
            font-weight: 700;
            text-align: center;
        }

        .custom-table td input,
        .custom-table td select {
            min-width: 100%;
        }

        .table-static-cell {
            min-width: 56px;
            text-align: center;
            font-weight: 600;
            color: var(--brand-mid);
        }

        .table-summary-label {
            font-weight: 700;
            text-align: right;
            background: rgba(6, 17, 42, 0.03);
        }

        .signature-block {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .signature-box {
            padding-top: 2.5rem;
        }

        .signature-line {
            border-top: 2px solid rgba(11, 27, 53, 0.3);
            padding-top: 0.75rem;
            text-align: center;
            font-weight: 600;
            color: var(--text-primary);
        }


        @media (max-width: 768px) {
            .college-header {
                padding: 2rem 1rem;
            }

            .form-section {
                padding: 1.5rem 1rem;
            }

            .subject-grid {
                grid-template-columns: 1fr;
            }

            .academic-table-card {
                overflow-x: auto;
            }

            .form-header {
                flex-direction: column;
                text-align: center;
            }

            .college-header h1 {
                font-size: 1.4rem;
            }
        }

        .print-button {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            color: white;
            border: none;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(34, 195, 227, 0.4);
            transition: all 0.3s ease;
            display: none;
        }

        .print-button.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .print-button:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(34, 195, 227, 0.5);
        }

        @media print {
            .navbar, .success-banner, .form-actions, .print-button, .form-header {
                display: none !important;
            }
            body {
                background: white;
            }
            .form-container {
                box-shadow: none;
                margin: 0;
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
                    <a class="nav-link" href="/college/public/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/college/public/index.php?url=admission_payment">Fees</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-primary rounded-pill px-3" href="/college/public/index.php?url=login">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <?php if (isset($_SESSION['payment_success'])): ?>
        <div class="alert alert-success shadow-sm rounded-4 border-0 py-3">
            <i class="bi bi-bell-fill me-2"></i>
            <?= htmlspecialchars($_SESSION['payment_success']) ?>
        </div>
        <?php unset($_SESSION['payment_success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['admission_email_message'])): ?>
        <div class="alert alert-info shadow-sm rounded-4 border-0 py-3">
            <i class="bi bi-envelope-check me-2"></i>
            <?= htmlspecialchars($_SESSION['admission_email_message']) ?>
        </div>
        <?php unset($_SESSION['admission_email_message']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['payment_warning'])): ?>
        <div class="alert alert-warning shadow-sm rounded-4 border-0 py-3">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?= htmlspecialchars($_SESSION['payment_warning']) ?>
        </div>
        <?php unset($_SESSION['payment_warning']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['admission_credentials'])): ?>
        <div class="alert alert-light shadow-sm rounded-4 border-0 py-3 mb-4">
            <div class="d-flex align-items-start">
                <div class="me-3">
                    <i class="bi bi-award-fill text-primary fs-2"></i>
                </div>
                <div>
                    <h5 class="mb-2">Your Student Portal Credentials</h5>
                    <p class="mb-2">We have generated your login details. If the email does not arrive, use these credentials to access the student portal immediately.</p>
                    <div class="bg-white p-3 rounded-4 border">
                        <p class="mb-1"><strong>Student ID:</strong> <span class="text-primary"><?= htmlspecialchars($_SESSION['admission_credentials']['student_id']) ?></span></p>
                        <p class="mb-1"><strong>Password:</strong> <span class="text-primary"><?= htmlspecialchars($_SESSION['admission_credentials']['password']) ?></span></p>
                        <p class="mb-0"><strong>Sent to Email:</strong> <span class="text-secondary"><?= htmlspecialchars($_SESSION['admission_credentials']['email']) ?></span></p>
                    </div>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['admission_credentials']); ?>
    <?php endif; ?>
    <!-- Success/Cash Approval Banner -->
    <?php if (isset($showCashApprovalNotice) && $showCashApprovalNotice): ?>
    <div class="success-banner" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); animation: slideInDown 0.6s ease-out;">
        <div style="position: relative; z-index: 1;">
            <div style="font-size: 3rem; margin-bottom: 1rem; animation: bounce 1s ease-in-out;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h2 style="animation: slideInUp 0.8s ease-out;">
                <i class="bi bi-check-circle-fill me-2"></i>Cash Payment Approved!
            </h2>
            <p style="margin-bottom: 0;">Your cash payment has been verified by the administration. Please complete your admission form below to finalize your admission.</p>
        </div>
    </div>
    <style>
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        
        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
    </style>
    <?php else: ?>
    <!-- Success Banner -->
    <div class="success-banner">
        <div style="position: relative; z-index: 1;">
            <i class="bi bi-check-circle-fill" style="font-size: 3rem; margin-bottom: 1rem;"></i>
            <h2><i class="bi bi-check-circle-fill me-2"></i>Payment Successful!</h2>
            <p>Your admission form fee has been received. Please fill out the complete admission form below.</p>
        </div>
    </div>
    <?php endif; ?>

    <!-- Main Admission Form -->
    <div class="form-container">
        <!-- College Header -->
        <div class="college-header">
            <div class="college-logo-badge">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <h1>NEHRU B.B.A. and B.C.A. COLLEGE</h1>
            <p>Ghantikeri, HUBLI – 580 020</p>
            <p>Recognised by the Technical Dept. Govt. of Karnataka, Bangalore<br>Affiliated to the Karnataka University, Dharwad</p>
        </div>

        <!-- Form Header -->
        <div class="form-header">
            <div class="form-header-icon">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div style="flex: 1; text-align: left;">
                <h3 class="mb-1" style="color: var(--brand-mid); font-weight: 700;">Official Admission Application Form</h3>
                <p class="mb-0" style="color: var(--text-secondary); font-size: 0.95rem;">BBA / BCA First Semester - 2025-26</p>
            </div>
        </div>

        <form action="/college/public/index.php?url=admission-submit" method="POST" id="admissionFormMain" enctype="multipart/form-data" novalidate>

            <!-- PARTICULARS OF THE CANDIDATE -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-person-vcard-fill"></i>
                    Particulars of the Candidate
                </div>

                <div class="info-note">
                    <i class="bi bi-info-circle me-2"></i>
                    Please fill all fields marked with <span class="required">*</span> (required fields)
                </div>

                <!-- Application Details -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="appNo">Application No. <span class="required">*</span></label>
                        <input type="text" class="form-control" id="appNo" name="application_no"  value="<?= htmlspecialchars($admission['admission_number']) ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="regNo">PUC / ITI / Diploma. <span class="required">*</span></label>
                        <input type="text" class="form-control" id="regNo" name="registration_no" placeholder="Enter registration number" required>
                    </div>
                </div>

                <!-- Candidate Name -->
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="candName">Name of the Candidate (In Capital Letters as per PUC / ITI / Diploma) <span class="required">*</span></label>
                    <input type="text" class="form-control" id="candName" name="candidate_name" placeholder="Enter full name in capital letters" required>
                </div>

                <!-- Parent Details -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="fatherName">Father's Name <span class="required">*</span></label>
                        <input type="text" class="form-control" id="fatherName" name="father_name" placeholder="Enter father's name" required>
                    </div>
                    <div class="form-group">
                        <label for="motherName">Mother's Name <span class="required">*</span></label>
                        <input type="text" class="form-control" id="motherName" name="mother_name" placeholder="Enter mother's name" required>
                    </div>
                </div>

                <!-- Surname & Gender -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="surname">Surname / Initial if any</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter surname if applicable">
                    </div>
                    <div class="form-group">
                        <label>Gender <span class="required">*</span></label>
                        <div style="display: flex; gap: 2rem; padding-top: 0.5rem;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Date of Birth -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="dob">Date of Birth <span class="required">*</span></label>
                        <input type="date" class="form-control" id="dob" name="date_of_birth" required>
                    </div>
                    <div class="form-group">
                        <label for="aadharNo">Aadhar Card No. <span class="required">*</span></label>
                        <input type="text" class="form-control" id="aadharNo" name="aadhar_no" placeholder="Enter 12-digit Aadhar number" pattern="[0-9]{12}" required>
                    </div>
                </div>

                <!-- Category Section -->
                <div style="margin-top: 2rem;">
                    <label style="font-weight: 600; color: var(--text-primary); margin-bottom: 1rem; display: block;">Category <span class="required">*</span></label>
                    <div class="category-options">
                        <div class="category-item">
                            <input type="radio" name="category" id="cat_gm" value="GM" required>
                            <label for="cat_gm">GM</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="cat_iia" value="IIA" required>
                            <label for="cat_iia">IIA</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="cat_iib" value="IIB" required>
                            <label for="cat_iib">IIB</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="cat_iiia" value="IIIA" required>
                            <label for="cat_iiia">IIIA</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="cat_iiib" value="IIIB" required>
                            <label for="cat_iiib">IIIB</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="cat_sc" value="SC" required>
                            <label for="cat_sc">SC</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="cat_st" value="ST" required>
                            <label for="cat_st">ST</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="cat_cat1" value="Cat-1" required>
                            <label for="cat_cat1">Cat-1</label>
                        </div>
                    </div>
                </div>

                <!-- Category Certificate & Annual Income -->
                <div class="form-row" style="margin-top: 1.5rem;">
                    <div class="form-group">
                        <label for="catCertNo">Category Certificate Number</label>
                        <input type="text" class="form-control" id="catCertNo" name="category_cert_no" placeholder="If applicable">
                    </div>
                    <div class="form-group">
                        <label for="annualIncome">Annual Income <span class="required">*</span></label>
                        <input type="number" class="form-control" id="annualIncome" name="annual_income" placeholder="Enter annual income" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="incomeCasteCertNo">Income &amp; Caste Certificate No.</label>
                        <input type="text" class="form-control" id="incomeCasteCertNo" name="income_caste_certificate_no" placeholder="Enter income &amp; caste certificate number">
                    </div>
                    <div class="form-group">
                        <label for="sslcRegNo">SSLC Reg No.</label>
                        <input type="text" class="form-control" id="sslcRegNo" name="sslc_reg_no" placeholder="Enter SSLC registration number">
                    </div>
                </div>
            </div>

            <!-- PHOTO UPLOAD -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-image-fill"></i>
                    Candidate Photograph
                </div>

                <div class="info-note">
                    <i class="bi bi-info-circle me-2"></i>
                    Upload a recent passport-size photograph (3x4 cm) with clear face and white background
                </div>

                <div class="photo-upload-container">
                    <div class="passport-photo-frame">
                        <div class="photo-upload" onclick="document.getElementById('photoInput').click();">
                            <div class="photo-placeholder">
                                <i class="bi bi-person-circle" style="font-size: 3rem; color: var(--brand-light); margin-bottom: 0.5rem;"></i>
                                <p style="color: var(--text-secondary); font-weight: 500; margin-bottom: 0.2rem; font-size: 0.9rem;">Affix your Photograph here</p>
                                <p style="color: var(--text-secondary); font-size: 0.75rem; margin-bottom: 0;">Passport Size (3x4 cm)</p>
                            </div>
                            <input type="file" id="photoInput" name="photo" accept="image/*" required onchange="validatePhotoFile(this); previewPhoto(event)">
                            <img id="photoPreview" class="photo-preview" style="display: none;" src="" alt="Photo Preview">
                        </div>
                        <div class="photo-instructions">
                            <small style="color: var(--text-secondary); font-size: 0.75rem; line-height: 1.3;">
                                • Recent photograph<br>
                                • Clear face visible<br>
                                • White background<br>
                                • Formal attire
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ADDRESS DETAILS -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-geo-alt-fill"></i>
                    Address & Contact Information
                </div>

                <!-- Correspondence Address -->
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="address">Address for Correspondence <span class="required">*</span></label>
                    <textarea class="form-control" id="address" name="address" placeholder="Enter complete address" required></textarea>
                </div>

                <!-- Permanent Address -->
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="Permanent Address">Permanent Address <span class="required">*</span></label>
                    <textarea class="form-control" id="Permanent Address" name="permanent_address" placeholder="Enter complete address" required></textarea>
                </div>

                <!-- City, State, Postal Code -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City <span class="required">*</span></label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State <span class="required">*</span></label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Enter state" required>
                    </div>
                    <div class="form-group">
                        <label for="postal">Postal Code <span class="required">*</span></label>
                        <input type="text" class="form-control" id="postal" name="postal_code" placeholder="Enter postal code" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="district">District</label>
                        <input type="text" class="form-control" id="district" name="district" placeholder="Enter district">
                    </div>
                    <div class="form-group">
                        <label for="taluk">Taluk</label>
                        <input type="text" class="form-control" id="taluk" name="taluk" placeholder="Enter taluk">
                    </div>
                    <div class="form-group">
                        <label for="areaType">Area (Urban / Rural)</label>
                        <select class="form-control" id="areaType" name="area_type">
                            <option value="">Select area type</option>
                            <option value="Urban">Urban</option>
                            <option value="Rural">Rural</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="wardNo">Ward No.</label>
                        <input type="text" class="form-control" id="wardNo" name="ward_no" placeholder="Enter ward number">
                    </div>
                </div>

                <!-- Contact Details -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="mobile">Mobile No. <span class="required">*</span></label>
                        <input type="tel" class="form-control" id="mobile" name="mobile_no" placeholder="Enter 10-digit mobile number" pattern="[0-9]{10}" required>
                    </div>
                    <div class="form-group">
                        <label for="parentMobile">Parent's / Guardian Mobile No. <span class="required">*</span></label>
                        <input type="tel" class="form-control" id="parentMobile" name="parent_mobile_no" placeholder="Enter parent/guardian mobile" pattern="[0-9]{10}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email ID <span class="required">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required>
                    </div>
                </div>
            </div>

            <!-- ACADEMIC DETAILS -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-book-fill"></i>
                    Academic Details
                </div>

                <!-- Qualifying Exam Marks -->
                <div style="margin-bottom: 2rem;">
                    <label style="font-weight: 600; color: var(--text-primary); margin-bottom: 1rem; display: block;">PUC / ITI / Diploma <span class="required">*</span></label>
                    
                    <div class="subject-grid">
                        <div>Subject / Paper</div>
                        <div style="text-align: center; font-weight: 600; font-size: 0.85rem;">Marks Obt.</div>
                        <div style="text-align: center; font-weight: 600; font-size: 0.85rem;">Total</div>
                        <div style="text-align: center; font-weight: 600; font-size: 0.85rem;">%age</div>
                    </div>

                    <div class="subject-grid">
                        <input type="text" class="form-control" name="subject_1" placeholder="Subject 1" required>
                        <input type="number" class="form-control" name="marks_1" placeholder="0" required>
                        <input type="number" class="form-control" name="total_1" placeholder="100" required>
                        <input type="number" class="form-control" name="percentage_1" placeholder="0%" readonly>
                    </div>

                    <div class="subject-grid">
                        <input type="text" class="form-control" name="subject_2" placeholder="Subject 2">
                        <input type="number" class="form-control" name="marks_2" placeholder="0">
                        <input type="number" class="form-control" name="total_2" placeholder="100">
                        <input type="number" class="form-control" name="percentage_2" placeholder="0%" readonly>
                    </div>

                    <div class="subject-grid">
                        <input type="text" class="form-control" name="subject_3" placeholder="Subject 3">
                        <input type="number" class="form-control" name="marks_3" placeholder="0">
                        <input type="number" class="form-control" name="total_3" placeholder="100">
                        <input type="number" class="form-control" name="percentage_3" placeholder="0%" readonly>
                    </div>
                    <div class="subject-grid">
                        <input type="text" class="form-control" name="subject_4" placeholder="Subject 4" required>
                        <input type="number" class="form-control" name="marks_4" placeholder="0" required>
                        <input type="number" class="form-control" name="total_4" placeholder="100" required>
                        <input type="number" class="form-control" name="percentage_4" placeholder="0%" readonly>
                    </div>
                    <div class="subject-grid">
                        <input type="text" class="form-control" name="subject_5" placeholder="Subject 5" required>
                        <input type="number" class="form-control" name="marks_5" placeholder="0" required>
                        <input type="number" class="form-control" name="total_5" placeholder="100" required>
                        <input type="number" class="form-control" name="percentage_5" placeholder="0%" readonly>
                    </div>
                    <div class="subject-grid">
                        <input type="text" class="form-control" name="subject_6" placeholder="Subject 6" required>
                        <input type="number" class="form-control" name="marks_6" placeholder="0" required>
                        <input type="number" class="form-control" name="total_6" placeholder="100" required>
                        <input type="number" class="form-control" name="percentage_6" placeholder="0%" readonly>
                    </div>
                </div>

                <!-- Overall Percentage -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="overallPerc">Overall Percentage <span class="required">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="overallPerc" name="overall_percentage" placeholder="Enter overall percentage" required>
                    </div>
                    <div class="form-group">
                        <label for="course">Course Applied For <span class="required">*</span></label>
                        <select class="form-control" id="course" name="course_applied" required>
                            <option value="">Select Course</option>
                            <option value="BBA">Bachelor of Business Administration (BBA)</option>
                            <option value="BCA">Bachelor of Computer Applications (BCA)</option>
                        </select>
                    </div>
                </div>
                <div class="form-row" style="margin-top: 1.5rem;">
                    <div class="form-group">
                        <label for="lastInstitution">Name of the Institution Last Attended</label>
                        <input type="text" class="form-control" id="lastInstitution" name="last_attended_institution" placeholder="Enter institution name">
                    </div>
                    <div class="form-group">
                        <label for="yearOfAdmission">Year of Admission</label>
                        <input type="number" class="form-control" id="yearOfAdmission" name="year_of_admission" min="1900" max="2099" placeholder="YYYY">
                    </div>
                    <div class="form-group">
                        <label for="yearOfPassing">Year of Passing</label>
                        <input type="number" class="form-control" id="yearOfPassing" name="year_of_passing" min="1900" max="2099" placeholder="YYYY">
                    </div>
                </div>
            </div>

            <!-- SUBJECTS / MARKS FORMAT FROM ADMISSION FORM -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-table"></i>
                   
    Subject Offered for I Semester 20 - 20 :
</div>

<div class="academic-table-card" style="margin-top: 2rem;">
    <table class="custom-table">
                        <thead>
                            <tr>
                                <th style="width: 90px;">Sl.No.</th>
                                <th style="width: 180px;">Subject Code</th>
                                <th>Title of Subject / Paper</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-static-cell">1</td>
                                <td><input type="text" class="form-control" name="semester_subject_code_1" placeholder="Subject code"></td>
                                <td><input type="text" class="form-control" name="semester_subject_title_1" placeholder="Title of subject / paper"></td>
                            </tr><tr>
                                <td class="table-static-cell">2</td>
                                <td><input type="text" class="form-control" name="semester_subject_code_2" placeholder="Subject code"></td>
                                <td><input type="text" class="form-control" name="semester_subject_title_2" placeholder="Title of subject / paper"></td>
                            </tr><tr>
                                <td class="table-static-cell">3</td>
                                <td><input type="text" class="form-control" name="semester_subject_code_3" placeholder="Subject code"></td>
                                <td><input type="text" class="form-control" name="semester_subject_title_3" placeholder="Title of subject / paper"></td>
                            </tr><tr>
                                <td class="table-static-cell">4</td>
                                <td><input type="text" class="form-control" name="semester_subject_code_4" placeholder="Subject code"></td>
                                <td><input type="text" class="form-control" name="semester_subject_title_4" placeholder="Title of subject / paper"></td>
                            </tr><tr>
                                <td class="table-static-cell">5</td>
                                <td><input type="text" class="form-control" name="semester_subject_code_5" placeholder="Subject code"></td>
                                <td><input type="text" class="form-control" name="semester_subject_title_5" placeholder="Title of subject / paper"></td>
                            </tr><tr>
                                <td class="table-static-cell">6</td>
                                <td><input type="text" class="form-control" name="semester_subject_code_6" placeholder="Subject code"></td>
                                <td><input type="text" class="form-control" name="semester_subject_title_6" placeholder="Title of subject / paper"></td>
                            </tr><tr>
                                <td class="table-static-cell">7</td>
                                <td><input type="text" class="form-control" name="semester_subject_code_7" placeholder="Subject code"></td>
                                <td><input type="text" class="form-control" name="semester_subject_title_7" placeholder="Title of subject / paper"></td>
                            </tr><tr>
                                <td class="table-static-cell">8</td>
                                <td><input type="text" class="form-control" name="semester_subject_code_8" placeholder="Subject code"></td>
                                <td><input type="text" class="form-control" name="semester_subject_title_8" placeholder="Title of subject / paper"></td>
                            </tr><tr>
                                <td class="table-static-cell">9</td>
                                <td><input type="text" class="form-control" name="semester_subject_code_9" placeholder="Subject code"></td>
                                <td><input type="text" class="form-control" name="semester_subject_title_9" placeholder="Title of subject / paper"></td>
                            </tr><tr>
                                <td class="table-static-cell">10</td>
                                <td><input type="text" class="form-control" name="semester_subject_code_10" placeholder="Subject code"></td>
                                <td><input type="text" class="form-control" name="semester_subject_title_10" placeholder="Title of subject / paper"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- DOCUMENT UPLOADS -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-file-earmark-arrow-up-fill"></i>
                    Document Uploads
                </div>

                <div class="info-note">
                    <i class="bi bi-info-circle me-2"></i>
                    Please upload clear, scanned copies of the following documents in PDF or image format (max 5MB each)
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>SSLC Marks Card <span class="required">*</span></label>
                        <div class="document-upload" onclick="document.getElementById('sslcMarksInput').click();">
                            <i class="bi bi-file-earmark-text" style="font-size: 2rem; color: var(--brand-light); margin-bottom: 0.5rem;"></i>
                            <p style="color: var(--text-primary); font-weight: 600; margin-bottom: 0.3rem;">Upload SSLC Marks Card</p>
                            <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 0;">PDF or Image (Max 5MB)</p>
                            <input type="file" id="sslcMarksInput" name="sslc_marks_card" accept=".pdf,.jpg,.jpeg,.png" required onchange="validateFile(this)">
                            <div class="upload-file-name" id="sslcMarksName"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>PUC / ITI / Diploma Marks Card <span class="required">*</span></label>
                        <div class="document-upload" onclick="document.getElementById('pucMarksInput').click();">
                            <i class="bi bi-file-earmark-text" style="font-size: 2rem; color: var(--brand-light); margin-bottom: 0.5rem;"></i>
                            <p style="color: var(--text-primary); font-weight: 600; margin-bottom: 0.3rem;">Upload PUC/ITI/Diploma Marks Card</p>
                            <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 0;">PDF or Image (Max 5MB)</p>
                            <input type="file" id="pucMarksInput" name="puc_marks_card" accept=".pdf,.jpg,.jpeg,.png" required onchange="validateFile(this)">
                            <div class="upload-file-name" id="pucMarksName"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Income Certificate <span class="required">*</span></label>
                        <div class="document-upload" onclick="document.getElementById('incomeCertInput').click();">
                            <i class="bi bi-file-earmark-text" style="font-size: 2rem; color: var(--brand-light); margin-bottom: 0.5rem;"></i>
                            <p style="color: var(--text-primary); font-weight: 600; margin-bottom: 0.3rem;">Upload Income Certificate</p>
                            <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 0;">PDF or Image (Max 5MB)</p>
                            <input type="file" id="incomeCertInput" name="income_certificate" accept=".pdf,.jpg,.jpeg,.png" required onchange="validateFile(this)">
                            <div class="upload-file-name" id="incomeCertName"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Aadhar Card <span class="required">*</span></label>
                        <div class="document-upload" onclick="document.getElementById('aadharCardInput').click();">
                            <i class="bi bi-credit-card" style="font-size: 2rem; color: var(--brand-light); margin-bottom: 0.5rem;"></i>
                            <p style="color: var(--text-primary); font-weight: 600; margin-bottom: 0.3rem;">Upload Aadhar Card</p>
                            <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 0;">PDF or Image (Max 5MB)</p>
                            <input type="file" id="aadharCardInput" name="aadhar_card" accept=".pdf,.jpg,.jpeg,.png" required onchange="validateFile(this)">
                            <div class="upload-file-name" id="aadharCardName"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DECLARATIONS -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-file-check"></i>
                    Declaration
                </div>

                <div class="form-check" style="margin-top: 1rem;">
                    <input class="form-check-input" type="checkbox" id="declaration1" name="declaration_1" required>
                    <label class="form-check-label" for="declaration1">
                        I hereby declare that the particulars furnished above are true and complete to the best of my knowledge and belief.
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="declaration2" name="declaration_2" required>
                    <label class="form-check-label" for="declaration2">
                        I understand that in case any information provided is found to be false or misleading, my admission shall be cancelled.
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="declaration3" name="declaration_3" required>
                    <label class="form-check-label" for="declaration3">
                        I agree to abide by the rules and regulations of the college as prescribed from time to time.
                    </label>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-pen-fill"></i>
                    Signatures
                </div>

                <div class="info-note">
                    <i class="bi bi-info-circle me-2"></i>
                    Please upload signature images in JPEG/PNG format (max 2MB each)
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Candidate Signature <span class="required">*</span></label>
                        <div class="signature-upload" onclick="document.getElementById('candidateSignInput').click();">
                            <i class="bi bi-vector-pen" style="font-size: 2rem; color: var(--brand-light); margin-bottom: 0.5rem;"></i>
                            <p style="color: var(--text-primary); font-weight: 600; margin-bottom: 0.3rem;">Upload Candidate Signature</p>
                            <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 0;">Image file (Max 2MB)</p>
                            <input type="file" id="candidateSignInput" name="candidate_signature" accept="image/*" required onchange="validateSignatureFile(this); previewSignature(event, 'candidateSignPreview')">
                            <img id="candidateSignPreview" class="signature-preview" style="display: none;" src="" alt="Candidate Signature Preview">
                            <div class="upload-file-name" id="candidateSignName">No file selected</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Parent Signature <span class="required">*</span></label>
                        <div class="signature-upload" onclick="document.getElementById('parentSignInput').click();">
                            <i class="bi bi-vector-pen" style="font-size: 2rem; color: var(--brand-light); margin-bottom: 0.5rem;"></i>
                            <p style="color: var(--text-primary); font-weight: 600; margin-bottom: 0.3rem;">Upload Parent Signature</p>
                            <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 0;">Image file (Max 2MB)</p>
                            <input type="file" id="parentSignInput" name="parent_signature" accept="image/*" required onchange="validateSignatureFile(this); previewSignature(event, 'parentSignPreview')">
                            <img id="parentSignPreview" class="signature-preview" style="display: none;" src="" alt="Parent Signature Preview">
                            <div class="upload-file-name" id="parentSignName">No file selected</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="form-actions">
                <button type="button" class="btn-draft" onclick="saveDraft()">
                    <i class="bi bi-download me-2"></i>Save as Draft
                </button>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle me-2"></i>Submit Application
                </button>
                <button type="button" class="btn-draft" onclick="window.print()">
                    <i class="bi bi-printer me-2"></i>Print Form
                </button>
            </div>

        </form>
    </div>
</div>

<!-- Print Button -->
<button class="print-button show" onclick="window.print()" title="Print Form">
    <i class="bi bi-printer"></i>
</button>

<script>
    // Auto-generate Application Number
    // function generateAppNo() {
    //     const prefix = 'APP';
    //     const timestamp = new Date().getTime();
    //     return prefix + timestamp;
    // }

    // Preview Photo with Enhanced Validation
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (file) {
            // Validate file first
            if (!validatePhotoFile(event.target)) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('photoPreview');
                const placeholder = document.querySelector('.photo-placeholder');
                
                preview.src = e.target.result;
                preview.classList.add('visible');
                
                if (placeholder) {
                    placeholder.style.display = 'none';
                }
                
                showNotification('Photo uploaded successfully!', 'success');
            }
            reader.readAsDataURL(file);
        }
    }

    // Preview Signature with Enhanced Animation
    function previewSignature(event, previewId) {
        const file = event.target.files[0];
        if (file) {
            if (!validateSignatureFile(event.target)) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                if (preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    preview.classList.add('visible');
                    preview.style.animation = 'fadeInImage 0.5s ease-out';
                }

                const nameId = previewId === 'candidateSignPreview' ? 'candidateSignName' : 'parentSignName';
                updateSignatureName(nameId, file.name);
            }
            reader.readAsDataURL(file);
        }
    }

    function updateSignatureName(nameId, fileName) {
        const label = document.getElementById(nameId);
        if (label) {
            label.textContent = fileName || 'No file selected';
        }
    }

    // Validate File Size and Type
    function validateFile(input) {
        const file = input.files[0];
        if (file) {
            const maxSize = 5 * 1024 * 1024; // 5MB for documents
            if (file.size > maxSize) {
                showNotification('File size must be less than 5MB', 'error');
                input.value = '';
                updateDocumentName(input, '');
                return false;
            }

            const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                showNotification('Please upload PDF or image files only', 'error');
                input.value = '';
                updateDocumentName(input, '');
                return false;
            }

            updateDocumentName(input, file.name);
        }
        return true;
    }

    function updateDocumentName(input, fileName) {
        const idMap = {
            'sslcMarksInput': 'sslcMarksName',
            'pucMarksInput': 'pucMarksName',
            'incomeCertInput': 'incomeCertName',
            'aadharCardInput': 'aadharCardName'
        };
        const nameId = idMap[input.id];
        if (nameId) {
            const label = document.getElementById(nameId);
            if (label) {
                label.textContent = fileName || 'No file selected';
            }
        }
    }

    // Validate Photo File with Clear Feedback
    function validatePhotoFile(input) {
        const file = input.files[0];
        if (file) {
            const maxSize = 2 * 1024 * 1024; // 2MB for photos
            if (file.size > maxSize) {
                showNotification('Photo file size must be less than 2MB. Current: ' + (file.size / (1024 * 1024)).toFixed(2) + 'MB', 'error');
                input.value = '';
                return false;
            }

            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                showNotification('Please upload JPEG or PNG images only. Uploaded: ' + file.type, 'error');
                input.value = '';
                return false;
            }

            // Check dimensions for passport photo (optional but recommended)
            const img = new Image();
            img.onload = function() {
                // Passport photo: 3.5 x 4.5 cm typically, but allow flexibility
                if (this.height < 100 || this.width < 80) {
                    showNotification('Image might be too small for a passport photo. Recommended: at least 100x80 pixels', 'warning');
                }
            };
            img.src = URL.createObjectURL(file);
        }
        return true;
    }

    // Show Notification Toast
    function showNotification(message, type = 'success') {
        const container = document.getElementById('notificationContainer') || createNotificationContainer();
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        
        const icon = type === 'success' ? 'check-circle-fill' : type === 'warning' ? 'exclamation-triangle-fill' : 'exclamation-circle-fill';
        
        notification.innerHTML = `
            <div class="notification-content">
                <i class="bi bi-${icon}"></i>
                <span>${message}</span>
            </div>
            <button class="notification-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x"></i>
            </button>
        `;
        
        container.appendChild(notification);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            notification.classList.add('notification-dismiss');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    function createNotificationContainer() {
        const container = document.createElement('div');
        container.id = 'notificationContainer';
        container.className = 'notification-container';
        document.body.appendChild(container);
        return container;
    }

    // Add CSS for notifications
    const notificationStyles = document.createElement('style');
    notificationStyles.textContent = `
        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .notification {
            background: white;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 12px;
            box-shadow: 0 6px 20px rgba(6, 17, 42, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            animation: slideInRight 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            border-left: 4px solid #22c3e3;
        }

        .notification-content {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .notification-content i {
            font-size: 18px;
            min-width: 20px;
        }

        .notification-success {
            border-left-color: #10b981;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        }

        .notification-success i {
            color: #10b981;
        }

        .notification-success span {
            color: #065f46;
            font-weight: 500;
        }

        .notification-error {
            border-left-color: #ef4444;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }

        .notification-error i {
            color: #ef4444;
        }

        .notification-error span {
            color: #991b1b;
            font-weight: 500;
        }

        .notification-warning {
            border-left-color: #f59e0b;
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        }

        .notification-warning i {
            color: #f59e0b;
        }

        .notification-warning span {
            color: #92400e;
            font-weight: 500;
        }

        .notification-close {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            padding: 0;
            display: flex;
            align-items: center;
            opacity: 0.6;
            transition: opacity 0.2s;
        }

        .notification-close:hover {
            opacity: 1;
        }

        .notification-close i {
            color: #6b7280;
            font-size: 16px;
        }

        .notification-dismiss {
            animation: slideOutRight 0.3s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(400px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(400px);
            }
        }

        @media (max-width: 640px) {
            .notification-container {
                left: 10px;
                right: 10px;
                max-width: none;
            }
        }
    `;
    document.head.appendChild(notificationStyles);

    // Save as Draft
    function saveDraft() {
        const formData = new FormData(document.getElementById('admissionFormMain'));
        formData.append('save_draft', true);
        
        fetch('/college/public/index.php?url=save-admission-draft', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
          .then(data => {
              alert(data.message || 'Form saved as draft successfully!');
          })
          .catch(error => console.error('Error:', error));
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // document.getElementById('appNo').value = generateAppNo();
        
        // Add percentage calculation on input
        for(let i = 1; i <= 3; i++) {
            document.querySelector(`[name="marks_${i}"]`).addEventListener('change', () => calculatePercentage(i));
            document.querySelector(`[name="total_${i}"]`).addEventListener('change', () => calculatePercentage(i));
        }
    });

    // Form Submission with Enhanced Validation & Feedback
    document.getElementById('admissionFormMain').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate required files are uploaded
        const requiredFiles = ['photoInput', 'sslcMarksInput', 'pucMarksInput', 'incomeCertInput', 'aadharCardInput', 'candidateSignInput', 'parentSignInput'];
        let allFilesUploaded = true;
        
        for (let fileId of requiredFiles) {
            const fileInput = document.getElementById(fileId);
            if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                allFilesUploaded = false;
                showNotification(`Please upload: ${fileId.replace('Input', '').replace(/([A-Z])/g, ' $1').trim()}`, 'error');
                break;
            }
        }

        if (!allFilesUploaded) {
            return false;
        }

        // Validate all required checkboxes
        const declaration1 = document.getElementById('declaration1');
        const declaration2 = document.getElementById('declaration2');
        const declaration3 = document.getElementById('declaration3');

        if (!declaration1?.checked || !declaration2?.checked || !declaration3?.checked) {
            showNotification('Please accept all declarations to proceed', 'error');
            document.querySelector('.form-check')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }

        if (!this.checkValidity()) {
            e.stopPropagation();
            this.reportValidity();
            showNotification('Please fill all required fields', 'error');
            return false;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        const originalBtnState = submitBtn.disabled;
        
        submitBtn.disabled = true;
        submitBtn.classList.add('loading');
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Submitting...';
        
        // Small delay for better UX
        setTimeout(() => {
            this.submit();
        }, 300);
    });
</script>

</body>
</html>