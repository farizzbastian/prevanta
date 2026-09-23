<?php

namespace App\Services\Growth;

use App\Gender;
use App\GrowthStatus;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use InvalidArgumentException;
use RuntimeException;

class WhoHeightForAgeCalculator
{
    /**
     * WHO Child Growth Standards, length/height-for-age expanded tables:
     * https://www.who.int/tools/child-growth-standards/standards/length-height-for-age
     *
     * @var array<string, array<int, array{l: float, m: float, s: float}>>
     */
    private array $standards = [];

    public function __construct(private readonly ?string $dataDirectory = null) {}

    public function calculate(
        Gender $gender,
        CarbonInterface $dateOfBirth,
        CarbonInterface $measurementDate,
        float $heightCm,
    ): HeightForAgeResult {
        $birthDate = CarbonImmutable::instance($dateOfBirth)->startOfDay();
        $measuredAt = CarbonImmutable::instance($measurementDate)->startOfDay();
        $ageInDays = (int) $birthDate->diffInDays($measuredAt, false);

        if ($ageInDays < 0 || $ageInDays > 1856) {
            throw new InvalidArgumentException('Standar PB/U atau TB/U WHO hanya tersedia untuk usia 0–1856 hari.');
        }

        if ($heightCm <= 0) {
            throw new InvalidArgumentException('Panjang atau tinggi badan harus lebih besar dari nol.');
        }

        $standard = $this->standardFor($gender, $ageInDays);
        $ratio = $heightCm / $standard['m'];
        $zScore = abs($standard['l']) < PHP_FLOAT_EPSILON
            ? log($ratio) / $standard['s']
            : (pow($ratio, $standard['l']) - 1) / ($standard['l'] * $standard['s']);

        return new HeightForAgeResult(
            zScore: round($zScore, 3),
            status: GrowthStatus::fromZScore($zScore),
            indicator: $ageInDays <= 730 ? 'PB/U' : 'TB/U',
            ageInDays: $ageInDays,
        );
    }

    /**
     * @return array{l: float, m: float, s: float}
     */
    private function standardFor(Gender $gender, int $ageInDays): array
    {
        $sex = $gender === Gender::LakiLaki ? 'boys' : 'girls';

        if (! isset($this->standards[$sex])) {
            $this->standards[$sex] = $this->loadStandards($sex);
        }

        return $this->standards[$sex][$ageInDays]
            ?? throw new RuntimeException("Standar WHO untuk usia {$ageInDays} hari tidak ditemukan.");
    }

    /**
     * @return array<int, array{l: float, m: float, s: float}>
     */
    private function loadStandards(string $sex): array
    {
        $directory = $this->dataDirectory ?? resource_path('data/who');
        $path = $directory.DIRECTORY_SEPARATOR."lhfa_{$sex}.csv";
        $handle = fopen($path, 'rb');

        if ($handle === false) {
            throw new RuntimeException("Tabel standar WHO tidak dapat dibaca: {$path}");
        }

        $standards = [];
        fgetcsv($handle, escape: '');

        while (($row = fgetcsv($handle, escape: '')) !== false) {
            $standards[(int) $row[0]] = [
                'l' => (float) $row[1],
                'm' => (float) $row[2],
                's' => (float) $row[3],
            ];
        }

        fclose($handle);

        return $standards;
    }
}
