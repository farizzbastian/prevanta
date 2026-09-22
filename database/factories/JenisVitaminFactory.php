<?php

namespace Database\Factories;

use App\Models\JenisVitamin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JenisVitamin>
 */
class JenisVitaminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_vitamin' => 'Vitamin '.fake()->unique()->randomLetter(),
            'deskripsi' => fake()->sentence(),
        ];
    }
}
