@extends('layouts.app')

@section('title', 'Anakku — Prevanta')

@section('content')
<x-portal-shell role="orang-tua" active="children">
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-prevanta-800 to-prevanta-500 p-6 text-white sm:p-8">
        <div class="relative z-10 max-w-2xl"><p class="text-sm font-semibold text-prevanta-100">Halo, {{ auth()->user()->name }} 👋</p><h1 class="mt-2 text-3xl font-bold sm:text-4xl">Selamat Datang di Portal Anakku</h1><p class="mt-3 max-w-xl text-sm leading-6 text-prevanta-100">Pantau pertumbuhan buah hati, lihat jadwal berikutnya, serta temukan edukasi sesuai usianya.</p></div>
        <div class="absolute -bottom-20 -right-12 size-64 rounded-full bg-white/10"></div>
    </section>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-metric-tile label="Total Anak" :value="$children->count().' Anak'" note="Terhubung ke Posyandu" icon="users" />
        <x-metric-tile label="Status Pertumbuhan" :value="$children->first()?->pengukuranTerbaru?->status_pertumbuhan?->label() ?? 'Belum Diukur'" note="Pengukuran terbaru" icon="chart" tone="mint" />
        <x-metric-tile label="Imunisasi" :value="$children->sum('imunisasi_count').' Catatan'" note="Riwayat semua anak" icon="syringe" tone="blue" />
        <x-metric-tile label="Jadwal Berikutnya" :value="$nextSchedule?->tanggal->translatedFormat('d M') ?? 'Belum Ada'" :note="$nextSchedule?->lokasi ?? 'Jadwal belum tersedia'" icon="calendar" tone="sand" />
    </div>

    <x-page-header title="Profil Anak" description="Pilih anak untuk melihat informasi pertumbuhan lebih lengkap." />
    <div class="grid gap-4">
        @forelse ($children as $child)
            @php
                $measurement = $child->pengukuranTerbaru;
                $months = $child->tanggal_lahir->diffInMonths(today());
                $age = $months >= 12 ? intdiv($months, 12).' tahun '.($months % 12).' bulan' : $months.' bulan';
            @endphp
            <x-child-card
                :name="$child->nama"
                :age="$age"
                :status="$measurement?->status_pertumbuhan?->label() ?? 'Belum Diukur'"
                :updated="$measurement?->tanggal_pengukuran->translatedFormat('d M Y') ?? 'Belum ada'"
                :weight="$measurement ? $measurement->berat_badan.' kg' : '—'"
                :height="$measurement ? $measurement->tinggi_badan.' cm' : '—'"
                :head="$measurement?->lingkar_kepala ? $measurement->lingkar_kepala.' cm' : '—'"
            ><a href="{{ route('parent.child-profile', $child) }}" class="rounded-xl bg-prevanta-600 px-4 py-2.5 text-center text-sm font-bold text-white">Lihat Profil</a></x-child-card>
        @empty
            <x-card><p class="text-sm text-ink-500">Belum ada balita yang terhubung dengan akun ini. Hubungi kader Posyandu untuk menambahkan data anak.</p></x-card>
        @endforelse
    </div>
</x-portal-shell>
@endsection
