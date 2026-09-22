<?php

namespace App\Models;

use App\VerificationStatus;
use Database\Factories\VerifikasiFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verifikasi extends Model
{
    /** @use HasFactory<VerifikasiFactory> */
    use HasFactory;

    protected $table = 'verifikasi';

    protected $fillable = [
        'pengukuran_id', 'bidan_id', 'tanggal_verifikasi', 'status',
        'catatan_penyuluhan', 'tindak_lanjut',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_verifikasi' => 'date',
            'status' => VerificationStatus::class,
        ];
    }

    public function pengukuran(): BelongsTo
    {
        return $this->belongsTo(Pengukuran::class);
    }

    public function bidan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bidan_id');
    }
}
