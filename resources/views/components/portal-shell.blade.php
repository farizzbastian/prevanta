@props([
    'role',
    'active',
])

<x-sidebar :role="$role" :active="$active" />
<x-navbar :role="$role" />

<main class="min-h-screen min-w-0 lg:ml-[268px]">
    <div {{ $attributes->merge(['class' => 'mx-auto grid max-w-[1500px] gap-5 px-4 py-5 sm:px-6 sm:py-6 lg:gap-6 lg:px-8 lg:py-7']) }}>
        {{ $slot }}
    </div>
</main>
