@if (session('success'))
    <div class="flex items-center justify-between gap-4 rounded-xl border border-mint-100 bg-mint-50 px-4 py-3 text-sm font-semibold text-mint-600" role="status">
        <span>{{ session('success') }}</span>
        <button type="button" class="text-lg leading-none" onclick="this.parentElement.remove()" aria-label="Tutup pesan">×</button>
    </div>
@endif

@if ($errors->any())
    <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
        <p class="font-bold">Periksa kembali data berikut:</p>
        <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
