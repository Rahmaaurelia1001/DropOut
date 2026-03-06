<h2>Data Kriteria</h2>

<a href="{{ route('admin.kriteria.create') }}">Tambah Kriteria</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama Kriteria</th>
        <th>Bobot</th>
        <th>Aksi</th>
    </tr>

    @foreach($kriteria as $k)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $k->nama_kriteria }}</td>
        <td>{{ $k->bobot }}</td>
        <td>
            <a href="{{ route('admin.kriteria.edit', $k->id_kriteria) }}">Edit</a>

            <form action="{{ route('admin.kriteria.destroy', $k->id_kriteria) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>