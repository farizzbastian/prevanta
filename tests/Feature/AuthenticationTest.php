<?php

namespace Tests\Feature;

use App\Gender;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_orang_tua_can_register_with_valid_data(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Siti Rahayu',
            'email' => 'siti@example.test',
            'no_hp' => '081234567890',
            'nik' => '3273014401900001',
            'jenis_kelamin' => Gender::Perempuan->value,
            'hubungan_dengan_balita' => 'ibu',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'terms' => '1',
        ]);

        $response->assertRedirectToRoute('parent.children');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'siti@example.test', 'name' => 'Siti Rahayu']);
        $this->assertDatabaseHas('orang_tua', ['nik' => '3273014401900001']);
    }

    public function test_registration_rejects_invalid_identity_and_weak_password(): void
    {
        $response = $this->from(route('register'))->post(route('register.store'), [
            'name' => 'Siti123',
            'email' => 'email-tidak-valid',
            'no_hp' => '1234',
            'nik' => '123',
            'jenis_kelamin' => 'invalid',
            'hubungan_dengan_balita' => 'invalid',
            'password' => 'lemah',
            'password_confirmation' => 'lemah',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertInvalid(['name', 'email', 'no_hp', 'nik', 'jenis_kelamin', 'hubungan_dengan_balita', 'password', 'terms']);
        $this->assertGuest();
    }

    public function test_registration_rejects_duplicate_name_email_phone_and_nik(): void
    {
        $user = User::factory()->orangTua()->create([
            'name' => 'Nama Unik',
            'email' => 'unik@example.test',
            'no_hp' => '081234567891',
        ]);
        OrangTua::factory()->for($user)->create(['nik' => '3273014401900002']);

        $response = $this->post(route('register.store'), [
            'name' => 'Nama Unik',
            'email' => 'unik@example.test',
            'no_hp' => '081234567891',
            'nik' => '3273014401900002',
            'jenis_kelamin' => Gender::Perempuan->value,
            'hubungan_dengan_balita' => 'ibu',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'terms' => '1',
        ]);

        $response->assertInvalid(['name', 'email', 'no_hp', 'nik']);
    }

    public function test_each_role_is_redirected_to_the_correct_dashboard_after_login(): void
    {
        $cases = [
            ['orangTua', 'parent.children'],
            ['kader', 'kader.dashboard'],
            ['bidan', 'bidan.dashboard'],
        ];

        foreach ($cases as [$state, $routeName]) {
            $user = User::factory()->{$state}()->create(['password' => 'Password123']);

            if ($state === 'orangTua') {
                OrangTua::factory()->for($user)->create();
            }

            $response = $this->post(route('login.store'), [
                'email' => $user->email,
                'password' => 'Password123',
            ]);

            $response->assertRedirectToRoute($routeName);
            $this->post(route('logout'));
        }
    }

    public function test_invalid_credentials_are_rejected(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'Password-yang-salah',
        ]);

        $response->assertInvalid(['email']);
        $this->assertGuest();
    }
}
