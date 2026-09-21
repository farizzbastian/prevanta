@extends('layouts.app')

@section('title', 'Profil Anak — Prevanta')

@section('content')
<x-portal-shell role="orang-tua" active="children">
    <x-page-header eyebrow="Profil Anak" title="Arka Pratama" description="Data tumbuh kembang dan status kesehatan anak.">
        <x-slot:actions><a href="{{ route('parent.children') }}" class="rounded-xl border border-prevanta-200 bg-white px-4 py-2.5 text-sm font-bold text-prevanta-700">← Kembali</a></x-slot:actions>
    </x-page-header>

    <x-card class="bg-gradient-to-r from-white to-prevanta-50">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
            <div class="grid size-24 place-items-center rounded-full bg-prevanta-100 text-4xl font-bold text-prevanta-700">A</div>
            <div class="flex-1"><div class="flex flex-wrap items-center gap-2"><h2 class="text-2xl font-bold">Arka Pratama</h2><x-status-pill tone="green">Pertumbuhan Normal</x-status-pill></div><p class="mt-2 text-sm text-ink-500">Laki-laki · 2 tahun 4 bulan · NIK 3204••••••1287</p><p class="mt-1 text-xs text-ink-500">Posyandu Mawar Melati · Ibu: Siti Rahayu</p></div>
        </div>
    </x-card>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-metric-tile label="Berat Badan" value="11,8 kg" note="Naik 0,3 kg" icon="chart" />
        <x-metric-tile label="Tinggi Badan" value="86 cm" note="Naik 1,2 cm" icon="chart" tone="mint" />
        <x-metric-tile label="Lingkar Kepala" value="47 cm" note="Dalam rentang normal" icon="users" tone="blue" />
        <x-metric-tile label="Status Gizi" value="Baik" note="BB/U normal" icon="clipboard" tone="sand" />
    </div>

    <div class="grid gap-5 xl:grid-cols-[1.5fr_1fr]"><x-growth-chart title="Kartu Menuju Sehat" subtitle="Perbandingan berat dan tinggi menurut usia" /><x-card><h2 class="font-bold">Informasi Anak</h2><dl class="mt-5 grid gap-4 text-sm">@foreach ([['Tanggal Lahir','12 Mei 2024'],['Berat Lahir','3,1 kg'],['Tinggi Lahir','49 cm'],['Golongan Darah','O'],['Pengukuran Terakhir','12 September 2026']] as [$label,$value])<div class="flex justify-between gap-3 border-b border-prevanta-50 pb-3"><dt class="text-ink-500">{{ $label }}</dt><dd class="font-semibold text-ink-900">{{ $value }}</dd></div>@endforeach</dl></x-card></div>
</x-portal-shell>
@endsection
