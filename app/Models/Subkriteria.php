<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    protected $table = 'Subkriteria';
    protected $primaryKey = 'id_subkriteria';
    public $timestamps = false;

    protected $fillable = [
        'id_kriteria',
        'nama_subkriteria',
        'nilai_skala'
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
}