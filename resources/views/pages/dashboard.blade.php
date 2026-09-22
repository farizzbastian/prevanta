@extends('layouts.app')

@section('title', 'Dashboard Bidan — Portal Prevanta')

@section('content')
<x-portal-shell role="bidan" active="portal">
    <section class="relative overflow-hidden rounded-[22px] bg-gradient-to-r from-prevanta-700 via-prevanta-600 to-prevanta-400 p-6 text-white shadow-lg shadow-prevanta-200/60 sm:p-8">
        <div class="absolute -right-14 -top-20 size-64 rounded-full border-[40px] border-white/10"></div>
        <div class="relative flex flex-col gap-6 xl:flex-row xl:items-center xl:justify-between">
            <div class="max-w-3xl">
                <p class="inline-flex items-center gap-2 rounded-full bg-white/14 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.14em] ring-1 ring-inset ring-white/20">
                    <span class="size-1.5 rounded-full bg-mint-100"></span> Portal Bidan Prevanta
                </p>
                <h1 class="mt-4 text-2xl font-bold tracking-tight sm:text-3xl">Selamat Datang, {{ auth()->user()->name }}!</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-white/80">Monitoring pertumbuhan balita, pengelolaan verifikasi, dan tindak lanjut berdasarkan data Posyandu.</p>
            </div>
            <div class="flex flex-wrap gap-2.5">
                <a href="{{ route('bidan.verification') }}" class="rounded-xl bg-white px-4 py-3 text-xs font-bold text-prevanta-700">Buka Pemeriksaan</a>
                <a href="{{ route('bidan.history') }}" class="rounded-xl bg-white/10 px-4 py-3 text-xs font-bold text-white ring-1 ring-inset ring-white/30">Lihat Semua Riwayat</a>
            </div>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-3" aria-label="Ringkasan portal bidan">
        <x-stat-card eyebrow="Balita Terdaftar" :value="$metrics['children'].' Balita'" description="Data aktif di sistem" icon="users" tone="green" />
        <x-stat-card eyebrow="Total Pengukuran" :value="$metrics['measurements'].' Data'" description="Seluruh riwayat" icon="chart" tone="peach" />
        <x-stat-card eyebrow="Perlu Verifikasi" :value="$metrics['pending'].' Data'" description="Menunggu tindakan bidan" icon="clipboard" tone="rose" />
    </section>

    <x-card id="antrean" padding="p-0">
        <div class="flex flex-col gap-3 border-b border-prevanta-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h2 class="flex items-center gap-2 text-sm font-bold text-ink-900"><x-icon name="clipboard" class="size-[18px] text-prevanta-600" />Antrean &amp; Riwayat Verifikasi Terkini</h2>
                <p class="mt-1 text-xs text-ink-500">Data hasil pengukuran yang dikirimkan kader.</p>
            </div>
            <a href="{{ route('bidan.history') }}" class="rounded-xl bg-prevanta-700 px-4 py-3 text-center text-xs font-bold text-white">Lihat Seluruh Riwayat</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] border-collapse text-left">
                <thead>
                    <tr class="bg-[#fcfafb] text-[10px] font-bold uppercase tracking-[0.08em] text-ink-500">
                        <th class="px-6 py-4">ID Ukur</th>
                        <th class="px-4 py-4">Nama Balita</th>
                        <th class="px-4 py-4">Pengukuran</th>
                        <th class="px-4 py-4">Status Pertumbuhan</th>
                        <th class="px-4 py-4">Status Verifikasi</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-prevanta-100">
                    @forelse ($recentMeasurements as $measurement)
                        <tr class="text-xs hover:bg-prevanta-50/40">
                            <td class="px-6 py-4 font-bold text-ink-900">#UKR-{{ str_pad((string) $measurement->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-4 py-4"><p class="font-bold text-ink-900">{{ $measurement->balita->nama }}</p><p class="mt-1 text-[10px] text-ink-500">{{ $measurement->tanggal_pengukuran->translatedFormat('d M Y') }}</p></td>
                            <td class="px-4 py-4"><p class="font-bold">{{ number_format((float) $measurement->berat_badan, 1, ',', '.') }} kg</p><p class="mt-1 text-[10px] text-ink-500">{{ number_format((float) $measurement->tinggi_badan, 1, ',', '.') }} cm</p></td>
                            <td class="px-4 py-4"><x-status-pill :tone="$measurement->status_pertumbuhan === \App\GrowthStatus::Normal ? 'green' : 'rose'">{{ $measurement->status_pertumbuhan->label() }}</x-status-pill></td>
                            <td class="px-4 py-4"><x-status-pill :tone="$measurement->verifikasi ? 'green' : 'amber'">{{ $measurement->verifikasi?->status->label() ?? 'Menunggu' }}</x-status-pill></td>
                            <td class="px-6 py-4 text-right"><a href="{{ route('bidan.verification', $measurement) }}" class="rounded-lg bg-prevanta-700 px-3 py-2 text-[11px] font-bold text-white">Periksa</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-sm text-ink-500">Belum ada data pengukuran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-portal-shell>
@endsection
