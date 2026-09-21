@extends('layouts.app')

@section('title', 'Prevanta — Cegah Stunting, Wujudkan Generasi Emas')

@section('content')
<header class="sticky top-0 z-40 border-b border-prevanta-100 bg-white/90 backdrop-blur-xl">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
        <a href="{{ route('landing') }}" class="flex items-center gap-3"><img src="{{ asset('assets/logo/prevanta-mark.svg') }}" alt="" class="size-10"><span class="text-xl font-bold text-prevanta-700">Prevanta</span></a>
        <nav class="hidden items-center gap-8 text-sm font-semibold text-ink-700 md:flex"><a href="#tentang">Tentang</a><a href="#fitur">Fitur</a><a href="#alur">Cara Kerja</a><a href="#edukasi">Edukasi</a></nav>
        <div class="flex items-center gap-2"><a href="{{ route('login') }}" class="rounded-xl px-4 py-2.5 text-sm font-bold text-prevanta-700">Masuk</a><a href="{{ route('register') }}" class="rounded-xl bg-prevanta-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm">Daftar</a></div>
    </div>
</header>

<main>
    <section class="overflow-hidden bg-gradient-to-br from-white via-prevanta-50 to-[#f7e0e5]">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 py-16 md:grid-cols-2 lg:px-8 lg:py-24">
            <div><span class="rounded-full bg-white px-4 py-2 text-xs font-bold text-prevanta-600 shadow-sm">Sistem Informasi Posyandu Terpadu</span><h1 class="mt-6 text-balance text-4xl font-bold leading-tight tracking-tight text-ink-900 sm:text-6xl">Pantau tumbuh kembang, <span class="text-prevanta-600">cegah stunting</span> sejak dini.</h1><p class="mt-6 max-w-xl text-base leading-8 text-ink-500">Prevanta menghubungkan orang tua, kader, dan bidan dalam satu portal untuk pemantauan pertumbuhan balita yang lebih terarah.</p><div class="mt-8 flex flex-wrap gap-3"><a href="{{ route('register') }}" class="rounded-xl bg-prevanta-600 px-6 py-3.5 font-bold text-white">Mulai Sekarang</a><a href="#fitur" class="rounded-xl border border-prevanta-200 bg-white px-6 py-3.5 font-bold text-prevanta-700">Lihat Fitur</a></div></div>
            <img src="{{ asset('assets/images/family-illustration.svg') }}" alt="Keluarga dengan anak sehat" class="mx-auto max-h-[570px] w-full max-w-xl object-contain">
        </div>
    </section>

    <section id="tentang" class="mx-auto max-w-7xl px-5 py-20 text-center lg:px-8"><p class="text-xs font-bold uppercase tracking-[.2em] text-prevanta-600">Bersama menjaga generasi</p><h2 class="mx-auto mt-3 max-w-3xl text-3xl font-bold tracking-tight sm:text-4xl">Pemantauan balita yang mudah dipahami setiap keluarga</h2><p class="mx-auto mt-5 max-w-2xl leading-7 text-ink-500">Data pertumbuhan, imunisasi, jadwal Posyandu, dan edukasi tersaji rapi untuk membantu keputusan yang lebih cepat.</p></section>

    <section id="fitur" class="bg-white py-20"><div class="mx-auto max-w-7xl px-5 lg:px-8"><div class="grid gap-5 md:grid-cols-3">@foreach ([['users','Pantau Pertumbuhan','Catat berat, tinggi, dan perkembangan balita dalam riwayat yang mudah dibaca.'],['clipboard','Kolaborasi Tenaga Kesehatan','Kader dan bidan dapat memantau serta memverifikasi data pengukuran.'],['book','Edukasi Terpercaya','Akses materi gizi, imunisasi, dan pola asuh sesuai usia anak.']] as [$icon,$title,$text])<x-card class="text-center"><span class="mx-auto grid size-14 place-items-center rounded-2xl bg-prevanta-50 text-prevanta-600"><x-icon :name="$icon" class="size-7" /></span><h3 class="mt-5 text-xl font-bold">{{ $title }}</h3><p class="mt-3 text-sm leading-7 text-ink-500">{{ $text }}</p></x-card>@endforeach</div></div></section>

    <section id="alur" class="mx-auto max-w-7xl px-5 py-20 lg:px-8"><div class="grid items-center gap-12 lg:grid-cols-2"><div><p class="text-xs font-bold uppercase tracking-[.2em] text-prevanta-600">Cara Kerja</p><h2 class="mt-3 text-3xl font-bold">Tiga langkah untuk pemantauan yang berkelanjutan</h2></div><div class="grid gap-4">@foreach ([['01','Daftarkan profil anak'],['02','Lakukan pengukuran di Posyandu'],['03','Pantau hasil dan rekomendasi']] as [$number,$label])<div class="flex items-center gap-4 rounded-2xl border border-prevanta-100 bg-white p-5 shadow-card"><span class="grid size-11 place-items-center rounded-full bg-prevanta-600 font-bold text-white">{{ $number }}</span><p class="font-bold">{{ $label }}</p></div>@endforeach</div></div></section>

    <section id="edukasi" class="mx-5 mb-20 overflow-hidden rounded-[2rem] bg-gradient-to-r from-prevanta-800 to-prevanta-500 px-6 py-16 text-center text-white lg:mx-auto lg:max-w-7xl"><h2 class="text-3xl font-bold sm:text-4xl">Mari tumbuh bersama Prevanta</h2><p class="mx-auto mt-4 max-w-xl text-prevanta-100">Jadikan setiap pengukuran langkah kecil menuju generasi Indonesia yang lebih sehat.</p><a href="{{ route('register') }}" class="mt-7 inline-block rounded-xl bg-white px-6 py-3.5 font-bold text-prevanta-700">Daftar Gratis</a></section>
</main>

<footer class="border-t border-prevanta-100 bg-white"><div class="mx-auto flex max-w-7xl flex-col gap-5 px-5 py-8 text-sm text-ink-500 sm:flex-row sm:items-center sm:justify-between lg:px-8"><span>© 2026 Prevanta · Sistem Informasi Posyandu</span><div class="flex gap-5"><a href="#">Privasi</a><a href="#">Bantuan</a><a href="#">Kontak</a></div></div></footer>
@endsection
