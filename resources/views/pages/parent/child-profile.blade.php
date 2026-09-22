@extends('layouts.app')

@section('title', 'Profil Anak — Prevanta')

@section('content')
<x-portal-shell role="orang-tua" active="children">
    @php($latest = $balita->pengukuran->last())
    <x-page-header eyebrow="Profil Anak" :title="$balita->nama" description="Data tumbuh kembang dan status kesehatan anak.">
        <x-slot:actions><a href="{{ route('parent.children') }}" class="rounded-xl border border-prevanta-200 bg-white px-4 py-2.5 text-sm font-bold text-prevanta-700">← Kembali</a></x-slot:actions>
    </x-page-header>

    <x-card class="bg-gradient-to-r from-white to-prevanta-50">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
            <div class="grid size-24 place-items-center rounded-full bg-prevanta-100 text-4xl font-bold text-prevanta-700">{{ mb_substr($balita->nama, 0, 1) }}</div>
            <div class="flex-1"><div class="flex flex-wrap items-center gap-2"><h2 class="text-2xl font-bold">{{ $balita->nama }}</h2><x-status-pill :tone="$latest?->status_pertumbuhan === \App\GrowthStatus::Normal ? 'green' : 'amber'">{{ $latest?->status_pertumbuhan?->label() ?? 'Belum Diukur' }}</x-status-pill></div><p class="mt-2 text-sm text-ink-500">{{ $balita->jenis_kelamin->label() }} · {{ $balita->tanggal_lahir->diffForHumans(['parts' => 2]) }} · NIK {{ mb_substr($balita->nik, 0, 4) }}••••••{{ mb_substr($balita->nik, -4) }}</p><p class="mt-1 text-xs text-ink-500">Posyandu Mawar Melati · Orang Tua: {{ $balita->orangTua->user->name }}</p></div>
        </div>
    </x-card>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-metric-tile label="Berat Badan" :value="$latest ? $latest->berat_badan.' kg' : '—'" note="Pengukuran terbaru" icon="chart" />
        <x-metric-tile label="Tinggi Badan" :value="$latest ? $latest->tinggi_badan.' cm' : '—'" note="Pengukuran terbaru" icon="chart" tone="mint" />
        <x-metric-tile label="Lingkar Kepala" :value="$latest?->lingkar_kepala ? $latest->lingkar_kepala.' cm' : '—'" note="Pengukuran terbaru" icon="users" tone="blue" />
        <x-metric-tile label="Status Gizi" :value="$latest?->status_pertumbuhan?->label() ?? 'Belum Diukur'" :note="$latest?->z_score ? 'Z-score '.$latest->z_score : 'Belum tersedia'" icon="clipboard" tone="sand" />
    </div>

    <div class="grid gap-5 xl:grid-cols-[1.5fr_1fr]"><x-growth-chart title="Kartu Menuju Sehat" subtitle="Perbandingan berat dan tinggi menurut usia" :measurements="$balita->pengukuran" /><x-card><h2 class="font-bold">Informasi Anak</h2><dl class="mt-5 grid gap-4 text-sm">@foreach ([['Tanggal Lahir',$balita->tanggal_lahir->translatedFormat('d F Y')],['Jenis Kelamin',$balita->jenis_kelamin->label()],['Alamat',$balita->alamat],['Jumlah Imunisasi',$balita->imunisasi->count().' catatan'],['Pengukuran Terakhir',$latest?->tanggal_pengukuran->translatedFormat('d F Y') ?? 'Belum ada']] as [$label,$value])<div class="flex justify-between gap-3 border-b border-prevanta-50 pb-3"><dt class="text-ink-500">{{ $label }}</dt><dd class="text-right font-semibold text-ink-900">{{ $value }}</dd></div>@endforeach</dl></x-card></div>
</x-portal-shell>
@endsection
