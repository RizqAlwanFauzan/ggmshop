<?php

namespace App\Http\Controllers\ManajemenPenerima;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPenerima\Status\StoreStatusRequest;
use App\Http\Requests\ManajemenPenerima\Status\UpdateStatusRequest;
use App\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StatusController extends Controller
{
    public function index(): View
    {
        $status = Status::orderBy('updated_at', 'desc')->get();
        $data   = [
            'title'  => 'Status',
            'status' => $status
        ];

        return view('pages.manajemen-penerima.status', $data);
    }

    public function show(Status $status): JsonResponse
    {
        return response()->json($status);
    }

    public function store(StoreStatusRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Status::create($validated);
        return redirect()->back()->with('success', 'Data status berhasil ditambahkan');
    }

    public function update(UpdateStatusRequest $request, Status $status): RedirectResponse
    {
        $validated = $request->validated();
        $status->update($validated);
        return redirect()->back()->with('success', 'Data status berhasil diperbarui');
    }

    public function destroy(Status $status): RedirectResponse
    {
        $status->delete();
        return redirect()->back()->with('success', 'Data status berhasil dihapus');
    }
}
