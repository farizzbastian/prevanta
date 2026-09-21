@extends('layouts.app')

@section('title', 'Masuk — Prevanta')

@section('content')
<main class="grid min-h-screen bg-white lg:grid-cols-[48%_52%]">
    <section class="relative hidden items-end justify-center overflow-hidden bg-[#fff9fa] p-12 lg:flex">
        <a href="{{ route('landing') }}" class="absolute left-10 top-9 flex items-center gap-3">
            <img src="{{ asset('assets/logo/prevanta-mark.svg') }}" alt="" class="size-11">
            <span class="text-2xl font-bold text-prevanta-700">Prevanta</span>
        </a>
        <img src="{{ asset('assets/images/family-illustration.svg') }}" alt="Ilustrasi keluarga sehat" class="max-h-[78vh] w-full max-w-xl object-contain">
    </section>

    <section class="relative flex items-center justify-center overflow-hidden bg-gradient-to-br from-prevanta-900 via-prevanta-700 to-prevanta-400 px-5 py-12 sm:px-10">
        <div class="absolute -left-28 top-[-5%] h-[110%] w-48 rounded-[50%] bg-white lg:block"></div>
        <div class="relative z-10 w-full max-w-md text-white">
            <a href="{{ route('landing') }}" class="mb-10 flex items-center gap-3 lg:hidden">
                <img src="{{ asset('assets/logo/prevanta-mark.svg') }}" alt="" class="size-10 rounded-full bg-white p-1">
                <span class="text-xl font-bold">Prevanta</span>
            </a>
            <p class="text-sm font-semibold text-prevanta-100">Selamat Datang</p>
            <h1 class="mt-2 text-4xl font-bold tracking-tight sm:text-5xl">Masuk ke Akun Anda</h1>
            <p class="mt-4 text-sm leading-6 text-prevanta-100">Pantau tumbuh kembang anak bersama Posyandu dengan mudah dan aman.</p>

            <form class="mt-8 grid gap-5" data-demo-form>
                <label class="grid gap-2 text-sm font-semibold">Email
                    <input type="email" placeholder="nama@email.com" required class="rounded-xl border border-white/20 bg-white px-4 py-3.5 text-ink-900 outline-none placeholder:text-stone-400 focus:ring-4 focus:ring-white/20">
                </label>
                <label class="grid gap-2 text-sm font-semibold">Kata Sandi
                    <input type="password" placeholder="Masukkan kata sandi" required class="rounded-xl border border-white/20 bg-white px-4 py-3.5 text-ink-900 outline-none placeholder:text-stone-400 focus:ring-4 focus:ring-white/20">
                </label>
                <a href="#" class="-mt-2 text-right text-xs font-semibold text-white/90">Lupa kata sandi?</a>
                <button class="rounded-xl bg-white px-5 py-3.5 font-bold text-prevanta-700 shadow-lg transition hover:bg-prevanta-50">Masuk</button>
                <p class="hidden rounded-xl bg-white/15 p-3 text-center text-sm" data-form-message>Mode frontend: formulir sudah siap dihubungkan ke backend.</p>
            </form>
            <div class="my-6 flex items-center gap-3 text-xs text-white/70"><span class="h-px flex-1 bg-white/25"></span>Atau<span class="h-px flex-1 bg-white/25"></span></div>
            <p class="text-center text-sm text-prevanta-100">Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-white underline underline-offset-4">Daftar sebagai Orang Tua</a></p>
        </div>
    </section>
</main>
@endsection
