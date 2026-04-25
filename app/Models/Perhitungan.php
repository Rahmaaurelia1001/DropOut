<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    protected $table = 'perhitungan';
    protected $primaryKey = 'id_perhitungan';
    public $timestamps = false;

    protected $fillable = [
        'id_siswa',
        'id_kriteria',
        'id_periode',
        'nilai_bobot',
        'nilai_skala',
        'hasil_perkalian',
        'id_penilaian',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }
}