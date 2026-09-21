@extends('layouts.app')

@section('title', 'Riwayat Imunisasi — Prevanta')

@section('content')
<x-portal-shell role="orang-tua" active="immunizations">
    <x-page-header eyebrow="Kesehatan Anak" title="Riwayat Imunisasi" description="Jadwal dan catatan imunisasi Arka Pratama.">
        <x-slot:actions><select class="rounded-xl border border-prevanta-100 bg-white px-4 py-2.5 text-sm font-semibold"><option>Arka Pratama</option><option>Aisyah Putri</option></select></x-slot:actions>
    </x-page-header>
    <div class="grid gap-4 sm:grid-cols-3"><x-metric-tile label="Sudah Diberikan" value="11 Imunisasi" icon="syringe" tone="mint" /><x-metric-tile label="Jadwal Berikutnya" value="MR 2" note="20 Oktober 2026" icon="calendar" /><x-metric-tile label="Status" value="Sesuai Jadwal" icon="clipboard" tone="blue" /></div>
    <x-card><div class="relative ml-3 border-l-2 border-prevanta-100 pl-8">@foreach ([['BCG & Polio 1','20 Juni 2024','Diberikan'],['DPT-HB-Hib 1','18 Juli 2024','Diberikan'],['DPT-HB-Hib 2','16 Agustus 2024','Diberikan'],['Campak Rubella 1','15 Februari 2025','Diberikan'],['MR 2','20 Oktober 2026','Akan Datang']] as [$name,$date,$status])<div class="relative pb-8 last:pb-0"><span class="absolute -left-[43px] top-1 grid size-6 place-items-center rounded-full {{ $status === 'Diberikan' ? 'bg-mint-500' : 'bg-prevanta-500' }} text-xs text-white">{{ $status === 'Diberikan' ? '✓' : '•' }}</span><div class="flex flex-wrap items-center justify-between gap-2"><div><h2 class="font-bold">{{ $name }}</h2><p class="mt-1 text-sm text-ink-500">{{ $date }} · Puskesmas Sukamaju</p></div><x-status-pill :tone="$status === 'Diberikan' ? 'green' : 'rose'">{{ $status }}</x-status-pill></div></div>@endforeach</div></x-card>
</x-portal-shell>
@endsection
