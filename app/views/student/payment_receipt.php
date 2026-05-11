<?php
/**
 * Payment Receipt View
 * Shows detailed receipt for successful installment payment
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt - College CMS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #1d3f7a;
            --secondary-blue: #2d5aa8;
            --accent-cyan: #22c3e3;
            --success-green: #10b981;
            --warning-orange: #f59e0b;
            --danger-red: #ef4444;
            --light-gray: #f3f4f6;
            --text-dark: #1f2937;
            --text-light: #6b7280;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, var(--success-green) 0%, #059669 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .header-icon {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .content {
            padding: 40px;
        }

        .success-badge {
            display: inline-block;
            background: var(--success-green);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            margin-left: 0;
        }

        .receipt-number {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid #e5e7eb;
        }

        .section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            color: var(--text-light);
            font-weight: bold;
            margin-bottom: 15px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--text-light);
            font-weight: 600;
        }

        .info-value {
            color: var(--text-dark);
            font-weight: bold;
        }

        .highlight {
            background: linear-gradient(135deg, #fef3c7 0%, #fce7f3 100%);
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .highlight-title {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .amount-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--success-green);
            text-align: center;
        }

        .installation-summary {
            background: var(--light-gray);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 0.95rem;
        }

        .summary-row.total {
            border-top: 2px solid #e5e7eb;
            padding-top: 12px;
            margin-top: 12px;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #e5e7eb;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(29, 63, 122, 0.3);
        }

        .btn-secondary {
            background: var(--light-gray);
            color: var(--text-dark);
            border: 2px solid var(--primary-blue);
        }

        .btn-secondary:hover {
            background: var(--primary-blue);
            color: white;
        }

        .next-installment {
            background: linear-gradient(135deg, #ede9fe 0%, #f3e8ff 100%);
            border-left: 4px solid var(--warning-orange);
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .next-installment-title {
            font-weight: bold;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .next-installment-details {
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .progress-indicator {
            display: flex;
            gap: 8px;
            margin-top: 20px;
            align-items: center;
        }

        .progress-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #e5e7eb;
        }

        .progress-dot.completed {
            background: var(--success-green);
        }

        .progress-dot.current {
            background: var(--accent-cyan);
            width: 14px;
            height: 14px;
        }

        @media print {
            body {
                background: white;
            }

            .action-buttons {
                display: none;
            }

            .container {
                box-shadow: none;
                border-radius: 0;
            }
        }

        @media (max-width: 600px) {
            .content {
                padding: 20px;
            }

            .amount-display {
                font-size: 2rem;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-icon">✅</div>
            <h1>Payment Successful!</h1>
        </div>

        <div class="content">
            <div class="success-badge">✓ Payment Received</div>
            <div class="receipt-number">
                Receipt ID: <?php echo 'RCP' . date('YmdHis'); ?>
            </div>

            <!-- Payment Summary -->
            <div class="highlight">
                <div class="highlight-title">Amount Paid</div>
                <div class="amount-display">
                    ₹<?php echo number_format($receipt['installment_amount'], 2); ?>
                </div>
            </div>

            <!-- Student Information -->
            <div class="section">
                <div class="section-title">Student Information</div>
                <div class="info-row">
                    <span class="info-label">Student Name:</span>
                    <span class="info-value"><?php echo htmlspecialchars($receipt['student_name']); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Student ID:</span>
                    <span class="info-value"><?php echo htmlspecialchars($receipt['student_id']); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Challan No:</span>
                    <span class="info-value"><?php echo htmlspecialchars($receipt['challan_no']); ?></span>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="section">
                <div class="section-title">Payment Details</div>
                <div class="info-row">
                    <span class="info-label">Installment Number:</span>
                    <span class="info-value"><?php echo $receipt['installment_number']; ?> of 5</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Amount:</span>
                    <span class="info-value">₹<?php echo number_format($receipt['installment_amount'], 2); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Payment Method:</span>
                    <span class="info-value"><?php echo ucfirst(str_replace('_', ' ', $receipt['payment_method'])); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Transaction ID:</span>
                    <span class="info-value"><?php echo htmlspecialchars($receipt['transaction_id']); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Payment Date:</span>
                    <span class="info-value"><?php echo date('d M Y, h:i A', strtotime($receipt['payment_date'])); ?></span>
                </div>
            </div>

            <!-- Fees Progress -->
            <div class="section">
                <div class="section-title">Your Fees Progress</div>
                <div class="installation-summary">
                    <div class="summary-row">
                        <span>Total Fees:</span>
                        <span>₹<?php echo number_format($receipt['finalized_fees'], 2); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Amount Paid:</span>
                        <span>₹<?php echo number_format($receipt['total_paid'], 2); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Remaining Balance:</span>
                        <span>₹<?php echo number_format($receipt['finalized_fees'] - $receipt['total_paid'], 2); ?></span>
                    </div>
                    <div class="summary-row total">
                        <span>Completion:</span>
                        <span><?php echo round(($receipt['total_paid'] / $receipt['finalized_fees']) * 100, 1); ?>%</span>
                    </div>
                </div>

                <!-- Progress Indicator -->
                <div class="progress-indicator">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <div class="progress-dot <?php echo $i <= $receipt['paid_count'] ? 'completed' : ($i == $receipt['paid_count'] + 1 ? 'current' : ''); ?>"></div>
                    <?php endfor; ?>
                    <span style="margin-left: 10px; color: var(--text-light); font-size: 0.9rem;">
                        <?php echo $receipt['paid_count']; ?> of 5 Paid
                    </span>
                </div>
            </div>

            <!-- Next Installment Information -->
            <?php if ($receipt['paid_count'] < 5): ?>
                <div class="next-installment">
                    <div class="next-installment-title">📅 Next Installment</div>
                    <div class="next-installment-details">
                        <strong>Installment <?php echo $receipt['paid_count'] + 1; ?></strong> will be due soon.
                        Check your dashboard for details on the next payment due date and amount.
                    </div>
                </div>
            <?php else: ?>
                <div style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-left: 4px solid var(--success-green); padding: 15px; border-radius: 6px;">
                    <strong style="color: var(--success-green);">✓ All Installments Paid!</strong>
                    <p style="color: var(--text-light); font-size: 0.9rem; margin-top: 5px;">You have successfully completed all installment payments.</p>
                </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn btn-secondary" onclick="window.print()">
                    🖨️ Print Receipt
                </button>
                <a href="<?php echo BASE_URL; ?>my-fees" class="btn btn-primary">
                    ← Back to My Fees
                </a>
            </div>
        </div>
    </div>

    <script>
        // Auto-redirect after 5 seconds if on success page
        // Commented out to allow user to see receipt first
        // setTimeout(() => {
        //     window.location.href = '<?php echo BASE_URL; ?>my-fees';
        // }, 5000);
    </script>
</body>
</html>
