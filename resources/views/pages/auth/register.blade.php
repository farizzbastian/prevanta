@extends('layouts.app')

@section('title', 'Daftar — Prevanta')

@section('content')
<main class="grid min-h-screen bg-white lg:grid-cols-[46%_54%]">
    <section class="relative hidden items-end justify-center overflow-hidden bg-[#fff9fa] p-12 lg:flex">
        <a href="{{ route('landing') }}" class="absolute left-10 top-9 flex items-center gap-3">
            <img src="{{ asset('assets/logo/prevanta-mark.svg') }}" alt="" class="size-11">
            <span class="text-2xl font-bold text-prevanta-700">Prevanta</span>
        </a>
        <img src="{{ asset('assets/images/family-illustration.svg') }}" alt="Ilustrasi keluarga sehat" class="max-h-[78vh] w-full max-w-xl object-contain">
    </section>

    <section class="flex items-center justify-center bg-gradient-to-br from-prevanta-800 via-prevanta-600 to-prevanta-300 px-5 py-10 sm:px-10">
        <div class="w-full max-w-xl text-white">
            <p class="text-sm font-semibold text-prevanta-100">Bergabung dengan Prevanta</p>
            <h1 class="mt-2 text-4xl font-bold tracking-tight">Buat Akun Orang Tua</h1>
            <p class="mt-3 text-sm text-prevanta-100">Isi data berikut untuk mulai memantau tumbuh kembang buah hati.</p>
            <form class="mt-7 grid gap-4 sm:grid-cols-2" data-demo-form>
                <label class="grid gap-2 text-sm font-semibold sm:col-span-2">Nama Lengkap
                    <input type="text" placeholder="Nama orang tua" required class="rounded-xl bg-white px-4 py-3 text-ink-900 outline-none focus:ring-4 focus:ring-white/20">
                </label>
                <label class="grid gap-2 text-sm font-semibold">Email
                    <input type="email" placeholder="nama@email.com" required class="rounded-xl bg-white px-4 py-3 text-ink-900 outline-none focus:ring-4 focus:ring-white/20">
                </label>
                <label class="grid gap-2 text-sm font-semibold">Nomor WhatsApp
                    <input type="tel" placeholder="08xxxxxxxxxx" required class="rounded-xl bg-white px-4 py-3 text-ink-900 outline-none focus:ring-4 focus:ring-white/20">
                </label>
                <label class="grid gap-2 text-sm font-semibold">Kata Sandi
                    <input type="password" placeholder="Minimal 8 karakter" required class="rounded-xl bg-white px-4 py-3 text-ink-900 outline-none focus:ring-4 focus:ring-white/20">
                </label>
                <label class="grid gap-2 text-sm font-semibold">Konfirmasi Kata Sandi
                    <input type="password" placeholder="Ulangi kata sandi" required class="rounded-xl bg-white px-4 py-3 text-ink-900 outline-none focus:ring-4 focus:ring-white/20">
                </label>
                <label class="flex items-start gap-3 text-xs leading-5 text-prevanta-50 sm:col-span-2"><input type="checkbox" required class="mt-1 accent-prevanta-800">Saya menyetujui syarat penggunaan dan kebijakan privasi Prevanta.</label>
                <button class="rounded-xl bg-white px-5 py-3.5 font-bold text-prevanta-700 shadow-lg sm:col-span-2">Daftar Sekarang</button>
                <p class="hidden rounded-xl bg-white/15 p-3 text-center text-sm sm:col-span-2" data-form-message>Mode frontend: data tidak dikirim ke server.</p>
            </form>
            <p class="mt-6 text-center text-sm text-prevanta-100">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-white underline underline-offset-4">Masuk</a></p>
        </div>
    </section>
</main>
@endsection
