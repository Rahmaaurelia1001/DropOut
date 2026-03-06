<h2>Tambah Periode</h2>

<form action="{{ route('admin.periode.store') }}" method="POST">
    @csrf

    <label>Tahun Ajaran</label><br>
    <input type="text" name="tahun_ajaran" required><br><br>

    <label>Semester</label><br>
    <select name="semester">
        <option value="1">1</option>
        <option value="2">2</option>
    </select><br><br>

    <label>Tanggal Mulai</label><br>
    <input type="date" name="tanggal_mulai" required><br><br>

    <label>Tanggal Selesai</label><br>
    <input type="date" name="tanggal_selesai" required><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="nonaktif">Nonaktif</option>
        <option value="aktif">Aktif</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('admin.periode.index') }}">Kembali</a>