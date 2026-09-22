@props([
    'eyebrow',
    'heading',
    'description',
    'contentWidth' => 'max-w-md',
])

<main class="grid min-h-screen bg-white lg:grid-cols-[48%_52%]">
    <section class="relative hidden items-end justify-center overflow-hidden bg-[#fff9fa] p-12 lg:flex">
        <a href="{{ route('landing') }}" class="absolute left-10 top-9 flex items-center gap-3" aria-label="Kembali ke beranda Prevanta">
            <img src="{{ asset('assets/logo/prevanta-mark.svg') }}" alt="" class="size-11">
            <span class="text-2xl font-bold text-prevanta-700">Prevanta</span>
        </a>

        <img
            src="{{ asset('assets/images/family-illustration.svg') }}"
            alt="Ilustrasi keluarga sehat"
            class="max-h-[78vh] w-full max-w-xl object-contain"
        >
    </section>

    <section class="relative flex items-center justify-center overflow-hidden bg-gradient-to-br from-prevanta-900 via-prevanta-700 to-prevanta-400 px-5 py-10 sm:px-10 lg:py-12">
        <div class="absolute -left-28 top-[-5%] hidden h-[110%] w-48 rounded-[50%] bg-white lg:block"></div>

        <div class="relative z-10 w-full {{ $contentWidth }} text-white">
            <a href="{{ route('landing') }}" class="mb-8 flex items-center gap-3 lg:hidden">
                <img src="{{ asset('assets/logo/prevanta-mark.svg') }}" alt="" class="size-10 rounded-full bg-white p-1">
                <span class="text-xl font-bold">Prevanta</span>
            </a>

            <header>
                <p class="text-sm font-semibold text-prevanta-100">{{ $eyebrow }}</p>
                <h1 class="mt-2 text-4xl font-bold tracking-tight sm:text-5xl">{{ $heading }}</h1>
                <p class="mt-4 text-sm leading-6 text-prevanta-100">{{ $description }}</p>
            </header>

            {{ $slot }}
        </div>
    </section>
</main>
