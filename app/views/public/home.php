<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Nehru BBA and BCA College</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --page-background: linear-gradient(180deg, #f3b0f2 45%, #f3f4f9 45%, #fbf5b9 100%);
            --page-surface: #091525;
            --surface-soft: rgba(255, 255, 255, 0.08);
            --surface-strong: rgba(0, 0, 0, 0.28);
            --brand-dark: #ffffff;
            --brand-mid: #22d5c5;
            --brand-light: #71f0e8;
            --brand-soft: rgba(34, 213, 197, 0.14);
            --accent: #ffd369;
            --accent-soft: rgba(255, 211, 105, 0.18);
            --glass-bg: rgba(255, 255, 255, 0.12);
            --glass-border: rgba(255, 255, 255, 0.14);
            --shadow-soft: 0 24px 60px rgba(0, 0, 0, 0.24);
            --shadow-strong: 0 36px 90px rgba(0, 0, 0, 0.32);
            --text-dark: #091525;
            --text-muted: #bac5cc;
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: radial-gradient(circle at top left, rgba(146, 106, 255, 0.20), transparent 22%),
                radial-gradient(circle at bottom right, rgba(80, 201, 213, 0.16), transparent 18%),
                var(--page-background);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Enhanced Navbar */
        .navbar {
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.10) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: 0 14px 34px rgba(0, 0, 0, 0.18);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.45rem;
            color: var(--brand-dark);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--brand-light) !important;
        }

        .btn-indigo {
            background: linear-gradient(135deg, #f2b84b 0%, #c68b38 100%) !important;
            color: #0f1720 !important;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 12px 34px rgba(117, 74, 1, 0.18);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-indigo:hover {
            transform: translateY(-3px);
            box-shadow: 0 24px 46px rgba(5, 111, 95, 0.3);
        }

        /* Hero Section Redesign */
        .hero-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.04));
            color: #ffffff;
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
            background: rgba(34, 213, 197, 0.16);
            top: -80px;
            right: -80px;
            animation: glowPulse 10s ease-in-out infinite alternate;
        }

        .hero-section::after {
            width: 260px;
            height: 260px;
            background: rgba(255, 211, 105, 0.18);
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
            background: rgba(255, 255, 255, 0.88);
            color: var(--text-dark);
            padding: 0.75rem 1.1rem;
            border-radius: 999px;
            font-size: 0.92rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            border: 1px solid rgba(255, 255, 255, 0.95);
        }

        .hero-title {
            font-size: clamp(3rem, 6vw, 4.6rem);
            font-weight: 900;
            letter-spacing: -1px;
            line-height: 1.02;
            margin-bottom: 1.4rem;
            position: relative;
        }

        .hero-title .hero-gradient,
        .hero-title .hero-accent {
            display: block;
            color: var(--text-dark);
        }

        .hero-subtitle {
            font-size: 1.1rem;
            font-weight: 400;
            color: rgba(15, 23, 32, 0.76);
            opacity: 0.95;
            margin-bottom: 2.2rem;
            line-height: 1.7;
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
            background: var(--accent);
            color: var(--text-dark);
            box-shadow: 0 18px 38px rgba(15, 23, 42, 0.18);
        }

        .hero-buttons .btn-primary:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 24px 48px rgba(15, 23, 42, 0.24);
        }

        .hero-buttons .btn-outline-light {
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.75);
            background: rgba(255, 255, 255, 0.15);
        }

        .hero-buttons .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.32);
            color: #ffffff;
            transform: translateY(-4px);
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.15);
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
            border: 1px solid rgba(14, 165, 163, 0.10);
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
            background: linear-gradient(135deg, var(--brand-mid) 0%, var(--accent) 100%);
            color: white;
            box-shadow: 0 12px 28px rgba(14, 165, 163, 0.16);
        }

        .feature-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .feature-description {
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Enhanced 3D Modules */
        .modules-section {
            padding: 100px 0;
            background: transparent;
        }

        .modules-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(34, 193, 183, 0.16);
            border-radius: 36px;
            padding: 2.5rem;
            box-shadow: 0 40px 90px rgba(15, 23, 42, 0.08);
            position: relative;
            overflow: hidden;
        }

        .modules-container h4 {
            color: var(--text-dark);
            letter-spacing: -0.02em;
            margin-bottom: 1.75rem;
            font-size: 1.38rem;
            font-weight: 800;
        }

        .modules-container::after {
            content: '';
            position: absolute;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(48, 226, 207, 0.16);
            bottom: -80px;
            right: -80px;
            z-index: 0;
        }

        .module-card-3d {
            background: rgba(255, 255, 255, 0.96);
            border-radius: 24px;
            padding: 1.6rem 1.4rem;
            text-align: center;
            color: var(--text-dark);
            transition: transform 0.4s ease, box-shadow 0.4s ease, background 0.4s ease;
            cursor: pointer;
            min-height: 180px;
            border: 1px solid rgba(255, 255, 255, 0.55);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 0 26px 45px rgba(15, 23, 42, 0.08);
        }

        .module-card-3d::before {
            content: '';
            position: absolute;
            top: -35%;
            left: -40%;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(34, 193, 183, 0.24), transparent 65%);
            opacity: 0;
            transition: opacity 0.35s ease;
            z-index: 0;
        }

        .module-card-3d:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 32px 80px rgba(15, 23, 42, 0.16);
            background: linear-gradient(180deg, #ffffff 0%, #f0fffb 100%);
        }

        .module-card-3d:hover::before {
            opacity: 1;
        }

        .module-card-3d i {
            width: 56px;
            height: 56px;
            line-height: 56px;
            font-size: 1.35rem;
            color: #ffffff;
            margin-bottom: 1rem;
            transition: transform 0.3s ease, color 0.3s ease, background 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--brand-mid) 0%, var(--brand-light) 100%);
            box-shadow: 0 14px 34px rgba(34, 193, 183, 0.2);
        }

        .module-card-3d:hover i {
            transform: scale(1.14);
            color: var(--brand-light);
        }

        .module-card-3d span {
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-dark);
            transition: color 0.3s ease;
            z-index: 1;
        }

        .module-card-3d:hover span {
            color: var(--brand-mid);
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
            padding: 100px 0 60px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02) 0%, rgba(255, 255, 255, 0.01) 100%);
        }

        .team-card {
            border: none;
            border-radius: 8px;
            background: transparent;
            overflow: visible;
        }

        .team-header {
            color: var(--text-dark);
            padding: 1rem 0 2rem;
            text-align: center;
        }

        .team-title {
            font-size: 2.6rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .team-subtitle {
            font-size: 1rem;
            color: black;
            margin-bottom: 1.6rem;
        }

        .lead-badge {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.02));
            padding: 0.9rem 1.6rem;
            border-radius: 999px;
            box-shadow: 0 8px 20px rgba(2, 6, 23, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.04);
            margin: 0 auto 2rem;
            max-width: 520px;
        }

        .lead-badge img {
            width: 48px;
            height: 48px;
            border-radius: 999px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.06);
        }

        .lead-avatar-fallback {
            width: 48px;
            height: 48px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.02));
            font-weight: 700;
            margin-right: 0.6rem;
            border: 2px solid rgba(255, 255, 255, 0.04);
        }

        .lead-name {
            font-weight: 800;
            color: var(--text-dark);
        }

        .lead-role {
            font-size: 0.85rem;
            color: black;
        }

        .developer-grid {
            padding: 1.5rem 0;
        }

        .developer-item {
            background: rgba(255, 255, 255, 0.03);
            padding: 1.6rem 1.6rem;
            border-radius: 14px;
            margin-bottom: 1rem;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 8px 20px rgba(2, 6, 23, 0.6);
            text-align: center;
        }

        .developer-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(2, 6, 23, 0.75);
        }

        .developer-avatar {
            width: 60px;
            height: 60px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--brand-light), var(--brand-mid));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            margin-bottom: 0.9rem;
            box-shadow: 0 8px 20px rgba(2, 6, 23, 0.6);
        }

        .developer-name {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 1rem;
        }

        .developer-role {
            font-size: 0.82rem;
            color: var(--brand-light);
            margin-top: 0.45rem;
            font-weight: 600;
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

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes glowPulse {

            0%,
            100% {
                opacity: 0.35;
            }

            50% {
                opacity: 0.85;
            }
        }

        /* Extreme animated background */
        .bg-animated {
            position: fixed;
            inset: 0;
            z-index: -3;
            pointer-events: none;
            background: radial-gradient(circle at 10% 20%, rgba(242, 184, 75, 0.20), transparent 14%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.24), transparent 16%),
                linear-gradient(180deg, rgba(14, 24, 45, 0.82), rgba(8, 15, 28, 0.96));
            mix-blend-mode: screen;
            filter: blur(28px) saturate(1.1);
            opacity: 0.94;
            animation: hueRotate 24s linear infinite, bgFloat 20s ease-in-out infinite alternate;
            will-change: transform, filter, opacity;
        }

        .bg-animated::before {
            content: '';
            position: absolute;
            left: -10%;
            top: -20%;
            width: 60vmax;
            height: 60vmax;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.18), transparent 20%),
                radial-gradient(circle at 70% 70%, rgba(48, 226, 207, 0.14), transparent 30%);
            transform: translate3d(0, 0, 0);
            animation: blobMove 26s linear infinite;
            filter: blur(44px) contrast(1.02);
            opacity: 0.92;
        }

        .bg-animated::after {
            content: '';
            position: absolute;
            right: -15%;
            bottom: -15%;
            width: 50vmax;
            height: 50vmax;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0, transparent 55%);
            animation: blobMove 32s linear reverse infinite;
            filter: blur(86px) brightness(1.05);
        }

        @keyframes hueRotate {
            0% {
                filter: blur(28px) saturate(1) hue-rotate(0deg);
            }

            50% {
                filter: blur(28px) saturate(1.06) hue-rotate(30deg);
            }

            100% {
                filter: blur(28px) saturate(1) hue-rotate(0deg);
            }
        }

        @keyframes blobMove {
            0% {
                transform: translate3d(0, 0, 0) scale(1);
            }

            25% {
                transform: translate3d(6vw, -4vw, 0) scale(1.02);
            }

            50% {
                transform: translate3d(-4vw, 6vw, 0) scale(1.03);
            }

            75% {
                transform: translate3d(4vw, -6vw, 0) scale(1.01);
            }

            100% {
                transform: translate3d(0, 0, 0) scale(1);
            }
        }

        @keyframes bgFloat {
            0% {
                transform: translateY(0) scale(1);
            }

            100% {
                transform: translateY(-6vh) scale(1.01);
            }
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

        /* ===== ULTIMATE DESIGN UPGRADE: visual-only layer ===== */
        :root {
            --ultimate-bg-1: #07111f;
            --ultimate-bg-2: #13235c;
            --ultimate-neon-cyan: #20f7ff;
            --ultimate-neon-blue: #6c7cff;
            --ultimate-neon-gold: #ffd36a;
            --ultimate-glass: rgba(255, 255, 255, 0.13);
            --ultimate-border: rgba(255, 255, 255, 0.22);
            --ultimate-shadow: 0 34px 110px rgba(4, 12, 31, 0.36);
        }

        html {
            scroll-padding-top: 92px;
        }

        body {
            background:
                radial-gradient(circle at 10% 10%, rgba(32, 247, 255, 0.22), transparent 28%),
                radial-gradient(circle at 90% 20%, rgba(255, 211, 106, 0.18), transparent 24%),
                radial-gradient(circle at 50% 90%, rgba(108, 124, 255, 0.22), transparent 28%),
                linear-gradient(135deg, #f8fbff 0%, #eef5ff 40%, #e9fbff 100%);
            background-attachment: fixed;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: -4;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 46px 46px;
            mask-image: linear-gradient(to bottom, transparent, black 18%, black 72%, transparent);
            animation: ultimateGridFlow 22s linear infinite;
        }

        .navbar {
            transform: translateZ(0);
            backdrop-filter: blur(26px) saturate(1.25);
            -webkit-backdrop-filter: blur(26px) saturate(1.25);
        }

        .navbar::after {
            content: '';
            position: absolute;
            left: 8%;
            right: 8%;
            bottom: -1px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--ultimate-neon-cyan), var(--ultimate-neon-gold), transparent);
            animation: ultimateLineScan 5s ease-in-out infinite;
        }

        .navbar-brand,
        .section-title,
        .team-title,
        .portal-heading,
        .hero-title {
            text-wrap: balance;
        }

        .btn,
        .module-card-3d,
        .feature-card,
        .portal-card,
        .team-card,
        .developer-item,
        .admission-card {
            transform-style: preserve-3d;
            backface-visibility: hidden;
        }

        .btn {
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .btn::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(120deg, transparent 20%, rgba(255, 255, 255, 0.75), transparent 80%);
            transform: translateX(-130%) skewX(-18deg);
            transition: transform 0.7s ease;
            z-index: -1;
        }

        .btn:hover::before {
            transform: translateX(130%) skewX(-18deg);
        }

        .btn:hover {
            transform: translateY(-4px) scale(1.015);
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background:
                radial-gradient(circle at 16% 24%, rgba(255, 255, 255, 0.24), transparent 20%),
                radial-gradient(circle at 82% 18%, rgba(32, 247, 255, 0.20), transparent 24%),
                linear-gradient(135deg, #f3b0f2, #fbf5b9);
        }

        .hero-section::before {
            animation: ultimateBlob 13s ease-in-out infinite alternate;
        }

        .hero-section::after {
            animation: ultimateBlob 11s ease-in-out infinite alternate-reverse;
        }

        .hero-title .hero-gradient,
        .hero-title .hero-accent {
            color: #000 !important;
            background: linear-gradient(90deg, #ffffff 0%, #e9fbff 30%, var(--ultimate-neon-gold) 58%, #ffffff 100%);
            background-size: 240% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            text-shadow: 0 18px 70px rgba(255, 255, 255, 0.18);
            animation: ultimateTextShine 6s linear infinite;
        }

        .hero-badge span {
            box-shadow: 0 18px 60px rgba(255, 255, 255, 0.16), inset 0 1px 0 rgba(0, 0, 0, 0.9);
            animation: ultimateFloat 5s ease-in-out infinite;
        }

        .hero-subtitle {
            color: rgba(0, 0, 0, 0.86) !important;
        }

        .modules-container,
        .portal-card,
        .feature-card,
        .team-card,
        .warning-card,
        .admission-card {
            position: relative;
            isolation: isolate;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.82) !important;
            border: 1px solid rgba(255, 255, 255, 0.55) !important;
            backdrop-filter: blur(22px) saturate(1.15);
            -webkit-backdrop-filter: blur(22px) saturate(1.15);
            box-shadow: var(--ultimate-shadow) !important;
        }

        .modules-container::before,
        .portal-card::before,
        .feature-card::before,
        .team-card::before,
        .admission-card::before {
            content: '';
            position: absolute;
            inset: 0;
            padding: 1px;
            border-radius: inherit;
            background: linear-gradient(135deg, rgba(32, 247, 255, 0.55), rgba(255, 211, 106, 0.38), rgba(108, 124, 255, 0.48));
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            z-index: 2;
        }

        .module-card-3d,
        .feature-card,
        .developer-item {
            transition: transform 0.45s cubic-bezier(.2, .9, .2, 1), box-shadow 0.45s ease, filter 0.45s ease;
            will-change: transform;
        }

        .module-card-3d:hover,
        .feature-card:hover,
        .developer-item:hover {
            transform: translateY(-16px) rotateX(5deg) rotateY(-5deg) scale(1.035) !important;
            filter: saturate(1.12);
        }

        .module-card-3d i,
        .feature-icon,
        .developer-avatar {
            animation: ultimateIconPulse 4.8s ease-in-out infinite;
        }

        .features-section,
        .team-section,
        .stats-section,
        .warning-section {
            position: relative;
            overflow: hidden;
        }

        .features-section::before,
        .team-section::before,
        .stats-section::before {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: radial-gradient(circle at var(--mx, 50%) var(--my, 50%), rgba(32, 247, 255, 0.16), transparent 28%);
            opacity: 0.75;
        }

        .reveal-ready {
            opacity: 0;
            transform: translateY(38px) scale(0.98);
        }

        .reveal-in {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: opacity 0.8s ease, transform 0.8s cubic-bezier(.2, .9, .2, 1);
        }

        @keyframes ultimateTextShine {
            to {
                background-position: -240% 0;
            }
        }

        @keyframes ultimateFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes ultimateBlob {
            0% {
                transform: translate3d(0, 0, 0) scale(1);
            }

            100% {
                transform: translate3d(36px, -28px, 0) scale(1.12);
            }
        }

        @keyframes ultimateIconPulse {

            0%,
            100% {
                box-shadow: 0 16px 38px rgba(34, 193, 183, 0.20);
            }

            50% {
                box-shadow: 0 20px 54px rgba(255, 211, 106, 0.35);
            }
        }

        @keyframes ultimateGridFlow {
            from {
                background-position: 0 0, 0 0;
            }

            to {
                background-position: 92px 92px, 92px 92px;
            }
        }

        @keyframes ultimateLineScan {

            0%,
            100% {
                opacity: .35;
                transform: scaleX(.35);
            }

            50% {
                opacity: 1;
                transform: scaleX(1);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: auto;
                padding: 96px 0 56px;
            }

            .module-card-3d:hover,
            .feature-card:hover,
            .developer-item:hover {
                transform: translateY(-8px) scale(1.015) !important;
            }
        }


        .orb {
            position: fixed;
            width: 18rem;
            height: 18rem;
            border-radius: 999px;
            pointer-events: none;
            z-index: -2;
            filter: blur(34px);
            opacity: .42;
            mix-blend-mode: screen;
        }

        .orb-one {
            left: -5rem;
            top: 18%;
            background: #20f7ff;
            animation: ultimateOrbOne 18s ease-in-out infinite alternate;
        }

        .orb-two {
            right: -4rem;
            top: 12%;
            background: #ffd36a;
            animation: ultimateOrbTwo 21s ease-in-out infinite alternate;
        }

        .orb-three {
            left: 42%;
            bottom: -8rem;
            background: #6c7cff;
            animation: ultimateOrbThree 24s ease-in-out infinite alternate;
        }

        @keyframes ultimateOrbOne {
            to {
                transform: translate(18vw, -8vh) scale(1.18);
            }
        }

        @keyframes ultimateOrbTwo {
            to {
                transform: translate(-16vw, 12vh) scale(1.08);
            }
        }

        @keyframes ultimateOrbThree {
            to {
                transform: translate(8vw, -16vh) scale(1.22);
            }
        }
    </style>
</head>

<body>
    <div class="bg-animated" aria-hidden="true"></div>
    <div class="orb orb-one" aria-hidden="true"></div>
    <div class="orb orb-two" aria-hidden="true"></div>
    <div class="orb orb-three" aria-hidden="true"></div>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-mortarboard-fill me-2"></i>Nehru College
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
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

    <section id="team" class="team-section">
        <div class="container">
            <div class="team-card">
                <div class="team-header">
                    <h2 class="team-title">Developer Team</h2>
                    <p class="team-subtitle mb-0">Built under academic guidance and close team collaboration.</p>
                </div>

                <div class="text-center mb-4">
                    <div class="lead-badge">
                        <img id="leadAvatar" src="/uploads/avatar/athar.jpg" alt="Athar Shaikh"
                            onerror="this.style.display='none';document.getElementById('leadFallback').style.display='inline-flex'">
                        <div id="leadFallback" class="lead-avatar-fallback" style="display:none">Athar</div>
                        <div>
                            <div class="lead-name">Athar Shaikh</div>
                            <div class="lead-role">Founder, DharwadHubliTutors — Academic Guide</div>
                        </div>
                    </div>
                </div>

                <div class="developer-grid">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                        <div class="col">
                            <div class="developer-item">
                                <div class="developer-avatar">MS</div>
                                <div class="developer-name">Mohammad Saad Mirjanavar</div>
                                <div class="developer-role">User Management</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="developer-item">
                                <div class="developer-avatar">MY</div>
                                <div class="developer-name">Mohammed Shakir Ali Yadwad</div>
                                <div class="developer-role">Admission Module</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="developer-item">
                                <div class="developer-avatar">JB</div>
                                <div class="developer-name">Jabeen Bepari</div>
                                <div class="developer-role">Student Module</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="developer-item">
                                <div class="developer-avatar">SY</div>
                                <div class="developer-name">Shaziya Yaragatti</div>
                                <div class="developer-role">Student Module</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="developer-item">
                                <div class="developer-avatar">TM</div>
                                <div class="developer-name">Taslim Meeranavar</div>
                                <div class="developer-role">Faculty Module</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="developer-item">
                                <div class="developer-avatar">BA</div>
                                <div class="developer-name">Bibi Asiya Karnool</div>
                                <div class="developer-role">Faculty Portal</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="developer-item">
                                <div class="developer-avatar">RM</div>
                                <div class="developer-name">Rubina Makandar</div>
                                <div class="developer-role">Faculty Portal</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="developer-item">
                                <div class="developer-avatar">FB</div>
                                <div class="developer-name">Farhat Bahadur</div>
                                <div class="developer-role">Cyber Security</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Warning section removed per redesign request -->

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
                <p class="mb-0">&copy; 2026 Nehru BBA and BCA College. All rights reserved. | Engineered for Excellence
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">

        // Ultimate visual-only interactions: tilt cards, cursor glow, staggered reveals.
        const motionSafe = !window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (motionSafe) {
            const tiltCards = document.querySelectorAll('.module-card-3d, .feature-card, .developer-item, .portal-card');
            tiltCards.forEach(card => {
                card.addEventListener('mousemove', (event) => {
                    const rect = card.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;
                    const rotateY = ((x / rect.width) - 0.5) * 10;
                    const rotateX = ((0.5 - (y / rect.height)) * 10);
                    card.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
                });
                card.addEventListener('mouseleave', () => { card.style.transform = ''; });
            });

            window.addEventListener('pointermove', (event) => {
                document.documentElement.style.setProperty('--mx', `${event.clientX}px`);
                document.documentElement.style.setProperty('--my', `${event.clientY}px`);
            }, { passive: true });

            document.querySelectorAll('.feature-card, .developer-item, .module-card-3d, .footer .col-lg-4, .footer .col-lg-2, .footer .col-lg-3').forEach((el, index) => {
                el.classList.add('reveal-ready');
                el.style.transitionDelay = `${Math.min(index * 55, 420)}ms`;
                observer.observe(el);
            });
        }

    </script>
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
        window.addEventListener('scroll', function () {
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