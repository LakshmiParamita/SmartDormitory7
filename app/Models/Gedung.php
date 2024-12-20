<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function lamps()
    {
        return $this->hasMany(Lamp::class, 'gedung_id');
    }

    public function buildingLock()
    {
        return $this->hasOne(BuildingLock::class);
    }
}
