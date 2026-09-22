<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Pengukuran;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(Request $request): View
    {
        $measurements = Pengukuran::query()
            ->with(['balita.orangTua.user:id,name', 'kader:id,name', 'verifikasi.bidan:id,name'])
            ->when($request->string('search')->isNotEmpty(), function ($query) use ($request): void {
                $search = $request->string('search')->toString();
                $query->whereHas('balita', fn ($query) => $query->where('nama', 'like', "%{$search}%"));
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status_pertumbuhan', $request->string('status')->toString()))
            ->latest('tanggal_pengukuran')
            ->paginate(12)
            ->withQueryString();

        return view('pages.bidan.history', compact('measurements'));
    }
}
