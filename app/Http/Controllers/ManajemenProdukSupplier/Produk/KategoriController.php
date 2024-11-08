<?php

namespace App\Http\Controllers\ManajemenProdukSupplier\Produk;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenProdukSupplier\Produk\Kategori\StoreKategoriRequest;
use App\Http\Requests\ManajemenProdukSupplier\Produk\Kategori\UpdateKategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function index(): View
    {
        $kategori = Kategori::orderBy('updated_at', 'desc')->get();
        $data   = [
            'title'    => 'Kategori',
            'kategori' => $kategori
        ];

        return view('pages.manajemen-produk-supplier.produk.kategori', $data);
    }

    public function show(Kategori $kategori): JsonResponse
    {
        return response()->json($kategori);
    }

    public function store(StoreKategoriRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Kategori::create($validated);
        return redirect()->back()->with('success', 'Data kategori berhasil ditambahkan');
    }

    public function update(UpdateKategoriRequest $request, Kategori $kategori): RedirectResponse
    {
        $validated = $request->validated();
        $kategori->update($validated);
        return redirect()->back()->with('success', 'Data kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori): RedirectResponse
    {
        $kategori->delete();
        return redirect()->back()->with('success', 'Data kategori berhasil dihapus');
    }
}
