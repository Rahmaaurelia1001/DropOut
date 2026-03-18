<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMapel extends Model
{
    protected $table = 'nilai_mapel';
    protected $primaryKey = 'id_nilai';
    public $timestamps = false;

    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'id_mapel',
        'id_periode',
        'nilai_pengetahuan',
        'nilai_keterampilan',
        'nilai_akhir',
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

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel', 'id_mapel');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodePenilaian::class, 'id_periode', 'id_periode');
    }
}