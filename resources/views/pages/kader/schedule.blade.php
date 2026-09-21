@extends('layouts.app')

@section('title', 'Jadwal Kader — Prevanta')

@section('content')
<x-portal-shell role="kader" active="schedule">
    <x-page-header eyebrow="Agenda Posyandu" title="Jadwal Kegiatan" description="Kelola agenda pelayanan dan kunjungan kader Posyandu Mawar Melati." />
    <div class="grid gap-5 xl:grid-cols-[1.3fr_1fr]">
        <x-card><div class="flex items-center justify-between"><div><h2 class="text-xl font-bold">September 2026</h2><p class="mt-1 text-xs text-ink-500">Kalender kegiatan Posyandu</p></div><div class="flex gap-2"><button class="grid size-9 place-items-center rounded-lg border border-prevanta-100">‹</button><button class="grid size-9 place-items-center rounded-lg border border-prevanta-100">›</button></div></div><div class="mt-6 grid grid-cols-7 gap-2 text-center text-xs">@foreach (['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $day)<span class="py-2 font-bold text-ink-500">{{ $day }}</span>@endforeach @foreach (range(1,35) as $date)<button class="aspect-square rounded-xl {{ in_array($date,[12,18,28]) ? 'bg-prevanta-600 font-bold text-white' : 'hover:bg-prevanta-50' }}">{{ $date <= 30 ? $date : $date - 30 }}</button>@endforeach</div></x-card>
        <div class="grid content-start gap-4"><h2 class="font-bold">Agenda Mendatang</h2>@foreach ([['Pelayanan Posyandu Bulanan','28 September · 08.00–12.00','Posyandu Mawar Melati'],['Kunjungan Rumah Balita','2 Oktober · 09.00','RT 04 / RW 03'],['Kelas Ibu Balita','8 Oktober · 10.00','Balai Desa Sukamaju']] as [$title,$time,$place])<x-card padding="p-4"><div class="flex gap-3"><span class="grid size-11 shrink-0 place-items-center rounded-xl bg-prevanta-50 text-prevanta-600"><x-icon name="calendar" /></span><div><h3 class="text-sm font-bold">{{ $title }}</h3><p class="mt-1 text-xs text-ink-500">{{ $time }}</p><p class="mt-1 text-[11px] text-ink-500">{{ $place }}</p></div></div></x-card>@endforeach</div>
    </div>
</x-portal-shell>
@endsection
