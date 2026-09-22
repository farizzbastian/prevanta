<?php

namespace App\Models;

use Database\Factories\VitaminBalitaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VitaminBalita extends Model
{
    /** @use HasFactory<VitaminBalitaFactory> */
    use HasFactory;

    protected $table = 'vitamin_balita';

    protected $fillable = ['balita_id', 'jenis_vitamin_id', 'kader_id', 'tanggal_pemberian', 'status'];

    protected function casts(): array
    {
        return ['tanggal_pemberian' => 'date'];
    }

    public function balita(): BelongsTo
    {
        return $this->belongsTo(Balita::class);
    }

    public function jenisVitamin(): BelongsTo
    {
        return $this->belongsTo(JenisVitamin::class);
    }

    public function kader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kader_id');
    }
}
