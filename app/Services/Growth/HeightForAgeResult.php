<?php

namespace App\Services\Growth;

use App\GrowthStatus;

readonly class HeightForAgeResult
{
    public function __construct(
        public float $zScore,
        public GrowthStatus $status,
        public string $indicator,
        public int $ageInDays,
    ) {}
}
