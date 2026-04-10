<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan SPK</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        .info {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 6px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>LAPORAN HASIL SPK</h2>

    <div class="info">
        <p><strong>Periode:</strong> {{ $periode->tahun_ajaran ?? '-' }} - Semester {{ $periode->semester ?? '-' }}</p>
        <p><strong>Kelas:</strong> {{ $kelas->nama_kelas ?? 'Semua Kelas' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nilai Preferensi</th>
                <th>Ranking</th>
            </tr>
        </thead>
        <tbody>
            @forelse($hasil as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                    <td>{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $item->total_nilai_preferensi }}</td>
                    <td>{{ $item->ranking ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>