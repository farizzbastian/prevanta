<?php

namespace App;

enum GrowthStatus: string
{
    case Normal = 'normal';
    case PerluDipantau = 'perlu_dipantau';
    case RisikoStunting = 'risiko_stunting';

    public function label(): string
    {
        return match ($this) {
            self::Normal => 'Normal',
            self::PerluDipantau => 'Perlu Dipantau',
            self::RisikoStunting => 'Risiko Stunting',
        };
    }
}
