<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodePenilaian extends Model
{
    protected $table = 'periode_penilaian';
    protected $primaryKey = 'id_periode';
    public $timestamps = false;

    protected $fillable = [
        'nama_periode',
        'semester',
        'tahun_ajaran',
        'status',
    ];

    public function nilaiMapel()
    {
        return $this->hasMany(NilaiMapel::class, 'id_periode', 'id_periode');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id_periode', 'id_periode');
    }

    public function evaluasiSiswa()
    {
        return $this->hasMany(EvaluasiSiswa::class, 'id_periode', 'id_periode');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_periode', 'id_periode');
    }
}