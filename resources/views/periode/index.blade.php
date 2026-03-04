<h2>Data Periode Penilaian</h2>

<a href="{{ route('periode.create') }}">Tambah Periode</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Tahun Ajaran</th>
        <th>Semester</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($periode as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->tahun_ajaran }}</td>
        <td>{{ $p->semester }}</td>
        <td>{{ $p->tanggal_mulai }}</td>
        <td>{{ $p->tanggal_selesai }}</td>
        <td>
            @if($p->status == 'aktif')
                <span style="color:green;"><b>Aktif</b></span>
            @else
                <span style="color:red;">Nonaktif</span>
            @endif
        </td>
        <td>
            <a href="{{ route('periode.edit', $p->id_periode) }}">Edit</a>

            <form action="{{ route('periode.destroy', $p->id_periode) }}"
                  method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit"
                    onclick="return confirm('Yakin hapus periode ini?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>