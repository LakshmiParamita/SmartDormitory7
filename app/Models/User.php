<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Relasi ke laporan yang dilaporkan oleh pengguna.
     */
    public function laporanDilaporkan()
    {
        return $this->hasMany(Laporan::class, 'dilaporkan_oleh');
    }

    /**
     * Relasi ke laporan yang ditugaskan ke pengguna ini.
     */
    public function laporanDitugaskan()
    {
        return $this->hasMany(Laporan::class, 'ditugaskan_ke');
    }
}
