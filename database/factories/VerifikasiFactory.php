<?php

namespace Database\Factories;

use App\Models\Pengukuran;
use App\Models\User;
use App\Models\Verifikasi;
use App\VerificationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Verifikasi>
 */
class VerifikasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pengukuran_id' => Pengukuran::factory(),
            'bidan_id' => User::factory()->bidan(),
            'tanggal_verifikasi' => now(),
            'status' => VerificationStatus::Terverifikasi,
            'catatan_penyuluhan' => fake()->sentence(),
            'tindak_lanjut' => fake()->sentence(),
        ];
    }
}
