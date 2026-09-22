<?php

namespace Database\Factories;

use App\Models\Balita;
use App\Models\JenisVitamin;
use App\Models\User;
use App\Models\VitaminBalita;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VitaminBalita>
 */
class VitaminBalitaFactory extends Factory
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
            'jenis_vitamin_id' => JenisVitamin::factory(),
            'kader_id' => User::factory()->kader(),
            'tanggal_pemberian' => fake()->dateTimeBetween('-1 year', 'now'),
            'status' => 'diberikan',
        ];
    }
}
