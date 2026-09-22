<?php

namespace App;

enum VerificationStatus: string
{
    case Terverifikasi = 'terverifikasi';
    case PerluPengukuranUlang = 'perlu_pengukuran_ulang';

    public function label(): string
    {
        return match ($this) {
            self::Terverifikasi => 'Terverifikasi',
            self::PerluPengukuranUlang => 'Perlu Pengukuran Ulang',
        };
    }
}
