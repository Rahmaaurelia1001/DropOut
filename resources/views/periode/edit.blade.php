<h2>Edit Periode Penilaian</h2>

<form action="{{ route('periode.update', $periode->id_periode) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Tahun Ajaran</label><br>
    <input type="text" name="tahun_ajaran"
        value="{{ $periode->tahun_ajaran }}" required><br><br>

    <label>Semester</label><br>
    <select name="semester">
        <option value="1" {{ $periode->semester == '1' ? 'selected' : '' }}>1</option>
        <option value="2" {{ $periode->semester == '2' ? 'selected' : '' }}>2</option>
    </select><br><br>

    <label>Tanggal Mulai</label><br>
    <input type="date" name="tanggal_mulai"
        value="{{ $periode->tanggal_mulai }}" required><br><br>

    <label>Tanggal Selesai</label><br>
    <input type="date" name="tanggal_selesai"
        value="{{ $periode->tanggal_selesai }}" required><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="nonaktif"
            {{ $periode->status == 'nonaktif' ? 'selected' : '' }}>
            Nonaktif
        </option>
        <option value="aktif"
            {{ $periode->status == 'aktif' ? 'selected' : '' }}>
            Aktif
        </option>
    </select><br><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('periode.index') }}">Kembali</a>