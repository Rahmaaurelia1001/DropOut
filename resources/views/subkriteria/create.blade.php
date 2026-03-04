<h2>Tambah Subkriteria</h2>

<form action="{{ route('subkriteria.store') }}" method="POST">
    @csrf

    <label>Kriteria</label><br>
    <select name="id_kriteria" required>
        <option value="">-- Pilih Kriteria --</option>
        @foreach($kriteria as $k)
            <option value="{{ $k->id_kriteria }}">
                {{ $k->nama_kriteria }}
            </option>
        @endforeach
    </select><br><br>

    <label>Nama Subkriteria</label><br>
    <input type="text" name="nama_subkriteria" required><br><br>

    <label>Nilai Skala</label><br>
    <input type="number" name="nilai_skala" required><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('subkriteria.index') }}">Kembali</a>