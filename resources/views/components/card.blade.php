@props(['padding' => 'p-5 sm:p-6'])

<section {{ $attributes->merge(['class' => "min-w-0 rounded-2xl border border-prevanta-100 bg-white {$padding} shadow-card"]) }}>
    {{ $slot }}
</section>
