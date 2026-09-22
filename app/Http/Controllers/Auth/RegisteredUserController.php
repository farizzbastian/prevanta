<?php

namespace App\Http\Controllers\Auth;

use App\Gender;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('pages.auth.register', ['genders' => Gender::cases()]);
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = DB::transaction(function () use ($validated): User {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'no_hp' => $validated['no_hp'],
                'password' => $validated['password'],
                'role' => UserRole::OrangTua,
            ]);

            $user->orangTua()->create([
                'nik' => $validated['nik'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'hubungan_dengan_balita' => $validated['hubungan_dengan_balita'],
            ]);

            return $user;
        });

        Auth::login($user);

        return redirect()->route('parent.children')->with('success', 'Akun berhasil dibuat. Selamat datang di Prevanta.');
    }
}
