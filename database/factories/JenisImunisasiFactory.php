<?php

namespace Database\Factories;

use App\Models\JenisImunisasi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JenisImunisasi>
 */
class JenisImunisasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_imunisasi' => fake()->unique()->words(2, true),
            'deskripsi' => fake()->sentence(),
        ];
    }
}
