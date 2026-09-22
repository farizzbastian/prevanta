@extends('layouts.app')

@section('title', 'Edukasi Tumbuh Kembang — Prevanta')

@section('content')
<x-portal-shell role="orang-tua" active="education">
    <x-page-header eyebrow="Materi Pilihan" title="Edukasi Tumbuh Kembang" description="Informasi terpercaya untuk mendampingi setiap tahap perkembangan buah hati." />
    <div class="flex flex-wrap gap-2" data-tabs>@foreach (['Semua','Gizi','Tumbuh Kembang','Imunisasi','Pola Asuh'] as $tab)<button type="button" data-tab class="rounded-full px-4 py-2 text-xs font-bold {{ $loop->first ? 'bg-prevanta-600 text-white' : 'bg-white text-ink-500' }} ring-1 ring-prevanta-100">{{ $tab }}</button>@endforeach</div>
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($articles as $article)
            <x-article-card :title="$article->judul" :category="$article->kategori" :excerpt="str($article->konten)->limit(130)" :image="$article->gambar" :tone="$loop->iteration % 3 === 0 ? 'sand' : ($loop->even ? 'mint' : 'rose')" />
        @empty
            <x-card class="md:col-span-2 xl:col-span-3"><p class="text-sm text-ink-500">Belum ada materi edukasi yang dipublikasikan.</p></x-card>
        @endforelse
    </div>
    {{ $articles->links() }}
</x-portal-shell>
@endsection
