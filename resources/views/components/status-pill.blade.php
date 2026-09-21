@props(['tone' => 'amber'])

@php
    $classes = match ($tone) {
        'green' => 'bg-mint-50 text-mint-600 ring-mint-100',
        'rose' => 'bg-prevanta-50 text-prevanta-700 ring-prevanta-100',
        default => 'bg-amber-50 text-amber-700 ring-amber-100',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-semibold ring-1 ring-inset {$classes}"]) }}>
    {{ $slot }}
</span>
