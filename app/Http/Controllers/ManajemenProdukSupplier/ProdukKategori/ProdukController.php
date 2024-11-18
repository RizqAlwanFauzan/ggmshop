<?php

namespace App\Http\Controllers\ManajemenProdukSupplier\ProdukKategori;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenProdukSupplier\ProdukKategori\Produk\StoreProdukRequest;
use App\Http\Requests\ManajemenProdukSupplier\ProdukKategori\Produk\UpdateProdukRequest;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProdukController extends Controller
{
    public function index(): View
    {
        $produk   = Produk::orderBy('updated_at', 'desc')->get();
        $kategori = Kategori::orderBy('updated_at', 'desc')->pluck('nama', 'id');
        $supplier = Supplier::orderBy('updated_at', 'desc')->pluck('nama', 'id');
        $data     = [
            'title'    => 'Produk',
            'produk'   => $produk,
            'kategori' => $kategori,
            'supplier' => $supplier
        ];

        return view('pages.manajemen-produk-supplier.produk-kategori.produk', $data);
    }

    public function show(Produk $produk): JsonResponse
    {
        $produk->load('kategori');
        $produk->load('supplier');
        return response()->json($produk);
    }

    public function store(StoreProdukRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Produk::create($validated);
        return redirect()->back()->with('success', 'Data produk berhasil ditambahkan');
    }

    public function update(UpdateProdukRequest $request, Produk $produk): RedirectResponse
    {
        $validated = $request->validated();
        $produk->update($validated);
        return redirect()->back()->with('success', 'Data produk berhasil diperbarui');
    }

    public function destroy(Produk $produk): RedirectResponse
    {
        $produk->delete();
        return redirect()->back()->with('success', 'Data produk berhasil dihapus');
    }
}
