<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';
    protected $primaryKey = 'id_presensi';
    public $timestamps = false;

    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'id_periode',
        'jumlah_sakit',
        'jumlah_izin',
        'jumlah_alpha',
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