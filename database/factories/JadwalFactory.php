<?php

namespace Database\Factories;

use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jadwal>
 */
class JadwalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->kader(),
            'jenis_kegiatan' => fake()->randomElement(['Pelayanan Posyandu', 'Kunjungan Rumah', 'Kelas Ibu Balita']),
            'tanggal' => fake()->dateTimeBetween('now', '+3 months'),
            'lokasi' => fake()->streetAddress(),
            'keterangan' => fake()->sentence(),
        ];
    }
}
