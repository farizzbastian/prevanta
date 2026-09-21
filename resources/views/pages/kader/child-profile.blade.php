@extends('layouts.app')

@section('title', 'Profil Balita Kader — Prevanta')

@section('content')
<x-portal-shell role="kader" active="monitoring">
    <x-page-header eyebrow="Profil Balita" title="Arka Pratama" description="Data identitas dan riwayat pengukuran balita."><x-slot:actions><a href="{{ route('kader.measurement') }}" class="rounded-xl bg-prevanta-600 px-4 py-2.5 text-sm font-bold text-white">Input Pengukuran</a></x-slot:actions></x-page-header>
    <x-card><div class="flex flex-col gap-5 md:flex-row md:items-center"><div class="grid size-24 place-items-center rounded-full bg-prevanta-100 text-3xl font-bold text-prevanta-700">A</div><div class="flex-1"><div class="flex flex-wrap items-center gap-2"><h2 class="text-2xl font-bold">Arka Pratama</h2><x-status-pill tone="green">Normal</x-status-pill></div><p class="mt-2 text-sm text-ink-500">Laki-laki · 2 tahun 4 bulan · Anak dari Ibu Siti Rahayu</p><p class="mt-1 text-xs text-ink-500">NIK 3204••••••1287 · RT 04 / RW 03, Desa Sukamaju</p></div></div></x-card>
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4"><x-metric-tile label="Berat Badan" value="11,8 kg" note="Normal" icon="chart" /><x-metric-tile label="Tinggi Badan" value="86 cm" note="Normal" icon="chart" tone="mint" /><x-metric-tile label="Lingkar Kepala" value="47 cm" icon="users" tone="blue" /><x-metric-tile label="Pengukuran" value="12 Sep" note="Terakhir diperbarui" icon="calendar" tone="sand" /></div>
    <div class="grid gap-5 xl:grid-cols-[1.5fr_1fr]"><x-growth-chart title="Grafik KMS" /><x-card><h2 class="font-bold">Data Orang Tua</h2><dl class="mt-5 grid gap-4 text-sm">@foreach ([['Nama Ibu','Siti Rahayu'],['Nomor HP','0812 •••• 2981'],['Alamat','RT 04 / RW 03'],['Bidan Pendamping','Bdn. Dewi Anggraini']] as [$label,$value])<div><dt class="text-xs text-ink-500">{{ $label }}</dt><dd class="mt-1 font-semibold">{{ $value }}</dd></div>@endforeach</dl></x-card></div>
</x-portal-shell>
@endsection
