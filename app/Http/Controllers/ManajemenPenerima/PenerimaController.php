<?php

namespace App\Http\Controllers\ManajemenPenerima;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPenerima\Penerima\StorePenerimaRequest;
use App\Http\Requests\ManajemenPenerima\Penerima\UpdatePenerimaRequest;
use App\Models\Bagian;
use App\Models\Departemen;
use App\Models\Penerima;
use App\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PenerimaController extends Controller
{
    public function index(): View
    {
        $penerima   = Penerima::orderBy('updated_at', 'desc')->get();
        $departemen = Departemen::orderBy('updated_at', 'desc')->pluck('nama', 'id');
        $status     = Status::orderBy('updated_at', 'desc')->pluck('nama', 'id');
        $data       = [
            'title'      => 'Penerima',
            'penerima'   => $penerima,
            'departemen' => $departemen,
            'status'     => $status
        ];

        if (old('departemen_id')) {
            $data['bagian'] = Bagian::where('departemen_id', old('departemen_id'))->orderBy('updated_at', 'desc')->pluck('nama', 'id');
        }

        return view('pages.manajemen-penerima.penerima', $data);
    }

    public function show(Penerima $penerima): JsonResponse
    {
        $penerima->load('departemen');
        $penerima->load('bagian');
        $penerima->load('status');
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

    public function getBagianByDepartemen(Departemen $departemen): JsonResponse
    {
        $bagian = $departemen->bagian()->orderBy('updated_at', 'desc')->pluck('nama', 'id');
        return response()->json($bagian);
    }
}
