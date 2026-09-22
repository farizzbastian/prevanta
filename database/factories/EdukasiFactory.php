<?php

namespace Database\Factories;

use App\Models\Edukasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Edukasi>
 */
class EdukasiFactory extends Factory
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
            'judul' => fake()->sentence(6),
            'konten' => fake()->paragraphs(4, true),
            'gambar' => null,
            'kategori' => fake()->randomElement(['Gizi', 'Tumbuh Kembang', 'Imunisasi', 'Pola Asuh']),
        ];
    }
}
