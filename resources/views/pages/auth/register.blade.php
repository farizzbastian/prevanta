@extends('layouts.app')

@section('title', 'Daftar — Prevanta')

@section('content')
<x-auth-shell
    eyebrow="Bergabung dengan Prevanta"
    heading="Buat Akun Orang Tua"
    description="Isi data berikut untuk mulai memantau tumbuh kembang buah hati."
    content-width="max-w-lg"
>
    <form method="POST" action="{{ route('register.store') }}" class="mt-8 grid gap-4 sm:grid-cols-2">
        @csrf
        <x-auth-field wrapper-class="sm:col-span-2" label="Nama Lengkap" name="name" placeholder="Nama orang tua" autocomplete="name" />
        <x-auth-field label="Email" name="email" type="email" placeholder="nama@email.com" autocomplete="email" />
        <x-auth-field label="Nomor WhatsApp" name="no_hp" type="tel" placeholder="08xxxxxxxxxx" autocomplete="tel" />
        <x-auth-field wrapper-class="sm:col-span-2" label="NIK" name="nik" placeholder="16 digit NIK" />

        <label class="grid gap-2 text-sm font-semibold text-white">Jenis Kelamin
            <select name="jenis_kelamin" required class="rounded-xl border border-white/20 bg-white px-4 py-3.5 font-normal text-ink-900 outline-none focus:ring-4 focus:ring-white/20">
                <option value="">Pilih jenis kelamin</option>
                @foreach ($genders as $gender)
                    <option value="{{ $gender->value }}" @selected(old('jenis_kelamin') === $gender->value)>{{ $gender->label() }}</option>
                @endforeach
            </select>
            @error('jenis_kelamin')<span class="text-xs text-[#ffe1e7]">{{ $message }}</span>@enderror
        </label>

        <label class="grid gap-2 text-sm font-semibold text-white">Hubungan dengan Balita
            <select name="hubungan_dengan_balita" required class="rounded-xl border border-white/20 bg-white px-4 py-3.5 font-normal text-ink-900 outline-none focus:ring-4 focus:ring-white/20">
                <option value="">Pilih hubungan</option>
                @foreach (['ibu' => 'Ibu', 'ayah' => 'Ayah', 'wali' => 'Wali'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('hubungan_dengan_balita') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('hubungan_dengan_balita')<span class="text-xs text-[#ffe1e7]">{{ $message }}</span>@enderror
        </label>

        <x-auth-field label="Kata Sandi" name="password" type="password" placeholder="Minimal 8 karakter" autocomplete="new-password" />
        <x-auth-field label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Ulangi kata sandi" autocomplete="new-password" />

        <label class="flex items-start gap-3 text-xs leading-5 text-prevanta-50 sm:col-span-2">
            <input type="checkbox" name="terms" value="1" required class="mt-1 accent-prevanta-800" @checked(old('terms'))>
            <span>Saya menyetujui syarat penggunaan dan kebijakan privasi Prevanta.</span>
        </label>

        <button type="submit" class="rounded-xl bg-white px-5 py-3.5 font-bold text-prevanta-700 shadow-lg transition hover:bg-prevanta-50 sm:col-span-2">Daftar Sekarang</button>
    </form>

    <div class="my-6 flex items-center gap-3 text-xs text-white/70">
        <span class="h-px flex-1 bg-white/25"></span>
        <span>Atau</span>
        <span class="h-px flex-1 bg-white/25"></span>
    </div>

    <p class="text-center text-sm text-prevanta-100">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-bold text-white underline underline-offset-4">Masuk</a>
    </p>
</x-auth-shell>
@endsection
