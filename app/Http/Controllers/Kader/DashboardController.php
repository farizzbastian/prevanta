<?php

namespace App\Http\Controllers\Kader;

use App\GrowthStatus;
use App\Http\Controllers\Controller;
use App\Models\Balita;
use App\Models\Pengukuran;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $children = Balita::query()->with('pengukuranTerbaru')->get();
        $measuredThisMonth = Pengukuran::query()
            ->whereBetween('tanggal_pengukuran', [now()->startOfMonth(), now()->endOfMonth()])
            ->distinct('balita_id')
            ->count('balita_id');

        $metrics = [
            'total' => $children->count(),
            'measured' => $measuredThisMonth,
            'unmeasured' => max(0, $children->count() - $measuredThisMonth),
            'normal' => $children->where('pengukuranTerbaru.status_pertumbuhan', GrowthStatus::Normal)->count(),
            'short' => $children->where('pengukuranTerbaru.status_pertumbuhan', GrowthStatus::Pendek)->count(),
            'severelyShort' => $children->where('pengukuranTerbaru.status_pertumbuhan', GrowthStatus::SangatPendek)->count(),
        ];

        return view('pages.kader.dashboard', compact('metrics'));
    }
}
