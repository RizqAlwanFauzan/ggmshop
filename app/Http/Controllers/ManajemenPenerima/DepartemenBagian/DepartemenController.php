<?php

namespace App\Http\Controllers\ManajemenPenerima\DepartemenBagian;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPenerima\DepartemenBagian\Departemen\StoreDepartemenRequest;
use App\Http\Requests\ManajemenPenerima\DepartemenBagian\Departemen\UpdateDepartemenRequest;
use App\Models\Departemen;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartemenController extends Controller
{
    public function index(): View
    {
        $departemen = Departemen::orderBy('updated_at', 'desc')->get();
        $data       = [
            'title'      => 'Departemen',
            'departemen' => $departemen
        ];

        return view('pages.manajemen-penerima.departemen-bagian.departemen', $data);
    }

    public function show(Departemen $departemen): JsonResponse
    {
        return response()->json($departemen);
    }

    public function store(StoreDepartemenRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Departemen::create($validated);
        return redirect()->back()->with('success', 'Data departemen berhasil ditambahkan');
    }

    public function update(UpdateDepartemenRequest $request, Departemen $departemen): RedirectResponse
    {
        $validated = $request->validated();
        $departemen->update($validated);
        return redirect()->back()->with('success', 'Data departemen berhasil diperbarui');
    }

    public function destroy(Departemen $departemen): RedirectResponse
    {
        if ($departemen->bagian()->exists()) {
            return redirect()->back()->with('warning', 'Data departemen tidak bisa dihapus karena digunakan pada bagian');
        }

        $departemen->delete();
        return redirect()->back()->with('success', 'Data departemen berhasil dihapus');
    }
}
