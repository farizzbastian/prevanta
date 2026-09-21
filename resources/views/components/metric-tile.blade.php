@props(['label', 'value', 'note' => null, 'icon' => 'chart', 'tone' => 'rose'])

@php
    $toneClasses = [
        'rose' => 'bg-prevanta-50 text-prevanta-600',
        'mint' => 'bg-mint-50 text-mint-600',
        'sand' => 'bg-[#fff7ed] text-[#b96836]',
        'blue' => 'bg-[#eff7ff] text-[#3878a8]',
    ];
@endphp

<x-card padding="p-4 sm:p-5">
    <div class="flex items-start justify-between gap-3">
        <div>
            <p class="text-xs font-semibold text-ink-500">{{ $label }}</p>
            <p class="mt-2 text-2xl font-bold tracking-tight text-ink-900">{{ $value }}</p>
            @if ($note)<p class="mt-1 text-[11px] text-ink-500">{{ $note }}</p>@endif
        </div>
        <span class="grid size-10 shrink-0 place-items-center rounded-xl {{ $toneClasses[$tone] }}">
            <x-icon :name="$icon" class="size-5" />
        </span>
    </div>
</x-card>
