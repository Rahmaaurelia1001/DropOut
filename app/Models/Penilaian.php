<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    public $timestamps = false;

    protected $fillable = [
        'id_siswa',
        'id_subkriteria',
        'id_periode'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'id_subkriteria', 'id_subkriteria');
    }
}