<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }} - {{ date('Ymd') }}</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            padding: 0;
            margin: 0;
        }
        
        /* Color Scheme */
        :root {
            --primary-50: #f0f9ff;
            --primary-100: #e0f2fe;
            --primary-200: #bae6fd;
            --primary-300: #7dd3fc;
            --primary-400: #38bdf8;
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --primary-700: #0369a1;
            --primary-800: #075985;
            --primary-900: #0c4a6e;
            --primary-950: #082f49;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
        }

        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--primary-200);
        }
        
        .header h1 {
            color: var(--primary-700);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        
        .header .subtitle {
            color: var(--primary-500);
            font-size: 0.9rem;
        }

        /* Table Styles */
        .table-container {
            margin: 1.5rem 0;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.85rem;
        }
        
        thead th {
            background-color: var(--primary-600);
            color: white;
            padding: 0.75rem 1rem;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            text-align: center;
        }
        
        thead th:first-child {
            border-top-left-radius: 0.5rem;
        }
        
        thead th:last-child {
            border-top-right-radius: 0.5rem;
        }
        
        tbody td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--gray-200);
            vertical-align: middle;
            font-size: 0.75rem;
        }
        
        tbody tr:nth-child(even) {
            background-color: var(--primary-50);
        }
        
        tbody tr:hover {
            background-color: var(--primary-100);
        }
        
        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
            text-align: center;
        }
        
        .status-pending {
            color: #dc2626;
        }
        
        .status-done {
            color: #16a34a;
        }

        /* Price Formatting */
        .price {
            font-weight: 500;
            color: var(--primary-700);
        }

        /* Footer Section */
        .footer {
            margin-top: 2.5rem;
            padding-top: 1rem;
            border-top: 2px solid var(--primary-200);
            font-size: 0.75rem;
            color: var(--primary-500);
            text-align: right;
        }
        
        .footer .print-info {
            margin-bottom: 0.25rem;
        }
        
        .footer .app-name {
            font-weight: 600;
            color: var(--primary-600);
        }

        /* Utility Classes */
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <h1>{{ $title }}</h1>
        <div class="subtitle">Tanggal Cetak: {{ date('d F Y') }}</div>
    </div>

    <!-- customer Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Kode</th>
                    <th class="text-center">Customer</th>
                    <th class="text-center">kontak</th>
                    <th class="text-center">alamat</th>
                    <th class="text-center">tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $key => $customer)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">
                        <span style="font-family: monospace; font-weight: 500;">
                            {{ $customer->kode_customer }}
                        </span>
                    </td>
                    <td class="text-center">{{ $customer->nama_customer }}</td>
                    <td class="text-center">{{ $customer->no_telp }}</td>
                    <td class="text-center">{{ $customer->alamat }}</td>
                    <td class="text-center">{{ $customer->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <div class="print-info">Dicetak oleh: {{ auth()->user()->name }}</div>
        <div class="app-name">Sistem Penjualan</div>
    </div>
</body>
</html>