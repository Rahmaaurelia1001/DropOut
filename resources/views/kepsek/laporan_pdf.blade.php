<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan SPK</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .title h2 {
            margin: 0;
            font-size: 18px;
        }

        .title p {
            margin: 4px 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
            vertical-align: top;
            text-align: left;
        }

        th {
            background: #e5e7eb;
        }

        .small {
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="title">
        <h2>LAPORAN HASIL SPK RISIKO PUTUS SEKOLAH</h2>
        <p>
            @if($periode)
                Periode {{ $periode->tahun_ajaran }} - Semester {{ $periode->semester }}
            @else
                Periode belum dipilih
            @endif
        </p>
        <p>
            @if($kelas)
                Kelas: {{ $kelas->nama_kelas }}
            @else
                Semua Kelas
            @endif
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Siswa</th>
                <th width="10%">Kelas</th>
                <th width="12%">Nilai Preferensi</th>
                <th width="10%">Kategori Risiko</th>
                <th width="18%">Faktor Dominan</th>
                <th width="25%">Tindak Lanjut Final</th>
            </tr>
        </thead>
        <tbody>
            @forelse($hasil as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                    <td>{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ number_format((float) $item->total_nilai_preferensi, 4) }}</td>
                    <td>{{ $item->kategori_risiko }}</td>
                    <td>{{ $item->faktor_dominan ?? '-' }}</td>
                    <td>{{ $item->tindak_lanjut_final ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">Data laporan belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br><br>
    <table style="width: 100%; border: none;">
        <tr style="border: none;">
            <td style="border: none; width: 60%;"></td>
            <td style="border: none; text-align: center;" class="small">
                Kepala Sekolah
                <br><br><br><br>
                ______________________
            </td>
        </tr>
    </table>

</body>
</html>