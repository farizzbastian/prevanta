@extends('layouts.app')

@section('title', 'Tambah Balita — Prevanta')

@section('content')
<x-portal-shell role="kader" active="monitoring" class="max-w-5xl">
    <x-page-header eyebrow="Data Baru" title="Tambah Balita" description="Lengkapi data identitas balita dan orang tua sesuai dokumen keluarga." />
    <form method="POST" action="{{ route('kader.children.store') }}" class="grid gap-5">
        @csrf
        <x-card><h2 class="font-bold">Identitas Balita</h2><div class="mt-5 grid gap-4 sm:grid-cols-2"><x-form-field label="Nama Lengkap" name="nama" placeholder="Nama sesuai Kartu Keluarga" required /><x-form-field label="NIK Anak" name="nik" placeholder="16 digit NIK" required /><x-form-field label="Tanggal Lahir" name="tanggal_lahir" type="date" required /><label class="grid gap-2 text-sm font-semibold text-ink-700">Jenis Kelamin<select name="jenis_kelamin" required class="rounded-xl border border-prevanta-100 bg-[#fcfafb] px-4 py-3 font-normal"><option value="">Pilih jenis kelamin</option>@foreach (\App\Gender::cases() as $gender)<option value="{{ $gender->value }}" @selected(old('jenis_kelamin') === $gender->value)>{{ $gender->label() }}</option>@endforeach</select>@error('jenis_kelamin')<span class="text-xs text-red-600">{{ $message }}</span>@enderror</label></div><label class="mt-4 grid gap-2 text-sm font-semibold text-ink-700">Alamat<textarea name="alamat" rows="3" required class="rounded-xl border border-prevanta-100 bg-[#fcfafb] px-4 py-3 font-normal outline-none focus:border-prevanta-400">{{ old('alamat') }}</textarea>@error('alamat')<span class="text-xs text-red-600">{{ $message }}</span>@enderror</label></x-card>
        <x-card><h2 class="font-bold">Akun Orang Tua</h2><label class="mt-5 grid gap-2 text-sm font-semibold text-ink-700">Pilih Orang Tua<select name="orang_tua_id" required class="rounded-xl border border-prevanta-100 bg-[#fcfafb] px-4 py-3 font-normal"><option value="">Pilih akun yang sudah terdaftar</option>@foreach ($parents as $parent)<option value="{{ $parent->id }}" @selected((string) old('orang_tua_id') === (string) $parent->id)>{{ $parent->user->name }} · {{ $parent->user->no_hp }}</option>@endforeach</select>@error('orang_tua_id')<span class="text-xs text-red-600">{{ $message }}</span>@enderror</label></x-card>
        <div class="flex justify-end gap-3"><a href="{{ route('kader.monitoring') }}" class="rounded-xl border border-prevanta-200 px-5 py-3 text-sm font-bold text-prevanta-700">Batal</a><button type="submit" class="rounded-xl bg-prevanta-600 px-5 py-3 text-sm font-bold text-white">Simpan Balita</button></div>
    </form>
</x-portal-shell>
@endsection
