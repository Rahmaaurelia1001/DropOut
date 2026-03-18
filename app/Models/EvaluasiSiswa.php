<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluasiSiswa extends Model
{
    protected $table = 'evaluasi_siswa';
    protected $primaryKey = 'id_evaluasi';
    public $timestamps = false;

    protected $fillable = [
    'id_siswa',
    'id_kelas',
    'id_periode',
    'nilai_rata_rata',
    'total_ketidakhadiran',
    'pekerjaan_ortu',
    'pendidikan_ortu',
    'id_file',
];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodePenilaian::class, 'id_periode', 'id_periode');
    }
}