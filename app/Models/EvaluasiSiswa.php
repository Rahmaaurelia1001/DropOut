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
        'pekerjaan_ortu',
        'pendidikan_ortu',
        'id_file',
    ];
}