<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'Kelas';

    // Primary key tabel
    protected $primaryKey = 'id_kelas';

    // Matikan timestamps jika tabel tidak punya kolom created_at/updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_kelas',
        'tahun_ajaran'
    ];

    /**
     * Relasi ke model Siswa (One to Many)
     * Satu kelas memiliki banyak siswa
     */
    public function siswa()
    {
        // id_kelas pertama adalah foreign key di tabel Siswa
        // id_kelas kedua adalah local key di tabel Kelas
        return $this->hasMany(Siswa::class, 'id_kelas', 'id_kelas');
    }
}