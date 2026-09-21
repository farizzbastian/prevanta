@props([
    'eyebrow' => null,
    'title',
    'description' => null,
])

<header {{ $attributes->merge(['class' => 'flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between']) }}>
    <div>
        @if ($eyebrow)
            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-prevanta-600">{{ $eyebrow }}</p>
        @endif
        <h1 class="mt-1 text-2xl font-bold tracking-tight text-ink-900 sm:text-3xl">{{ $title }}</h1>
        @if ($description)
            <p class="mt-2 max-w-3xl text-sm leading-6 text-ink-500">{{ $description }}</p>
        @endif
    </div>

    @if (isset($actions))
        <div class="flex flex-wrap gap-2">{{ $actions }}</div>
    @endif
</header>
