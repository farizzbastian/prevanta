@extends('layouts.app')

@section('title', 'Masuk — Prevanta')

@section('content')
<x-auth-shell
    eyebrow="Selamat Datang"
    heading="Masuk ke Akun Anda"
    description="Pantau tumbuh kembang anak bersama Posyandu dengan mudah dan aman."
>
    <form method="POST" action="{{ route('login.store') }}" class="mt-8 grid gap-5">
        @csrf
        <x-auth-field label="Email" name="email" type="email" placeholder="nama@email.com" autocomplete="email" />
        <x-auth-field label="Kata Sandi" name="password" type="password" placeholder="Masukkan kata sandi" autocomplete="current-password" />

        <div class="-mt-2 flex items-center justify-between gap-3 text-xs">
            <label class="flex items-center gap-2 text-prevanta-50"><input type="checkbox" name="remember" value="1" class="accent-prevanta-800"> Ingat saya</label>
            <span class="font-semibold text-white/75">Lupa kata sandi?</span>
        </div>
        <button type="submit" class="rounded-xl bg-white px-5 py-3.5 font-bold text-prevanta-700 shadow-lg transition hover:bg-prevanta-50">Masuk</button>
    </form>

    <div class="my-6 flex items-center gap-3 text-xs text-white/70">
        <span class="h-px flex-1 bg-white/25"></span>
        <span>Atau</span>
        <span class="h-px flex-1 bg-white/25"></span>
    </div>

    <p class="text-center text-sm text-prevanta-100">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-bold text-white underline underline-offset-4">Daftar sebagai Orang Tua</a>
    </p>
</x-auth-shell>
@endsection
