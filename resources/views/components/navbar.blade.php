@props(['role' => 'bidan'])

@php
    $identity = match ($role) {
        'orang-tua' => ['name' => 'Ibu Siti Rahayu', 'label' => 'Orang Tua'],
        'kader' => ['name' => 'Kader Siti Rahayu', 'label' => 'Kader'],
        default => ['name' => 'Bdn. Dewi Anggraini', 'label' => 'Bidan'],
    };
    $identity['name'] = auth()->user()?->name ?? $identity['name'];
@endphp

<header class="sticky top-0 z-30 border-b border-prevanta-100 bg-white/95 backdrop-blur lg:ml-[268px]">
    <div class="flex min-h-20 items-center gap-3 px-4 sm:px-6 lg:px-8">
        <button
            type="button"
            class="grid size-10 shrink-0 place-items-center rounded-xl border border-prevanta-100 text-ink-700 lg:hidden"
            aria-label="Buka navigasi"
            aria-expanded="false"
            data-sidebar-open
        >
            <x-icon name="menu" class="size-5" />
        </button>

        <div class="flex min-w-0 flex-1 items-center gap-3">
            <div class="inline-flex min-w-0 items-center gap-2 rounded-full bg-mint-50 px-3 py-2 text-xs font-semibold text-mint-600 ring-1 ring-inset ring-mint-100">
                <x-icon name="location" class="size-4 shrink-0" />
                <span class="truncate">Posyandu Mawar Melati · Desa Sukamaju</span>
            </div>
        </div>

        <div class="hidden items-center gap-2 text-xs font-medium text-ink-500 md:flex">
            <x-icon name="calendar" class="size-4 text-prevanta-600" />
            <span>Kamis, 24 Oktober 2025 · {{ $role === 'orang-tua' ? 'Data keluarga' : 'Posko RW 03' }}</span>
        </div>

        <span class="hidden h-8 w-px bg-prevanta-100 md:block"></span>

        <button type="button" class="relative grid size-10 shrink-0 place-items-center rounded-full text-ink-500 hover:bg-prevanta-50" aria-label="Notifikasi">
            <x-icon name="bell" class="size-5" />
            <span class="absolute right-2 top-2 size-2 rounded-full bg-prevanta-500 ring-2 ring-white"></span>
        </button>

        <button type="button" class="flex shrink-0 items-center gap-2 rounded-xl p-1.5 hover:bg-prevanta-50" aria-label="Buka menu profil">
            <img src="{{ asset('assets/images/avatar-bidan.svg') }}" alt="" class="size-9 rounded-full">
            <span class="hidden text-left xl:block">
                <span class="block text-xs font-bold text-ink-900">{{ $identity['name'] }}</span>
                <span class="block text-[10px] text-ink-500">{{ $identity['label'] }}</span>
            </span>
            <x-icon name="chevron-down" class="hidden size-4 text-ink-500 xl:block" />
        </button>
    </div>
</header>
