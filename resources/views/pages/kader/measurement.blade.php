@extends('layouts.app')

@section('title', 'Pengukuran Balita — Prevanta')

@section('content')
@php
    $ageTodayInDays = (int) $balita->tanggal_lahir->diffInDays(today());
    $currentIndicator = $ageTodayInDays <= 730 ? 'PB/U' : 'TB/U';
    $heightLabel = $ageTodayInDays <= 730 ? 'Panjang Badan (cm)' : 'Tinggi Badan (cm)';
    $maximumMeasurementDate = $balita->tanggal_lahir->copy()->addDays(1856)->min(today())->toDateString();
@endphp

<x-portal-shell role="kader" active="monitoring" class="max-w-5xl">
    <x-page-header eyebrow="Pencatatan KMS" title="Pengukuran Balita" :description="'Masukkan hasil pengukuran '.$balita->nama.'. Z-score dan status pertumbuhan akan dihitung otomatis.'" />

    <x-card class="bg-prevanta-50">
        <div class="flex items-center gap-4">
            <div class="grid size-14 place-items-center rounded-full bg-white text-xl font-bold text-prevanta-700">{{ mb_substr($balita->nama, 0, 1) }}</div>
            <div>
                <h2 class="font-bold">{{ $balita->nama }}</h2>
                <p class="mt-1 text-xs text-ink-500">{{ $balita->jenis_kelamin->label() }} · {{ $balita->tanggal_lahir->diffForHumans(['parts' => 2]) }} · Pengukuran terakhir {{ $balita->pengukuranTerbaru?->tanggal_pengukuran->translatedFormat('d M Y') ?? 'belum ada' }}</p>
            </div>
        </div>
    </x-card>

    <aside class="rounded-2xl border border-mint-100 bg-mint-50 p-4 text-sm text-ink-700" aria-label="Informasi perhitungan otomatis">
        <div class="flex items-start gap-3">
            <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-white text-mint-600"><x-icon name="chart" class="size-5" /></span>
            <div>
                <h2 class="font-bold text-ink-900">Z-score {{ $currentIndicator }} dihitung otomatis berdasarkan standar WHO</h2>
                <p class="mt-1 leading-6">Sistem memakai usia tepat pada tanggal pengukuran, jenis kelamin, serta panjang/tinggi badan. Usia 0–730 hari menggunakan PB/U dan usia 731–1856 hari menggunakan TB/U.</p>
                <p class="mt-2 text-xs font-semibold">Normal: ≥ -2 SD · Pendek: ≥ -3 hingga &lt; -2 SD · Sangat Pendek: &lt; -3 SD</p>
            </div>
        </div>
    </aside>

    <form method="POST" action="{{ route('kader.measurements.store', $balita) }}" enctype="multipart/form-data" class="grid gap-5">
        @csrf
        <x-card>
            <h2 class="font-bold">Hasil Pengukuran</h2>
            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <x-form-field label="Tanggal Pengukuran" name="tanggal_pengukuran" type="date" :min="$balita->tanggal_lahir->toDateString()" :max="$maximumMeasurementDate" required />
                <x-form-field label="Berat Badan (kg)" name="berat_badan" type="number" step="0.01" min="1" max="40" placeholder="11.8" required />
                <x-form-field :label="$heightLabel.' — indikator '.$currentIndicator" name="tinggi_badan" type="number" step="0.01" min="30" max="130" placeholder="86" required />
                <x-form-field label="Lingkar Kepala (cm)" name="lingkar_kepala" type="number" step="0.01" min="20" max="70" placeholder="47" />
                <x-form-field label="Lingkar Lengan Atas (cm)" name="lingkar_lengan_atas" type="number" step="0.01" min="5" max="40" placeholder="14.5" />
                <label class="grid gap-2 text-sm font-semibold text-ink-700">
                    Foto Pengukuran
                    <input type="file" name="foto" accept="image/png,image/jpeg,image/webp" class="rounded-xl border border-prevanta-100 bg-[#fcfafb] px-4 py-3 font-normal">
                    @error('foto')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                </label>
            </div>
        </x-card>

        <div class="flex justify-end gap-3">
            <a href="{{ route('kader.child-profile', $balita) }}" class="rounded-xl border border-prevanta-200 px-5 py-3 text-sm font-bold text-prevanta-700">Batal</a>
            <button type="submit" class="rounded-xl bg-prevanta-600 px-5 py-3 text-sm font-bold text-white">Hitung &amp; Simpan Pengukuran</button>
        </div>
    </form>
</x-portal-shell>
@endsection
