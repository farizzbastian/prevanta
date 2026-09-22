<?php

namespace Tests\Feature;

use App\Gender;
use App\GrowthStatus;
use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class KaderBalitaTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_only_kader_can_access_kader_pages(): void
    {
        $this->get(route('kader.monitoring'))->assertRedirectToRoute('login');

        $parent = User::factory()->orangTua()->create();
        OrangTua::factory()->for($parent)->create();

        $this->actingAs($parent)->get(route('kader.monitoring'))->assertForbidden();
    }

    public function test_kader_can_create_balita_with_valid_data(): void
    {
        $kader = User::factory()->kader()->create();
        $parent = OrangTua::factory()->create();

        $response = $this->actingAs($kader)->post(route('kader.children.store'), [
            'orang_tua_id' => $parent->id,
            'nama' => 'Arka Pratama',
            'nik' => '3273010101240001',
            'tanggal_lahir' => now()->subYears(2)->toDateString(),
            'jenis_kelamin' => Gender::LakiLaki->value,
            'alamat' => 'Jalan Melati Nomor 10 Bandung',
        ]);

        $balita = Balita::query()->where('nik', '3273010101240001')->firstOrFail();
        $response->assertRedirectToRoute('kader.child-profile', $balita);
        $this->assertDatabaseHas('balita', ['nama' => 'Arka Pratama', 'orang_tua_id' => $parent->id]);
    }

    public function test_balita_validation_rejects_numeric_name_and_invalid_nik(): void
    {
        $kader = User::factory()->kader()->create();
        $parent = OrangTua::factory()->create();

        $response = $this->actingAs($kader)->post(route('kader.children.store'), [
            'orang_tua_id' => $parent->id,
            'nama' => 'Arka 123',
            'nik' => '123',
            'tanggal_lahir' => now()->subYears(6)->toDateString(),
            'jenis_kelamin' => Gender::LakiLaki->value,
            'alamat' => 'Pendek',
        ]);

        $response->assertInvalid(['nama', 'nik', 'tanggal_lahir', 'alamat']);
    }

    public function test_kader_can_record_a_measurement_for_balita(): void
    {
        $kader = User::factory()->kader()->create();
        $balita = Balita::factory()->create();

        $response = $this->actingAs($kader)->post(route('kader.measurements.store', $balita), [
            'tanggal_pengukuran' => today()->toDateString(),
            'berat_badan' => 11.8,
            'tinggi_badan' => 86,
            'lingkar_lengan_atas' => 14,
            'lingkar_kepala' => 47,
            'z_score' => -0.5,
            'status_pertumbuhan' => GrowthStatus::Normal->value,
        ]);

        $response->assertRedirectToRoute('kader.child-profile', $balita);
        $this->assertDatabaseHas('pengukuran', [
            'balita_id' => $balita->id,
            'kader_id' => $kader->id,
            'tanggal_pengukuran' => today()->startOfDay()->toDateTimeString(),
        ]);
    }
}
