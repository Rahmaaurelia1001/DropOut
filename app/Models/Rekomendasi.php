<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    protected $table = 'rekomendasi';
    protected $primaryKey = 'id_rekomendasi';
    public $timestamps = false;

    protected $fillable = [
        'id_hasil',
        'deskripsi_rekomendasi',
        'status',
        'is_selected',
        'tanggal_dibuat',
        'tanggal_update',
    ];

    public function hasilKeputusan()
    {
        return $this->belongsTo(HasilKeputusan::class, 'id_hasil', 'id_hasil');
    }
}