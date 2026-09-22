<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bidan\StoreVerifikasiRequest;
use App\Models\Pengukuran;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VerificationController extends Controller
{
    public function show(?Pengukuran $pengukuran = null): View
    {
        $pengukuran ??= Pengukuran::query()->doesntHave('verifikasi')->oldest('tanggal_pengukuran')->first()
            ?? Pengukuran::query()->latest('tanggal_pengukuran')->first();

        $pengukuran?->load([
            'balita.orangTua.user:id,name,no_hp',
            'balita.pengukuran' => fn ($query) => $query->oldest('tanggal_pengukuran'),
            'kader:id,name',
            'verifikasi',
        ]);

        $pendingCount = Pengukuran::query()->doesntHave('verifikasi')->count();

        return view('pages.bidan.verification', compact('pengukuran', 'pendingCount'));
    }

    public function store(StoreVerifikasiRequest $request, Pengukuran $pengukuran): RedirectResponse
    {
        $pengukuran->verifikasi()->updateOrCreate(
            ['pengukuran_id' => $pengukuran->id],
            [
                ...$request->validated(),
                'bidan_id' => $request->user()->id,
                'tanggal_verifikasi' => today(),
            ],
        );

        return redirect()->route('bidan.verification')->with('success', 'Pengukuran berhasil diverifikasi.');
    }
}
