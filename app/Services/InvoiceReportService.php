<?php

namespace App\Services;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceReportService
{
    public function viewInvoice($id)
    {
        $transaction = Transaction::select('transactions.*', 'customers.nama_customer','customers.alamat', 'customers.no_telp', 'products.harga', 'products.nama_produk')
            ->leftJoin('products', 'transactions.kode_produk', '=', 'products.kode_produk')
            ->leftJoin('customers', 'transactions.kode_customer', '=', 'customers.kode_customer')
            ->findOrFail($id);
        return view('transactions.invoice', compact('transaction'));
    }

    public function generateInvoice($id)
    {
        $transaction = Transaction::select('transactions.*', 'customers.nama_customer','customers.alamat', 'customers.no_telp', 'products.harga', 'products.nama_produk')
            ->leftJoin('products', 'transactions.kode_produk', '=', 'products.kode_produk')
            ->leftJoin('customers', 'transactions.kode_customer', '=', 'customers.kode_customer')
            ->findOrFail($id);
        
        $pdf = Pdf::loadView('transactions.invoice', [ 
            'transaction' => $transaction,
        ]);
        
        return $pdf;
    }
}