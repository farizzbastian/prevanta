<?php

namespace Database\Seeders;

use App\Gender;
use App\GrowthStatus;
use App\Models\Edukasi;
use App\Models\ImunisasiBalita;
use App\Models\Jadwal;
use App\Models\JenisImunisasi;
use App\Models\JenisVitamin;
use App\Models\Pengukuran;
use App\Models\User;
use App\Models\Verifikasi;
use App\Models\VitaminBalita;
use App\UserRole;
use App\VerificationStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $parent = User::factory()->create([
            'name' => 'Siti Rahayu',
            'email' => 'orangtua@prevanta.test',
            'no_hp' => '081234567890',
            'password' => 'Password123',
            'role' => UserRole::OrangTua,
        ]);
        $parentProfile = $parent->orangTua()->create([
            'nik' => '3204015205980001',
            'jenis_kelamin' => Gender::Perempuan,
            'hubungan_dengan_balita' => 'ibu',
        ]);

        $secondParent = User::factory()->create([
            'name' => 'Rina Marlina',
            'email' => 'rina@prevanta.test',
            'no_hp' => '081234567891',
            'password' => 'Password123',
            'role' => UserRole::OrangTua,
        ]);
        $secondParent->orangTua()->create([
            'nik' => '3204015205980002',
            'jenis_kelamin' => Gender::Perempuan,
            'hubungan_dengan_balita' => 'ibu',
        ]);

        $kader = User::factory()->create([
            'name' => 'Kader Siti Rahayu',
            'email' => 'kader@prevanta.test',
            'no_hp' => '081234567892',
            'password' => 'Password123',
            'role' => UserRole::Kader,
        ]);
        $bidan = User::factory()->create([
            'name' => 'Dewi Anggraini',
            'email' => 'bidan@prevanta.test',
            'no_hp' => '081234567893',
            'password' => 'Password123',
            'role' => UserRole::Bidan,
        ]);

        $arka = $parentProfile->balita()->create([
            'nama' => 'Arka Pratama',
            'nik' => '3204011205240001',
            'tanggal_lahir' => '2024-05-12',
            'jenis_kelamin' => Gender::LakiLaki,
            'alamat' => 'RT 04 / RW 03, Desa Sukamaju',
        ]);
        $aisyah = $parentProfile->balita()->create([
            'nama' => 'Aisyah Putri',
            'nik' => '3204012811250002',
            'tanggal_lahir' => '2025-11-28',
            'jenis_kelamin' => Gender::Perempuan,
            'alamat' => 'RT 04 / RW 03, Desa Sukamaju',
        ]);

        foreach ([
            ['2026-04-12', 10.4, 79.0, 45.2, -0.8, GrowthStatus::Normal],
            ['2026-05-12', 10.7, 80.2, 45.5, -0.7, GrowthStatus::Normal],
            ['2026-06-14', 10.9, 82.1, 46.2, -0.6, GrowthStatus::Normal],
            ['2026-07-13', 11.2, 83.5, 46.5, -0.5, GrowthStatus::Normal],
            ['2026-08-15', 11.5, 84.8, 46.8, -0.4, GrowthStatus::Normal],
            ['2026-09-12', 11.8, 86.0, 47.0, -0.3, GrowthStatus::Normal],
        ] as [$date, $weight, $height, $head, $zScore, $status]) {
            Pengukuran::create([
                'balita_id' => $arka->id,
                'kader_id' => $kader->id,
                'tanggal_pengukuran' => $date,
                'berat_badan' => $weight,
                'tinggi_badan' => $height,
                'lingkar_lengan_atas' => 14.5,
                'lingkar_kepala' => $head,
                'z_score' => $zScore,
                'status_pertumbuhan' => $status,
            ]);
        }

        Pengukuran::create([
            'balita_id' => $aisyah->id,
            'kader_id' => $kader->id,
            'tanggal_pengukuran' => '2026-09-12',
            'berat_badan' => 7.1,
            'tinggi_badan' => 67,
            'lingkar_lengan_atas' => 12.1,
            'lingkar_kepala' => 43,
            'z_score' => -1.8,
            'status_pertumbuhan' => GrowthStatus::PerluDipantau,
        ]);

        $verifiedMeasurement = $arka->pengukuran()->oldest('tanggal_pengukuran')->firstOrFail();
        Verifikasi::create([
            'pengukuran_id' => $verifiedMeasurement->id,
            'bidan_id' => $bidan->id,
            'tanggal_verifikasi' => '2026-04-13',
            'status' => VerificationStatus::Terverifikasi,
            'catatan_penyuluhan' => 'Pertumbuhan sesuai kurva. Pertahankan asupan gizi seimbang.',
            'tindak_lanjut' => 'Lanjutkan pemantauan rutin setiap bulan.',
        ]);

        $bcg = JenisImunisasi::create(['nama_imunisasi' => 'BCG & Polio 1', 'deskripsi' => 'Imunisasi dasar untuk bayi.']);
        $dpt = JenisImunisasi::create(['nama_imunisasi' => 'DPT-HB-Hib 1', 'deskripsi' => 'Perlindungan terhadap difteri, pertusis, tetanus, hepatitis B, dan Hib.']);
        $mr = JenisImunisasi::create(['nama_imunisasi' => 'Campak Rubella', 'deskripsi' => 'Perlindungan terhadap campak dan rubella.']);

        foreach ([[$bcg, '2024-06-20'], [$dpt, '2024-07-18'], [$mr, '2025-02-15']] as [$type, $date]) {
            ImunisasiBalita::create([
                'balita_id' => $arka->id,
                'jenis_imunisasi_id' => $type->id,
                'kader_id' => $kader->id,
                'tanggal_pemberian' => $date,
                'status' => 'diberikan',
            ]);
        }

        $vitaminA = JenisVitamin::create(['nama_vitamin' => 'Vitamin A', 'deskripsi' => 'Mendukung kesehatan mata dan daya tahan tubuh.']);
        VitaminBalita::create([
            'balita_id' => $arka->id,
            'jenis_vitamin_id' => $vitaminA->id,
            'kader_id' => $kader->id,
            'tanggal_pemberian' => '2026-08-15',
            'status' => 'diberikan',
        ]);

        Jadwal::create([
            'user_id' => $kader->id,
            'jenis_kegiatan' => 'Pelayanan Posyandu Bulanan',
            'tanggal' => '2026-09-28 08:00:00',
            'lokasi' => 'Posyandu Mawar Melati',
            'keterangan' => 'Penimbangan, pengukuran, imunisasi, dan konsultasi.',
        ]);
        Jadwal::create([
            'user_id' => $bidan->id,
            'jenis_kegiatan' => 'Kelas Ibu Balita',
            'tanggal' => '2026-10-08 10:00:00',
            'lokasi' => 'Balai Desa Sukamaju',
            'keterangan' => 'Edukasi gizi dan stimulasi tumbuh kembang.',
        ]);

        foreach ([
            ['Menu MPASI Seimbang untuk Usia 6–12 Bulan', 'Gizi'],
            ['Tanda Perkembangan Anak Sesuai Usianya', 'Tumbuh Kembang'],
            ['Mengapa Imunisasi Dasar Lengkap Penting?', 'Imunisasi'],
            ['Membentuk Kebiasaan Makan yang Sehat', 'Pola Asuh'],
        ] as [$title, $category]) {
            Edukasi::create([
                'user_id' => $kader->id,
                'judul' => $title,
                'kategori' => $category,
                'konten' => 'Materi edukasi ini membantu orang tua memahami langkah praktis untuk mendukung pertumbuhan dan perkembangan balita secara optimal melalui kebiasaan sehat yang dapat diterapkan setiap hari.',
            ]);
        }
    }
}
