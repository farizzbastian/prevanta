<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Balita;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MeasurementHistoryController extends Controller
{
    public function index(Request $request): View
    {
        $children = $request->user()->orangTua?->balita()->orderBy('nama')->get() ?? collect();
        $selectedChild = $children->firstWhere('id', $request->integer('balita')) ?? $children->first();

        if ($selectedChild instanceof Balita) {
            $selectedChild->load(['pengukuran' => fn ($query) => $query->latest('tanggal_pengukuran')]);
        }

        return view('pages.parent.measurements', compact('children', 'selectedChild'));
    }
}
