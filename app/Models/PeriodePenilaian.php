<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodePenilaian extends Model
{
    protected $table = 'Periode_Penilaian';
    protected $primaryKey = 'id_periode';
    public $timestamps = false;

    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];
}