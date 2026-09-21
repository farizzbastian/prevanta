@extends('layouts.app')

@section('title', 'Edukasi Kader — Prevanta')

@section('content')
<x-portal-shell role="kader" active="education">
    <x-page-header eyebrow="Pustaka Posyandu" title="Edukasi" description="Kelola materi edukasi yang dapat dibaca orang tua."><x-slot:actions><a href="{{ route('kader.add-education') }}" class="inline-flex items-center gap-2 rounded-xl bg-prevanta-600 px-4 py-2.5 text-sm font-bold text-white"><x-icon name="plus" class="size-4" /> Tambah Edukasi</a></x-slot:actions></x-page-header>
    <x-card padding="p-4"><div class="flex flex-col gap-3 sm:flex-row"><label class="relative flex-1"><x-icon name="search" class="absolute left-3 top-3 size-5 text-ink-500" /><input type="search" placeholder="Cari judul edukasi..." class="w-full rounded-xl border border-prevanta-100 py-2.5 pl-11 pr-4 text-sm outline-none"></label><select class="rounded-xl border border-prevanta-100 bg-white px-4 text-sm"><option>Semua Kategori</option><option>Gizi</option><option>Imunisasi</option></select></div></x-card>
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3"><x-article-card title="Menu MPASI Seimbang untuk Usia 6–12 Bulan" category="Gizi" excerpt="Panduan komposisi MPASI sesuai kebutuhan anak." /><x-article-card title="Kenali Tanda Perkembangan Anak" excerpt="Milestone penting yang perlu diketahui orang tua." tone="mint" /><x-article-card title="Jadwal Imunisasi Dasar Lengkap" category="Imunisasi" excerpt="Rangkuman jadwal imunisasi dari lahir hingga balita." tone="sand" /><x-article-card title="Cegah Stunting Sejak 1000 HPK" category="Gizi" excerpt="Langkah pencegahan yang dapat dilakukan keluarga." /><x-article-card title="Stimulasi Motorik untuk Balita" excerpt="Aktivitas mudah yang dapat dilakukan di rumah." tone="mint" /><x-article-card title="Pola Makan Anak Saat Sakit" category="Gizi" excerpt="Tips menjaga asupan saat nafsu makan menurun." tone="sand" /></div>
</x-portal-shell>
@endsection
