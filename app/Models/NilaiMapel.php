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
        'id_mapel',
        'id_periode',
        'nilai_akhir',
        'id_file',
    ];
}