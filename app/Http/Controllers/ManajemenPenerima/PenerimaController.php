<?php

namespace App\Http\Controllers\ManajemenPenerima;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPenerima\Penerima\StorePenerimaRequest;
use App\Http\Requests\ManajemenPenerima\Penerima\UpdatePenerimaRequest;
use App\Models\Penerima;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PenerimaController extends Controller
{
    public function index(): View
    {
        $penerima = Penerima::orderBy('updated_at', 'desc')->get();
        $data     = [
            'title'    => 'Penerima',
            'penerima' => $penerima
        ];

        return view('pages.manajemen-penerima.penerima', $data);
    }

    public function show(Penerima $penerima): JsonResponse
    {
        return response()->json($penerima);
    }

    public function store(StorePenerimaRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Penerima::create($validated);
        return redirect()->back()->with('success', 'Data penerima berhasil ditambahkan');
    }

    public function update(UpdatePenerimaRequest $request, Penerima $penerima): RedirectResponse
    {
        $validated = $request->validated();
        $penerima->update($validated);
        return redirect()->back()->with('success', 'Data penerima berhasil diperbarui');
    }

    public function destroy(Penerima $penerima): RedirectResponse
    {
        $penerima->delete();
        return redirect()->back()->with('success', 'Data penerima berhasil dihapus');
    }
}
