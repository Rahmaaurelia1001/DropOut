<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    protected $id_kelas;

    public function __construct($id_kelas)
    {
        $this->id_kelas = $id_kelas;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {

            if ($index == 0) {
                continue; // skip header
            }

            $nisn = $row[0];
            $nama = $row[1];

            Siswa::updateOrCreate(
    [
        'nisn' => $nisn
    ],
    [
        'nama_siswa'    => $nama,
        'id_kelas'      => $this->id_kelas,
        // PAKSA JADI NULL jika di excel tidak ada datanya
        // Atau ganti 'L' jika ingin default laki-laki
        'jenis_kelamin' => null, 
        'tanggal_lahir' => null,
    ]
);
        }
    }
}