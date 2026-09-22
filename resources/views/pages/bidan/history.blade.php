@extends('layouts.app')

@section('title', 'Riwayat dan History — Prevanta')

@section('content')
<x-portal-shell role="bidan" active="history">
    <x-page-header eyebrow="Data Pengukuran" title="Riwayat dan History" description="Riwayat verifikasi dan perkembangan balita di seluruh Posyandu binaan." />

    <x-card padding="p-4">
        <form method="GET" action="{{ route('bidan.history') }}" class="flex flex-col gap-3 md:flex-row">
            <label class="relative flex-1">
                <span class="sr-only">Cari nama balita</span>
                <x-icon name="search" class="absolute left-3 top-3 size-5 text-ink-500" />
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama balita..." class="w-full rounded-xl border border-prevanta-100 py-2.5 pl-11 pr-4 text-sm outline-none focus:border-prevanta-400">
            </label>
            <select name="status" class="rounded-xl border border-prevanta-100 bg-white px-4 py-2.5 text-sm">
                <option value="">Semua Status Pertumbuhan</option>
                @foreach (\App\GrowthStatus::cases() as $status)
                    <option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>
                @endforeach
            </select>
            <button class="rounded-xl bg-prevanta-600 px-5 py-2.5 text-sm font-bold text-white">Terapkan</button>
        </form>
    </x-card>

    <div class="grid gap-4">
        @forelse ($measurements as $measurement)
            @php
                $isNormal = $measurement->status_pertumbuhan === \App\GrowthStatus::Normal;
                $verification = $measurement->verifikasi;
            @endphp
            <x-card padding="p-4 sm:p-5">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center">
                    <div class="flex min-w-0 flex-1 items-center gap-4">
                        <div class="grid size-14 shrink-0 place-items-center rounded-full bg-prevanta-100 text-lg font-bold text-prevanta-700">{{ mb_substr($measurement->balita->nama, 0, 1) }}</div>
                        <div>
                            <div class="flex flex-wrap items-center gap-2">
                                <h2 class="font-bold">{{ $measurement->balita->nama }}</h2>
                                <x-status-pill :tone="$isNormal ? 'green' : 'rose'">{{ $measurement->status_pertumbuhan->label() }}</x-status-pill>
                                <x-status-pill :tone="$verification ? 'green' : 'amber'">{{ $verification?->status->label() ?? 'Menunggu Verifikasi' }}</x-status-pill>
                            </div>
                            <p class="mt-1 text-xs text-ink-500">{{ $measurement->balita->tanggal_lahir->diffForHumans(parts: 2, short: true) }} · Orang tua {{ $measurement->balita->orangTua->user->name }} · {{ $measurement->tanggal_pengukuran->translatedFormat('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex gap-6 text-sm">
                        <span><b class="block">{{ number_format((float) $measurement->berat_badan, 1, ',', '.') }} kg</b><small class="text-ink-500">Berat</small></span>
                        <span><b class="block">{{ number_format((float) $measurement->tinggi_badan, 1, ',', '.') }} cm</b><small class="text-ink-500">Tinggi</small></span>
                    </div>
                    <a href="{{ route('bidan.verification', $measurement) }}" class="rounded-xl bg-prevanta-600 px-4 py-2.5 text-center text-sm font-bold text-white">{{ $verification ? 'Lihat / Ubah' : 'Periksa + Tindak' }}</a>
                </div>
            </x-card>
        @empty
            <x-card><p class="text-center text-sm text-ink-500">Tidak ada data pengukuran yang sesuai dengan filter.</p></x-card>
        @endforelse
    </div>

    {{ $measurements->links() }}
</x-portal-shell>
@endsection
