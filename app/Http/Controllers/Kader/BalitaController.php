<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\StoreBalitaRequest;
use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BalitaController extends Controller
{
    public function index(Request $request): View
    {
        $children = Balita::query()
            ->with(['orangTua.user:id,name,no_hp', 'pengukuranTerbaru'])
            ->when($request->string('search')->isNotEmpty(), function ($query) use ($request): void {
                $search = $request->string('search')->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('nama', 'like', "%{$search}%")->orWhere('nik', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->whereHas(
                'pengukuran',
                fn ($query) => $query->where('status_pertumbuhan', $request->string('status')->toString()),
            ))
            ->orderBy('nama')
            ->paginate(12)
            ->withQueryString();

        return view('pages.kader.monitoring', compact('children'));
    }

    public function create(): View
    {
        $parents = OrangTua::query()->with('user:id,name,no_hp')->orderBy('id')->get();

        return view('pages.kader.add-child', compact('parents'));
    }

    public function store(StoreBalitaRequest $request): RedirectResponse
    {
        $balita = Balita::create($request->validated());

        return redirect()->route('kader.child-profile', $balita)->with('success', 'Data balita berhasil ditambahkan.');
    }

    public function show(Balita $balita): View
    {
        $balita->load([
            'orangTua.user:id,name,no_hp',
            'pengukuran' => fn ($query) => $query->oldest('tanggal_pengukuran'),
            'imunisasi.jenisImunisasi',
            'vitamin.jenisVitamin',
        ]);

        return view('pages.kader.child-profile', compact('balita'));
    }
}
