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


            @if(session('success'))
                <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            

            <form action="{{ route('admin.kriteria.destroy', $k->id_kriteria) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach

    <div class="mb-4 text-sm text-gray-600">
    Total Bobot Saat Ini:
    <span class="font-semibold">
        {{ number_format(\App\Models\Kriteria::sum('bobot'), 2) }} / 1.00
    </span>
</div>
</table>