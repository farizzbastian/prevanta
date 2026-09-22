<?php

namespace Database\Factories;

use App\Models\User;
use App\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => '08'.fake()->unique()->numerify('##########'),
            'password' => static::$password ??= Hash::make('Password123'),
            'role' => UserRole::OrangTua,
            'remember_token' => Str::random(10),
        ];
    }

    public function orangTua(): static
    {
        return $this->state(fn (): array => ['role' => UserRole::OrangTua]);
    }

    public function kader(): static
    {
        return $this->state(fn (): array => ['role' => UserRole::Kader]);
    }

    public function bidan(): static
    {
        return $this->state(fn (): array => ['role' => UserRole::Bidan]);
    }
}
