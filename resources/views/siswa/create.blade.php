<h2>Tambah Siswa</h2>

<form action="{{ route('siswa.store') }}" method="POST">
    @csrf

    <div>
        <label>NISN</label><br>
        <input type="text" name="nisn" required>
    </div>

    <div>
        <label>Nama Siswa</label><br>
        <input type="text" name="nama_siswa" required>
    </div>

    <div>
        <label>Jenis Kelamin</label><br>
        <select name="jenis_kelamin" required>
            <option value="">-- Pilih --</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div>
        <label>Tanggal Lahir</label><br>
        <input type="date" name="tanggal_lahir" required>
    </div>

    <div>
        <label>Kelas</label><br>
        <select name="id_kelas" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}">
                    {{ $k->nama_kelas }} - {{ $k->tahun_ajaran }}
                </option>
            @endforeach
        </select>
    </div>

    <br>
    <button type="submit">Simpan</button>
    <a href="{{ route('siswa.index') }}">Kembali</a>
</form>