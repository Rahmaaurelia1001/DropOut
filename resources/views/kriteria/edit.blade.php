<h2>Edit Kriteria</h2>


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

<form action="{{ route('admin.kriteria.update', $kriteria->id_kriteria) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Kriteria</label><br>
    <input type="text" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" required><br><br>

    <label>Bobot</label><br>
    <input type="number" step="0.01" name="bobot" value="{{ $kriteria->bobot }}" required><br><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('admin.kriteria.index') }}">Kembali</a>