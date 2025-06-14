<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $transaction->kode_transaksi }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-size: 13px;
        }
        
        .header {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }
        
        .header h1 {
            color: #2563eb;
            margin: 0;
            font-size: 22px;
        }
        
        .header p {
            margin: 3px 0;
            color: #666;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 25px;
        }
        
        .info-box {
            flex: 1;
            border: 1px solid #eee;
            padding: 12px;
            border-radius: 4px;
            margin-right: 15px;
        }
        
        .info-box:last-child {
            margin-right: 0;
        }
        
        .info-title {
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 8px;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .info-content p {
            margin: 5px 0;
            line-height: 1.4;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            font-size: 13px;
        }
        
        .items-table th {
            text-align: left;
            padding: 8px 10px;
            background-color: #f5f7ff;
            color: #2563eb;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }
        
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .items-table .text-right {
            text-align: right;
        }
        
        .items-table .text-center {
            text-align: center;
        }
        
        .total-table {
            width: 250px;
            margin-left: auto;
            border-collapse: collapse;
            font-size: 13px;
        }
        
        .total-table td {
            padding: 6px 8px;
        }
        
        .total-table .label {
            font-weight: bold;
        }
        
        .total-table .grand-total {
            font-weight: bold;
            font-size: 14px;
            color: #2563eb;
            border-top: 1px dashed #ccc;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>INVOICE</h1>
        <p>Antares Diecast • Palimanan, Kabupaten Cirebon, 45161</p>
        <p>Invoice #{{ $transaction->kode_transaksi }} • Issued: {{ $transaction->tanggal_dibayar->format('F j, Y') }}</p>
    </div>

    <div class="info-row">
        <div class="info-box">
            <div class="info-title">BILLED TO</div>
            <div class="info-content">
                <p><strong>{{ $transaction->nama_customer ?? 'Customer Name' }}</strong></p>
                <p>Adress : {{ $transaction->alamat ?? '123 Customer Street' }}</p>
                <p>Phone : {{ $transaction->no_telp ?? '(123) 456-7890' }}</p>
                <p>ID Customer : {{ $transaction->kode_customer }}</p>
            </div>
        </div>
        
        <div class="info-box">
            <div class="info-title">PAYMENT STATUS</div>
            <div class="info-content">
                <p style="color:green"><strong>PAID</strong></p>
                <p>Method : Cash</p>
                <p>Paid On : {{ $transaction->tanggal_dibayar->format('M j, Y') }}</p>
                <p>Invoice #{{ $transaction->kode_transaksi }}</p>
            </div>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-center">Unit Price</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $transaction->nama_produk }}</td>
                <td class="text-center">Rp {{ number_format($transaction->harga, 0, ',', '.') }}</td>
                <td class="text-center">{{ $transaction->quantity }}</td>
                <td class="text-right">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <table class="total-table">
        <tr>
            <td class="grand-total">Total:</td>
            <td class="grand-total text-right">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for your business! • Payment due upon receipt</p>
        <p>Contact: antaresdiecast@company.com</p>
    </div>
</body>
</html>