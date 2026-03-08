<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\NilaiMapel;
use App\Models\PeriodePenilaian;
use App\Models\MataPelajaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NilaiMapelImport implements ToCollection
{
    protected $idFile;

    public function __construct($idFile)
    {
        $this->idFile = $idFile;
    }

    public function collection(Collection $rows)
    {
        $header = $rows[0];

        $periode = PeriodePenilaian::where('status', 'aktif')->first();

        if (!$periode) {
            return;
        }

        foreach ($rows as $index => $row) {

            if ($index == 0) {
                continue; // skip header
            }

            $nisn = $row[0];
            $siswa = Siswa::where('nisn', $nisn)->first();

            if (!$siswa) {
                continue;
            }

            for ($i = 2; $i < count($header); $i++) {

                $namaMapel = $header[$i];
                $nilai = $row[$i];

                $mapel = MataPelajaran::where('nama_mapel', $namaMapel)->first();

                if (!$mapel) {
                    continue;
                }

                NilaiMapel::updateOrCreate(
                    [
                        'id_siswa' => $siswa->id_siswa,
                        'id_mapel' => $mapel->id_mapel,
                        'id_periode' => $periode->id_periode,
                    ],
                    [
                        'nilai_akhir' => $nilai,
                        'id_file' => $this->idFile,
                    ]
                );
            }
        }
    }
}