<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\NilaiMapel;
use App\Models\MataPelajaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NilaiMapelImport implements ToCollection
{
    protected $idFile;
    protected $idPeriode;

    public function __construct($idFile, $idPeriode)
    {
        $this->idFile = $idFile;
        $this->idPeriode = $idPeriode;
    }

    public function collection(Collection $rows)
    {
        if ($rows->isEmpty()) {
            return;
        }

        $header = $rows[0];

        foreach ($rows as $index => $row) {
            if ($index == 0) {
                continue; // skip header
            }

            $nisn = trim((string) ($row[0] ?? ''));

            if (!$nisn) {
                continue;
            }

            $siswa = Siswa::where('nisn', $nisn)->first();

            if (!$siswa) {
                continue;
            }

            for ($i = 2; $i < count($header); $i++) {
                $namaMapel = trim((string) ($header[$i] ?? ''));
                $nilai = $row[$i] ?? null;

                if ($namaMapel === '' || $nilai === null || $nilai === '') {
                    continue;
                }

                // normalisasi nama mapel dari header Excel
                $namaMapelLookup = strtoupper(trim($namaMapel));

                    if ($namaMapelLookup === 'SB' || $namaMapelLookup === 'SBDP') {
                        $namaMapelLookup = 'SENI BUDAYA';
                    } elseif ($namaMapelLookup === 'BINDO' || $namaMapelLookup === 'B.INDO') {
                        $namaMapelLookup = 'B.INDO';
                    } elseif ($namaMapelLookup === 'MATEMATIKA') {
                        $namaMapelLookup = 'MTK';
                    }

                $mapel = MataPelajaran::where('nama_mapel', $namaMapelLookup)->first();

                if (!$mapel) {
                    continue;
                }

                NilaiMapel::updateOrCreate(
                    [
                        'id_siswa' => $siswa->id_siswa,
                        'id_mapel' => $mapel->id_mapel,
                        'id_periode' => $this->idPeriode,
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
