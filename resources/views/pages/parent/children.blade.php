@extends('layouts.app')

@section('title', 'Anakku — Prevanta')

@section('content')
<x-portal-shell role="orang-tua" active="children">
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-prevanta-800 to-prevanta-500 p-6 text-white sm:p-8">
        <div class="relative z-10 max-w-2xl"><p class="text-sm font-semibold text-prevanta-100">Halo, Ibu Siti 👋</p><h1 class="mt-2 text-3xl font-bold sm:text-4xl">Selamat Datang di Portal Anakku</h1><p class="mt-3 max-w-xl text-sm leading-6 text-prevanta-100">Pantau pertumbuhan Arka dan Aisyah, lihat jadwal berikutnya, serta temukan edukasi sesuai usia mereka.</p></div>
        <div class="absolute -bottom-20 -right-12 size-64 rounded-full bg-white/10"></div>
    </section>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-metric-tile label="Total Anak" value="2 Anak" note="Terhubung ke Posyandu" icon="users" />
        <x-metric-tile label="Status Pertumbuhan" value="Normal" note="Pengukuran terbaru" icon="chart" tone="mint" />
        <x-metric-tile label="Imunisasi" value="Lengkap" note="Sesuai usia" icon="syringe" tone="blue" />
        <x-metric-tile label="Jadwal Berikutnya" value="28 Sep" note="Posyandu Mawar Melati" icon="calendar" tone="sand" />
    </div>

    <x-page-header title="Profil Anak" description="Pilih anak untuk melihat informasi pertumbuhan lebih lengkap." />
    <div class="grid gap-4">
        <x-child-card name="Arka Pratama" age="2 tahun 4 bulan"><a href="{{ route('parent.child-profile') }}" class="rounded-xl bg-prevanta-600 px-4 py-2.5 text-center text-sm font-bold text-white">Lihat Profil</a></x-child-card>
        <x-child-card name="Aisyah Putri" age="10 bulan" status="Perlu Dipantau" updated="28 Agu 2026"><a href="{{ route('parent.child-profile') }}" class="rounded-xl bg-prevanta-600 px-4 py-2.5 text-center text-sm font-bold text-white">Lihat Profil</a></x-child-card>
    </div>
</x-portal-shell>
@endsection
