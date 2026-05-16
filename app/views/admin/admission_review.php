<?php
/**
 * Admin Admission Review Page
 * Display detailed student admission information with documents for admin approval
 */

$admissionId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$admission = $admissionModel->getAdmissionById($admissionId);

if (!$admission) {
    header('Location: ' . BASE_URL . 'admin-admissions&error=not_found');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Admission - <?= htmlspecialchars($admission['full_name']) ?></title>
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
            --warning: #f59e0b;
            --text-primary: #0b1b35;
            --text-secondary: #556f91;
            --shadow: 0 20px 60px rgba(9, 26, 51, 0.15);
            --shadow-lg: 0 30px 90px rgba(9, 26, 51, 0.25);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #eef6ff 0%, #dbeeff 100%);
            min-height: 100vh;
            padding: 30px 20px;
        }

        .container-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header with Back Button */
        .review-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            animation: slideDown 0.6s ease-out;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 20px;
            color: var(--text-primary);
            text-decoration: none;
        }

        .back-button:hover {
            border-color: var(--brand-light);
            box-shadow: 0 4px 12px rgba(34, 195, 227, 0.2);
        }

        .header-title {
            flex: 1;
        }

        .header-title h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 5px;
        }

        .header-title p {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Main Content Grid */
        .review-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
            margin-bottom: 30px;
        }

        /* Student Information Card */
        .student-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 30px;
            animation: slideUp 0.6s ease-out 0.1s forwards;
            opacity: 0;
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

        .section-heading {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 3px solid var(--brand-light);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-heading i {
            color: var(--brand-light);
            font-size: 18px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-box {
            background: var(--brand-soft);
            padding: 16px;
            border-radius: 12px;
            border-left: 4px solid var(--brand-light);
        }

        .info-label {
            font-size: 12px;
            color: var(--text-secondary);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 15px;
            color: var(--text-primary);
            font-weight: 600;
        }

        /* Documents Section */
        .documents-section {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 30px;
            animation: slideUp 0.6s ease-out 0.2s forwards;
            opacity: 0;
            margin-bottom: 30px;
        }

        .document-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .document-card {
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            animation: fadeIn 0.4s ease-out forwards;
            opacity: 0;
        }

        .document-card:hover {
            border-color: var(--brand-light);
            box-shadow: 0 8px 24px rgba(34, 195, 227, 0.15);
        }

        .document-preview {
            width: 100%;
            height: 200px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .document-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .document-preview i {
            font-size: 48px;
            color: #d1d5db;
        }

        .document-info {
            padding: 16px;
        }

        .document-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .document-file-name {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
            max-width: 220px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .document-upload-date {
            font-size: 11px;
            color: #6b7280;
            margin-top: 4px;
        }

        .document-meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }

        .document-view-button {
            border: none;
            outline: none;
            cursor: pointer;
            padding: 10px 16px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--brand-light) 0%, #0ea5e9 100%);
            color: white;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            white-space: nowrap;
        }

        .document-view-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(14, 165, 233, 0.25);
        }

        .document-clickable {
            cursor: pointer;
        }

        .document-preview .pdf-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.15) 0%, rgba(14, 165, 233, 0.05) 100%);
            color: #0369a1;
            font-size: 32px;
        }

        .document-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
        }

        .status-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            font-size: 10px;
        }

        .status-icon.success {
            background: var(--success);
            color: white;
        }

        .status-icon.pending {
            background: var(--warning);
            color: white;
        }

        /* Side Panel */
        .approval-panel {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 25px;
            position: sticky;
            top: 20px;
            animation: slideUp 0.6s ease-out 0.3s forwards;
            opacity: 0;
            height: fit-content;
        }

        .panel-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e5e7eb;
        }

        .checklist {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 25px;
        }

        .checklist-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            color: var(--text-primary);
        }

        .checklist-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            cursor: pointer;
            accent-color: var(--brand-light);
        }

        .notes-area {
            margin-bottom: 20px;
        }

        .notes-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .notes-textarea {
            width: 100%;
            min-height: 120px;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            resize: vertical;
            transition: all 0.3s ease;
        }

        .notes-textarea:focus {
            outline: none;
            border-color: var(--brand-light);
            box-shadow: 0 0 0 4px rgba(34, 195, 227, 0.1);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .btn-action {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-approve {
            background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-approve::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.5s ease;
            z-index: 0;
        }

        .btn-approve:hover::before {
            left: 100%;
        }

        .btn-approve:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
        }

        .btn-approve:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-reject {
            background: linear-gradient(135deg, var(--error) 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-reject::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.5s ease;
            z-index: 0;
        }

        .btn-reject:hover::before {
            left: 100%;
        }

        .btn-reject:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(239, 68, 68, 0.4);
        }

        .btn-reject:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-action:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-action.loading {
            pointer-events: none;
        }

        .btn-action i {
            transition: transform 0.3s ease;
        }

        .btn-action.loading i {
            animation: spin 1s linear infinite;
        }

        /* Modal for Document View - Full Screen */
        .modal-backdrop.show {
            background-color: rgba(6, 17, 42, 0.6);
            animation: fadeInBackdrop 0.3s ease-out;
        }

        @keyframes fadeInBackdrop {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            animation: slideUpModal 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden;
        }

        @keyframes slideUpModal {
            from {
                opacity: 0;
                transform: translateY(60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            border-bottom: 2px solid #e5e7eb;
            background: linear-gradient(135deg, var(--brand-mid) 0%, var(--brand-light) 100%);
            color: white;
            padding: 24px 30px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-header .modal-title {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
            transition: all 0.2s ease;
        }

        .modal-header .btn-close:hover {
            opacity: 1;
        }

        .modal-body {
            padding: 30px;
            background: #f9fafb;
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .document-viewer {
            width: 100%;
            max-width: 96vw;
            max-height: 82vh;
            min-height: 60vh;
            background: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 40px rgba(6, 17, 42, 0.2);
            overflow: hidden;
            animation: zoomIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .document-viewer img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
            animation: fadeIn 0.5s ease-out 0.2s both;
        }

        .document-viewer iframe {
            width: 100%;
            height: 100%;
            border: none;
            animation: fadeIn 0.5s ease-out 0.2s both;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-lg {
            max-width: 95vw;
        }

        /* Loading Spinner for Document Viewer */
        .document-loading {
            text-align: center;
            padding: 40px;
        }

        .document-loading-spinner {
            border: 4px solid rgba(34, 195, 227, 0.1);
            border-top: 4px solid var(--brand-light);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        .modal-footer {
            padding: 20px 30px;
            background: white;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .modal-footer .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .modal-footer .btn-secondary {
            background: #e5e7eb;
            color: var(--text-primary);
        }

        .modal-footer .btn-secondary:hover {
            background: #d1d5db;
        }

        /* Loading State */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

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

        .document-card:nth-child(1) { animation-delay: 0.1s; }
        .document-card:nth-child(2) { animation-delay: 0.15s; }
        .document-card:nth-child(3) { animation-delay: 0.2s; }
        .document-card:nth-child(4) { animation-delay: 0.25s; }
        .document-card:nth-child(5) { animation-delay: 0.3s; }
        .document-card:nth-child(6) { animation-delay: 0.35s; }

        /* Toast Notification */
        .toast-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1050;
            max-width: 400px;
        }

        .toast {
            background: white;
            border-radius: 14px;
            box-shadow: var(--shadow-lg);
            padding: 18px 24px;
            margin-bottom: 12px;
            animation: slideInUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 300px;
            border-left: 5px solid var(--brand-light);
            backdrop-filter: blur(10px);
        }

        .toast i {
            font-size: 20px;
            flex-shrink: 0;
        }

        .toast span {
            flex: 1;
            font-weight: 500;
        }

        .toast.success {
            border-left-color: var(--success);
            background: linear-gradient(135deg, rgba(209, 250, 229, 0.5) 0%, rgba(167, 243, 208, 0.3) 100%);
        }

        .toast.success i {
            color: var(--success);
        }

        .toast.success span {
            color: #065f46;
        }

        .toast.error {
            border-left-color: var(--error);
            background: linear-gradient(135deg, rgba(254, 226, 226, 0.5) 0%, rgba(254, 202, 202, 0.3) 100%);
        }

        .toast.error i {
            color: var(--error);
        }

        .toast.error span {
            color: #991b1b;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideOutUp {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-40px);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .review-grid {
                grid-template-columns: 1fr;
            }

            .approval-panel {
                position: relative;
                top: 0;
            }
        }

        @media (max-width: 768px) {
            .review-header {
                flex-direction: column;
                text-align: center;
            }

            .header-title h1 {
                font-size: 22px;
            }

            .document-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container-wrapper">
        <!-- Header with Back Button -->
        <div class="review-header">
            <a href="<?= BASE_URL ?>admin-admissions" class="back-button" title="Back to Admissions">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div class="header-title">
                <h1><i class="bi bi-file-earmark-check"></i> Admission Review</h1>
                <p>Verify student details and documents before approval</p>
            </div>
            <span class="status-badge status-<?= strtolower($admission['admin_approval_status'] ?? 'pending') ?>">
                <i class="bi bi-circle-fill"></i> <?= ucfirst($admission['admin_approval_status'] ?? 'pending') ?>
            </span>
        </div>

        <div class="review-grid">
            <!-- Main Content -->
            <div>
                <!-- Student Information -->
                <div class="student-card">
                    <h3 class="section-heading">
                        <i class="bi bi-person-vcard-fill"></i> Personal Information
                    </h3>
                    <div class="info-grid">
                        <div class="info-box">
                            <div class="info-label">Student Name</div>
                            <div class="info-value"><?= htmlspecialchars($admission['full_name'] ?? '') ?></div>
                        </div>
                        <div class="info-box">
                            <div class="info-label">Father's Name</div>
                            <div class="info-value"><?= htmlspecialchars($admission['father_name'] ?? '') ?></div>
                        </div>
                        <div class="info-box">
                            <div class="info-label">Student ID</div>
                            <div class="info-value"><?= htmlspecialchars($admission['student_id'] ?? 'N/A') ?></div>
                        </div>
                        <div class="info-box">
                            <div class="info-label">Aadhar Number</div>
                            <div class="info-value">XXXX XXXX <?= substr($admission['aadhar_number'] ?? '', -4) ?></div>
                        </div>
                        <div class="info-box">
                            <div class="info-label">Email</div>
                            <div class="info-value"><?= htmlspecialchars($admission['email'] ?? '') ?></div>
                        </div>
                        <div class="info-box">
                            <div class="info-label">Mobile No.</div>
                            <div class="info-value"><?= htmlspecialchars($admission['mobile_no'] ?? '') ?></div>
                        </div>
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="student-card">
                    <h3 class="section-heading">
                        <i class="bi bi-book"></i> Academic Information
                    </h3>
                    <div class="info-grid">
                        <div class="info-box">
                            <div class="info-label">Course Applied</div>
                            <div class="info-value"><?= htmlspecialchars($admission['course_applied'] ?? '') ?></div>
                        </div>
                        <div class="info-box">
                            <div class="info-label">PUC Institute</div>
                            <div class="info-value"><?= htmlspecialchars($admission['puc_institute'] ?? '') ?></div>
                        </div>
                        <div class="info-box">
                            <div class="info-label">Year Last Attended</div>
                            <div class="info-value"><?= htmlspecialchars($admission['last_attended'] ?? '') ?></div>
                        </div>
                        <div class="info-box">
                            <div class="info-label">Overall Percentage</div>
                            <div class="info-value"><?= htmlspecialchars($admission['overall_percentage'] ?? '') ?>%</div>
                        </div>
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="documents-section">
                    <h3 class="section-heading">
                        <i class="bi bi-file-pdf"></i> Uploaded Documents
                    </h3>
                    <p style="color: var(--text-secondary); font-size: 13px; margin-bottom: 20px;">
                        Click on any document to view it in full size
                    </p>
                    <div class="document-grid">
                        <?php
                        $publicBase = rtrim(str_replace('index.php?url=', '', BASE_URL), '/');

                        function resolveDocumentUrl($path) {
                            global $publicBase;
                            $normalized = trim($path);
                            $normalized = preg_replace('#^/+|/+$#', '', $normalized);
                            $normalized = preg_replace('#^college/public/#', '', $normalized);
                            $normalized = preg_replace('#^public/#', '', $normalized);
                            return $publicBase . '/' . ltrim($normalized, '/');
                        }

                        function resolveDocumentFilePath($path) {
                            $normalized = trim($path);
                            $normalized = preg_replace('#^/+|/+$#', '', $normalized);
                            $normalized = preg_replace('#^college/public/#', '', $normalized);
                            $normalized = preg_replace('#^public/#', '', $normalized);
                            return __DIR__ . '/../../' . $normalized;
                        }

                        $documents = [
                            ['label' => 'Photo', 'field' => 'photo', 'icon' => 'image'],
                            ['label' => 'SSLC Marks', 'field' => 'sslc_marks_card', 'icon' => 'file-earmark-pdf'],
                            ['label' => 'PUC/Diploma Marks', 'field' => 'puc_marks_card', 'icon' => 'file-earmark-pdf'],
                            ['label' => 'Aadhar Card', 'field' => 'aadhar_card', 'icon' => 'id-card'],
                            ['label' => 'Candidate Signature', 'field' => 'candidate_signature', 'icon' => 'pen'],
                            ['label' => 'Parent Signature', 'field' => 'parent_signature', 'icon' => 'pen'],
                        ];

                        foreach ($documents as $doc):
                            $docValue = trim($admission[$doc['field']] ?? '');
                            $hasDoc = $docValue !== '';
                            $docPath = $hasDoc ? resolveDocumentUrl($docValue) : '';
                            $fileName = $hasDoc ? basename($docValue) : '';
                            $isPdf = $hasDoc && preg_match('/\.pdf$/i', $docValue);
                            $isImage = $hasDoc && preg_match('/\.(jpe?g|png|gif|webp)$/i', $docValue);
                            $uploadDate = '';
                            if ($hasDoc) {
                                $serverFile = resolveDocumentFilePath($docValue);
                                if (file_exists($serverFile)) {
                                    $uploadDate = date('d M Y, H:i', filemtime($serverFile));
                                } elseif (!empty($admission['updated_at'])) {
                                    $uploadDate = date('d M Y, H:i', strtotime($admission['updated_at']));
                                }
                            }
                        ?>
                            <div class="document-card" <?= $hasDoc ? 'onclick="viewDocument(\'' . htmlspecialchars($docPath) . '\', \'' . htmlspecialchars($doc['label']) . '\')" style="cursor: pointer;"' : '' ?>>
                                <div class="document-preview">
                                    <?php if ($hasDoc && $isPdf): ?>
                                        <div class="pdf-badge"><i class="bi bi-file-earmark-pdf-fill"></i></div>
                                    <?php elseif ($hasDoc && $isImage): ?>
                                        <img src="<?= htmlspecialchars($docPath) ?>" alt="<?= htmlspecialchars($doc['label']) ?>">
                                    <?php else: ?>
                                        <i class="bi bi-<?= $doc['icon'] ?>"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="document-info">
                                    <div class="document-meta-row">
                                        <div>
                                            <div class="document-name"><?= htmlspecialchars($doc['label']) ?></div>
                                            <?php if ($hasDoc): ?>
                                                <div class="document-file-name"><?= htmlspecialchars($fileName) ?></div>
                                                <?php if ($uploadDate): ?>
                                                    <div class="document-upload-date">Uploaded: <?= htmlspecialchars($uploadDate) ?></div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($hasDoc): ?>
                                            <div style="display:flex; gap: 0.5rem; align-items: center;">
                                                <button type="button" class="document-view-button" onclick="event.stopPropagation(); viewDocument('<?= htmlspecialchars($docPath) ?>', '<?= htmlspecialchars($doc['label']) ?>')">View</button>
                                                <a href="<?= htmlspecialchars($docPath) ?>" download="<?= htmlspecialchars($fileName) ?>" class="document-view-button" onclick="event.stopPropagation();" style="background: #2563eb;">Download</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="document-status">
                                        <?php if ($hasDoc): ?>
                                            <span class="status-icon success"><i class="bi bi-check"></i></span>
                                            <span>Uploaded</span>
                                        <?php else: ?>
                                            <span class="status-icon pending"><i class="bi bi-clock"></i></span>
                                            <span>Missing</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Side Approval Panel -->
            <div>
                <div class="approval-panel">
                    <h4 class="panel-title">
                        <i class="bi bi-check2-circle"></i> Admin Review
                    </h4>

                    <!-- Checklist -->
                    <div class="checklist">
                        <div class="checklist-item">
                            <input type="checkbox" id="check-personal" checked>
                            <label for="check-personal" style="margin-bottom: 0; cursor: pointer;">Personal info verified</label>
                        </div>
                        <div class="checklist-item">
                            <input type="checkbox" id="check-academic" checked>
                            <label for="check-academic" style="margin-bottom: 0; cursor: pointer;">Academic details verified</label>
                        </div>
                        <div class="checklist-item">
                            <input type="checkbox" id="check-documents" checked>
                            <label for="check-documents" style="margin-bottom: 0; cursor: pointer;">All documents received</label>
                        </div>
                        <div class="checklist-item">
                            <input type="checkbox" id="check-eligibility">
                            <label for="check-eligibility" style="margin-bottom: 0; cursor: pointer;">Student is eligible</label>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="notes-area">
                        <label class="notes-label">Admin Notes</label>
                        <textarea class="notes-textarea" id="approvalNotes" placeholder="Add any notes or observations..."></textarea>
                    </div>

                    <div class="notes-area">
                        <label class="notes-label">Fee Payment Window</label>
                        <div class="payment-schedule-row">
                            <?php
                                $paymentSchedule = isset($admission['admin_payment_schedule']) ? $admission['admin_payment_schedule'] : '';
                                $scheduleParts = $paymentSchedule !== '' ? explode(' to ', $paymentSchedule) : [];
                                $paymentStartValue = htmlspecialchars($scheduleParts[0] ?? '12');
                                $paymentEndValue = htmlspecialchars($scheduleParts[1] ?? '16');
                            ?>
                            <input type="text" id="paymentStart" class="notes-textarea" placeholder="From (e.g. 12)" value="<?= $paymentStartValue ?>">
                            <span style="display: inline-flex; align-items: center; margin: 0 8px; color: var(--text-secondary);">to</span>
                            <input type="text" id="paymentEnd" class="notes-textarea" placeholder="To (e.g. 16)" value="<?= $paymentEndValue ?>">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button type="button" class="btn-action btn-approve" id="approveBtn" onclick="handleApproval()">
                            <i class="bi bi-check-circle"></i> Approve
                        </button>
                        <button type="button" class="btn-action btn-reject" id="rejectBtn" onclick="handleRejection()">
                            <i class="bi bi-x-circle"></i> Reject
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Viewer Modal - Enhanced Full Page -->
    <div class="modal fade" id="documentModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-file-earmark-pdf"></i>
                        <span id="documentTitle"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" title="Close document viewer"></button>
                </div>
                <div class="modal-body">
                    <div class="document-viewer" id="documentViewer">
                        <div class="document-loading">
                            <div class="document-loading-spinner"></div>
                            <p style="color: var(--text-secondary); font-weight: 500;">Loading document...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Close
                    </button>
                    <a id="downloadDocLink" href="#" class="btn btn-primary" download>
                        <i class="bi bi-download"></i> Download
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div class="toast-container" id="toastContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const admissionId = <?= $admissionId ?>;
        const currentStatus = '<?= $admission['admin_approval_status'] ?? 'pending' ?>';

        // Disable buttons if already approved/rejected
        if (currentStatus !== 'pending') {
            document.getElementById('approveBtn').disabled = true;
            document.getElementById('rejectBtn').disabled = true;
        }

        // View Document with Enhanced Modal
        function viewDocument(documentPath, documentName) {
            console.log('Viewing document:', documentPath, documentName);
            const modal = new bootstrap.Modal(document.getElementById('documentModal'));
            const viewer = document.getElementById('documentViewer');
            const titleElement = document.getElementById('documentTitle');
            const downloadLink = document.getElementById('downloadDocLink');

            titleElement.textContent = documentName;
            downloadLink.href = documentPath;
            const sanitizedFileName = documentName.replace(/\.[^/.]+$/, '');
            downloadLink.download = sanitizedFileName + (documentPath.toLowerCase().includes('.pdf') ? '.pdf' : '');

            // Show loading spinner
            viewer.innerHTML = `
                <div class="document-loading">
                    <div class="document-loading-spinner"></div>
                    <p style="color: var(--text-secondary); font-weight: 500;">Loading document...</p>
                </div>
            `;

            // Simulate loading delay for better UX
            setTimeout(() => {
                if (!documentPath) {
                    console.error('Document path is empty for', documentName);
                    viewer.innerHTML = `<div style="color:#ef4444; padding:20px;">Unable to load document. File path is missing.</div>`;
                    return;
                }

                if (documentPath.toLowerCase().includes('.pdf')) {
                    viewer.innerHTML = `
                        <iframe 
                            src="${documentPath}#toolbar=0&navpanes=0&scrollbar=0" 
                            style="width: 100%; height: 100%; border: none; border-radius: 12px;"
                            title="Document Viewer">
                        </iframe>
                    `;
                } else {
                    viewer.innerHTML = `
                        <img 
                            src="${documentPath}" 
                            alt="${documentName}"
                            style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                        >
                    `;
                }

                const mediaElement = viewer.querySelector('img, iframe');
                if (mediaElement) {
                    mediaElement.addEventListener('error', () => {
                        console.error('Document failed to load:', documentPath);
                        viewer.innerHTML = `<div style="color:#ef4444; padding:20px;">Unable to load the document. It may be missing or inaccessible.</div>`;
                    });
                }
            }, 400);

            modal.show();
        }

        // Handle Approval with Enhanced Feedback
        function handleApproval() {
            if (!validateChecklist()) {
                showAdminToast('Please verify all items in the checklist', 'error');
                document.getElementById('check-eligibility').focus();
                return;
            }

            const notes = document.getElementById('approvalNotes').value;
            const approveBtn = document.getElementById('approveBtn');
            
            approveBtn.classList.add('loading');
            approveBtn.innerHTML = '<span class="spinner"></span> Processing Approval...';
            
            setTimeout(() => {
                submitDecision('approved', notes);
            }, 300);
        }

        // Handle Rejection with Enhanced Feedback
        function handleRejection() {
            const notes = document.getElementById('approvalNotes').value;
            if (!notes.trim()) {
                showAdminToast('Please provide rejection reason/notes', 'error');
                document.getElementById('approvalNotes').focus();
                return;
            }
            
            const rejectBtn = document.getElementById('rejectBtn');
            rejectBtn.classList.add('loading');
            rejectBtn.innerHTML = '<span class="spinner"></span> Processing Rejection...';
            
            setTimeout(() => {
                submitDecision('rejected', notes);
            }, 300);
        }

        // Validate Checklist
        function validateChecklist() {
            const checks = [
                document.getElementById('check-personal').checked,
                document.getElementById('check-academic').checked,
                document.getElementById('check-documents').checked,
                document.getElementById('check-eligibility').checked
            ];
            return checks.every(c => c === true);
        }

        // Submit Decision with Enhanced Error Handling
        function submitDecision(status, notes) {
            const approveBtn = document.getElementById('approveBtn');
            const rejectBtn = document.getElementById('rejectBtn');
            const originalApproveText = approveBtn.innerHTML;
            const originalRejectText = rejectBtn.innerHTML;

            // Send to server
            fetch('<?= BASE_URL ?>admin-admission-decision', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    admission_id: admissionId,
                    decision: status,

                    notes: notes,
                    payment_start: document.getElementById('paymentStart')?.value || '',
                    payment_end: document.getElementById('paymentEnd')?.value || ''
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showAdminToast(data.message, 'success');
                    // Add success animation
                    const panel = document.querySelector('.approval-panel');
                    panel.style.animation = 'fadeOut 0.5s ease-out 1s forwards';
                    
                    setTimeout(() => {
                        window.location.href = '<?= BASE_URL ?>admin-admissions&msg=' + (status === 'approved' ? 'approved_success' : 'rejected_success');
                    }, 1500);
                } else {
                    showAdminToast(data.message || 'An error occurred', 'error');
                    restoreButtons();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAdminToast('Network error. Please try again.', 'error');
                restoreButtons();
            });

            function restoreButtons() {
                approveBtn.classList.remove('loading');
                rejectBtn.classList.remove('loading');
                approveBtn.disabled = false;
                rejectBtn.disabled = false;
                approveBtn.innerHTML = originalApproveText;
                rejectBtn.innerHTML = originalRejectText;
            }
        }

        // Show Toast Notification with Enhanced Styling
        function showAdminToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            
            const icon = type === 'success' ? 'check-circle-fill' : 
                        type === 'warning' ? 'exclamation-triangle-fill' : 'exclamation-circle-fill';
            
            toast.innerHTML = `
                <i class="bi bi-${icon}"></i>
                <span>${message}</span>
                <button onclick="this.parentElement.remove()" style="background: none; border: none; color: inherit; cursor: pointer; font-size: 16px; padding: 0; margin-left: auto;">
                    <i class="bi bi-x"></i>
                </button>
            `;
            
            container.appendChild(toast);

            // Auto-remove after 4 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.animation = 'slideOutUp 0.4s ease-out forwards';
                    setTimeout(() => toast.remove(), 400);
                }
            }, 4000);
        }

        // Support both old and new toast function names
        const showToast = showAdminToast;
    </script>
</body>
</html>
