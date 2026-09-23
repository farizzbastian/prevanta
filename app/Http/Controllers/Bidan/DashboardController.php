<?php

namespace App\Http\Controllers\Bidan;

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
        $measurementsThisMonth = Pengukuran::query()
            ->whereBetween('tanggal_pengukuran', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();
        $pendingVerification = Pengukuran::query()->doesntHave('verifikasi')->count();

        $metrics = [
            'total' => $children->count(),
            'measured' => $measurementsThisMonth,
            'pending' => $pendingVerification,
            'normal' => $children->where('pengukuranTerbaru.status_pertumbuhan', GrowthStatus::Normal)->count(),
            'short' => $children->where('pengukuranTerbaru.status_pertumbuhan', GrowthStatus::Pendek)->count(),
            'severelyShort' => $children->where('pengukuranTerbaru.status_pertumbuhan', GrowthStatus::SangatPendek)->count(),
        ];

        return view('pages.bidan.dashboard', compact('metrics'));
    }
}
