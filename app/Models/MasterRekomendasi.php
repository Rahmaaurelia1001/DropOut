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
}