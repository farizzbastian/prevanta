<?php

namespace Tests\Feature\Console\Commands;

use App\Gender;
use App\GrowthStatus;
use App\Models\Balita;
use App\Models\Pengukuran;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class RecalculateGrowthStatusesTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_command_recalculates_existing_measurements_using_who_standard(): void
    {
        $child = Balita::factory()->create([
            'tanggal_lahir' => '2026-01-01',
            'jenis_kelamin' => Gender::LakiLaki,
        ]);
        $measurement = Pengukuran::factory()->for($child, 'balita')->create([
            'tanggal_pengukuran' => '2026-01-01',
            'tinggi_badan' => 49.8842,
            'z_score' => -9,
            'status_pertumbuhan' => GrowthStatus::SangatPendek,
        ]);

        $this->artisan('measurements:recalculate-growth')
            ->expectsOutput('1 pengukuran berhasil dihitung ulang berdasarkan standar WHO.')
            ->assertSuccessful();

        $measurement->refresh();
        $this->assertSame('-0.002', $measurement->z_score);
        $this->assertSame(GrowthStatus::Normal, $measurement->status_pertumbuhan);
    }
}
