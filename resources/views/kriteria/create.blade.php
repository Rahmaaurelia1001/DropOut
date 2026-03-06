<h2>Tambah Kriteria</h2>

<form action="{{ route('admin.kriteria.store') }}" method="POST">
    @csrf

    <label>Nama Kriteria</label><br>
    <input type="text" name="nama_kriteria" required><br><br>

    <label>Bobot</label><br>
    <input type="number" step="0.01" name="bobot" required><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('admin.kriteria.index') }}">Kembali</a>