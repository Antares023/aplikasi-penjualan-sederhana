<?php

namespace App\Services;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionReportService
{
    public function generatePdf($status = null)
    {
        $query = Transaction::with(['customer', 'product'])
            ->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        $transactions = $query->get();
        $title = $status ? 'Laporan Transaksi ' . ucfirst($status) : 'Laporan Semua Transaksi';

        $pdf = Pdf::loadView('pdf.transactions', [
            'transactions' => $transactions,
            'title' => $title
        ]);

        return $pdf;
    }
}