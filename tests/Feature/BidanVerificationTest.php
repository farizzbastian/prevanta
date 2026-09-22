<?php

namespace Tests\Feature;

use App\Models\Pengukuran;
use App\Models\User;
use App\VerificationStatus;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class BidanVerificationTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_non_bidan_cannot_verify_measurements(): void
    {
        $kader = User::factory()->kader()->create();
        $measurement = Pengukuran::factory()->create();

        $this->actingAs($kader)
            ->post(route('bidan.verification.store', $measurement), [
                'status' => VerificationStatus::Terverifikasi->value,
                'tindak_lanjut' => 'Lanjutkan pemantauan rutin.',
            ])
            ->assertForbidden();
    }

    public function test_bidan_can_verify_a_measurement(): void
    {
        $bidan = User::factory()->bidan()->create();
        $measurement = Pengukuran::factory()->create();

        $response = $this->actingAs($bidan)
            ->post(route('bidan.verification.store', $measurement), [
                'status' => VerificationStatus::Terverifikasi->value,
                'catatan_penyuluhan' => 'Orang tua sudah menerima penyuluhan gizi.',
                'tindak_lanjut' => 'Lanjutkan pemantauan rutin pada jadwal berikutnya.',
            ]);

        $response->assertRedirectToRoute('bidan.verification');
        $this->assertDatabaseHas('verifikasi', [
            'pengukuran_id' => $measurement->id,
            'bidan_id' => $bidan->id,
            'status' => VerificationStatus::Terverifikasi->value,
        ]);
    }

    public function test_verification_requires_a_meaningful_follow_up(): void
    {
        $bidan = User::factory()->bidan()->create();
        $measurement = Pengukuran::factory()->create();

        $response = $this->actingAs($bidan)
            ->post(route('bidan.verification.store', $measurement), [
                'status' => 'invalid',
                'tindak_lanjut' => 'Singkat',
            ]);

        $response->assertInvalid(['status', 'tindak_lanjut']);
    }
}
