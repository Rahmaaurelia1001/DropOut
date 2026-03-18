<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\EvaluasiSiswa;
use App\Models\Presensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RaporImport implements ToCollection
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

            $sakit = (int) ($row[2] ?? 0);
            $izin = (int) ($row[3] ?? 0);
            $alpha = (int) ($row[4] ?? 0);

            $pekerjaanOrtu = $row[5] ?? null;
            $pendidikanOrtu = $row[6] ?? null;

            EvaluasiSiswa::updateOrCreate(
                [
                    'id_siswa' => $siswa->id_siswa,
                    'id_periode' => $this->idPeriode,
                ],
                [
                    'id_kelas' => $siswa->id_kelas,
                    'pekerjaan_ortu' => $pekerjaanOrtu,
                    'pendidikan_ortu' => $pendidikanOrtu,
                    'id_file' => $this->idFile,
                ]
            );

            Presensi::updateOrCreate(
                [
                    'id_siswa' => $siswa->id_siswa,
                    'id_periode' => $this->idPeriode,
                ],
                [
                    'jumlah_hadir' => 0,
                    'jumlah_sakit' => $sakit,
                    'jumlah_izin' => $izin,
                    'jumlah_alpha' => $alpha,
                    'id_file' => $this->idFile,
                ]
            );
        }
    }
}