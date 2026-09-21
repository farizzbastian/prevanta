@extends('layouts.app')

@section('title', 'Tambah Balita — Prevanta')

@section('content')
<x-portal-shell role="kader" active="monitoring" class="max-w-5xl">
    <x-page-header eyebrow="Data Baru" title="Tambah Balita" description="Lengkapi data identitas balita dan orang tua sesuai dokumen keluarga." />
    <form class="grid gap-5" data-demo-form>
        <x-card><h2 class="font-bold">Identitas Balita</h2><div class="mt-5 grid gap-4 sm:grid-cols-2"><x-form-field label="Nama Lengkap" name="child_name" placeholder="Nama sesuai Kartu Keluarga" required /><x-form-field label="NIK Anak" name="child_nik" placeholder="16 digit NIK" required /><x-form-field label="Tanggal Lahir" name="birth_date" type="date" required /><label class="grid gap-2 text-sm font-semibold text-ink-700">Jenis Kelamin<select class="rounded-xl border border-prevanta-100 bg-[#fcfafb] px-4 py-3 font-normal"><option>Laki-laki</option><option>Perempuan</option></select></label><x-form-field label="Berat Lahir (kg)" name="birth_weight" type="number" placeholder="3.2" /><x-form-field label="Tinggi Lahir (cm)" name="birth_height" type="number" placeholder="49" /></div></x-card>
        <x-card><h2 class="font-bold">Data Orang Tua</h2><div class="mt-5 grid gap-4 sm:grid-cols-2"><x-form-field label="Nama Ibu" name="mother_name" placeholder="Nama lengkap ibu" required /><x-form-field label="Nomor WhatsApp" name="phone" type="tel" placeholder="08xxxxxxxxxx" required /><x-form-field label="Nomor Kartu Keluarga" name="family_card" placeholder="16 digit nomor KK" /><x-form-field label="Alamat" name="address" placeholder="RT / RW, desa" required /></div></x-card>
        <p class="hidden rounded-xl bg-mint-50 p-4 text-sm font-semibold text-mint-600" data-form-message>Data demo berhasil disiapkan. Belum ada data yang disimpan.</p><div class="flex justify-end gap-3"><a href="{{ route('kader.monitoring') }}" class="rounded-xl border border-prevanta-200 px-5 py-3 text-sm font-bold text-prevanta-700">Batal</a><button class="rounded-xl bg-prevanta-600 px-5 py-3 text-sm font-bold text-white">Simpan Balita</button></div>
    </form>
</x-portal-shell>
@endsection
