<?php

namespace App\Http\Controllers\ManajemenPenerima\DepartemenBagian;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPenerima\DepartemenBagian\Bagian\StoreBagianRequest;
use App\Http\Requests\ManajemenPenerima\DepartemenBagian\Bagian\UpdateBagianRequest;
use App\Models\Bagian;
use App\Models\Departemen;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BagianController extends Controller
{
    public function index(): View
    {
        $bagian     = Bagian::orderBy('updated_at', 'desc')->get();
        $departemen = Departemen::orderBy('updated_at', 'desc')->pluck('nama', 'id');
        $data   = [
            'title'      => 'Bagian',
            'bagian'     => $bagian,
            'departemen' => $departemen
        ];

        return view('pages.manajemen-penerima.departemen-bagian.bagian', $data);
    }

    public function show(Bagian $bagian): JsonResponse
    {
        $bagian->load('departemen');
        return response()->json($bagian);
    }

    public function store(StoreBagianRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Bagian::create($validated);
        return redirect()->back()->with('success', 'Data bagian berhasil ditambahkan');
    }

    public function update(UpdateBagianRequest $request, Bagian $bagian): RedirectResponse
    {
        $validated = $request->validated();
        $bagian->update($validated);
        return redirect()->back()->with('success', 'Data bagian berhasil diperbarui');
    }

    public function destroy(Bagian $bagian): RedirectResponse
    {
        $bagian->delete();
        return redirect()->back()->with('success', 'Data bagian berhasil dihapus');
    }
}
