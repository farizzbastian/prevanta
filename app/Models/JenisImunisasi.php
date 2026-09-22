<?php

namespace App\Models;

use Database\Factories\JenisImunisasiFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisImunisasi extends Model
{
    /** @use HasFactory<JenisImunisasiFactory> */
    use HasFactory;

    protected $table = 'jenis_imunisasi';

    protected $fillable = ['nama_imunisasi', 'deskripsi'];

    public function pemberian(): HasMany
    {
        return $this->hasMany(ImunisasiBalita::class);
    }
}
