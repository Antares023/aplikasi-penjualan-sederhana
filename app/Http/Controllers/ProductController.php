<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::oldest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merek_produk' => 'required|string|max:50',
            'nama_produk' => 'required|string|max:150',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time().'_'.$foto->getClientOriginalName();
            $path = $foto->storeAs('public/foto-product', $filename);
            
            // Create product with foto path
            Product::create([
                'merek_produk' => $request->merek_produk,
                'nama_produk' => $request->nama_produk,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'foto' => $filename
            ]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'merek_produk' => 'required|string|max:50',
            'nama_produk' => 'required|string|max:150',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048' // 'sometimes' berarti validasi hanya jika file diupload
        ]);

        $data = [
            'merek_produk' => $request->merek_produk,
            'nama_produk' => $request->nama_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'foto' => $request->foto
        ];

        // Handle file upload jika ada foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($product->foto && Storage::exists('public/foto-product/'.$product->foto)) {
                Storage::delete('public/foto-product/'.$product->foto);
            }

            $foto = $request->file('foto');
            $filename = time().'_'.$foto->getClientOriginalName();
            $path = $foto->storeAs('public/foto-product', $filename);
            $data['foto'] = $filename;
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        // Hapus foto terkait jika ada
        if ($product->foto && Storage::exists('public/foto-product/'.$product->foto)) {
            Storage::delete('public/foto-product/'.$product->foto);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}