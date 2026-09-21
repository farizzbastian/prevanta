@extends('layouts.app')

@section('title', 'Edukasi Tumbuh Kembang — Prevanta')

@section('content')
<x-portal-shell role="orang-tua" active="education">
    <x-page-header eyebrow="Materi Pilihan" title="Edukasi Tumbuh Kembang" description="Informasi terpercaya untuk mendampingi setiap tahap perkembangan buah hati." />
    <div class="flex flex-wrap gap-2" data-tabs>@foreach (['Semua','Gizi','Tumbuh Kembang','Imunisasi','Pola Asuh'] as $tab)<button type="button" data-tab class="rounded-full px-4 py-2 text-xs font-bold {{ $loop->first ? 'bg-prevanta-600 text-white' : 'bg-white text-ink-500' }} ring-1 ring-prevanta-100">{{ $tab }}</button>@endforeach</div>
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        <x-article-card title="Menu MPASI Seimbang untuk Usia 6–12 Bulan" category="Gizi" excerpt="Kenali komposisi makanan pendamping ASI yang sesuai kebutuhan pertumbuhan anak." />
        <x-article-card title="Tanda Perkembangan Anak Sesuai Usianya" excerpt="Panduan sederhana mengamati kemampuan motorik, bahasa, dan sosial anak." tone="mint" />
        <x-article-card title="Mengapa Imunisasi Dasar Lengkap Penting?" category="Imunisasi" excerpt="Perlindungan penting untuk membantu anak terhindar dari penyakit berbahaya." tone="sand" />
        <x-article-card title="Membentuk Kebiasaan Makan yang Sehat" category="Pola Asuh" excerpt="Langkah praktis membangun suasana makan yang positif di rumah." tone="mint" />
        <x-article-card title="Cegah Stunting Sejak 1000 Hari Pertama" category="Gizi" excerpt="Periode emas yang menentukan kualitas pertumbuhan dan perkembangan anak." />
        <x-article-card title="Stimulasi Sederhana untuk Balita Aktif" excerpt="Ide permainan aman yang membantu anak belajar sambil bergerak." tone="sand" />
    </div>
</x-portal-shell>
@endsection
