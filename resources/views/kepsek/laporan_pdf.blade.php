<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Analisis SPK</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 12px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info table {
            border: none;
            width: auto;
        }
        .info td {
            border: none;
            text-align: left;
            padding: 2px 0;
            font-size: 12px;
        }
        .info td.label {
            width: 100px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }
        table, th, td {
            border: 1px solid #444;
        }
        th, td {
            padding: 8px 5px;
            text-align: center;
        }
        .text-left {
            text-align: left;
            padding-left: 8px;
        }
        .font-bold {
            font-weight: bold;
        }
        /* Penanda Risiko */
        .risiko-tinggi { color: #d9534f; font-weight: bold; }
        .risiko-sedang { color: #f0ad4e; font-weight: bold; }
        .risiko-rendah { color: #5cb85c; font-weight: bold; }

        .footer {
            margin-top: 30px;
            float: right;
            width: 200px;
            text-align: center;
        }
        .footer p {
            margin-bottom: 60px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN HASIL IDENTIFIKASI RISIKO PUTUS SEKOLAH</h2>
        <p>SDN 11 KAMPUNG BATU DALAM</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td class="label">Periode</td>
                <td>: {{ $periode->tahun_ajaran ?? '-' }} - Semester {{ $periode->semester ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td>: {{ $kelas->nama_kelas ?? 'Semua Kelas' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Cetak</td>
                <td>: {{ now()->translatedFormat('d F Y') }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">Rank</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th style="width: 70px;">Preferensi</th>
                <th style="width: 80px;">Risiko</th>
                <th>Faktor Dominan</th>
                <th>Keputusan Final</th>
            </tr>
        </thead>
        <tbody>
            @forelse($hasil as $index => $item)
                <tr>
                    <td class="font-bold">{{ $index + 1 }}</td>
                    <td class="text-left">{{ $item->siswa->nama_siswa ?? '-' }}</td>
                    <td>{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ number_format((float) $item->total_nilai_preferensi, 4) }}</td>
                    <td>
                        <span class="@if($item->kategori_risiko == 'Tinggi') risiko-tinggi @elseif($item->kategori_risiko == 'Sedang') risiko-sedang @else risiko-rendah @endif">
                            {{ $item->kategori_risiko }}
                        </span>
                    </td>
                    <td class="text-left" style="font-size: 9px;">{{ $item->faktor_dominan ?? '-' }}</td>
                    <td class="text-left" style="font-size: 9px;">{{ $item->tindak_lanjut_final ?? 'Belum ada keputusan' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Data hasil analisis tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Kampung Batu Dalam, {{ now()->translatedFormat('d F Y') }}<br>Kepala Sekolah,</p>
        <br>
        <p><strong>{{ Auth::user()->name }}</strong></p>
    </div>

</body>
</html>