<?php

namespace Database\Factories;

use App\GrowthStatus;
use App\Models\Balita;
use App\Models\Pengukuran;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pengukuran>
 */
class PengukuranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'balita_id' => Balita::factory(),
            'kader_id' => User::factory()->kader(),
            'tanggal_pengukuran' => fake()->dateTimeBetween('-6 months', 'now'),
            'berat_badan' => fake()->randomFloat(2, 5, 20),
            'tinggi_badan' => fake()->randomFloat(2, 55, 110),
            'lingkar_lengan_atas' => fake()->randomFloat(2, 10, 25),
            'lingkar_kepala' => fake()->randomFloat(2, 35, 55),
            'foto' => null,
            'z_score' => fake()->randomFloat(2, -2.5, 2),
            'status_pertumbuhan' => GrowthStatus::Normal,
        ];
    }
}
