@props([
    'eyebrow',
    'value',
    'description',
    'icon',
    'tone' => 'rose',
])

@php
    $tones = [
        'rose' => [
            'card' => 'bg-gradient-to-br from-prevanta-50 to-[#f8eee9]',
            'icon' => 'bg-prevanta-100 text-prevanta-700',
            'accent' => 'bg-prevanta-600',
        ],
        'green' => [
            'card' => 'bg-gradient-to-br from-mint-50 to-[#edf7ef]',
            'icon' => 'bg-mint-100 text-mint-600',
            'accent' => 'bg-mint-500',
        ],
        'peach' => [
            'card' => 'bg-gradient-to-br from-[#fff5ef] to-[#f9ede8]',
            'icon' => 'bg-[#ffe1d7] text-[#b85c43]',
            'accent' => 'bg-[#e17d63]',
        ],
    ];

    $selectedTone = $tones[$tone] ?? $tones['rose'];
@endphp

<article {{ $attributes->merge(['class' => "relative overflow-hidden rounded-2xl border border-white/80 p-5 {$selectedTone['card']}"]) }}>
    <span class="absolute right-0 top-0 h-full w-2 rounded-l-full {{ $selectedTone['accent'] }}"></span>

    <div class="flex items-center gap-4">
        <span class="grid size-11 shrink-0 place-items-center rounded-xl {{ $selectedTone['icon'] }}">
            <x-icon :name="$icon" class="size-5" />
        </span>

        <div class="min-w-0">
            <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-ink-500">{{ $eyebrow }}</p>
            <p class="mt-1 text-lg font-bold leading-none text-ink-900">{{ $value }}</p>
            <p class="mt-1 text-xs text-ink-500">{{ $description }}</p>
        </div>
    </div>
</article>
