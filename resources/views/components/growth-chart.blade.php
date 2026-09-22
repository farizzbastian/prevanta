@props(['title' => 'Tren Pertumbuhan', 'subtitle' => 'Perkembangan enam bulan terakhir', 'measurements' => collect()])

@php
    $items = collect($measurements)->sortBy('tanggal_pengukuran')->take(-6)->values();
    $chartItems = $items->isNotEmpty() ? $items : collect([
        (object) ['berat_badan' => 8, 'tinggi_badan' => 65, 'tanggal_pengukuran' => now()->subMonths(5)],
        (object) ['berat_badan' => 8.7, 'tinggi_badan' => 69, 'tanggal_pengukuran' => now()->subMonths(4)],
        (object) ['berat_badan' => 9.4, 'tinggi_badan' => 73, 'tanggal_pengukuran' => now()->subMonths(3)],
        (object) ['berat_badan' => 10.2, 'tinggi_badan' => 77, 'tanggal_pengukuran' => now()->subMonths(2)],
        (object) ['berat_badan' => 10.9, 'tinggi_badan' => 81, 'tanggal_pengukuran' => now()->subMonth()],
        (object) ['berat_badan' => 11.8, 'tinggi_badan' => 86, 'tanggal_pengukuran' => now()],
    ]);
    $count = max(1, $chartItems->count() - 1);
    $weightPoints = $chartItems->map(fn ($item, $index) => (($index / $count) * 700).','. (200 - ((float) $item->berat_badan / 40 * 170)))->implode(' ');
    $heightPoints = $chartItems->map(fn ($item, $index) => (($index / $count) * 700).','. (200 - ((float) $item->tinggi_badan / 130 * 170)))->implode(' ');
@endphp

<x-card>
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="font-bold text-ink-900">{{ $title }}</h2>
            <p class="mt-1 text-xs text-ink-500">{{ $subtitle }}</p>
        </div>
        <div class="flex gap-4 text-[11px] font-semibold text-ink-500">
            <span><i class="mr-1 inline-block size-2 rounded-full bg-prevanta-500"></i> Berat</span>
            <span><i class="mr-1 inline-block size-2 rounded-full bg-mint-500"></i> Tinggi</span>
        </div>
    </div>
    <div class="relative mt-6 h-56 overflow-hidden rounded-xl bg-[linear-gradient(to_bottom,#f4e9ec_1px,transparent_1px)] bg-[size:100%_25%]">
        <svg class="absolute inset-0 size-full" viewBox="0 0 700 220" preserveAspectRatio="none" aria-label="Grafik pertumbuhan statis" role="img">
            <polyline points="{{ $weightPoints }}" fill="none" stroke="#cf4869" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
            <polyline points="{{ $heightPoints }}" fill="none" stroke="#27ae7b" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
    <div class="mt-3 grid text-center text-[10px] text-ink-500" style="grid-template-columns: repeat({{ $chartItems->count() }}, minmax(0, 1fr));">
        @foreach ($chartItems as $item)<span>{{ $item->tanggal_pengukuran->translatedFormat('M') }}</span>@endforeach
    </div>
</x-card>
