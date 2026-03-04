<h2>Tambah Kelas</h2>

<form action="{{ route('kelas.store') }}" method="POST">
    @csrf

    <div>
        <label>Nama Kelas</label><br>
        <input type="text" name="nama_kelas" required>
    </div>

    <div>
        <label>Tahun Ajaran</label><br>
        <input type="text" name="tahun_ajaran" placeholder="Contoh: 2024/2025" required>
    </div>

    <br>
    <button type="submit">Simpan</button>
    <a href="{{ route('kelas.index') }}">Kembali</a>
</form>