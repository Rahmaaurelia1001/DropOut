<h2>Edit Kelas</h2>

<form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nama Kelas</label><br>
        <input type="text" name="nama_kelas" value="{{ $kelas->nama_kelas }}" required>
    </div>

    <div>
        <label>Tahun Ajaran</label><br>
        <input type="text" name="tahun_ajaran" value="{{ $kelas->tahun_ajaran }}" required>
    </div>

    <br>
    <button type="submit">Update</button>
    <a href="{{ route('kelas.index') }}">Kembali</a>
</form>