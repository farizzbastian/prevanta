@props(['title' => 'Tren Pertumbuhan', 'subtitle' => 'Perkembangan enam bulan terakhir'])

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
            <path d="M0 182 C90 178 100 148 185 151 S300 112 390 120 S510 72 700 55" fill="none" stroke="#cf4869" stroke-width="4" stroke-linecap="round" />
            <path d="M0 195 C80 182 130 187 210 165 S330 153 420 130 S560 118 700 84" fill="none" stroke="#27ae7b" stroke-width="4" stroke-linecap="round" />
            @foreach ([0, 140, 280, 420, 560, 700] as $point)
                <circle cx="{{ $point }}" cy="{{ 182 - ($loop->index * 25) }}" r="5" fill="#fff" stroke="#cf4869" stroke-width="3" />
            @endforeach
        </svg>
    </div>
    <div class="mt-3 grid grid-cols-6 text-center text-[10px] text-ink-500">
        @foreach (['Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'] as $month)<span>{{ $month }}</span>@endforeach
    </div>
</x-card>
