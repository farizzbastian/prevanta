@extends('layouts.app')

@section('title', 'Riwayat Imunisasi — Prevanta')

@section('content')
<x-portal-shell role="orang-tua" active="immunizations">
    <x-page-header eyebrow="Kesehatan Anak" title="Riwayat Imunisasi" :description="$selectedChild ? 'Catatan imunisasi '.$selectedChild->nama.'.' : 'Belum ada data anak.'">
        <x-slot:actions><form method="GET"><select name="balita" onchange="this.form.submit()" class="rounded-xl border border-prevanta-100 bg-white px-4 py-2.5 text-sm font-semibold">@foreach ($children as $child)<option value="{{ $child->id }}" @selected($selectedChild?->is($child))>{{ $child->nama }}</option>@endforeach</select></form></x-slot:actions>
    </x-page-header>
    <div class="grid gap-4 sm:grid-cols-3"><x-metric-tile label="Sudah Diberikan" :value="($selectedChild?->imunisasi?->count() ?? 0).' Imunisasi'" icon="syringe" tone="mint" /><x-metric-tile label="Vitamin" :value="($selectedChild?->vitamin?->count() ?? 0).' Pemberian'" note="Riwayat vitamin" icon="calendar" /><x-metric-tile label="Status" :value="$selectedChild?->imunisasi?->isNotEmpty() ? 'Tercatat' : 'Belum Ada'" icon="clipboard" tone="blue" /></div>
    <x-card><div class="relative ml-3 border-l-2 border-prevanta-100 pl-8">@forelse ($selectedChild?->imunisasi ?? [] as $immunization)<div class="relative pb-8 last:pb-0"><span class="absolute -left-[43px] top-1 grid size-6 place-items-center rounded-full bg-mint-500 text-xs text-white">✓</span><div class="flex flex-wrap items-center justify-between gap-2"><div><h2 class="font-bold">{{ $immunization->jenisImunisasi->nama_imunisasi }}</h2><p class="mt-1 text-sm text-ink-500">{{ $immunization->tanggal_pemberian->translatedFormat('d F Y') }} · Posyandu Mawar Melati</p></div><x-status-pill tone="green">{{ str($immunization->status)->headline() }}</x-status-pill></div></div>@empty<p class="py-5 text-sm text-ink-500">Belum ada riwayat imunisasi.</p>@endforelse</div></x-card>
</x-portal-shell>
@endsection
