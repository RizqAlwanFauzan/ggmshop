<?php

namespace App\Http\Controllers\ManajemenPenerima;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPenerima\Kuota\StoreKuotaRequest;
use App\Http\Requests\ManajemenPenerima\Kuota\UpdateKuotaRequest;
use App\Models\Kuota;
use App\Models\Penerima;
use App\Models\Produk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KuotaController extends Controller
{

    public function index(): View
    {
        $kuota    = Kuota::orderBy('updated_at', 'desc')->get();
        $penerima = Penerima::orderBy('updated_at', 'desc')->get(['id', 'nip', 'nama']);
        $produk   = Produk::orderBy('updated_at', 'desc')->pluck('nama', 'id');
        $data     = [
            'title'    => 'Kuota',
            'kuota'    => $kuota,
            'penerima' => $penerima,
            'produk'   => $produk
        ];

        return view('pages.manajemen-penerima.kuota', $data);
    }

    public function show(Kuota $kuota): JsonResponse
    {
        $kuota->load('penerima');
        $kuota->load('produk');
        return response()->json($kuota);
    }

    public function store(StoreKuotaRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Kuota::create($validated);
        return redirect()->back()->with('success', 'Data kuota berhasil ditambahkan');
    }

    public function update(UpdateKuotaRequest $request, Kuota $kuota): RedirectResponse
    {
        $validated = $request->validated();
        $kuota->update($validated);
        return redirect()->back()->with('success', 'Data kuota berhasil diperbarui');
    }

    public function destroy(Kuota $kuota): RedirectResponse
    {
        $kuota->delete();
        return redirect()->back()->with('success', 'Data kuota berhasil dihapus');
    }
}
