<?php

namespace App\Http\Controllers\ManajemenProdukSupplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenProdukSupplier\Supplier\StoreSupplierRequest;
use App\Http\Requests\ManajemenProdukSupplier\Supplier\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function index(): View
    {
        $supplier = Supplier::orderBy('updated_at', 'desc')->get();
        $data   = [
            'title'    => 'Supplier',
            'supplier' => $supplier
        ];

        return view('pages.manajemen-produk-supplier.supplier', $data);
    }

    public function show(Supplier $supplier): JsonResponse
    {
        return response()->json($supplier);
    }

    public function store(StoreSupplierRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Supplier::create($validated);
        return redirect()->back()->with('success', 'Data supplier berhasil ditambahkan');
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier): RedirectResponse
    {
        $validated = $request->validated();
        $supplier->update($validated);
        return redirect()->back()->with('success', 'Data supplier berhasil diperbarui');
    }

    public function destroy(Supplier $supplier): RedirectResponse
    {
        if ($supplier->produk()->exists()) {
            return redirect()->back()->with('warning', 'Data supplier tidak bisa dihapus karena digunakan pada produk');
        }

        $supplier->delete();
        return redirect()->back()->with('success', 'Data supplier berhasil dihapus');
    }
}
