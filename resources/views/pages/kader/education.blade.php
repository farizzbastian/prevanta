@extends('layouts.app')

@section('title', 'Edukasi Kader — Prevanta')

@section('content')
<x-portal-shell role="kader" active="education">
    <x-page-header eyebrow="Pustaka Posyandu" title="Edukasi" description="Kelola materi edukasi yang dapat dibaca orang tua."><x-slot:actions><a href="{{ route('kader.add-education') }}" class="inline-flex items-center gap-2 rounded-xl bg-prevanta-600 px-4 py-2.5 text-sm font-bold text-white"><x-icon name="plus" class="size-4" /> Tambah Edukasi</a></x-slot:actions></x-page-header>
    <x-card padding="p-4"><form method="GET" class="flex flex-col gap-3 sm:flex-row"><label class="relative flex-1"><x-icon name="search" class="absolute left-3 top-3 size-5 text-ink-500" /><input type="search" name="search" value="{{ request('search') }}" placeholder="Cari judul edukasi..." class="w-full rounded-xl border border-prevanta-100 py-2.5 pl-11 pr-4 text-sm outline-none"></label><select name="category" class="rounded-xl border border-prevanta-100 bg-white px-4 text-sm"><option value="">Semua Kategori</option>@foreach (['Gizi','Tumbuh Kembang','Imunisasi','Pola Asuh'] as $category)<option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>@endforeach</select><button class="rounded-xl border border-prevanta-100 px-4 py-2.5 text-sm font-bold">Filter</button></form></x-card>
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">@forelse ($articles as $article)<x-article-card :title="$article->judul" :category="$article->kategori" :excerpt="str($article->konten)->limit(130)" :image="$article->gambar" :tone="$loop->iteration % 3 === 0 ? 'sand' : ($loop->even ? 'mint' : 'rose')" />@empty<x-card class="md:col-span-2 xl:col-span-3"><p class="text-sm text-ink-500">Materi edukasi tidak ditemukan.</p></x-card>@endforelse</div>
    {{ $articles->links() }}
</x-portal-shell>
@endsection
