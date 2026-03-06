<h2>Edit User</h2>

<form action="{{ route('admin.user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nama</label><br>
        <input type="text" name="name" value="{{ $user->name }}" required>
    </div>

    <div>
        <label>Email</label><br>
        <input type="email" name="email" value="{{ $user->email }}" required>
    </div>

    <div>
        <label>Password Baru</label><br>
        <input type="password" name="password">
        <br>
        <small>Kosongkan jika tidak ingin ganti password</small>
    </div>

    <div>
    <label>Role</label><br>
    <select name="role" required>
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="wali_kelas" {{ $user->role == 'wali_kelas' ? 'selected' : '' }}>Wali Kelas</option>
        <option value="kepsek" {{ $user->role == 'kepsek' ? 'selected' : '' }}>Kepala Sekolah</option>
    </select>
</div>

<div>
    <label>Kelas</label><br>
    <select name="id_kelas">
        <option value="">-- Pilih Kelas --</option>
        @foreach($kelas as $k)
            <option value="{{ $k->id_kelas }}" {{ $user->id_kelas == $k->id_kelas ? 'selected' : '' }}>
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
        <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>Aktif</option>
        <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>Nonaktif</option>
    </select>
</div>
    <br>
    <button type="submit">Update</button>
    <a href="{{ route('admin.user.index') }}">Kembali</a>
</form>