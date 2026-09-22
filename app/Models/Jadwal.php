<?php

namespace App\Models;

use Database\Factories\JadwalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    /** @use HasFactory<JadwalFactory> */
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = ['user_id', 'jenis_kegiatan', 'tanggal', 'lokasi', 'keterangan'];

    protected function casts(): array
    {
        return ['tanggal' => 'datetime'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
