@extends('layouts.app')

@section('title', 'Riwayat Pengukuran — Prevanta')

@section('content')
<x-portal-shell role="orang-tua" active="measurements">
    <x-page-header eyebrow="Riwayat Anak" title="Riwayat Pengukuran" description="Lihat perkembangan berat, tinggi, dan status gizi setiap kunjungan Posyandu.">
        <x-slot:actions><select class="rounded-xl border border-prevanta-100 bg-white px-4 py-2.5 text-sm font-semibold"><option>Arka Pratama</option><option>Aisyah Putri</option></select></x-slot:actions>
    </x-page-header>
    <x-growth-chart />
    <x-card padding="p-0">
        <div class="border-b border-prevanta-100 p-5"><h2 class="font-bold">Catatan Pengukuran</h2></div>
        <div class="overflow-x-auto"><table class="w-full min-w-[760px] text-left text-sm"><thead class="bg-prevanta-50 text-xs text-ink-500"><tr>@foreach (['Tanggal','Usia','Berat','Tinggi','Lingkar Kepala','Status'] as $head)<th class="px-5 py-3 font-semibold">{{ $head }}</th>@endforeach</tr></thead><tbody class="divide-y divide-prevanta-50">@foreach ([['12 Sep 2026','28 bulan','11,8 kg','86 cm','47 cm','Normal'],['15 Agu 2026','27 bulan','11,5 kg','84,8 cm','46,8 cm','Normal'],['13 Jul 2026','26 bulan','11,2 kg','83,5 cm','46,5 cm','Normal'],['14 Jun 2026','25 bulan','10,9 kg','82,1 cm','46,2 cm','Perlu Dipantau']] as $row)<tr>@foreach ($row as $cell)<td class="px-5 py-4 {{ $loop->first ? 'font-semibold text-ink-900' : 'text-ink-500' }}">{{ $loop->last ? '' : $cell }}@if($loop->last)<x-status-pill :tone="$cell === 'Normal' ? 'green' : 'amber'">{{ $cell }}</x-status-pill>@endif</td>@endforeach</tr>@endforeach</tbody></table></div>
    </x-card>
</x-portal-shell>
@endsection
