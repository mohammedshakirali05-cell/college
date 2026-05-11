<?php
/**
 * Installments Tab Component
 * Displays installment breakdown with payment tracking and recording
 */
?>

<div class="installments-container" id="installmentsContainer">
    <style>
        .installments-wrapper {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 30px;
            border-radius: 15px;
            margin-top: 30px;
            animation: slideInUp 0.5s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .installments-title {
            font-size: 24px;
            font-weight: 700;
            color: #1d3f7a;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .installments-title::before {
            content: "💳";
            font-size: 28px;
        }

        .installments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .installment-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-left: 5px solid #22c3e3;
            position: relative;
            overflow: hidden;
        }

        .installment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .installment-card.paid {
            border-left-color: #28a745;
            background: linear-gradient(135deg, #f0fff4 0%, #e8f5e9 100%);
        }

        .installment-card.pending {
            border-left-color: #ffc107;
            background: linear-gradient(135deg, #fffbf0 0%, #fff8e1 100%);
        }

        .installment-number {
            font-size: 12px;
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .installment-amount {
            font-size: 28px;
            font-weight: 700;
            color: #1d3f7a;
            margin: 12px 0;
        }

        .installment-status {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }

        .installment-status.paid {
            background: #d4edda;
            color: #155724;
        }

        .installment-status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .installment-date {
            font-size: 12px;
            color: #999;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .installment-date::before {
            content: "📅";
        }

        .installment-actions {
            margin-top: 15px;
            display: flex;
            gap: 8px;
        }

        .btn-pay {
            flex: 1;
            padding: 10px 16px;
            background: linear-gradient(135deg, #22c3e3 0%, #1d9fb8 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
        }

        .btn-pay:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(34, 195, 227, 0.4);
        }

        .btn-pay:disabled {
            background: linear-gradient(135deg, #e0e0e0 0%, #bdbdbd 100%);
            cursor: not-allowed;
            opacity: 0.7;
        }

        .btn-challan {
            flex: 1;
            padding: 10px 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
        }

        .btn-challan:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
        }

        .summary-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .summary-item {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .summary-label {
            font-size: 12px;
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .summary-value {
            font-size: 24px;
            font-weight: 700;
            color: #1d3f7a;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #22c3e3 0%, #00d4ff 100%);
            transition: width 0.5s ease;
            border-radius: 4px;
        }

        .payment-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .payment-modal.active {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            padding: 35px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideInDown 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

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

        .modal-header {
            font-size: 22px;
            font-weight: 700;
            color: #1d3f7a;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #999;
            transition: color 0.3s ease;
        }

        .modal-close:hover {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #22c3e3;
            box-shadow: 0 0 0 3px rgba(34, 195, 227, 0.1);
            background: #f8feff;
        }

        .form-hint {
            font-size: 12px;
            color: #999;
            margin-top: 6px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .modal-btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modal-btn-submit {
            background: linear-gradient(135deg, #22c3e3 0%, #1d9fb8 100%);
            color: white;
        }

        .modal-btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(34, 195, 227, 0.4);
        }

        .modal-btn-cancel {
            background: #f0f0f0;
            color: #666;
        }

        .modal-btn-cancel:hover {
            background: #e0e0e0;
        }

        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #22c3e3;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            animation: slideInDown 0.3s ease;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .installments-grid {
                grid-template-columns: 1fr;
            }

            .summary-section {
                grid-template-columns: repeat(2, 1fr);
            }

            .modal-content {
                padding: 25px;
            }
        }
    </style>

    <!-- Installments Content -->
    <div class="installments-wrapper">
        <!-- Student Search Section -->
        <div style="background: white; padding: 25px; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
            <label class="form-label" style="display: block; margin-bottom: 15px;">🔍 Search Student to Manage Installments</label>
            <div style="display: flex; gap: 12px; margin-bottom: 15px;">
                <input 
                    type="text" 
                    id="studentSearch" 
                    class="form-select" 
                    placeholder="Search by Student Name, Admission #, or Challan #..." 
                    oninput="searchStudents(this.value)"
                    style="max-width: 100%; flex: 1; margin: 0;"
                />
                <button type="button" class="btn-pay" onclick="clearSearch()" style="flex: 0 0 auto; width: 120px; margin: 0;">
                    Clear
                </button>
            </div>
            
            <!-- Search Results -->
            <div id="searchResults" style="display: none; background: #f8f9fa; border-radius: 8px; max-height: 300px; overflow-y: auto;">
                <!-- Dynamically populated -->
            </div>
        </div>

        <!-- Selected Student Info -->
        <div id="selectedStudentInfo" style="display: none; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); padding: 20px; border-radius: 12px; margin-bottom: 30px; border-left: 5px solid #2196F3;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 14px; color: #666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Selected Student</div>
                    <div id="selectedStudentName" style="font-size: 18px; font-weight: 700; color: #1d3f7a;"></div>
                    <div id="selectedStudentDetails" style="font-size: 13px; color: #666; margin-top: 8px;"></div>
                </div>
                <button type="button" onclick="changeStudent()" style="padding: 10px 20px; background: #2196F3; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    Change Student
                </button>
            </div>
        </div>

        <h3 class="installments-title">Payment Installments</h3>

        <!-- Summary Section -->
        <div class="summary-section" id="summarySection" style="display: none;">
            <div class="summary-item">
                <div class="summary-label">Total Fees</div>
                <div class="summary-value" id="totalFees">₹ 0</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Paid</div>
                <div class="summary-value" id="totalPaid" style="color: #28a745;">₹ 0</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Remaining</div>
                <div class="summary-value" id="balanceFees" style="color: #ffc107;">₹ 0</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Progress</div>
                <div style="margin-top: 5px;">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill" style="width: 0%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Installments Grid -->
        <div class="installments-grid" id="installmentsGrid">
            <!-- Dynamically populated by JavaScript -->
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="payment-modal" id="paymentModal">
        <div class="modal-content">
            <div class="modal-header">
                <span>Record Payment</span>
                <button type="button" class="modal-close" onclick="closePaymentModal()">✕</button>
            </div>

            <div id="alertContainer"></div>

            <form id="paymentForm" onsubmit="submitPayment(event)">
                <div class="form-group">
                    <label class="form-label">Installment Number</label>
                    <div style="font-size: 18px; font-weight: 700; color: #1d3f7a;">
                        <span id="modalInstallmentNo"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Amount (₹)</label>
                    <div style="font-size: 24px; font-weight: 700; color: #22c3e3;">
                        ₹ <span id="modalAmount">0</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Payment Method *</label>
                    <select class="form-select" name="payment_method" id="paymentMethod" required>
                        <option value="">-- Select Payment Method --</option>
                        <option value="offline">Offline / Cash</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="cheque">Cheque</option>
                        <option value="online">Online Payment</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Transaction ID (Optional)</label>
                    <input type="text" class="form-input" name="transaction_id" placeholder="Enter transaction reference number" />
                    <div class="form-hint">For online/bank transfer payments</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Payment Date *</label>
                    <input type="date" class="form-input" name="paid_date" id="paidDate" required />
                </div>

                <div class="modal-actions">
                    <button type="button" class="modal-btn modal-btn-cancel" onclick="closePaymentModal()">
                        Cancel
                    </button>
                    <button type="submit" class="modal-btn modal-btn-submit" id="submitBtn">
                        Record Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentFeeData = null;
let currentInstallmentNumber = null;
let allFeesData = <?php echo json_encode($fees ?? []); ?>;

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'INR',
        minimumFractionDigits: 2
    }).format(amount);
}

// Search students
function searchStudents(query) {
    const resultsContainer = document.getElementById('searchResults');
    
    if (!query || query.trim().length < 2) {
        resultsContainer.style.display = 'none';
        return;
    }

    const searchTerm = query.toLowerCase().trim();
    const filtered = allFeesData.filter(fee => {
        const studentName = (fee.student_name || fee.full_name || '').toLowerCase();
        const challanNo = (fee.challan_no || '').toLowerCase();
        const studentId = (fee.student_id || '').toLowerCase();
        
        return studentName.includes(searchTerm) || 
               challanNo.includes(searchTerm) || 
               studentId.includes(searchTerm);
    });

    if (filtered.length === 0) {
        resultsContainer.innerHTML = '<div style="padding: 20px; text-align: center; color: #999;">No students found matching your search.</div>';
        resultsContainer.style.display = 'block';
        return;
    }

    const html = filtered.map(fee => `
        <div style="padding: 15px; border-bottom: 1px solid #e0e0e0; cursor: pointer; transition: background 0.2s;" 
             onmouseover="this.style.background='#f0f0f0'" 
             onmouseout="this.style.background='white'"
             onclick="selectStudent(${fee.id}, '${fee.student_name || fee.full_name}', '${fee.challan_no}', ${fee.balance_fees})">
            <div style="font-weight: 600; color: #1d3f7a; margin-bottom: 4px;">
                ${fee.student_name || fee.full_name}
            </div>
            <div style="font-size: 13px; color: #666;">
                📋 ${fee.challan_no} | 💰 Balance: ₹${Number(fee.balance_fees).toFixed(2)}
            </div>
        </div>
    `).join('');

    resultsContainer.innerHTML = html;
    resultsContainer.style.display = 'block';
}

// Select student from search results
function selectStudent(feeId, studentName, challanNo, balance) {
    const searchInput = document.getElementById('studentSearch');
    const selectedInfo = document.getElementById('selectedStudentInfo');
    const summarySection = document.getElementById('summarySection');
    const installmentsGrid = document.getElementById('installmentsGrid');
    const resultsContainer = document.getElementById('searchResults');

    // Hide search results
    resultsContainer.style.display = 'none';
    
    // Update search input
    searchInput.value = studentName;
    
    // Show selected student info
    document.getElementById('selectedStudentName').textContent = studentName;
    document.getElementById('selectedStudentDetails').textContent = `Challan: ${challanNo} | Balance: ₹${Number(balance).toFixed(2)}`;
    selectedInfo.style.display = 'block';

    // Clear previous display
    installmentsGrid.innerHTML = '<p style="text-align: center; color: #999; padding: 40px;"><span class="loading-spinner"></span>Loading installments...</p>';
    summarySection.style.display = 'grid';

    // Load installments
    loadInstallments(feeId);
}

// Change student (go back to search)
function changeStudent() {
    const searchInput = document.getElementById('studentSearch');
    const selectedInfo = document.getElementById('selectedStudentInfo');
    const summarySection = document.getElementById('summarySection');
    const installmentsGrid = document.getElementById('installmentsGrid');

    searchInput.value = '';
    selectedInfo.style.display = 'none';
    summarySection.style.display = 'none';
    installmentsGrid.innerHTML = '';
    currentFeeData = null;
    currentInstallmentNumber = null;
}

// Clear search
function clearSearch() {
    document.getElementById('studentSearch').value = '';
    document.getElementById('searchResults').style.display = 'none';
    changeStudent();
}

// Load installments data
function loadInstallments(feeId) {
    const grid = document.getElementById('installmentsGrid');

    fetch(`?url=api-installments&fee_id=${feeId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data) {
                currentFeeData = Object.assign({ fee_id: feeId }, data.data);
                renderInstallments(currentFeeData);
                return;
            }

            grid.innerHTML = '<p style="text-align: center; color: #999; padding: 40px;">No installments found for this fee record.</p>';
            showAlert(data.error || 'Unable to load installments. Try another fee record.', 'error');
        })
        .catch(error => {
            console.error('Error loading installments:', error);
            grid.innerHTML = '<p style="text-align: center; color: #999; padding: 40px;">Failed to load installments.</p>';
            showAlert('Error loading installments. Please refresh the page.', 'error');
        });
}

// Render installments
function renderInstallments(data) {
    const grid = document.getElementById('installmentsGrid');
    const totalFees = Number(data.finalized_fees || 0);
    const totalPaid = Number(data.total_paid || 0);
    const progress = totalFees > 0 ? (totalPaid / totalFees * 100) : 0;

    // Update summary
    document.getElementById('totalFees').textContent = formatCurrency(totalFees);
    document.getElementById('totalPaid').textContent = formatCurrency(totalPaid);
    document.getElementById('balanceFees').textContent = formatCurrency(Number(data.balance_fees || 0));
    document.getElementById('progressFill').style.width = progress.toFixed(1) + '%';

    if (!Array.isArray(data.installments) || data.installments.length === 0) {
        grid.innerHTML = '<p style="text-align: center; color: #999; padding: 40px;">No installment plans available for this fee record.</p>';
        return;
    }

    grid.innerHTML = data.installments.map(inst => `
        <div class="installment-card ${inst.status}">
            <div class="installment-number">Installment ${inst.number}</div>
            <div class="installment-amount">${formatCurrency(Number(inst.amount || 0))}</div>
            <span class="installment-status ${inst.status}">
                ${inst.status.charAt(0).toUpperCase() + inst.status.slice(1)}
            </span>
            ${inst.paid_date ? `
                <div class="installment-date">
                    ${new Date(inst.paid_date).toLocaleDateString('en-IN')}
                </div>
            ` : ''}
            <div class="installment-actions">
                ${inst.status === 'pending' ? `
                    <button type="button" class="btn-pay" onclick="openPaymentModal(${inst.number}, ${Number(inst.amount || 0)})">
                        💳 Pay Now
                    </button>
                ` : `
                    <button type="button" class="btn-pay" disabled>✓ Paid</button>
                `}
                <button type="button" class="btn-challan" onclick="downloadChallan(${inst.number})">
                    📄 Challan
                </button>
            </div>
        </div>
    `).join('');
}

// Open payment modal
function openPaymentModal(installmentNumber, amount) {
    currentInstallmentNumber = installmentNumber;
    document.getElementById('modalInstallmentNo').textContent = installmentNumber;
    document.getElementById('modalAmount').textContent = Number(amount).toFixed(2);
    document.getElementById('paidDate').valueAsDate = new Date();
    document.getElementById('alertContainer').innerHTML = '';
    document.getElementById('paymentForm').reset();
    document.getElementById('paymentModal').classList.add('active');
}

// Close payment modal
function closePaymentModal() {
    document.getElementById('paymentModal').classList.remove('active');
    currentInstallmentNumber = null;
}

// Submit payment
function submitPayment(e) {
    e.preventDefault();

    const feeId = currentFeeData?.fee_id;
    if (!feeId) {
        showAlert('Please select a student first.', 'error');
        return;
    }
    if (!currentInstallmentNumber) {
        showAlert('Please choose an installment to pay.', 'error');
        return;
    }

    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="loading-spinner"></span>Recording...';

    const formData = new FormData(document.getElementById('paymentForm'));
    const payload = {
        fee_id: feeId,
        installment_number: currentInstallmentNumber,
        payment_method: formData.get('payment_method'),
        transaction_id: formData.get('transaction_id'),
        paid_date: formData.get('paid_date')
    };

    fetch('?url=api-record-installment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = 'Record Payment';

        if (data.success) {
            showAlert('Payment recorded successfully! ✓', 'success');
            setTimeout(() => {
                loadInstallments(feeId);
                closePaymentModal();
            }, 800);
            return;
        }

        showAlert(data.error || 'Failed to record payment', 'error');
    })
    .catch(error => {
        btn.disabled = false;
        btn.innerHTML = 'Record Payment';
        showAlert('Error: ' + error.message, 'error');
    });
}

// Download challan
function downloadChallan(installmentNumber) {
    const feeId = currentFeeData?.fee_id;
    if (!feeId) {
        showAlert('Please select a student first', 'error');
        return;
    }
    window.location.href = `?url=view-challan&fee_id=${feeId}&installment=${installmentNumber}`;
}

// Show alert
function showAlert(message, type) {
    const container = document.getElementById('alertContainer');
    if (!container) return;
    const alertHtml = `<div class="alert alert-${type}">${message}</div>`;
    container.innerHTML = alertHtml;
    setTimeout(() => {
        container.innerHTML = '';
    }, 5000);
}

// Close modal when clicking outside
document.addEventListener('click', (e) => {
    const modal = document.getElementById('paymentModal');
    if (e.target === modal) {
        closePaymentModal();
    }
});

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const studentSearch = document.getElementById('studentSearch');
    if (studentSearch) {
        studentSearch.focus();
    }
});
</script>
