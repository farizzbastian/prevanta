@extends('layouts.app')

@section('title', 'Monitoring Balita — Prevanta')

@section('content')
<x-portal-shell role="kader" active="monitoring">
    <x-page-header eyebrow="Data Posyandu" title="Monitoring Balita" description="Kelola dan pantau status pertumbuhan seluruh balita.">
        <x-slot:actions><a href="{{ route('kader.add-child') }}" class="inline-flex items-center gap-2 rounded-xl bg-prevanta-600 px-4 py-2.5 text-sm font-bold text-white"><x-icon name="plus" class="size-4" /> Tambah Balita</a></x-slot:actions>
    </x-page-header>
    <x-card padding="p-4"><form method="GET" class="flex flex-col gap-3 md:flex-row"><label class="relative flex-1"><x-icon name="search" class="absolute left-3 top-3 size-5 text-ink-500" /><input type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama anak atau NIK..." class="w-full rounded-xl border border-prevanta-100 py-2.5 pl-11 pr-4 text-sm outline-none focus:border-prevanta-400"></label><select name="status" class="rounded-xl border border-prevanta-100 bg-white px-4 py-2.5 text-sm"><option value="">Semua Status</option>@foreach (\App\GrowthStatus::cases() as $status)<option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>@endforeach</select><button class="inline-flex items-center justify-center gap-2 rounded-xl border border-prevanta-100 px-4 py-2.5 text-sm font-bold text-ink-700"><x-icon name="filter" class="size-4" /> Filter</button></form></x-card>
    <div class="grid gap-4">@forelse ($children as $child)@php($measurement = $child->pengukuranTerbaru)<x-child-card :name="$child->nama" :age="$child->tanggal_lahir->diffForHumans(['parts' => 2])" :status="$measurement?->status_pertumbuhan?->label() ?? 'Belum Diukur'" :updated="$measurement?->tanggal_pengukuran->translatedFormat('d M Y') ?? 'Belum ada'" :weight="$measurement ? $measurement->berat_badan.' kg' : '—'" :height="$measurement ? $measurement->tinggi_badan.' cm' : '—'" :head="$measurement?->lingkar_kepala ? $measurement->lingkar_kepala.' cm' : '—'"><div class="flex gap-2"><a href="{{ route('kader.measurement', $child) }}" class="rounded-xl bg-prevanta-600 px-4 py-2.5 text-center text-sm font-bold text-white">Input Ukur</a><a href="{{ route('kader.child-profile', $child) }}" class="rounded-xl border border-prevanta-200 px-4 py-2.5 text-center text-sm font-bold text-prevanta-700">Detail</a></div></x-child-card>@empty<x-card><p class="text-sm text-ink-500">Data balita tidak ditemukan.</p></x-card>@endforelse</div>
    {{ $children->links() }}
</x-portal-shell>
@endsection
