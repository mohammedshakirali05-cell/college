<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Nehru BBA and BCA College</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --page-background: linear-gradient(180deg, #f5f8ff 0%, #e6efff 100%);
            --page-surface: #ffffff;
            --surface-soft: rgba(255, 255, 255, 0.92);
            --surface-strong: rgba(15, 23, 42, 0.04);
            --brand-dark: #091a33;
            --brand-mid: #1d3f7a;
            --brand-light: #4f8bfd;
            --brand-soft: #dbe8ff;
            --accent: #22c3e3;
            --accent-soft: #d2f7ff;
            --glass-bg: rgba(255, 255, 255, 0.82);
            --glass-border: rgba(79, 139, 253, 0.18);
            --shadow-soft: 0 24px 60px rgba(9, 26, 51, 0.08);
            --shadow-strong: 0 30px 80px rgba(9, 26, 51, 0.14);
            --text-dark: #0f172a;
            --text-muted: #52647a;
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: radial-gradient(circle at top left, rgba(79, 139, 253, 0.16), transparent 30%),
                        radial-gradient(circle at bottom right, rgba(34, 195, 227, 0.12), transparent 24%),
                        var(--page-background);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Enhanced Navbar */
        .navbar {
            backdrop-filter: blur(24px);
            background: rgba(255, 255, 255, 0.72) !important;
            border-bottom: 1px solid rgba(79, 139, 253, 0.12);
            box-shadow: 0 18px 45px rgba(9, 26, 51, 0.06);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.45rem;
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-nav .nav-link {
            color: #1d3f7a;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #22c3e3 !important;
        }

        .btn-indigo {
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%) !important;
            color: #fff !important;
            border: none;
            box-shadow: 0 14px 30px rgba(34, 195, 227, 0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-indigo:hover {
            transform: translateY(-3px);
            box-shadow: 0 22px 42px rgba(34, 195, 227, 0.3);
        }

        /* Hero Section Redesign */
        .hero-section {
            background: linear-gradient(180deg, #f8fbff 0%, #eff8ff 45%, #e3f3ff 100%);
            color: var(--brand-dark);
            padding: 110px 0 90px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before,
        .hero-section::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.65;
            pointer-events: none;
        }

        .hero-section::before {
            width: 380px;
            height: 380px;
            background: rgba(34, 195, 227, 0.25);
            top: -80px;
            right: -80px;
            animation: glowPulse 10s ease-in-out infinite alternate;
        }

        .hero-section::after {
            width: 260px;
            height: 260px;
            background: rgba(79, 139, 253, 0.20);
            bottom: 20px;
            left: -80px;
            animation: glowPulse 9s ease-in-out infinite alternate-reverse;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.65rem;
            margin-bottom: 1.4rem;
        }

        .hero-badge span {
            background: rgba(34, 195, 227, 0.12);
            color: #1d3f7a;
            padding: 0.75rem 1.1rem;
            border-radius: 999px;
            font-size: 0.92rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            border: 1px solid rgba(34, 195, 227, 0.22);
        }

        .hero-title {
            font-size: clamp(3rem, 6vw, 4.6rem);
            font-weight: 900;
            letter-spacing: -1px;
            line-height: 1.02;
            margin-bottom: 1.4rem;
            position: relative;
        }

        .hero-title .hero-gradient {
            display: block;
            background: linear-gradient(135deg, #ff9a8b 0%, #fad0c4 50%, #a18cd1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-title .hero-accent {
            display: block;
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            font-weight: 400;
            color: var(--text-muted);
            opacity: 0.95;
            margin-bottom: 2.2rem;
            line-height: 1.75;
            max-width: 620px;
        }

        .hero-buttons .btn {
            padding: 1rem 2rem;
            border-radius: 999px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.25s ease;
            border: none;
        }

        .hero-buttons .btn-primary {
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            color: #ffffff;
            box-shadow: 0 20px 40px rgba(34, 195, 227, 0.25);
        }

        .hero-buttons .btn-primary:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 24px 48px rgba(34, 195, 227, 0.35);
        }

        .hero-buttons .btn-outline-light {
            color: var(--brand-dark);
            border: 1px solid rgba(15, 23, 42, 0.12);
            background: rgba(255,255,255,0.92);
        }

        .hero-buttons .btn-outline-light:hover {
            background: #ffffff;
            color: #1d3f7a;
            transform: translateY(-4px);
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.1);
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: white;
        }

        .feature-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 2.2rem;
            text-align: center;
            box-shadow: var(--shadow-soft);
            transition: all 0.4s ease;
            border: 1px solid rgba(79, 139, 253, 0.12);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-strong);
        }

        .feature-icon {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.7rem;
            font-size: 2rem;
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            color: white;
            box-shadow: 0 12px 28px rgba(34, 195, 227, 0.18);
        }

        .feature-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .feature-description {
            color: #475569;
            line-height: 1.6;
        }

        /* Enhanced 3D Modules */
        .modules-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .modules-container {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(79, 139, 253, 0.14);
            border-radius: 36px;
            padding: 3rem;
            box-shadow: var(--shadow-soft);
            position: relative;
            overflow: hidden;
        }

        .modules-container::after {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(34, 195, 227, 0.12);
            bottom: -80px;
            right: -80px;
            z-index: 0;
        }

        .module-card-3d {
            background: #ffffff;
            border-radius: 28px;
            padding: 2rem 1.5rem;
            text-align: center;
            color: var(--brand-dark);
            transition: transform 0.4s ease, box-shadow 0.4s ease, background 0.4s ease;
            cursor: pointer;
            height: 100%;
            border: 1px solid rgba(79, 139, 253, 0.14);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .module-card-3d::before {
            content: '';
            position: absolute;
            top: -35%;
            left: -40%;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(34,195,227,0.24), transparent 65%);
            opacity: 0;
            transition: opacity 0.35s ease;
            z-index: 0;
        }

        .module-card-3d:hover {
            transform: translateY(-16px) scale(1.03);
            box-shadow: var(--shadow-strong);
            background: #f8fbff;
        }

        .module-card-3d:hover::before {
            opacity: 1;
        }

        .module-card-3d i {
            font-size: 2.4rem;
            color: #1d3f7a;
            margin-bottom: 1.15rem;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .module-card-3d:hover i {
            transform: scale(1.14);
            color: #22c3e3;
        }

        .module-card-3d span {
            font-weight: 700;
            font-size: 1rem;
            color: var(--brand-dark);
            transition: color 0.3s ease;
            z-index: 1;
        }

        .module-card-3d:hover span {
            color: #1d3f7a;
        }

        /* Stats Section */
        .stats-section {
            padding: 80px 0;
            background: #eef7ff;
            color: #102a43;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-weight: 500;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        /* Team Section Enhancement */
        .team-section {
            padding: 100px 0;
            background: white;
        }

        .team-card {
            border: none;
            border-radius: 32px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
        }

        .team-header {
            background: var(--primary-gradient);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }

        .team-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .team-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .developer-grid {
            padding: 3rem 2rem;
        }

        .developer-item {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            padding: 1.5rem 2rem;
            border-radius: 16px;
            margin-bottom: 1rem;
            border-left: 5px solid #667eea;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .developer-item:hover {
            transform: translateX(8px) translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
        }

        .developer-name {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 1.1rem;
        }

        .developer-role {
            font-size: 0.9rem;
            color: #64748b;
            margin-top: 0.25rem;
        }

        /* Warning Section */
        .warning-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }

        .warning-card {
            background: white;
            border-left: 6px solid #ef4444;
            border-radius: 16px;
            box-shadow: var(--shadow-soft);
        }

        /* Footer Enhancement */
        .footer {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: rgba(255, 255, 255, 0.8);
            padding: 3rem 0 2rem;
        }

        .footer-title {
            color: white;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 2rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(36px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatPulse {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes glowPulse {
            0%, 100% { opacity: 0.35; }
            50% { opacity: 0.85; }
        }

        .animate-fade-in {
            animation: fadeInUp 0.65s ease-out both;
        }

        .hero-section .animate-fade-in {
            animation-delay: 0.15s;
        }

        .module-card-3d {
            animation: floatPulse 6s ease-in-out infinite;
        }

        .module-card-3d:nth-child(2) {
            animation-delay: 0.2s;
        }

        .module-card-3d:nth-child(4) {
            animation-delay: 0.35s;
        }

        .module-card-3d:nth-child(6) {
            animation-delay: 0.5s;
        }

        .hero-buttons .btn {
            will-change: transform, box-shadow;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .modules-container {
                padding: 2rem 1rem;
            }

            .module-card-3d {
                padding: 1.5rem 1rem;
            }

            .team-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-mortarboard-fill me-2"></i>Nehru College
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#modules">Modules</a></li>
                <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                <li class="nav-item"><a class="nav-link" href="?url=admission_payment">Fees</a></li>
                <li class="nav-item ms-lg-3 d-flex gap-2 flex-column flex-lg-row">
                    <a class="btn btn-outline-primary px-4" href="?url=admission">New Admission</a>
                    <a class="btn btn-indigo px-4" href="?url=login">Staff Portal</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 animate-fade-in">
                <div class="hero-badge">
                    <span>Campus ERP • Designed for BBA & BCA Excellence</span>
                </div>
                <h1 class="hero-title">
                    <span class="hero-gradient">Welcome to</span>
                    <span class="hero-accent">Nehru BBA and BCA College</span>
                </h1>
                <p class="hero-subtitle">
                    Experience the future of education management with our comprehensive ERP solution.
                    Seamlessly handle admissions, track performance, manage faculty, and monitor attendance
                    with cutting-edge technology and intuitive design.
                </p>
                <div class="hero-buttons d-flex gap-3 flex-wrap">
                    <a href="?url=admission" class="btn btn-primary">
                        <i class="bi bi-rocket-takeoff me-2"></i>Start Admission
                    </a>
                    <a href="#features" class="btn btn-outline-light">
                        <i class="bi bi-chevron-down me-2"></i>Explore Features
                    </a>
                </div>
            </div>

            <div class="col-lg-6 animate-fade-in">
                <div class="modules-container">
                    <h4 class="text-dark mb-4 fw-bold text-center">
                        <i class="bi bi-grid-3x3-gap me-2"></i>Core Modules
                    </h4>
                    <div class="row g-3">
                        <div class="col-6 col-md-4">
                            <a href="?url=login" class="module-card-3d">
                                <i class="bi bi-shield-lock"></i>
                                <span>Admin Portal</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-4">
                            <a href="?url=admission" class="module-card-3d">
                                <i class="bi bi-journal-check"></i>
                                <span>Admissions</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-4">
                            <a href="?url=login" class="module-card-3d">
                                <i class="bi bi-mortarboard"></i>
                                <span>Students</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-4">
                            <a href="?url=login" class="module-card-3d">
                                <i class="bi bi-briefcase"></i>
                                <span>Faculty</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-4">
                            <a href="?url=login" class="module-card-3d">
                                <i class="bi bi-calendar-check"></i>
                                <span>Attendance</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-4">
                            <a href="?url=login" class="module-card-3d">
                                <i class="bi bi-graph-up"></i>
                                <span>Analytics</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="features-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Why Choose Our System?</h2>
            <p class="text-muted fs-5">Advanced features designed for modern educational institutions</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card animate-fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h3 class="feature-title">Lightning Fast</h3>
                    <p class="feature-description">
                        Process admissions in minutes with our streamlined workflow and automated document generation.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card animate-fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="feature-title">Secure & Reliable</h3>
                    <p class="feature-description">
                        Bank-grade security with encrypted data storage and comprehensive audit trails.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card animate-fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h3 class="feature-title">Smart Analytics</h3>
                    <p class="feature-description">
                        Gain insights with detailed reports and analytics to improve institutional performance.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card animate-fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h3 class="feature-title">Mobile Ready</h3>
                    <p class="feature-description">
                        Access the system anywhere with our responsive design optimized for all devices.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card animate-fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="feature-title">User Friendly</h3>
                    <p class="feature-description">
                        Intuitive interface designed for administrators, faculty, and students alike.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card animate-fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-cloud"></i>
                    </div>
                    <h3 class="feature-title">Cloud Based</h3>
                    <p class="feature-description">
                        Scalable cloud infrastructure ensuring 99.9% uptime and automatic backups.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="modules" class="modules-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Comprehensive Module Suite</h2>
            <p class="text-muted fs-5">Everything you need to manage your institution efficiently</p>
        </div>

        <div class="modules-container">
            <div class="row g-4">
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="?url=login" class="module-card-3d">
                        <i class="bi bi-person-badge"></i>
                        <span>User Management</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="?url=admission" class="module-card-3d">
                        <i class="bi bi-file-earmark-plus"></i>
                        <span>Online Admissions</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="?url=login" class="module-card-3d">
                        <i class="bi bi-person-lines-fill"></i>
                        <span>Student Profiles</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="?url=login" class="module-card-3d">
                        <i class="bi bi-person-workspace"></i>
                        <span>Faculty Portal</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="?url=login" class="module-card-3d">
                        <i class="bi bi-calendar-event"></i>
                        <span>Attendance System</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="?url=login" class="module-card-3d">
                        <i class="bi bi-clipboard-data"></i>
                        <span>Grade Management</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="?url=login" class="module-card-3d">
                        <i class="bi bi-bar-chart-line"></i>
                        <span>Reports & Analytics</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="?url=login" class="module-card-3d">
                        <i class="bi bi-envelope"></i>
                        <span>Communication</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Students Enrolled</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Faculty Members</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">System Uptime</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support Available</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="team" class="team-section">
    <div class="container">
        <div class="team-card">
            <div class="team-header">
                <h2 class="team-title">Meet Our Development Team</h2>
                <p class="team-subtitle mb-0">
                    Expert developers under the guidance of Athar Shaikh (DharwadHubliTutors)
                </p>
            </div>

            <div class="developer-grid">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    <div class="col">
                        <div class="developer-item">
                            <div class="developer-name">Mohammad Saad Mirjanavar</div>
                            <div class="developer-role">User Management Specialist</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="developer-item">
                            <div class="developer-name">Mohammed Shakir Ali Yadwad</div>
                            <div class="developer-role">Admission Module Expert</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="developer-item">
                            <div class="developer-name">Jabeen Bepari</div>
                            <div class="developer-role">Student Module Developer</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="developer-item">
                            <div class="developer-name">Shaziya Yaragatti</div>
                            <div class="developer-role">Student Portal Specialist</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="developer-item">
                            <div class="developer-name">Taslim Meeranavar</div>
                            <div class="developer-role">Faculty Module Engineer</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="developer-item">
                            <div class="developer-name">Bibi Asiya Karnool</div>
                            <div class="developer-role">Faculty Portal Developer</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="warning-section">
    <div class="container">
        <div class="warning-card p-4">
            <div class="d-flex align-items-start">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-3 me-3 mt-1"></i>
                <div>
                    <h6 class="text-danger fw-bold mb-2">Security & Compliance Notice</h6>
                    <p class="mb-0 text-secondary">
                        Unauthorized access to the Nehru BBA and BCA College database is strictly prohibited under academic cyber-laws.
                        All activities are monitored and logged for security purposes. Data privacy and protection are our top priorities.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="footer-title">Nehru College</h5>
                <p class="mb-3">
                    Leading institution for BBA and BCA programs with state-of-the-art campus management technology.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="footer-link"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="footer-link"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="footer-link"><i class="bi bi-linkedin fs-5"></i></a>
                    <a href="#" class="footer-link"><i class="bi bi-instagram fs-5"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <h6 class="footer-title">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="?url=admission" class="footer-link">Admissions</a></li>
                    <li><a href="?url=login" class="footer-link">Staff Portal</a></li>
                    <li><a href="#features" class="footer-link">Features</a></li>
                    <li><a href="#team" class="footer-link">Team</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4">
                <h6 class="footer-title">Modules</h6>
                <ul class="list-unstyled">
                    <li><a href="?url=login" class="footer-link">User Management</a></li>
                    <li><a href="?url=login" class="footer-link">Student Portal</a></li>
                    <li><a href="?url=login" class="footer-link">Faculty Portal</a></li>
                    <li><a href="?url=login" class="footer-link">Reports</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4">
                <h6 class="footer-title">Support</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Help Center</a></li>
                    <li><a href="#" class="footer-link">Documentation</a></li>
                    <li><a href="#" class="footer-link">Contact Us</a></li>
                    <li><a href="#" class="footer-link">System Status</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom text-center">
            <p class="mb-0">&copy; 2026 Nehru BBA and BCA College. All rights reserved. | Engineered for Excellence</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Navbar background change on scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(255, 255, 255, 0.98) !important';
        } else {
            navbar.style.background = 'rgba(255, 255, 255, 0.95) !important';
        }
    });

    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Initially hide animated elements
    document.querySelectorAll('.animate-fade-in').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
</script>
</body>
</html>