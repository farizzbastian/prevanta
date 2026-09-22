<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\StoreJadwalRequest;
use App\Models\Jadwal;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JadwalController extends Controller
{
    public function index(): View
    {
        $schedules = Jadwal::query()->with('user:id,name')->where('tanggal', '>=', now())->oldest('tanggal')->get();

        return view('pages.kader.schedule', compact('schedules'));
    }

    public function store(StoreJadwalRequest $request): RedirectResponse
    {
        $request->user()->jadwal()->create($request->validated());

        return back()->with('success', 'Jadwal berhasil ditambahkan.');
    }
}
