<?php

namespace App\Models;

use App\GrowthStatus;
use Database\Factories\PengukuranFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengukuran extends Model
{
    /** @use HasFactory<PengukuranFactory> */
    use HasFactory;

    protected $table = 'pengukuran';

    protected $fillable = [
        'balita_id', 'kader_id', 'tanggal_pengukuran', 'berat_badan', 'tinggi_badan',
        'lingkar_lengan_atas', 'lingkar_kepala', 'foto', 'z_score', 'status_pertumbuhan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pengukuran' => 'date',
            'berat_badan' => 'decimal:2',
            'tinggi_badan' => 'decimal:2',
            'lingkar_lengan_atas' => 'decimal:2',
            'lingkar_kepala' => 'decimal:2',
            'z_score' => 'decimal:3',
            'status_pertumbuhan' => GrowthStatus::class,
        ];
    }

    public function balita(): BelongsTo
    {
        return $this->belongsTo(Balita::class);
    }

    public function kader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kader_id');
    }

    public function verifikasi(): HasOne
    {
        return $this->hasOne(Verifikasi::class);
    }
}
