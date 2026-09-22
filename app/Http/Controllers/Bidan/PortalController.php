<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Balita;
use App\Models\Pengukuran;
use Illuminate\View\View;

class PortalController extends Controller
{
    public function __invoke(): View
    {
        $recentMeasurements = Pengukuran::query()
            ->with(['balita:id,nama', 'kader:id,name', 'verifikasi.bidan:id,name'])
            ->latest('tanggal_pengukuran')
            ->limit(6)
            ->get();
        $metrics = [
            'children' => Balita::count(),
            'measurements' => Pengukuran::count(),
            'pending' => Pengukuran::doesntHave('verifikasi')->count(),
        ];

        return view('pages.dashboard', compact('recentMeasurements', 'metrics'));
    }
}
