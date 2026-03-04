<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'Kelas';

    protected $primaryKey = 'id_kelas';

    public $timestamps = false;

    protected $fillable = [
        'nama_kelas',
        'tahun_ajaran'
    ];
}