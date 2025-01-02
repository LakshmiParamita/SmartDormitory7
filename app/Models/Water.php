<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    protected $table = 'waters';
    protected $fillable = [
        'kode_sensor', 
        'nama_gedung', 
        'kualitas_air',
        'debit',
        'tekanan_air',
        'status_kebocoran',
        'status_penanganan',
        'status_cek_pompa'
    ];

    protected $casts = [
        'status_kebocoran' => 'boolean',
        'status_penanganan' => 'boolean',
        'status_cek_pompa' => 'boolean'
    ];

    public static $kualitasAirValues = ['Bersih', 'Keruh', 'Kotor'];

    const DEFAULT_VELOCITY = 0.5;
    const DEFAULT_WIDTH = 1.0;
    const BATAS_NORMAL_DEBIT = 3.0;
    const BATAS_MIN_TEKANAN = 3;
    const BATAS_MAX_TEKANAN = 6;

    public function getKualitasAirAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    public function cekKebocoran()
    {
        if ($this->tekanan_air > self::BATAS_MAX_TEKANAN) {
            $this->status_kebocoran = true;
            $this->save();
            return true;
        }

        if ($this->debit > self::BATAS_NORMAL_DEBIT) {
            $this->status_kebocoran = true;
            $this->save();
            return true;
        }

        $this->status_kebocoran = false;
        $this->save();
        return false;
    }

    public function panggilTeknisi()
    {
        if ($this->status_kebocoran && !$this->status_penanganan) {
            $this->status_penanganan = true;
            $this->save();
            return true;
        }
        return false;
    }

    public function cekTekananRendah()
    {
        return $this->tekanan_air < self::BATAS_MIN_TEKANAN;
    }

    public function cekPompaAir()
    {
        if ($this->cekTekananRendah() && !$this->status_cek_pompa) {
            $this->status_cek_pompa = true;
            $this->save();
            return true;
        }
        return false;
    }

    public function selesaiPenanganan()
    {
        if ($this->status_penanganan) {
            // Reset semua nilai ke normal
            $this->update([
                'status_penanganan' => false,
                'status_kebocoran' => false,
                'tekanan_air' => 3.0,  
                'debit' => 1.5,         
            ]);
            return true;
        }
        return false;
    }

    public function selesaiCekPompa()
    {
        if ($this->status_cek_pompa) {
            // Reset nilai tekanan dan status
            $this->update([
                'status_cek_pompa' => false,
                'tekanan_air' => 3.0,  
                'debit' => 1.5         
            ]);
            return true;
        }
        return false;
    }
}
