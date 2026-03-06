<h2>Data Kelas</h2>

<a href="{{ route('admin.kelas.create') }}">Tambah Kelas</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Tahun Ajaran</th>
        <th>Aksi</th>
    </tr>

    @foreach($kelas as $k)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $k->nama_kelas }}</td>
        <td>{{ $k->tahun_ajaran }}</td>
        <td>
            <a href="{{ route('admin.kelas.edit', $k->id_kelas) }}">Edit</a>

            <form action="{{ route('admin.kelas.destroy', $k->id_kelas) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>