@props([
    'title',
    'category' => 'Tumbuh Kembang',
    'excerpt',
    'tone' => 'rose',
])

@php
    $tones = [
        'rose' => 'from-prevanta-100 to-[#f6d8df] text-prevanta-700',
        'mint' => 'from-mint-100 to-[#dff4ea] text-mint-600',
        'sand' => 'from-[#f8eadb] to-[#f4ddca] text-[#9a5d35]',
    ];
@endphp

<article class="overflow-hidden rounded-2xl border border-prevanta-100 bg-white shadow-card transition hover:-translate-y-0.5">
    <div class="grid h-40 place-items-center bg-gradient-to-br {{ $tones[$tone] }}">
        <x-icon name="book" class="size-12 opacity-70" />
    </div>
    <div class="p-5">
        <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-prevanta-600">{{ $category }}</span>
        <h2 class="mt-2 text-lg font-bold leading-snug text-ink-900">{{ $title }}</h2>
        <p class="mt-2 line-clamp-2 text-sm leading-6 text-ink-500">{{ $excerpt }}</p>
        <a href="#" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-prevanta-600">Baca selengkapnya <span aria-hidden="true">→</span></a>
    </div>
</article>
