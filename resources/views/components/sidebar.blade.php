@props([
    'role' => 'bidan',
    'active' => 'dashboard',
])

@php
    $profiles = [
        'orang-tua' => [
            'name' => 'Ibu Siti Rahayu',
            'subtitle' => 'Orang Tua Arka & Aisyah',
            'status' => 'Akun terhubung',
        ],
        'kader' => [
            'name' => 'Kader Ibu Siti Rahayu',
            'subtitle' => 'Kader Posyandu RW 03',
            'status' => 'Aktif bertugas',
        ],
        'bidan' => [
            'name' => 'Bdn. Dewi Anggraini, S.Tr.Keb',
            'subtitle' => 'Bidan Desa Sukamaju',
            'status' => 'Aktif saat ini',
        ],
    ];

    $menus = [
        'orang-tua' => [
            ['key' => 'children', 'label' => 'Anakku', 'icon' => 'users', 'route' => 'parent.children'],
            ['key' => 'measurements', 'label' => 'Riwayat Pengukuran', 'icon' => 'chart', 'route' => 'parent.measurements'],
            ['key' => 'immunizations', 'label' => 'Riwayat Imunisasi', 'icon' => 'clipboard', 'route' => 'parent.immunizations'],
            ['key' => 'education', 'label' => 'Edukasi', 'icon' => 'book', 'route' => 'parent.education'],
        ],
        'kader' => [
            ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'route' => 'kader.dashboard'],
            ['key' => 'monitoring', 'label' => 'Monitoring Balita', 'icon' => 'users', 'route' => 'kader.monitoring', 'badge' => '68'],
            ['key' => 'schedule', 'label' => 'Jadwal', 'icon' => 'calendar', 'route' => 'kader.schedule'],
            ['key' => 'education', 'label' => 'Edukasi', 'icon' => 'book', 'route' => 'kader.education'],
        ],
        'bidan' => [
            ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'route' => 'bidan.dashboard'],
            ['key' => 'verification', 'label' => 'Verifikasi Pengukuran', 'icon' => 'clipboard', 'route' => 'bidan.verification', 'badge' => '4 Antrean'],
            ['key' => 'history', 'label' => 'Riwayat & History', 'icon' => 'history', 'route' => 'bidan.history', 'badge' => '128'],
            ['key' => 'portal', 'label' => 'Portal Klinis', 'icon' => 'chart', 'route' => 'bidan.portal'],
        ],
    ];

    $profile = $profiles[$role] ?? $profiles['bidan'];
    $roleMenus = $menus[$role] ?? $menus['bidan'];
    $homeRoute = match ($role) {
        'orang-tua' => 'parent.children',
        'kader' => 'kader.dashboard',
        default => 'bidan.dashboard',
    };
@endphp

<div class="fixed inset-0 z-40 hidden bg-ink-900/35 backdrop-blur-[2px] lg:hidden" data-sidebar-overlay></div>

<aside
    class="fixed inset-y-0 left-0 z-50 flex w-[268px] -translate-x-full flex-col border-r border-prevanta-100 bg-white transition-transform duration-300 lg:translate-x-0"
    data-sidebar
    aria-label="Navigasi utama"
>
    <div class="flex min-h-20 items-center justify-between border-b border-prevanta-100 px-6">
        <a href="{{ route($homeRoute) }}" class="flex items-center gap-3" aria-label="Prevanta dashboard">
            <img src="{{ asset('assets/logo/prevanta-mark.svg') }}" alt="" class="size-10">
            <span>
                <span class="block text-xl font-bold tracking-tight text-prevanta-700">Prevanta</span>
                <span class="block text-[9px] font-semibold uppercase tracking-[0.11em] text-ink-500">
                    Cegah stunting, wujudkan generasi emas
                </span>
            </span>
        </a>

        <button
            type="button"
            class="grid size-9 place-items-center rounded-lg text-ink-500 hover:bg-prevanta-50 lg:hidden"
            aria-label="Tutup navigasi"
            data-sidebar-close
        >
            <x-icon name="close" class="size-5" />
        </button>
    </div>

    <div class="mx-4 mt-5 rounded-2xl border border-prevanta-100 bg-prevanta-50/70 p-4">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/avatar-bidan.svg') }}" alt="Avatar {{ $profile['name'] }}" class="size-11 rounded-full ring-2 ring-white">
            <div class="min-w-0">
                <p class="truncate text-sm font-bold text-ink-900">{{ $profile['name'] }}</p>
                <p class="mt-0.5 text-[11px] text-ink-500">{{ $profile['subtitle'] }}</p>
                <p class="mt-0.5 text-[10px] font-medium text-mint-600">● {{ $profile['status'] }}</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-6" aria-label="Menu utama">
        <p class="px-3 text-[10px] font-bold uppercase tracking-[0.16em] text-ink-500">Utama</p>

        <div class="mt-3 grid gap-1.5">
            @foreach ($roleMenus as $menu)
                @php($isActive = $active === $menu['key'])
                <a
                    href="{{ route($menu['route']) }}"
                    @class([
                        'flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition',
                        'bg-prevanta-600 text-white shadow-sm shadow-prevanta-300/50' => $isActive,
                        'text-ink-700 hover:bg-prevanta-50' => ! $isActive,
                    ])
                    @if ($isActive) aria-current="page" @endif
                >
                    <x-icon :name="$menu['icon']" @class(['size-[18px]', 'text-ink-500' => ! $isActive]) />
                    <span>{{ $menu['label'] }}</span>
                    @isset($menu['badge'])
                        <span @class([
                            'ml-auto rounded-full px-2 py-0.5 text-[10px] font-bold',
                            'bg-white/20 text-white' => $isActive,
                            'bg-prevanta-100 text-prevanta-700' => ! $isActive,
                        ])>{{ $menu['badge'] }}</span>
                    @endisset
                </a>
            @endforeach
        </div>
    </nav>

    <div class="border-t border-prevanta-100 p-4">
        <div class="rounded-xl bg-[#fbf7f4] p-3 text-xs leading-relaxed text-ink-500">
            <span class="font-semibold text-ink-700">{{ $role === 'orang-tua' ? 'Posyandu terhubung:' : 'Posko aktif:' }}</span><br>
            Posyandu Mawar Melati · RW 03
        </div>
    </div>
</aside>
