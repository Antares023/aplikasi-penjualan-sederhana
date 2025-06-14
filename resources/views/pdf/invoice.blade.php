<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $transaction->kode_transaksi }}</title>
    <style>
        
        :root {
            --primary: #3b82f6;
            --primary-soft: #eff6ff;
            --primary-light: #93c5fd;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --success: #10b981;
            --success-light: #d1fae5;
            --gray-light: #f1f5f9;
            --gray-border: #e2e8f0;
            --text-dark: #1e293b;
            --text-medium: #475569;
            --text-light: #64748b;
        }
        
        body {
            font-family: 'poppins', sans-serif;
            color: var(--text-dark);
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: white;
            font-size: 14px;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2.5rem;
            box-sizing: border-box;
        }
        
        /* Header Section */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--gray-border);
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .logo-placeholder {
            width: 48px;
            height: 48px;
            background-color: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .company-info h2 {
            margin: 0;
            color: var(--primary);
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .company-info p {
            margin: 0.25rem 0 0;
            color: var(--text-light);
            font-size: 0.875rem;
        }
        
        .invoice-meta {
            text-align: right;
        }
        
        .invoice-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0 0 0.5rem;
        }
        
        .invoice-number {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }
        
        .invoice-date {
            color: var(--text-light);
            font-size: 0.875rem;
        }
        
        /* Main Grid Layout */
        .invoice-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2.5rem;
        }
        
        /* Customer Section */
        .customer-section {
            background-color: var(--primary-soft);
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid var(--gray-border);
        }
        
        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin: 0 0 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .section-title svg {
            width: 18px;
            height: 18px;
        }
        
        .customer-details p {
            margin: 0.5rem 0;
            color: var(--text-medium);
        }
        
        .customer-name {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1.125rem;
            margin-bottom: 0.75rem;
        }
        
        /* Payment Status Section */
        .payment-section {
            background-color: white;
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid var(--gray-border);
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            background-color: var(--success-light);
            color: var(--success);
            margin-bottom: 1rem;
        }
        
        .status-badge svg {
            width: 16px;
            height: 16px;
        }
        
        .payment-method {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.875rem;
        }
        
        /* Items Table */
        .items-container {
            margin-bottom: 2rem;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        
        .items-table thead th {
            background-color: var(--primary-soft);
            color: var(--primary-dark);
            padding: 0.75rem 1rem;
            font-weight: 600;
            text-align: left;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .items-table tbody td {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-border);
            color: var(--text-medium);
        }
        
        .items-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .product-name {
            font-weight: 500;
            color: var(--text-dark);
        }
        
        .text-right {
            text-align: right;
        }
        
        /* Summary Section */
        .summary-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        
        .notes-section {
            background-color: var(--gray-light);
            padding: 1.5rem;
            border-radius: 8px;
        }
        
        .notes-title {
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--text-dark);
        }
        
        .notes-content {
            color: var(--text-medium);
            font-size: 0.875rem;
            line-height: 1.6;
        }
        
        .totals-section {
            background-color: white;
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid var(--gray-border);
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }
        
        .total-label {
            color: var(--text-medium);
        }
        
        .total-amount {
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .grand-total {
            padding-top: 0.75rem;
            margin-top: 0.75rem;
            border-top: 1px dashed var(--gray-border);
            font-size: 1.125rem;
        }
        
        .grand-total .total-label {
            color: var(--primary-dark);
            font-weight: 600;
        }
        
        .grand-total .total-amount {
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 1.25rem;
        }
        
        /* Footer */
        .invoice-footer {
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-border);
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            text-align: center;
            color: var(--text-light);
            font-size: 0.75rem;
        }
        
        .footer-item {
            padding: 0 1rem;
        }
        
        .footer-item-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--text-medium);
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header Section -->
        <div class="invoice-header">
            <div class="logo-section">
                <div class="logo-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <div class="company-info">
                    <h2>Antares Diecast</h2>
                    <p>Palimanan, Kabupaten Cirebon, 45161</p>
                </div>
            </div>
            
            <div class="invoice-meta">
                <h1 class="invoice-title">INVOICE</h1>
                <div class="invoice-number">#{{ $transaction->kode_transaksi }}</div>
                <div class="invoice-date">Issued: {{ $transaction->tanggal_dibayar->format('F j, Y') }}</div>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="invoice-grid">
            <!-- Customer Section -->
            <div class="customer-section">
                <h3 class="section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Billed To
                </h3>
                <div class="customer-details">
                    <div class="customer-name">{{ $transaction->nama_customer ?? 'Customer Name' }}</div>
                    <p>Address : {{ $transaction->alamat ?? '123 Customer Street' }}</p>
                    <p>Phone : {{ $transaction->no_telp ?? 'Phone: (123) 456-7890' }}</p>
                    <p>Customer ID : {{ $transaction->kode_customer }}</p>
                </div>
            </div>
            
            <!-- Payment Section -->
            <div class="payment-section">
                <h3 class="section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Payment Details
                </h3>
                <div class="status-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    PAID
                </div>
                <div class="payment-method">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                    Payment Method: Cash
                </div>
                <div class="payment-method" style="margin-top: 0.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Paid On: {{ $transaction->tanggal_dibayar->format('M j, Y') }}
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="items-container">
            <h3 class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Invoice Items
            </h3>
            
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="product-name">{{ $transaction->nama_produk }}</td>
                        <td class="text-center">Rp {{ number_format($transaction->harga, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $transaction->quantity }}</td>
                        <td class="text-center">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- Footer -->
        <div class="invoice-footer">
            <div class="footer-item">
                <div class="footer-item-title">Payment Terms</div>
                <div>Due upon receipt</div>
            </div>
            <div class="footer-item">
                <div class="footer-item-title">Contact Us</div>
                <div>antaresdiecast@company.com</div>
            </div>
            <div class="footer-item">
                <div class="footer-item-title">Thank You</div>
                <div>We appreciate your business</div>
            </div>
        </div>
    </div>
</body>
</html>