<?php

namespace Database\Factories;

use App\Gender;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrangTua>
 */
class OrangTuaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->orangTua(),
            'nik' => fake()->unique()->numerify('################'),
            'jenis_kelamin' => fake()->randomElement(Gender::cases()),
            'hubungan_dengan_balita' => fake()->randomElement(['ibu', 'ayah', 'wali']),
        ];
    }
}
