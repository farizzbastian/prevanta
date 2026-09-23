<?php

namespace App\Console\Commands;

use App\Models\Pengukuran;
use App\Services\Growth\WhoHeightForAgeCalculator;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('measurements:recalculate-growth')]
#[Description('Hitung ulang Z-score PB/U atau TB/U dan status pertumbuhan berdasarkan standar WHO.')]
class RecalculateGrowthStatuses extends Command
{
    public function handle(WhoHeightForAgeCalculator $calculator): int
    {
        $updated = 0;

        Pengukuran::query()
            ->with('balita')
            ->orderBy('id')
            ->chunkById(100, function ($measurements) use ($calculator, &$updated): void {
                foreach ($measurements as $measurement) {
                    $growth = $calculator->calculate(
                        $measurement->balita->jenis_kelamin,
                        $measurement->balita->tanggal_lahir,
                        $measurement->tanggal_pengukuran,
                        (float) $measurement->tinggi_badan,
                    );

                    $measurement->update([
                        'z_score' => $growth->zScore,
                        'status_pertumbuhan' => $growth->status,
                    ]);
                    $updated++;
                }
            });

        $this->info("{$updated} pengukuran berhasil dihitung ulang berdasarkan standar WHO.");

        return self::SUCCESS;
    }
}
