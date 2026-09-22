<?php

namespace App\Models;

use Database\Factories\JenisVitaminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisVitamin extends Model
{
    /** @use HasFactory<JenisVitaminFactory> */
    use HasFactory;

    protected $table = 'jenis_vitamin';

    protected $fillable = ['nama_vitamin', 'deskripsi'];

    public function pemberian(): HasMany
    {
        return $this->hasMany(VitaminBalita::class);
    }
}
