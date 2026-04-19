<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterRekomendasi extends Model
{
    protected $table = 'master_rekomendasi';
    protected $primaryKey = 'id_master_rekomendasi';

    protected $fillable = [
        'kategori_risiko',
        'faktor_dominan',
        'deskripsi_rekomendasi',
        'is_active',
    ];

    public function rekomendasi()
{
    return $this->hasMany(Rekomendasi::class, 'id_master_rekomendasi', 'id_master_rekomendasi');
}
}

