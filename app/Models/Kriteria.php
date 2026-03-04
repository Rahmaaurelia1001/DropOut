<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'Kriteria';
    protected $primaryKey = 'id_kriteria';
    public $timestamps = false;

    protected $fillable = [
        'nama_kriteria',
        'bobot'
    ];

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class, 'id_kriteria', 'id_kriteria');
    }
}