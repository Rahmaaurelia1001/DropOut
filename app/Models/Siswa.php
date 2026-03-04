<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'Siswa';
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'tanggal_lahir',
        'id_kelas'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}