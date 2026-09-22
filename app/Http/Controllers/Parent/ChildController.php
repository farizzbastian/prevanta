<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Balita;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChildController extends Controller
{
    public function index(Request $request): View
    {
        $orangTua = $request->user()->orangTua;
        $children = $orangTua?->balita()
            ->with('pengukuranTerbaru.verifikasi')
            ->withCount('imunisasi')
            ->orderBy('nama')
            ->get() ?? collect();
        $nextSchedule = Jadwal::query()->where('tanggal', '>=', now())->oldest('tanggal')->first();

        return view('pages.parent.children', compact('children', 'nextSchedule'));
    }

    public function show(Request $request, Balita $balita): View
    {
        $balita = $request->user()->orangTua?->balita()
            ->with(['orangTua.user:id,name', 'pengukuran' => fn ($query) => $query->oldest('tanggal_pengukuran'), 'imunisasi.jenisImunisasi'])
            ->findOrFail($balita->id);

        return view('pages.parent.child-profile', compact('balita'));
    }
}
