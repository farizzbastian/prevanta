@extends('layouts.app')

@section('title', 'Verifikasi Balita — Prevanta')

@section('content')
<x-portal-shell role="bidan" active="verification">
    <x-page-header eyebrow="Antrean Verifikasi" title="Verifikasi Balita" :description="$pengukuran ? 'Periksa hasil pengukuran dan tentukan tindak lanjut untuk '.$pengukuran->balita->nama.'.' : 'Belum ada pengukuran yang dapat diverifikasi.'">
        <x-slot:actions>
            <a href="{{ route('bidan.history') }}" class="rounded-xl border border-prevanta-200 bg-white px-4 py-2.5 text-sm font-bold text-prevanta-700">← Kembali</a>
        </x-slot:actions>
    </x-page-header>

    @if (! $pengukuran)
        <x-card><p class="text-center text-sm text-ink-500">Belum ada data pengukuran. Kader perlu mencatat pengukuran terlebih dahulu.</p></x-card>
    @else
        @php($child = $pengukuran->balita)
        <x-card class="bg-gradient-to-r from-white to-prevanta-50">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                <div class="grid size-20 place-items-center rounded-full bg-prevanta-100 text-2xl font-bold text-prevanta-700">{{ mb_substr($child->nama, 0, 1) }}</div>
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="text-xl font-bold">{{ $child->nama }}</h2>
                        <x-status-pill :tone="$pengukuran->status_pertumbuhan === \App\GrowthStatus::Normal ? 'green' : 'rose'">{{ $pengukuran->status_pertumbuhan->label() }}</x-status-pill>
                        <x-status-pill :tone="$pengukuran->verifikasi ? 'green' : 'amber'">{{ $pengukuran->verifikasi?->status->label() ?? $pendingCount.' antrean' }}</x-status-pill>
                    </div>
                    <p class="mt-2 text-sm text-ink-500">{{ $child->jenis_kelamin->label() }} · {{ $child->tanggal_lahir->diffForHumans(parts: 2, short: true) }} · Orang tua {{ $child->orangTua->user->name }}</p>
                    <p class="mt-1 text-xs text-ink-500">Diukur {{ $pengukuran->kader->name }} · {{ $pengukuran->tanggal_pengukuran->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </x-card>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <x-metric-tile label="Berat Badan" :value="number_format((float) $pengukuran->berat_badan, 1, ',', '.').' kg'" note="Hasil pengukuran kader" icon="chart" tone="rose" />
            <x-metric-tile label="Tinggi Badan" :value="number_format((float) $pengukuran->tinggi_badan, 1, ',', '.').' cm'" note="Hasil pengukuran kader" icon="chart" tone="sand" />
            <x-metric-tile label="Lingkar Kepala" :value="$pengukuran->lingkar_kepala ? number_format((float) $pengukuran->lingkar_kepala, 1, ',', '.').' cm' : '-'" note="Data antropometri" icon="users" tone="mint" />
            <x-metric-tile label="Z-Score" :value="$pengukuran->z_score !== null ? number_format((float) $pengukuran->z_score, 2, ',', '.').' SD' : '-'" note="Status pertumbuhan" icon="clipboard" tone="rose" />
        </div>

        <div class="grid gap-5 xl:grid-cols-[1.25fr_1fr]">
            <x-growth-chart :title="'Grafik Pertumbuhan '.$child->nama" subtitle="Riwayat berat dan tinggi badan" :measurements="$child->pengukuran" />
            <form method="POST" action="{{ route('bidan.verification.store', $pengukuran) }}" class="grid gap-4">
                @csrf
                <x-card>
                    <h2 class="font-bold">Hasil Pemeriksaan Bidan</h2>
                    <div class="mt-5 grid gap-4">
                        <label class="grid gap-2 text-sm font-semibold text-ink-700">
                            Status Verifikasi <span class="text-prevanta-600">*</span>
                            <select name="status" required class="rounded-xl border border-prevanta-100 bg-[#fcfafb] px-4 py-3 font-normal">
                                @foreach (\App\VerificationStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected(old('status', $pengukuran->verifikasi?->status?->value) === $status->value)>{{ $status->label() }}</option>
                                @endforeach
                            </select>
                            @error('status')<span class="text-xs font-medium text-red-600">{{ $message }}</span>@enderror
                        </label>
                        <label class="grid gap-2 text-sm font-semibold text-ink-700">
                            Catatan Penyuluhan
                            <textarea name="catatan_penyuluhan" rows="4" class="rounded-xl border border-prevanta-100 bg-[#fcfafb] px-4 py-3 font-normal outline-none" placeholder="Catatan yang dapat dibaca sebagai riwayat...">{{ old('catatan_penyuluhan', $pengukuran->verifikasi?->catatan_penyuluhan) }}</textarea>
                            @error('catatan_penyuluhan')<span class="text-xs font-medium text-red-600">{{ $message }}</span>@enderror
                        </label>
                        <label class="grid gap-2 text-sm font-semibold text-ink-700">
                            Tindak Lanjut <span class="text-prevanta-600">*</span>
                            <textarea name="tindak_lanjut" rows="5" required class="rounded-xl border border-prevanta-100 bg-[#fcfafb] px-4 py-3 font-normal outline-none" placeholder="Tuliskan rekomendasi tindak lanjut minimal 10 karakter...">{{ old('tindak_lanjut', $pengukuran->verifikasi?->tindak_lanjut) }}</textarea>
                            @error('tindak_lanjut')<span class="text-xs font-medium text-red-600">{{ $message }}</span>@enderror
                        </label>
                        <button class="rounded-xl bg-prevanta-600 px-5 py-3 text-sm font-bold text-white">Verifikasi &amp; Simpan</button>
                    </div>
                </x-card>
            </form>
        </div>
    @endif
</x-portal-shell>
@endsection
