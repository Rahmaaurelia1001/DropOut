<?php

namespace App\Services;

use App\Models\EvaluasiSiswa;
use App\Models\NilaiMapel;
use App\Models\Presensi;
use App\Models\Siswa;

class EvaluasiSiswaService
{
    public function generate(int $idPeriode, ?int $idKelas = null, ?int $idFile = null): void
    {
        $query = Siswa::query();

        if ($idKelas) {
            $query->where('id_kelas', $idKelas);
        }

        $siswas = $query->get();

        foreach ($siswas as $siswa) {
            $rataRata = NilaiMapel::where('id_siswa', $siswa->id_siswa)
                ->where('id_periode', $idPeriode)
                ->avg('nilai_akhir');

            $presensi = Presensi::where('id_siswa', $siswa->id_siswa)
                ->where('id_periode', $idPeriode)
                ->first();

            $totalKetidakhadiran =
                ($presensi->jumlah_sakit ?? 0) +
                ($presensi->jumlah_izin ?? 0) +
                ($presensi->jumlah_alpha ?? 0);

            EvaluasiSiswa::updateOrCreate(
                [
                    'id_siswa' => $siswa->id_siswa,
                    'id_periode' => $idPeriode,
                ],
                [
                    'id_kelas' => $siswa->id_kelas,
                    'nilai_rata_rata' => round($rataRata ?? 0, 2),
                    'total_ketidakhadiran' => $totalKetidakhadiran,
                    'id_file' => $idFile,
                ]
            );
        }
    }
}