<?php

namespace App;

enum GrowthStatus: string
{
    case Normal = 'normal';
    case Pendek = 'pendek';
    case SangatPendek = 'sangat_pendek';

    public function label(): string
    {
        return match ($this) {
            self::Normal => 'Normal',
            self::Pendek => 'Pendek (Stunted)',
            self::SangatPendek => 'Sangat Pendek (Severely Stunted)',
        };
    }

    public static function fromZScore(float $zScore): self
    {
        if ($zScore >= -2) {
            return self::Normal;
        }

        if ($zScore >= -3) {
            return self::Pendek;
        }

        return self::SangatPendek;
    }
}
