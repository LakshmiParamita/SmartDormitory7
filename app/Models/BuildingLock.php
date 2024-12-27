<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingLock extends Model
{
    use HasFactory;

    protected $table = 'building_locks';
    protected $fillable = ['gedung_id', 'is_locked'];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }
}
