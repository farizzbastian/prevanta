<?php

namespace App\Models;

use App\Gender;
use Database\Factories\OrangTuaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrangTua extends Model
{
    /** @use HasFactory<OrangTuaFactory> */
    use HasFactory;

    protected $table = 'orang_tua';

    protected $fillable = ['user_id', 'nik', 'jenis_kelamin', 'hubungan_dengan_balita'];

    protected function casts(): array
    {
        return ['jenis_kelamin' => Gender::class];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function balita(): HasMany
    {
        return $this->hasMany(Balita::class);
    }
}
