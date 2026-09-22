<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Balita;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImmunizationHistoryController extends Controller
{
    public function index(Request $request): View
    {
        $children = $request->user()->orangTua?->balita()->orderBy('nama')->get() ?? collect();
        $selectedChild = $children->firstWhere('id', $request->integer('balita')) ?? $children->first();

        if ($selectedChild instanceof Balita) {
            $selectedChild->load([
                'imunisasi' => fn ($query) => $query->with('jenisImunisasi')->latest('tanggal_pemberian'),
                'vitamin' => fn ($query) => $query->with('jenisVitamin')->latest('tanggal_pemberian'),
            ]);
        }

        return view('pages.parent.immunizations', compact('children', 'selectedChild'));
    }
}
