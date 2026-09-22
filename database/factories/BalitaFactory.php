<?php

namespace Database\Factories;

use App\Gender;
use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Balita>
 */
class BalitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'orang_tua_id' => OrangTua::factory(),
            'nama' => fake()->name(),
            'nik' => fake()->unique()->numerify('################'),
            'tanggal_lahir' => fake()->dateTimeBetween('-4 years', '-2 months'),
            'jenis_kelamin' => fake()->randomElement(Gender::cases()),
            'alamat' => fake()->address(),
        ];
    }
}
