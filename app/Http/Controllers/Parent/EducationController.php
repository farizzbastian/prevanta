<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(): View
    {
        $articles = Edukasi::query()->with('user:id,name')->latest()->paginate(9);

        return view('pages.parent.education', compact('articles'));
    }
}
