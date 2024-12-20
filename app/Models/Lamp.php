<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamp extends Model
{
    use HasFactory;

    protected $fillable = ['gedung_id', 'name', 'is_on'];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }
}
