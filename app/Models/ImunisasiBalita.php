<?php

namespace App\Models;

use Database\Factories\ImunisasiBalitaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImunisasiBalita extends Model
{
    /** @use HasFactory<ImunisasiBalitaFactory> */
    use HasFactory;

    protected $table = 'imunisasi_balita';

    protected $fillable = ['balita_id', 'jenis_imunisasi_id', 'kader_id', 'tanggal_pemberian', 'status'];

    protected function casts(): array
    {
        return ['tanggal_pemberian' => 'date'];
    }

    public function balita(): BelongsTo
    {
        return $this->belongsTo(Balita::class);
    }

    public function jenisImunisasi(): BelongsTo
    {
        return $this->belongsTo(JenisImunisasi::class);
    }

    public function kader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kader_id');
    }
}
