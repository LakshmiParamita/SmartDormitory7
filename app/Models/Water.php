<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    protected $table = 'waters';
    protected $fillable = [
        'kode_sensor', 
        'nama_gedung', 
        'kualitas_air'
    ];

    public function getKualitasAirAttribute($value)
    {
        return ucfirst(strtolower($value));
    }
}
