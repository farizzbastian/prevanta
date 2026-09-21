@extends('layouts.app')

@section('title', 'Dashboard Bidan — Portal Prevanta')

@section('content')
    @php
        $queueRows = [
            [
                'code' => 'VRF-2025-1024-081',
                'name' => 'Muhammad Arka Pratama',
                'meta' => '18 bulan · Laki-laki',
                'measurement' => 'PB 77,8 cm',
                'weight' => 'BB 9,5 kg · LILA 13,5 cm',
                'status' => 'TWU -3,12',
                'statusMeta' => 'BB Sangat Pendek',
                'time' => '24 Okt 2025',
                'timeMeta' => '09.15 WIB',
                'verification' => 'Sedang Ditinjau',
                'tone' => 'amber',
            ],
            [
                'code' => 'VRF-2025-1024-080',
                'name' => 'Aisyah Putri Azzahra',
                'meta' => '22 bulan · Perempuan',
                'measurement' => 'PB 74,2 cm',
                'weight' => 'BB 9,0 kg · LILA 13,2 cm',
                'status' => 'Normal +0,32',
                'statusMeta' => 'BB Sesuai Usia',
                'time' => '24 Okt 2025',
                'timeMeta' => '08.48 WIB',
                'verification' => 'Menunggu',
                'tone' => 'rose',
            ],
            [
                'code' => 'VRF-2025-1024-079',
                'name' => 'Raka Dwi Saputra',
                'meta' => '31 bulan · Laki-laki',
                'measurement' => 'TB 88,6 cm',
                'weight' => 'BB 11,8 kg · LILA 14 cm',
                'status' => 'Pendek -2,28',
                'statusMeta' => 'Perlu Konfirmasi',
                'time' => '24 Okt 2025',
                'timeMeta' => '08.25 WIB',
                'verification' => 'Prioritas',
                'tone' => 'rose',
            ],
        ];
    @endphp

    <x-sidebar role="bidan" active="portal" />
    <x-navbar role="bidan" />

    <main class="min-w-0 min-h-screen lg:ml-[268px]">
        <div class="mx-auto grid max-w-[1500px] gap-5 px-4 py-5 sm:px-6 sm:py-6 lg:gap-6 lg:px-8 lg:py-7">
            <section class="relative overflow-hidden rounded-[22px] bg-gradient-to-r from-prevanta-700 via-prevanta-600 to-prevanta-400 p-6 text-white shadow-lg shadow-prevanta-200/60 sm:p-8">
                <div class="absolute -right-14 -top-20 size-64 rounded-full border-[40px] border-white/10"></div>
                <div class="absolute -bottom-20 right-52 size-44 rounded-full bg-white/5"></div>

                <div class="relative flex flex-col gap-6 xl:flex-row xl:items-center xl:justify-between">
                    <div class="max-w-3xl">
                        <p class="inline-flex items-center gap-2 rounded-full bg-white/14 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.14em] ring-1 ring-inset ring-white/20">
                            <span class="size-1.5 rounded-full bg-mint-100"></span>
                            Posyandu Mawar Melati · RW 03
                        </p>
                        <h1 class="mt-4 text-balance text-2xl font-bold tracking-tight sm:text-3xl">
                            Selamat Datang, Bidan Dewi Anggraini!
                        </h1>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-white/80">
                            Monitoring prevalensi stunting posyandu, pengelolaan rujukan faskes, dan alokasi PMT pemulihan Puskesmas Pembantu Sukamaju.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2.5">
                        <a href="#antrean" class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-3 text-xs font-bold text-prevanta-700 shadow-sm hover:bg-prevanta-50">
                            <x-icon name="clipboard" class="size-4" />
                            Buka Pemeriksaan
                        </a>
                        <a href="#antrean" class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-3 text-xs font-bold text-white ring-1 ring-inset ring-white/30 hover:bg-white/15">
                            <x-icon name="history" class="size-4" />
                            Lihat Semua Riwayat (128)
                        </a>
                        <button type="button" class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-3 text-xs font-bold text-white ring-1 ring-inset ring-white/30 hover:bg-white/15">
                            <x-icon name="chart" class="size-4" />
                            Rekap SKDN
                        </button>
                    </div>
                </div>
            </section>

            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-3" aria-label="Ringkasan verifikasi balita">
                <x-stat-card
                    eyebrow="Perlu Verifikasi"
                    value="4 Balita"
                    description="Prioritas Hari Ini"
                    icon="clipboard"
                    tone="rose"
                />
                <x-stat-card
                    eyebrow="Sudah Terverifikasi"
                    value="121 Balita"
                    description="Bulan Oktober"
                    icon="check"
                    tone="green"
                />
                <x-stat-card
                    eyebrow="Minta Ukur Ulang"
                    value="3 Balita"
                    description="Anomali Data"
                    icon="refresh"
                    tone="peach"
                    class="md:col-span-2 xl:col-span-1"
                />
            </section>

            <section class="grid gap-5 xl:grid-cols-[minmax(0,1.55fr)_minmax(360px,0.85fr)] lg:gap-6">
                <x-card>
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h2 class="flex items-center gap-2 text-sm font-bold text-ink-900">
                                <x-icon name="chart" class="size-[18px] text-prevanta-600" />
                                Tren Prevalensi Stunting Wilayah Pustu (6 Bulan Terakhir)
                            </h2>
                            <p class="mt-1 text-xs text-ink-500">Mei–Oktober 2025 · Hasil agregasi penimbangan SKDN 4 Posyandu Sukamaju</p>
                        </div>

                        <div class="flex items-center gap-4 text-[10px] font-medium text-ink-500">
                            <span class="inline-flex items-center gap-1.5"><span class="h-0.5 w-5 bg-prevanta-700"></span>Prevanta Pustu</span>
                            <span class="inline-flex items-center gap-1.5"><span class="h-0.5 w-5 border-t border-dashed border-prevanta-300"></span>Batas WHO (20%)</span>
                        </div>
                    </div>

                    <div class="mt-5 overflow-x-auto scrollbar-thin">
                        <svg class="min-w-[640px]" viewBox="0 0 760 260" role="img" aria-label="Grafik prevalensi stunting turun dari 18,2 persen menjadi 14,8 persen">
                            <defs>
                                <linearGradient id="chartArea" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0" stop-color="#cf4869" stop-opacity="0.2" />
                                    <stop offset="1" stop-color="#cf4869" stop-opacity="0" />
                                </linearGradient>
                            </defs>

                            <g stroke="#f1e6e9" stroke-width="1">
                                <line x1="58" y1="42" x2="722" y2="42" />
                                <line x1="58" y1="92" x2="722" y2="92" />
                                <line x1="58" y1="142" x2="722" y2="142" />
                                <line x1="58" y1="192" x2="722" y2="192" />
                            </g>

                            <line x1="58" y1="53" x2="722" y2="53" stroke="#f3aebd" stroke-dasharray="6 6" />
                            <text x="722" y="47" text-anchor="end" fill="#cf4869" font-size="11">WHO 20%</text>
                            <line x1="58" y1="183" x2="722" y2="183" stroke="#8bcdb4" stroke-dasharray="6 6" />
                            <text x="722" y="177" text-anchor="end" fill="#178760" font-size="11">Target 14%</text>

                            <path d="M72 76 L198 91 L324 110 L450 132 L576 148 L702 166 L702 198 L72 198 Z" fill="url(#chartArea)" />
                            <polyline points="72,76 198,91 324,110 450,132 576,148 702,166" fill="none" stroke="#8b2942" stroke-width="3" />

                            @foreach ([['72', '76', '18,2%', 'Mei 25'], ['198', '91', '17,5%', 'Jun 25'], ['324', '110', '16,9%', 'Jul 25'], ['450', '132', '16,0%', 'Agu 25'], ['576', '148', '15,4%', 'Sep 25'], ['702', '166', '14,8%', 'Okt 25']] as [$x, $y, $value, $month])
                                <circle cx="{{ $x }}" cy="{{ $y }}" r="5" fill="white" stroke="#8b2942" stroke-width="3" />
                                <text x="{{ $x }}" y="{{ (int) $y - 14 }}" text-anchor="middle" fill="#493e43" font-size="12" font-weight="700">{{ $value }}</text>
                                <text x="{{ $x }}" y="224" text-anchor="middle" fill="#958a8f" font-size="11">{{ $month }}</text>
                            @endforeach
                        </svg>
                    </div>

                    <div class="mt-4 grid gap-3 border-t border-prevanta-100 pt-4 text-xs sm:grid-cols-3">
                        <div class="flex items-center gap-2 text-ink-500"><span class="size-2 rounded-full bg-mint-500"></span>Penurunan kumulatif <strong class="text-ink-900">3,4%</strong></div>
                        <div class="text-ink-500">Terbesar di <strong class="text-ink-900">Posyandu Melati</strong></div>
                        <a href="#" class="font-semibold text-prevanta-700 hover:text-prevanta-800">Analisis SKDN Bulanan →</a>
                    </div>
                </x-card>

                <x-card>
                    <div class="flex items-start justify-between gap-3">
                        <h2 class="flex items-center gap-2 text-sm font-bold text-ink-900">
                            <x-icon name="users" class="size-[18px] text-prevanta-600" />
                            Distribusi Status Gizi
                        </h2>
                        <span class="rounded-full bg-prevanta-50 px-2.5 py-1 text-[10px] font-bold text-prevanta-700">N=124 Balita</span>
                    </div>

                    <div class="mt-7 flex flex-col items-center gap-7 sm:flex-row sm:items-center xl:flex-col 2xl:flex-row">
                        <div class="relative grid size-40 shrink-0 place-items-center rounded-full bg-[conic-gradient(#27ae7b_0_82.3%,#f3a11b_82.3%_96.8%,#e65b73_96.8%_100%)]">
                            <div class="grid size-24 place-items-center rounded-full bg-white text-center shadow-inner">
                                <span>
                                    <strong class="block text-3xl font-bold text-ink-900">124</strong>
                                    <span class="text-[10px] font-bold uppercase tracking-wide text-ink-500">Terperiksa</span>
                                </span>
                            </div>
                        </div>

                        <dl class="grid w-full gap-3 text-xs">
                            <div class="grid grid-cols-[auto_1fr_auto] items-center gap-2">
                                <span class="size-2.5 rounded-full bg-mint-500"></span>
                                <dt class="font-medium text-ink-700">Normal (Gizi Baik)</dt>
                                <dd class="font-bold text-ink-900">102 <span class="font-medium text-ink-500">82,3%</span></dd>
                            </div>
                            <div class="grid grid-cols-[auto_1fr_auto] items-center gap-2">
                                <span class="size-2.5 rounded-full bg-amber-500"></span>
                                <dt class="font-medium text-ink-700">Pendek (Stunted)</dt>
                                <dd class="font-bold text-ink-900">18 <span class="font-medium text-ink-500">14,5%</span></dd>
                            </div>
                            <div class="grid grid-cols-[auto_1fr_auto] items-center gap-2 rounded-lg bg-prevanta-50 p-2.5">
                                <span class="size-2.5 rounded-full bg-prevanta-500"></span>
                                <dt class="font-medium text-prevanta-800">Sangat Pendek (Severely)</dt>
                                <dd class="font-bold text-prevanta-800">4 <span class="font-medium text-prevanta-600">3,2%</span></dd>
                            </div>
                        </dl>
                    </div>

                    <a href="#antrean" class="mt-7 inline-flex items-center gap-2 text-xs font-bold text-prevanta-700 hover:text-prevanta-800">
                        Lihat Rincian Z-Score Standar Antropometri
                        <x-icon name="arrow-right" class="size-4" />
                    </a>
                </x-card>
            </section>

            <x-card id="antrean" padding="p-0">
                <div class="flex flex-col gap-4 border-b border-prevanta-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 class="flex items-center gap-2 text-sm font-bold text-ink-900">
                                <x-icon name="clipboard" class="size-[18px] text-prevanta-600" />
                                Antrean &amp; Riwayat Log Verifikasi Terkini
                            </h2>
                            <span class="rounded-full bg-prevanta-50 px-2.5 py-1 text-[10px] font-bold text-prevanta-700">5 Terakhir dari 128 Data</span>
                        </div>
                        <p class="mt-1 text-xs text-ink-500">Dikirimkan oleh TPK atau kader lapangan dan perlu ditinjau tenaga kesehatan.</p>
                    </div>

                    <a href="#" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-prevanta-700 px-4 py-3 text-xs font-bold text-white hover:bg-prevanta-800">
                        Lihat Semua Antrean &amp; Riwayat Log (128)
                        <x-icon name="arrow-right" class="size-4" />
                    </a>
                </div>

                <div class="overflow-x-auto scrollbar-thin">
                    <table class="w-full min-w-[1080px] border-collapse text-left">
                        <thead>
                            <tr class="bg-[#fcfafb] text-[10px] font-bold uppercase tracking-[0.08em] text-ink-500">
                                <th class="px-6 py-4">No. Registrasi / ID Ukur</th>
                                <th class="px-4 py-4">Nama Balita &amp; Usia</th>
                                <th class="px-4 py-4">Pengukuran (PB / BB)</th>
                                <th class="px-4 py-4">Z-Score &amp; Status Individu</th>
                                <th class="px-4 py-4">Waktu Masuk</th>
                                <th class="px-4 py-4">Status Verifikasi</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-prevanta-100">
                            @foreach ($queueRows as $row)
                                <tr class="text-xs transition hover:bg-prevanta-50/40">
                                    <td class="px-6 py-4 align-top">
                                        <p class="font-bold text-ink-900">{{ $row['code'] }}</p>
                                        <p class="mt-1 text-[10px] text-ink-500">Posyandu Mawar Melati</p>
                                    </td>
                                    <td class="px-4 py-4 align-top">
                                        <div class="flex items-center gap-3">
                                            <span class="grid size-9 shrink-0 place-items-center rounded-full bg-prevanta-100 text-xs font-bold text-prevanta-700">
                                                {{ collect(explode(' ', $row['name']))->take(2)->map(fn ($part) => mb_substr($part, 0, 1))->join('') }}
                                            </span>
                                            <span>
                                                <span class="block font-bold text-ink-900">{{ $row['name'] }}</span>
                                                <span class="mt-1 block text-[10px] text-ink-500">{{ $row['meta'] }}</span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 align-top">
                                        <p class="font-bold text-ink-900">{{ $row['measurement'] }}</p>
                                        <p class="mt-1 text-[10px] text-ink-500">{{ $row['weight'] }}</p>
                                    </td>
                                    <td class="px-4 py-4 align-top">
                                        <p class="font-bold {{ $row['tone'] === 'rose' ? 'text-prevanta-700' : 'text-mint-600' }}">{{ $row['status'] }}</p>
                                        <p class="mt-1 text-[10px] text-ink-500">{{ $row['statusMeta'] }}</p>
                                    </td>
                                    <td class="px-4 py-4 align-top">
                                        <p class="font-bold text-ink-900">{{ $row['time'] }}</p>
                                        <p class="mt-1 text-[10px] text-ink-500">{{ $row['timeMeta'] }}</p>
                                    </td>
                                    <td class="px-4 py-4 align-top">
                                        <x-status-pill :tone="$row['tone']">{{ $row['verification'] }}</x-status-pill>
                                    </td>
                                    <td class="px-6 py-4 text-right align-top">
                                        <button type="button" class="rounded-lg bg-prevanta-700 px-3 py-2 text-[11px] font-bold text-white hover:bg-prevanta-800">
                                            Periksa &amp; Konfirmasi
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col gap-2 border-t border-prevanta-100 px-6 py-4 text-[11px] text-ink-500 sm:flex-row sm:items-center sm:justify-between">
                    <span>Menampilkan 3 dari 128 riwayat verifikasi</span>
                    <span>Data terakhir diperbarui 24 Oktober 2025 · 09.30 WIB</span>
                </div>
            </x-card>
        </div>
    </main>
@endsection
