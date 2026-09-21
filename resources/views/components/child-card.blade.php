@props(['name', 'age', 'status' => 'Normal', 'updated' => '12 Sep 2026'])

<article class="flex flex-col gap-4 rounded-2xl border border-prevanta-100 bg-white p-5 shadow-card sm:flex-row sm:items-center">
    <div class="grid size-16 shrink-0 place-items-center rounded-full bg-prevanta-100 text-xl font-bold text-prevanta-700">{{ mb_substr($name, 0, 1) }}</div>
    <div class="min-w-0 flex-1">
        <div class="flex flex-wrap items-center gap-2">
            <h2 class="font-bold text-ink-900">{{ $name }}</h2>
            <x-status-pill :tone="$status === 'Normal' ? 'green' : 'amber'">{{ $status }}</x-status-pill>
        </div>
        <p class="mt-1 text-sm text-ink-500">{{ $age }} · Pengukuran terakhir {{ $updated }}</p>
        <div class="mt-3 flex flex-wrap gap-x-6 gap-y-1 text-xs text-ink-500">
            <span><b class="text-ink-700">11,8 kg</b> Berat</span>
            <span><b class="text-ink-700">86 cm</b> Tinggi</span>
            <span><b class="text-ink-700">47 cm</b> Lingkar kepala</span>
        </div>
    </div>
    {{ $slot }}
</article>
