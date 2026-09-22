<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\StoreEdukasiRequest;
use App\Models\Edukasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EdukasiController extends Controller
{
    public function index(Request $request): View
    {
        $articles = Edukasi::query()
            ->with('user:id,name')
            ->when($request->string('search')->isNotEmpty(), fn ($query) => $query->where('judul', 'like', '%'.$request->string('search').'%'))
            ->when($request->filled('category'), fn ($query) => $query->where('kategori', $request->string('category')->toString()))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.kader.education', compact('articles'));
    }

    public function create(): View
    {
        return view('pages.kader.add-education');
    }

    public function store(StoreEdukasiRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('gambar');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('edukasi', 'public');
        }

        $request->user()->edukasi()->create($data);

        return redirect()->route('kader.education')->with('success', 'Materi edukasi berhasil dipublikasikan.');
    }
}
