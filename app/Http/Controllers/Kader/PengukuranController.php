<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\StorePengukuranRequest;
use App\Models\Balita;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PengukuranController extends Controller
{
    public function create(Balita $balita): View
    {
        $balita->load('pengukuranTerbaru');

        return view('pages.kader.measurement', compact('balita'));
    }

    public function store(StorePengukuranRequest $request, Balita $balita): RedirectResponse
    {
        $data = $request->safe()->except('foto');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengukuran', 'public');
        }

        $data['kader_id'] = $request->user()->id;
        $balita->pengukuran()->create($data);

        return redirect()->route('kader.child-profile', $balita)->with('success', 'Pengukuran berhasil disimpan dan menunggu verifikasi bidan.');
    }
}
