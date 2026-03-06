<h2>Edit Siswa</h2>

<form action="{{ route('admin.siswa.update', $siswa->id_siswa) }}" method="POST">
    @csrf
    @method('PUT')

    <label>NISN</label>
    <input type="text" name="nisn" value="{{ $siswa->nisn }}">
    <br><br>

    <label>Nama</label>
    <input type="text" name="nama_siswa" value="{{ $siswa->nama_siswa }}">
    <br><br>

    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin">
        <option value="L" {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>L</option>
        <option value="P" {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>P</option>
    </select>
    <br><br>

    <label>Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}">
    <br><br>

    <label>Kelas</label>
    <select name="id_kelas">
        @foreach($kelas as $k)
            <option value="{{ $k->id_kelas }}"
                {{ $siswa->id_kelas == $k->id_kelas ? 'selected' : '' }}>
                {{ $k->nama_kelas }}
            </option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('admin.siswa.index') }}">Kembali</a>