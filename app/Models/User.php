<?php

namespace App\Models;

use App\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'no_hp', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function orangTua(): HasOne
    {
        return $this->hasOne(OrangTua::class);
    }

    public function pengukuranDicatat(): HasMany
    {
        return $this->hasMany(Pengukuran::class, 'kader_id');
    }

    public function verifikasiDilakukan(): HasMany
    {
        return $this->hasMany(Verifikasi::class, 'bidan_id');
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }

    public function edukasi(): HasMany
    {
        return $this->hasMany(Edukasi::class);
    }
}
