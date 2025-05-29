<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Product;
use App\Services\TransactionReportService;
use barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::query()->with(['customer', 'product']);

        // Filter berdasarkan kode transaksi jika ada parameter search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('kode_transaksi', 'LIKE', "%{$search}%")
            ->orWhere('kode_customer', 'LIKE', "%{$search}%");
        }

        $transactions = $query->orderBy('created_at', 'asc')->oldest()->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'kode_customer', 'kode_customer');
    }

    public function show($id)
    {
        $transaction = Transaction::select('transactions.*', 'customers.nama_customer', 'products.nama_produk')
            ->leftJoin('products', 'transactions.kode_produk', '=', 'products.kode_produk')
            ->leftJoin('customers', 'transactions.kode_customer', '=', 'customers.kode_customer')
            ->findOrFail($id);
        
        return view('transactions.show', compact('transaction'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('transactions.create', compact('customers', 'products'));
    }

// app/Http/Controllers/TransactionController.php

    public function store(Request $request)
    {
        $request->validate([
            'kode_customer' => 'required|exists:customers,kode_customer',
        ]);

        $product = Product::where('kode_produk', $request->kode_produk)->first();

        Transaction::create([
            'kode_customer' => $request->kode_customer,
            'status' => 'pending',
            'tanggal_dibayar' => null,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dibuat');
    }

// app/Http/Controllers/TransactionController.php

    public function edit(Transaction $transaction)
    {
        // Hanya bisa edit transaksi pending
        if ($transaction->status === 'done') {
            return redirect()->route('transactions.index')
                ->with('error', 'Transaksi yang sudah selesai tidak bisa diubah');
        }

        $products = Product::all();
        $transaction = Transaction::select('transactions.*', 'customers.nama_customer')
            ->leftJoin('customers', 'transactions.kode_customer', '=', 'customers.kode_customer')
            ->findOrFail($transaction->id);
        return view('transactions.edit', compact('transaction', 'products'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // dd($request->all()); 

        $request->validate([
            'kode_customer' => 'required|exists:customers,kode_customer',
            'kode_produk' => 'required|exists:products,kode_produk',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::where('kode_produk', $request->kode_produk)->firstOrFail();

        $updateData = [
            'kode_produk' => $request->kode_produk,
            'quantity' => $request->quantity,
            'total_harga' => $product->harga * $request->quantity,
            'status' => 'pending',
            'tanggal_dibayar' => null,
        ];

        // Jika status diubah ke done, set tanggal dibayar
        if ($request->status === 'done' && $transaction->status === 'pending') {
            $updateData['tanggal_dibayar'] = now();
        }

        $transaction->update($updateData);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    public function updateStatus($id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Validasi bahwa quantity > 0
        if ($transaction->quantity <= 0) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menyelesaikan transaksi dengan quantity 0');
        }

        // Update status menjadi 'done'
        $transaction->update([
            'status' => 'done',
            'tanggal_dibayar' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()
            ->with('success', 'Transaksi berhasil, terima kasih telah berbelanja!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    public function downloadPdf(Request $request, TransactionReportService $reportService)
    {
        $reportService = new TransactionReportService();
        $status = $request->query('status');
        $pdf = $reportService->generatePdf($status);
        
        $filename = $status 
            ? 'laporan-transaksi-' . $status . '-' . date('Ymd') . '.pdf'
            : 'laporan-semua-transaksi-' . date('Ymd') . '.pdf';
        
        return $pdf->download($filename);
    }

}