@extends('layouts.app')

@section('title', 'Jadwal Kader — Prevanta')

@section('content')
<x-portal-shell role="kader" active="schedule">
    <x-page-header eyebrow="Agenda Posyandu" title="Jadwal Kegiatan" description="Kelola agenda pelayanan dan kunjungan kader Posyandu Mawar Melati." />
    <div class="grid gap-5 xl:grid-cols-[1.3fr_1fr]">
        <x-card><div class="flex items-center justify-between"><div><h2 class="text-xl font-bold">September 2026</h2><p class="mt-1 text-xs text-ink-500">Kalender kegiatan Posyandu</p></div><div class="flex gap-2"><button class="grid size-9 place-items-center rounded-lg border border-prevanta-100">‹</button><button class="grid size-9 place-items-center rounded-lg border border-prevanta-100">›</button></div></div><div class="mt-6 grid grid-cols-7 gap-2 text-center text-xs">@foreach (['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $day)<span class="py-2 font-bold text-ink-500">{{ $day }}</span>@endforeach @foreach (range(1,35) as $date)<button class="aspect-square rounded-xl {{ in_array($date,[12,18,28]) ? 'bg-prevanta-600 font-bold text-white' : 'hover:bg-prevanta-50' }}">{{ $date <= 30 ? $date : $date - 30 }}</button>@endforeach</div></x-card>
        <div class="grid content-start gap-4"><h2 class="font-bold">Agenda Mendatang</h2>@forelse ($schedules as $schedule)<x-card padding="p-4"><div class="flex gap-3"><span class="grid size-11 shrink-0 place-items-center rounded-xl bg-prevanta-50 text-prevanta-600"><x-icon name="calendar" /></span><div><h3 class="text-sm font-bold">{{ $schedule->jenis_kegiatan }}</h3><p class="mt-1 text-xs text-ink-500">{{ $schedule->tanggal->translatedFormat('d F Y · H.i') }}</p><p class="mt-1 text-[11px] text-ink-500">{{ $schedule->lokasi }} · oleh {{ $schedule->user->name }}</p></div></div></x-card>@empty<p class="text-sm text-ink-500">Belum ada agenda mendatang.</p>@endforelse</div>
    </div>
    <x-card><h2 class="font-bold">Tambah Jadwal</h2><form method="POST" action="{{ route('kader.schedules.store') }}" class="mt-5 grid gap-4 md:grid-cols-2">@csrf<x-form-field label="Jenis Kegiatan" name="jenis_kegiatan" placeholder="Contoh: Pelayanan Posyandu" required /><x-form-field label="Tanggal dan Waktu" name="tanggal" type="datetime-local" required /><x-form-field label="Lokasi" name="lokasi" placeholder="Lokasi kegiatan" required /><x-form-field label="Keterangan" name="keterangan" placeholder="Keterangan singkat" /><div class="md:col-span-2 md:text-right"><button type="submit" class="rounded-xl bg-prevanta-600 px-5 py-3 text-sm font-bold text-white">Simpan Jadwal</button></div></form></x-card>
</x-portal-shell>
@endsection
