@extends('layouts.app')

@section('title', 'Dashboard Bidan — Prevanta')

@section('content')
<x-portal-shell role="bidan" active="dashboard">
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-prevanta-900 to-prevanta-500 p-7 text-white">
        <p class="text-sm font-semibold text-prevanta-100">Portal pemantauan wilayah Posyandu</p>
        <h1 class="mt-2 text-3xl font-bold">Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-prevanta-100">Tinjau data pertumbuhan, verifikasi hasil pengukuran, dan pantau prevalensi stunting wilayah kerja Anda.</p>
        <span class="absolute -bottom-20 -right-8 size-64 rounded-full bg-white/10"></span>
    </section>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <x-metric-tile label="Total Balita" :value="$metrics['total']" note="Terdaftar di sistem" icon="users" />
        <x-metric-tile label="Pengukuran Bulan Ini" :value="$metrics['measured']" note="Data pengukuran masuk" icon="clipboard" tone="mint" />
        <x-metric-tile label="Menunggu Verifikasi" :value="$metrics['pending']" note="Perlu ditinjau" icon="history" tone="sand" />
        <x-metric-tile label="Pertumbuhan Normal" :value="$metrics['normal']" note="Z-score ≥ -2 SD" icon="chart" tone="mint" />
        <x-metric-tile label="Pendek (Stunted)" :value="$metrics['short']" note="-3 SD ≤ Z-score < -2 SD" icon="bell" tone="sand" />
        <x-metric-tile label="Sangat Pendek" :value="$metrics['severelyShort']" note="Z-score < -3 SD" icon="clipboard" tone="rose" />
    </div>

    <div class="grid gap-5 xl:grid-cols-[1.55fr_1fr]">
        <x-growth-chart title="Tren Pengukuran Balita" subtitle="Data pengukuran terbaru pada sistem" />
        <x-card>
            <div class="flex items-center justify-between">
                <h2 class="font-bold">Tindakan Cepat</h2>
                <x-status-pill tone="rose">{{ $metrics['pending'] }} antrean</x-status-pill>
            </div>
            <div class="mt-5 grid gap-3">
                <a href="{{ route('bidan.verification') }}" class="rounded-xl bg-prevanta-600 px-4 py-3 text-center text-sm font-bold text-white">Buka Antrean Verifikasi</a>
                <a href="{{ route('bidan.history') }}" class="rounded-xl border border-prevanta-200 bg-white px-4 py-3 text-center text-sm font-bold text-prevanta-700">Lihat Riwayat Pengukuran</a>
                <a href="{{ route('bidan.portal') }}" class="rounded-xl border border-prevanta-200 bg-white px-4 py-3 text-center text-sm font-bold text-prevanta-700">Buka Portal Bidan</a>
            </div>
        </x-card>
    </div>
</x-portal-shell>
@endsection
