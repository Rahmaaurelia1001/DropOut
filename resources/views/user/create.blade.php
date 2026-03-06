<h2>Tambah User</h2>

<form action="{{ route('admin.user.store') }}" method="POST">
    @csrf

    <div>
        <label>Nama</label><br>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Email</label><br>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
    </div>

    <div>
    <label>Role</label><br>
    <select name="role" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin">Admin</option>
        <option value="wali_kelas">Wali Kelas</option>
        <option value="kepsek">Kepala Sekolah</option>
    </select>
</div>

<div>
    <label>Kelas</label><br>
    <select name="id_kelas">
        <option value="">-- Pilih Kelas --</option>
        @foreach($kelas as $k)
            <option value="{{ $k->id_kelas }}">
                {{ $k->nama_kelas }} - {{ $k->tahun_ajaran }}
            </option>
        @endforeach
    </select>
    <br>
    <small>Kosongkan jika role = admin atau kepsek</small>
</div>

<div>
    <label>Status Akun</label><br>
    <select name="is_active" required>
        <option value="1">Aktif</option>
        <option value="0">Nonaktif</option>
    </select>
</div>

    <br>
    <button type="submit">Simpan</button>
    <a href="{{ route('admin.user.index') }}">Kembali</a>
</form>