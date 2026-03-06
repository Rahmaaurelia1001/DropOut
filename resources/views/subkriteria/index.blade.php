<h2>Data Subkriteria</h2>

<a href="{{ route('admin.subkriteria.create') }}">Tambah Subkriteria</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Kriteria</th>
        <th>Nama Subkriteria</th>
        <th>Nilai Skala</th>
        <th>Aksi</th>
    </tr>

    @foreach($subkriteria as $s)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $s->kriteria->nama_kriteria }}</td>
        <td>{{ $s->nama_subkriteria }}</td>
        <td>{{ $s->nilai_skala }}</td>
        <td>
            <a href="{{ route('admin.subkriteria.edit', $s->id_subkriteria) }}">Edit</a>

            <form action="{{ route('admin.subkriteria.destroy', $s->id_subkriteria) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>