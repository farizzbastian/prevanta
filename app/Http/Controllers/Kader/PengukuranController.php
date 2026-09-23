<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\StorePengukuranRequest;
use App\Models\Balita;
use App\Services\Growth\WhoHeightForAgeCalculator;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PengukuranController extends Controller
{
    public function create(Balita $balita): View
    {
        $balita->load('pengukuranTerbaru');

        return view('pages.kader.measurement', compact('balita'));
    }

    public function store(
        StorePengukuranRequest $request,
        Balita $balita,
        WhoHeightForAgeCalculator $calculator,
    ): RedirectResponse {
        $data = $request->safe()->except('foto');
        $data['tinggi_badan'] = round((float) $data['tinggi_badan'], 2);
        $growth = $calculator->calculate(
            $balita->jenis_kelamin,
            $balita->tanggal_lahir,
            CarbonImmutable::parse($data['tanggal_pengukuran']),
            $data['tinggi_badan'],
        );

        $data['z_score'] = $growth->zScore;
        $data['status_pertumbuhan'] = $growth->status;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengukuran', 'public');
        }

        $data['kader_id'] = $request->user()->id;
        $balita->pengukuran()->create($data);

        return redirect()->route('kader.child-profile', $balita)->with('success', 'Pengukuran berhasil disimpan dan menunggu verifikasi bidan.');
    }
}
