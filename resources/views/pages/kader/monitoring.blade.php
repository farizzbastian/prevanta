@extends('layouts.app')

@section('title', 'Monitoring Balita — Prevanta')

@section('content')
<x-portal-shell role="kader" active="monitoring">
    <x-page-header eyebrow="Data Posyandu" title="Monitoring Balita" description="Kelola dan pantau status pertumbuhan seluruh balita.">
        <x-slot:actions><a href="{{ route('kader.add-child') }}" class="inline-flex items-center gap-2 rounded-xl border border-prevanta-200 bg-white px-4 py-2.5 text-sm font-bold text-prevanta-700"><x-icon name="plus" class="size-4" /> Tambah Balita</a><a href="{{ route('kader.measurement') }}" class="inline-flex items-center gap-2 rounded-xl bg-prevanta-600 px-4 py-2.5 text-sm font-bold text-white"><x-icon name="clipboard" class="size-4" /> Input Ukur Cepat</a></x-slot:actions>
    </x-page-header>
    <x-card padding="p-4"><div class="flex flex-col gap-3 md:flex-row"><label class="relative flex-1"><x-icon name="search" class="absolute left-3 top-3 size-5 text-ink-500" /><input type="search" placeholder="Cari nama anak atau NIK..." class="w-full rounded-xl border border-prevanta-100 py-2.5 pl-11 pr-4 text-sm outline-none focus:border-prevanta-400"></label><select class="rounded-xl border border-prevanta-100 bg-white px-4 py-2.5 text-sm"><option>Semua Status</option><option>Normal</option><option>Perlu Dipantau</option></select><button class="inline-flex items-center justify-center gap-2 rounded-xl border border-prevanta-100 px-4 py-2.5 text-sm font-bold text-ink-700"><x-icon name="filter" class="size-4" /> Filter</button></div></x-card>
    <div class="flex flex-wrap gap-2" data-tabs>@foreach (['Semua 68','Belum Diukur 16','Normal 54','Perlu Dipantau 10','Risiko 4'] as $tab)<button data-tab class="rounded-full px-4 py-2 text-xs font-bold {{ $loop->first ? 'bg-prevanta-600 text-white' : 'bg-white text-ink-500' }} ring-1 ring-prevanta-100">{{ $tab }}</button>@endforeach</div>
    <div class="grid gap-4"><x-child-card name="Arka Pratama" age="2 tahun 4 bulan"><a href="{{ route('kader.child-profile') }}" class="rounded-xl border border-prevanta-200 px-4 py-2.5 text-center text-sm font-bold text-prevanta-700">Lihat Detail</a></x-child-card><x-child-card name="Aisyah Putri" age="10 bulan" status="Perlu Dipantau"><a href="{{ route('kader.child-profile') }}" class="rounded-xl border border-prevanta-200 px-4 py-2.5 text-center text-sm font-bold text-prevanta-700">Lihat Detail</a></x-child-card><x-child-card name="Raka Saputra" age="1 tahun 7 bulan"><a href="{{ route('kader.child-profile') }}" class="rounded-xl border border-prevanta-200 px-4 py-2.5 text-center text-sm font-bold text-prevanta-700">Lihat Detail</a></x-child-card></div>
</x-portal-shell>
@endsection
