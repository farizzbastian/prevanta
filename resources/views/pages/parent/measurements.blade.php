@extends('layouts.app')

@section('title', 'Riwayat Pengukuran — Prevanta')

@section('content')
<x-portal-shell role="orang-tua" active="measurements">
    <x-page-header eyebrow="Riwayat Anak" title="Riwayat Pengukuran" description="Lihat perkembangan berat, tinggi, dan status gizi setiap kunjungan Posyandu.">
        <x-slot:actions><form method="GET"><select name="balita" onchange="this.form.submit()" class="rounded-xl border border-prevanta-100 bg-white px-4 py-2.5 text-sm font-semibold">@foreach ($children as $child)<option value="{{ $child->id }}" @selected($selectedChild?->is($child))>{{ $child->nama }}</option>@endforeach</select></form></x-slot:actions>
    </x-page-header>
    <x-growth-chart :measurements="$selectedChild?->pengukuran ?? collect()" />
    <x-card padding="p-0">
        <div class="border-b border-prevanta-100 p-5"><h2 class="font-bold">Catatan Pengukuran</h2></div>
        <div class="overflow-x-auto"><table class="w-full min-w-[760px] text-left text-sm"><thead class="bg-prevanta-50 text-xs text-ink-500"><tr>@foreach (['Tanggal','Usia','Berat','Tinggi','Lingkar Kepala','Status'] as $head)<th class="px-5 py-3 font-semibold">{{ $head }}</th>@endforeach</tr></thead><tbody class="divide-y divide-prevanta-50">@forelse ($selectedChild?->pengukuran ?? [] as $measurement)<tr><td class="px-5 py-4 font-semibold text-ink-900">{{ $measurement->tanggal_pengukuran->translatedFormat('d M Y') }}</td><td class="px-5 py-4 text-ink-500">{{ $selectedChild->tanggal_lahir->diffInMonths($measurement->tanggal_pengukuran) }} bulan</td><td class="px-5 py-4 text-ink-500">{{ $measurement->berat_badan }} kg</td><td class="px-5 py-4 text-ink-500">{{ $measurement->tinggi_badan }} cm</td><td class="px-5 py-4 text-ink-500">{{ $measurement->lingkar_kepala ?? '—' }} cm</td><td class="px-5 py-4"><x-status-pill :tone="$measurement->status_pertumbuhan === \App\GrowthStatus::Normal ? 'green' : 'amber'">{{ $measurement->status_pertumbuhan->label() }}</x-status-pill></td></tr>@empty<tr><td colspan="6" class="px-5 py-8 text-center text-ink-500">Belum ada catatan pengukuran.</td></tr>@endforelse</tbody></table></div>
    </x-card>
</x-portal-shell>
@endsection
