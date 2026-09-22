<?php

namespace App\Models;

use App\Gender;
use Database\Factories\BalitaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Balita extends Model
{
    /** @use HasFactory<BalitaFactory> */
    use HasFactory;

    protected $table = 'balita';

    protected $fillable = ['orang_tua_id', 'nama', 'nik', 'tanggal_lahir', 'jenis_kelamin', 'alamat'];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'jenis_kelamin' => Gender::class,
        ];
    }

    public function orangTua(): BelongsTo
    {
        return $this->belongsTo(OrangTua::class);
    }

    public function pengukuran(): HasMany
    {
        return $this->hasMany(Pengukuran::class);
    }

    public function pengukuranTerbaru(): HasOne
    {
        return $this->hasOne(Pengukuran::class)->latestOfMany('tanggal_pengukuran');
    }

    public function imunisasi(): HasMany
    {
        return $this->hasMany(ImunisasiBalita::class);
    }

    public function vitamin(): HasMany
    {
        return $this->hasMany(VitaminBalita::class);
    }
}
