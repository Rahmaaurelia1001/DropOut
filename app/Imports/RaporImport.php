<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\EvaluasiSiswa;
use App\Models\PeriodePenilaian;
use App\Models\Presensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class RaporImport implements ToCollection
{
  public function collection(Collection $rows)
{
    foreach ($rows as $index => $row) {

        if ($index == 0) {
            continue; // skip header
        }

        $nisn = $row[0];

        $sakit = $row[2];
        $izin = $row[3];
        $alpha = $row[4];

        $pekerjaanOrtu = $row[5];
        $pendidikanOrtu = $row[6];
        $nilaiRata = $row[7];

        $siswa = Siswa::where('nisn', $nisn)->first();

        if (!$siswa) {
            continue;
        }

        $periode = PeriodePenilaian::where('status', 'aktif')->first();

        if (!$periode) {
            continue;
        }

        EvaluasiSiswa::updateOrCreate(
    [
        'id_siswa' => $siswa->id_siswa,
        'id_periode' => $periode->id_periode,
    ],
    [
        'id_kelas' => $siswa->id_kelas,
        'nilai_rata_rata' => $nilaiRata,
        'pekerjaan_ortu' => $pekerjaanOrtu,
        'pendidikan_ortu' => $pendidikanOrtu,
    ]
);

        Presensi::updateOrCreate(
    [
        'id_siswa' => $siswa->id_siswa,
        'id_periode' => $periode->id_periode,
    ],
    [
        'jumlah_hadir' => 0,
        'jumlah_sakit' => $sakit,
        'jumlah_izin' => $izin,
        'jumlah_alpha' => $alpha,
        'id_file' => null,
    ]
);
    }
}
}
