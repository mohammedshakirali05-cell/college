<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nehru BBA & BCA College - Payment Challan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1d3f7a 0%, #22c3e3 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .challan-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header-section {
            background: white;
            padding: 28px 30px;
            border-radius: 16px 16px 0 0;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.12);
            text-align: center;
            margin-bottom: 0;
            border-left: 6px solid #22c3e3;
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(34, 197, 94, 0.14), transparent 30%);
            pointer-events: none;
            opacity: 0.6;
        }

        .header-section::after {
            content: '';
            position: absolute;
            top: -40px;
            right: -60px;
            width: 180px;
            height: 180px;
            background: rgba(59, 130, 246, 0.14);
            border-radius: 50%;
            filter: blur(24px);
            pointer-events: none;
        }

        .header-section h1 {
            position: relative;
            font-size: 28px;
            color: #1d3f7a;
            margin-bottom: 8px;
            font-weight: 700;
            z-index: 1;
        }

        .header-section p {
            font-size: 14px;
            color: #666;
            margin: 4px 0;
        }

        .student-info {
            background: linear-gradient(135deg, #f0f9ff 0%, #f0fdff 100%);
            padding: 18px 25px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            border-bottom: 2px solid #e9ecef;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 11px;
            color: #1d3f7a;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 15px;
            color: #222;
            font-weight: 600;
        }

        .print-controls {
            background: rgba(255, 255, 255, 0.95);
            padding: 18px 25px;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            border-bottom: 2px solid #e9ecef;
            align-items: center;
            box-shadow: 0 26px 80px rgba(15, 23, 42, 0.08);
            border-radius: 0 0 18px 18px;
            position: relative;
            overflow: hidden;
        }

        .print-controls::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.08), transparent 32%);
            pointer-events: none;
        }

        .status-card {
            flex: 1 1 320px;
            background: linear-gradient(135deg, #eff8ff 0%, #e0f2fe 100%);
            border: 1px solid rgba(37, 99, 235, 0.16);
            border-radius: 18px;
            padding: 18px 20px;
            color: #0f172a;
            position: relative;
            z-index: 1;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .status-card::after {
            content: '';
            position: absolute;
            right: -40px;
            top: -20px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(37, 99, 235, 0.12);
            filter: blur(18px);
            pointer-events: none;
        }

        .status-card::before {
            content: '';
            position: absolute;
            left: -20px;
            bottom: -20px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.12);
            filter: blur(16px);
            pointer-events: none;
        }

        .status-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .status-subtitle {
            font-size: 13px;
            color: #475569;
            line-height: 1.55;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex: 0 0 auto;
            gap: 10px;
            position: relative;
            z-index: 1;
        }

        .print-btn {
            padding: 10px 18px;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
        }

        .btn-bank-copy {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border: 2px solid transparent;
        }

        .btn-bank-copy:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
        }

        .btn-college-copy {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: 2px solid transparent;
        }

        .btn-college-copy:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(5, 150, 105, 0.35);
        }

        .btn-candidate-copy {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            border: 2px solid transparent;
        }

        .btn-candidate-copy:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(217, 119, 6, 0.35);
        }

        .btn-print-all {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            margin-left: auto;
            border: 2px solid transparent;
        }

        .btn-print-all:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(124, 58, 237, 0.35);
        }

        .challan-forms {
            display: block;
            opacity: 0;
            transform: translateY(10px);
            animation: fadeIn 0.55s ease forwards;
        }

        .challan-page {
            background: white;
            padding: 22px;
            margin-bottom: 16px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12);
            page-break-after: auto;
            page-break-inside: avoid;
            border: 1px solid rgba(148, 163, 184, 0.25);
            border-radius: 18px;
            overflow: hidden;
            position: relative;
        }

        .challan-page::before {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: radial-gradient(circle at top left, rgba(34, 197, 94, 0.12), transparent 32%), radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.12), transparent 28%);
        }

        .challan-page:last-of-type {
            margin-bottom: 0;
        }

        .challan-sheet {
            display: grid;
            gap: 18px;
            margin-top: 20px;
        }

        .challan-forms {
            opacity: 1;
        }

        .challan-page.last {
            margin-bottom: 0;
        }

        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 2px solid #1d3f7a;
        }

        .page-type {
            display: inline-block;
            padding: 6px 12px;
            background: #e0e7ff;
            color: #3730a3;
            border-radius: 4px;
            font-weight: 600;
            font-size: 12px;
        }

        .page-type.bank {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
        }

        .page-type.college {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
        }

        .page-type.candidate {
            background: linear-gradient(135deg, #fed7aa 0%, #fecda6 100%);
            color: #92400e;
        }

        .college-header {
            text-align: center;
            margin-bottom: 16px;
        }

        .college-header p {
            font-size: 12px;
            margin: 2px 0;
            color: #666;
        }

        .college-header h2 {
            font-size: 24px;
            font-weight: 700;
            margin: 4px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1d3f7a;
        }

        .college-header .address {
            font-size: 12px;
            font-weight: 500;
            color: #555;
            margin-top: 3px;
        }

        .account-info {
            display: flex;
            justify-content: space-between;
            margin: 12px 0;
            font-weight: 600;
            font-size: 12px;
        }

        .form-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 8px 0;
            flex-wrap: wrap;
        }

        .form-row label {
            min-width: 120px;
            font-size: 12px;
            font-weight: 600;
            color: #333;
        }

        .form-input {
            border: none;
            border-bottom: 1px solid #333;
            outline: none;
            background: transparent;
            padding: 3px 4px;
            font-size: 12px;
            font-family: inherit;
            flex: 1;
            min-width: 120px;
        }

        .form-input.full-width {
            width: 100%;
            min-width: 100%;
        }

        .notes-table {
            width: 280px;
            border-collapse: collapse;
            margin: 10px 0;
        }

        .notes-table th,
        .notes-table td {
            border: 1px solid #333;
            padding: 4px;
            text-align: center;
            font-size: 11px;
            height: 28px;
        }

        .notes-table th {
            background: #f3f4f6;
            font-weight: 700;
        }

        .notes-table input {
            width: 100%;
            border: none;
            outline: none;
            text-align: center;
            background: transparent;
            font-size: 11px;
        }

        .grid-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 16px;
            margin: 12px 0;
        }

        .fees-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        .fees-table th,
        .fees-table td {
            border: 1px solid #333;
            padding: 4px;
            font-size: 11px;
            text-align: center;
        }

        .fees-table th {
            background: #f3f4f6;
            font-weight: 700;
        }

        .fees-table td.particular {
            text-align: left;
            padding-left: 8px;
        }

        .fees-table input {
            width: 100%;
            border: none;
            outline: none;
            text-align: center;
            background: transparent;
            padding: 2px 3px;
            font-size: 11px;
        }

        .signature-line {
            display: inline-block;
            min-width: 150px;
            border-bottom: 1px solid #333;
            height: 14px;
            vertical-align: middle;
        }

        .signature-section {
            text-align: right;
            margin: 10px 0;
            font-size: 11px;
        }

        .seal-box {
            width: 100%;
            height: 70px;
            border: 1px solid #333;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
            text-align: center;
            padding: 8px;
            margin: 12px 0;
        }

        .footer-sign {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 600;
            margin-top: 12px;
        }

        .section-divider {
            border-top: 2px solid #333;
            margin: 16px 0;
        }

        .notice {
            font-size: 12px;
            margin: 6px 0;
            font-weight: 500;
            color: #333;
        }

        .candidate-dash {
            color: #999;
            float: right;
            font-size: 12px;
        }

        .no-print {
            display: block;
        }

        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .challan-container {
                max-width: 100%;
                margin: 0;
            }

            .header-section,
            .student-info,
            .print-controls {
                display: none !important;
            }

            .challan-page {
                box-shadow: none;
                page-break-inside: avoid;
                break-inside: avoid;
                padding: 6mm 8mm;
                margin: 2mm 0;
                border: 1px solid #bbb;
                border-radius: 0;
                font-size: 9px;
                min-height: 90mm;
                max-height: 90mm;
                overflow: hidden;
            }

            .challan-sheet {
                gap: 2mm;
            }

            .challan-page .page-title {
                margin-bottom: 8px;
            }

            .challan-page .college-header h2 {
                font-size: 16px;
            }

            .challan-page .form-row {
                gap: 4px;
                margin: 5px 0;
            }

            .challan-page .form-row label,
            .challan-page .form-input,
            .challan-page .notes-table th,
            .challan-page .notes-table td,
            .challan-page .fees-table th,
            .challan-page .fees-table td,
            .challan-page .signature-section,
            .challan-page .notice,
            .challan-page .footer-sign {
                font-size: 9px;
                line-height: 1.2;
            }

            .challan-page .notes-table th,
            .challan-page .notes-table td,
            .challan-page .fees-table th,
            .challan-page .fees-table td {
                padding: 3px;
            }

            .challan-page .seal-box {
                height: 55px;
            }

            .challan-forms {
                display: block !important;
            }

            .no-print {
                display: none !important;
            }

            @page {
                size: A4;
                margin: 10mm;
            }
        }

        @media (max-width: 768px) {
            .challan-page {
                padding: 16px;
            }

            .college-header h2 {
                font-size: 18px;
            }

            .grid-layout {
                grid-template-columns: 1fr;
            }

            .print-controls {
                flex-direction: column;
            }

            .btn-print-all {
                margin-left: 0;
                width: 100%;
            }

            .form-row label {
                min-width: 100%;
            }
        }

        .tab-buttons {
            display: flex;
            gap: 6px;
            margin-bottom: 0;
            flex-wrap: wrap;
        }

        .tab-btn {
            padding: 8px 14px;
            border: 2px solid #e9ecef;
            background: white;
            color: #666;
            cursor: pointer;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background: #22c3e3;
            color: white;
            border-color: #22c3e3;
        }

        .tab-btn:hover {
            border-color: #22c3e3;
            color: #22c3e3;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
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

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .info-item {
            animation: slideInRight 0.5s ease forwards;
        }

        .info-item:nth-child(1) { animation-delay: 0.1s; }
        .info-item:nth-child(2) { animation-delay: 0.2s; }
        .info-item:nth-child(3) { animation-delay: 0.3s; }
        .info-item:nth-child(4) { animation-delay: 0.4s; }
        .info-item:nth-child(5) { animation-delay: 0.5s; }
        .info-item:nth-child(6) { animation-delay: 0.6s; }
        .info-item:nth-child(7) { animation-delay: 0.7s; }

        .print-btn {
            animation: fadeIn 0.3s ease;
        }

        .print-btn:active {
            transform: scale(0.95);
        }

        .header-section {
            animation: slideInRight 0.5s ease;
        }

        .student-info {
            animation: fadeIn 0.6s ease;
        }

        .print-controls {
            animation: fadeIn 0.7s ease;
        }

        .challan-page {
            animation: fadeIn 0.4s ease;
        }

        .installment-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div class="challan-container">
        <!-- Header -->
        <div class="header-section">
            <h1>Payment Challan Confirmation</h1>
            <p>Nehru BBA & BCA College, Ghantikeri, Hubli</p>
            <?php if (!empty($challanData['installment_label'])): ?>
                <div style="margin-top: 12px;">
                    <span class="installment-badge"><?php echo htmlspecialchars($challanData['installment_label']); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Student Info Display -->
        <div class="student-info">
            <div class="info-item">
                <div class="info-label">Challan Number</div>
                <div class="info-value" id="display-challan"><?php echo htmlspecialchars($challanData['challan_no']); ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Student Name</div>
                <div class="info-value" id="display-name"><?php echo htmlspecialchars($challanData['student_name']); ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Admission Number</div>
                <div class="info-value" id="display-admission"><?php echo htmlspecialchars($challanData['admission_number']); ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Class</div>
                <div class="info-value" id="display-class"><?php echo htmlspecialchars($challanData['class']); ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Amount</div>
                <div class="info-value" id="display-amount">₹ <?php echo ChallanHelper::formatCurrency($challanData['amount_figures']); ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Date</div>
                <div class="info-value" id="display-date"><?php echo htmlspecialchars($challanData['date']); ?></div>
            </div>
        </div>

        <!-- Print Controls -->
        <div class="print-controls">
            <div class="status-card">
                <div class="status-title">3 Challan copies ready</div>
                <div class="status-subtitle">All copies are optimized to print together on a single A4 sheet in one pass.</div>
            </div>
            <div class="action-buttons">
                <button class="print-btn btn-print-all" onclick="printAllChallan()">🖨️ Print All Copies</button>
            </div>
        </div>

        <!-- Challan Forms -->
        <div class="challan-sheet">
            <div class="challan-forms" id="bank-form">
                <?php include __DIR__ . '/challan-forms/bank-copy.php'; ?>
            </div>

            <div class="challan-forms" id="college-form">
                <?php include __DIR__ . '/challan-forms/college-copy.php'; ?>
            </div>

            <div class="challan-forms" id="candidate-form">
                <?php include __DIR__ . '/challan-forms/candidate-copy.php'; ?>
            </div>
        </div>
    </div>

    <script>
        // Initialize challan data
        const challanData = {
            challan_no: '<?php echo htmlspecialchars($challanData['challan_no']); ?>',
            student_name: '<?php echo htmlspecialchars($challanData['student_name']); ?>',
            admission_number: '<?php echo htmlspecialchars($challanData['admission_number']); ?>',
            course: '<?php echo htmlspecialchars($challanData['program'] ?? 'BBA'); ?>',
            program: '<?php echo htmlspecialchars($challanData['program'] ?? 'BBA'); ?>',
            academic_year: '<?php echo htmlspecialchars($challanData['academic_year']); ?>',
            amount_figures: <?php echo (float)$challanData['amount_figures']; ?>,
            amount_words: '<?php echo htmlspecialchars($challanData['amount_words']); ?>',
            date: '<?php echo htmlspecialchars($challanData['date']); ?>',
            class: '<?php echo htmlspecialchars($challanData['class'] ?? 'BBA'); ?>'
        };

        // Populate all forms with challan data
        function populateForms() {
            // Bank Copy - auto-populate program from fees
            populateForm('bank', [
                { selector: '[name="challan_no"]', value: challanData.challan_no },
                { selector: '[name="date"]', value: challanData.date },
                { selector: '[name="student_name"]', value: challanData.student_name },
                { selector: '[name="program"]', value: challanData.program },
                { selector: '[name="rupees_figures"]', value: '₹ ' + challanData.amount_figures },
                { selector: '[name="rupees_words"]', value: challanData.amount_words }
            ]);

            // College Copy - auto-populate program from fees
            populateForm('college', [
                { selector: '[name="challan_no"]', value: challanData.challan_no },
                { selector: '[name="date"]', value: challanData.date },
                { selector: '[name="student_name"]', value: challanData.student_name },
                { selector: '[name="class"]', value: challanData.class },
                { selector: '[name="program"]', value: challanData.program },
                { selector: '[name="rupees_figures"]', value: '₹ ' + challanData.amount_figures },
                { selector: '[name="rupees_words"]', value: challanData.amount_words }
            ]);

            // Candidate Copy - auto-populate program from fees
            populateForm('candidate', [
                { selector: '[name="challan_no"]', value: challanData.challan_no },
                { selector: '[name="date"]', value: challanData.date },
                { selector: '[name="student_name"]', value: challanData.student_name },
                { selector: '[name="class"]', value: challanData.class },
                { selector: '[name="program"]', value: challanData.program },
                { selector: '[name="rupees_figures"]', value: '₹ ' + challanData.amount_figures },
                { selector: '[name="rupees_words"]', value: challanData.amount_words }
            ]);
        }

        function populateForm(formId, fields) {
            const form = document.getElementById(formId + '-form');
            if (!form) return;

            fields.forEach(field => {
                const elements = form.querySelectorAll(field.selector);
                elements.forEach(el => {
                    if (el.tagName === 'INPUT') {
                        el.value = field.value;
                    }
                });
            });
        }

        // Switch between forms
        function switchForm(formType) {
            // Hide all forms
            document.querySelectorAll('.challan-forms').forEach(form => {
                form.classList.remove('active');
            });

            // Show selected form
            document.getElementById(formType + '-form').classList.add('active');

            // Update buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Update print button visibility
            document.getElementById('btn-print-bank').style.display = formType === 'bank' ? 'flex' : 'none';
            document.getElementById('btn-print-college').style.display = formType === 'college' ? 'flex' : 'none';
            document.getElementById('btn-print-candidate').style.display = formType === 'candidate' ? 'flex' : 'none';
        }

        // Print individual form
        function printForm(formType) {
            // Create a new window for printing
            const printWindow = window.open('', '', 'height=600,width=800');
            const formElement = document.getElementById(formType + '-form').innerHTML;
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Print ${formType.charAt(0).toUpperCase() + formType.slice(1)} Copy</title>
                    <style>
                        * {
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                        }
                        body {
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                            background: white;
                        }
                        .challan-page {
                            padding: 15mm;
                            page-break-after: always;
                        }
                        .form-row {
                            display: flex;
                            align-items: center;
                            gap: 8px;
                            margin: 8px 0;
                            flex-wrap: wrap;
                        }
                        .form-row label {
                            min-width: 120px;
                            font-size: 12px;
                            font-weight: 600;
                            color: #333;
                        }
                        .form-input {
                            border: none;
                            border-bottom: 1px solid #333;
                            outline: none;
                            background: transparent;
                            padding: 3px 4px;
                            font-size: 12px;
                            font-family: inherit;
                            flex: 1;
                            min-width: 120px;
                        }
                        .form-input.full-width {
                            width: 100%;
                            min-width: 100%;
                        }
                        .page-title {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            margin-bottom: 18px;
                            padding-bottom: 10px;
                            border-bottom: 2px solid #1d3f7a;
                        }
                        .page-type {
                            display: inline-block;
                            padding: 6px 12px;
                            background: #e0e7ff;
                            color: #3730a3;
                            border-radius: 4px;
                            font-weight: 600;
                            font-size: 12px;
                        }
                        .page-type.bank {
                            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
                            color: #1e40af;
                        }
                        .page-type.college {
                            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
                            color: #166534;
                        }
                        .page-type.candidate {
                            background: linear-gradient(135deg, #fed7aa 0%, #fecda6 100%);
                            color: #92400e;
                        }
                        .college-header {
                            text-align: center;
                            margin-bottom: 16px;
                        }
                        .college-header p {
                            font-size: 12px;
                            margin: 2px 0;
                            color: #666;
                        }
                        .college-header h2 {
                            font-size: 24px;
                            font-weight: 700;
                            margin: 4px 0;
                            text-transform: uppercase;
                            letter-spacing: 0.5px;
                            color: #1d3f7a;
                        }
                        .college-header .address {
                            font-size: 12px;
                            font-weight: 500;
                            color: #555;
                            margin-top: 3px;
                        }
                        .account-info {
                            display: flex;
                            justify-content: space-between;
                            margin: 12px 0;
                            font-weight: 600;
                            font-size: 12px;
                        }
                        .notes-table, .fees-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin: 10px 0;
                        }
                        .notes-table th, .notes-table td,
                        .fees-table th, .fees-table td {
                            border: 1px solid #333;
                            padding: 4px;
                            text-align: center;
                            font-size: 11px;
                        }
                        .notes-table th, .fees-table th {
                            background: #f3f4f6;
                            font-weight: 700;
                        }
                        .fees-table td.particular {
                            text-align: left;
                            padding-left: 8px;
                        }
                        .notes-table input, .fees-table input {
                            width: 100%;
                            border: none;
                            outline: none;
                            text-align: center;
                            background: transparent;
                            padding: 2px 3px;
                            font-size: 11px;
                        }
                        .grid-layout {
                            display: grid;
                            grid-template-columns: 280px 1fr;
                            gap: 16px;
                            margin: 12px 0;
                        }
                        .signature-section {
                            text-align: right;
                            margin: 10px 0;
                            font-size: 11px;
                        }
                        .signature-line {
                            display: inline-block;
                            min-width: 150px;
                            border-bottom: 1px solid #333;
                            height: 14px;
                            vertical-align: middle;
                        }
                        .seal-box {
                            width: 100%;
                            height: 70px;
                            border: 1px solid #333;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-weight: 700;
                            font-size: 12px;
                            text-align: center;
                            padding: 8px;
                            margin: 12px 0;
                        }
                        .footer-sign {
                            display: flex;
                            justify-content: space-between;
                            font-size: 12px;
                            font-weight: 600;
                            margin-top: 12px;
                        }
                        .section-divider {
                            border-top: 2px solid #333;
                            margin: 16px 0;
                        }
                        .notice {
                            font-size: 12px;
                            margin: 6px 0;
                            font-weight: 500;
                            color: #333;
                        }
                        .candidate-dash {
                            color: #999;
                            float: right;
                            font-size: 12px;
                        }
                        .slno {
                            text-align: center;
                        }
                        .particular {
                            text-align: left;
                            padding-left: 8px;
                        }
                        @page {
                            size: A4;
                            margin: 10mm;
                        }
                    </style>
                </head>
                <body>
                    ${formElement}
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        }

        // Print all three forms
        function printAllChallan() {
            // Create a new window for printing
            const printWindow = window.open('', '', 'height=600,width=800');
            
            const bankForm = document.getElementById('bank-form').innerHTML;
            const collegeForm = document.getElementById('college-form').innerHTML;
            const candidateForm = document.getElementById('candidate-form').innerHTML;
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Print All Challan Copies</title>
                    <style>
                        * {
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                        }
                        body {
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                            background: white;
                        }
                        .challan-page {
                            padding: 15mm;
                            page-break-after: always;
                            page-break-inside: avoid;
                        }
                        .challan-page.last {
                            page-break-after: auto;
                        }
                        .form-row {
                            display: flex;
                            align-items: center;
                            gap: 8px;
                            margin: 8px 0;
                            flex-wrap: wrap;
                        }
                        .form-row label {
                            min-width: 120px;
                            font-size: 12px;
                            font-weight: 600;
                            color: #333;
                        }
                        .form-input {
                            border: none;
                            border-bottom: 1px solid #333;
                            outline: none;
                            background: transparent;
                            padding: 3px 4px;
                            font-size: 12px;
                            font-family: inherit;
                            flex: 1;
                            min-width: 120px;
                        }
                        .form-input.full-width {
                            width: 100%;
                            min-width: 100%;
                        }
                        .page-title {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            margin-bottom: 18px;
                            padding-bottom: 10px;
                            border-bottom: 2px solid #1d3f7a;
                        }
                        .page-type {
                            display: inline-block;
                            padding: 6px 12px;
                            background: #e0e7ff;
                            color: #3730a3;
                            border-radius: 4px;
                            font-weight: 600;
                            font-size: 12px;
                        }
                        .page-type.bank {
                            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
                            color: #1e40af;
                        }
                        .page-type.college {
                            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
                            color: #166534;
                        }
                        .page-type.candidate {
                            background: linear-gradient(135deg, #fed7aa 0%, #fecda6 100%);
                            color: #92400e;
                        }
                        .college-header {
                            text-align: center;
                            margin-bottom: 16px;
                        }
                        .college-header p {
                            font-size: 12px;
                            margin: 2px 0;
                            color: #666;
                        }
                        .college-header h2 {
                            font-size: 24px;
                            font-weight: 700;
                            margin: 4px 0;
                            text-transform: uppercase;
                            letter-spacing: 0.5px;
                            color: #1d3f7a;
                        }
                        .college-header .address {
                            font-size: 12px;
                            font-weight: 500;
                            color: #555;
                            margin-top: 3px;
                        }
                        .account-info {
                            display: flex;
                            justify-content: space-between;
                            margin: 12px 0;
                            font-weight: 600;
                            font-size: 12px;
                        }
                        .notes-table, .fees-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin: 10px 0;
                        }
                        .notes-table th, .notes-table td,
                        .fees-table th, .fees-table td {
                            border: 1px solid #333;
                            padding: 4px;
                            text-align: center;
                            font-size: 11px;
                        }
                        .notes-table th, .fees-table th {
                            background: #f3f4f6;
                            font-weight: 700;
                        }
                        .fees-table td.particular {
                            text-align: left;
                            padding-left: 8px;
                        }
                        .notes-table input, .fees-table input {
                            width: 100%;
                            border: none;
                            outline: none;
                            text-align: center;
                            background: transparent;
                            padding: 2px 3px;
                            font-size: 11px;
                        }
                        .grid-layout {
                            display: grid;
                            grid-template-columns: 280px 1fr;
                            gap: 16px;
                            margin: 12px 0;
                        }
                        .signature-section {
                            text-align: right;
                            margin: 10px 0;
                            font-size: 11px;
                        }
                        .signature-line {
                            display: inline-block;
                            min-width: 150px;
                            border-bottom: 1px solid #333;
                            height: 14px;
                            vertical-align: middle;
                        }
                        .seal-box {
                            width: 100%;
                            height: 70px;
                            border: 1px solid #333;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-weight: 700;
                            font-size: 12px;
                            text-align: center;
                            padding: 8px;
                            margin: 12px 0;
                        }
                        .footer-sign {
                            display: flex;
                            justify-content: space-between;
                            font-size: 12px;
                            font-weight: 600;
                            margin-top: 12px;
                        }
                        .section-divider {
                            border-top: 2px solid #333;
                            margin: 16px 0;
                        }
                        .notice {
                            font-size: 12px;
                            margin: 6px 0;
                            font-weight: 500;
                            color: #333;
                        }
                        .candidate-dash {
                            color: #999;
                            float: right;
                            font-size: 12px;
                        }
                        .slno {
                            text-align: center;
                        }
                        .particular {
                            text-align: left;
                            padding-left: 8px;
                        }
                        @page {
                            size: A4;
                            margin: 10mm;
                        }
                    </style>
                </head>
                <body>
                    ${bankForm}
                    ${collegeForm}
                    ${candidateForm}
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        }

        // Copy to clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Challan number copied to clipboard!');
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            populateForms();
            document.getElementById('bank-form').classList.add('active');
        });
    </script>
</body>
</html>
