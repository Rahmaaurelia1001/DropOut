<h2>Data Siswa</h2>

<a href="{{ route('siswa.create') }}">Tambah Siswa</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>NISN</th>
        <th>Nama</th>
        <th>JK</th>
        <th>Tanggal Lahir</th>
        <th>Kelas</th>
        <th>Aksi</th>
    </tr>

    @foreach($siswa as $s)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $s->nisn }}</td>
        <td>{{ $s->nama_siswa }}</td>
        <td>{{ $s->jenis_kelamin }}</td>
        <td>{{ $s->tanggal_lahir }}</td>
        <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
        <td>
            <a href="{{ route('siswa.edit', $s->id_siswa) }}">Edit</a>

            <form action="{{ route('siswa.destroy', $s->id_siswa) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>