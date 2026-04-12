<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'alamat',
        'id_kelas',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function nilaiMapel()
    {
        return $this->hasMany(NilaiMapel::class, 'id_siswa', 'id_siswa');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id_siswa', 'id_siswa');
    }

    public function evaluasiSiswa()
    {
        return $this->hasMany(EvaluasiSiswa::class, 'id_siswa', 'id_siswa');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_siswa', 'id_siswa');
    }
    
}