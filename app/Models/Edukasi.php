<?php

namespace App\Models;

use Database\Factories\EdukasiFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Edukasi extends Model
{
    /** @use HasFactory<EdukasiFactory> */
    use HasFactory;

    protected $table = 'edukasi';

    protected $fillable = ['user_id', 'judul', 'konten', 'gambar', 'kategori'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
