<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Rekomendasi;

class HasilKeputusan extends Model
{
    protected $table = 'hasil_keputusan';
    protected $primaryKey = 'id_hasil';
    public $timestamps = false;

    protected $fillable = [
        'id_siswa',
        'id_periode',
        'total_nilai_preferensi',
        'kategori_risiko',
        'faktor_dominan',
        'tanggal_proses',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function rekomendasi()
{
    return $this->hasMany(Rekomendasi::class, 'id_hasil', 'id_hasil');
}
}