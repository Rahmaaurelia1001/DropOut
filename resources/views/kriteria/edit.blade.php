<h2>Edit Kriteria</h2>

<form action="{{ route('kriteria.update', $kriteria->id_kriteria) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Kriteria</label><br>
    <input type="text" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" required><br><br>

    <label>Bobot</label><br>
    <input type="number" step="0.01" name="bobot" value="{{ $kriteria->bobot }}" required><br><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('kriteria.index') }}">Kembali</a>