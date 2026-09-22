<?php

namespace Database\Factories;

use App\Models\Balita;
use App\Models\ImunisasiBalita;
use App\Models\JenisImunisasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ImunisasiBalita>
 */
class ImunisasiBalitaFactory extends Factory
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
            'jenis_imunisasi_id' => JenisImunisasi::factory(),
            'kader_id' => User::factory()->kader(),
            'tanggal_pemberian' => fake()->dateTimeBetween('-2 years', 'now'),
            'status' => 'diberikan',
        ];
    }
}
