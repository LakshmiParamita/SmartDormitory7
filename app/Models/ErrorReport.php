<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorReport extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'building_name',       // Nama gedung
        'error_title',         // Judul laporan error
        'error_description',   // Deskripsi laporan error
    ];

    /**
     * Attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime', // Timestamp otomatis dari Laravel
        'updated_at' => 'datetime', // Timestamp otomatis dari Laravel
    ];
}
