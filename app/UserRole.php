<?php

namespace App;

enum UserRole: string
{
    case OrangTua = 'orang_tua';
    case Kader = 'kader';
    case Bidan = 'bidan';

    public function label(): string
    {
        return match ($this) {
            self::OrangTua => 'Orang Tua',
            self::Kader => 'Kader',
            self::Bidan => 'Bidan',
        };
    }

    public function dashboardRoute(): string
    {
        return match ($this) {
            self::OrangTua => 'parent.children',
            self::Kader => 'kader.dashboard',
            self::Bidan => 'bidan.dashboard',
        };
    }
}
