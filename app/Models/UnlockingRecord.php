<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnlockingRecord extends Model
{
    use HasFactory;
    protected $table = 'unlocking_records';
    public $timestamps = false; // Nonaktifkan timestamp
    protected $fillable = ['timestamp', 'activity', 'image']; // Kolom yang dapat diisi
}
