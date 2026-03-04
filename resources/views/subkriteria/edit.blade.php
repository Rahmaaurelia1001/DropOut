<h2>Edit Subkriteria</h2>

<form action="{{ route('subkriteria.update', $subkriteria->id_subkriteria) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Kriteria</label><br>
    <select name="id_kriteria" required>
        @foreach($kriteria as $k)
            <option value="{{ $k->id_kriteria }}"
                {{ $subkriteria->id_kriteria == $k->id_kriteria ? 'selected' : '' }}>
                {{ $k->nama_kriteria }}
            </option>
        @endforeach
    </select><br><br>

    <label>Nama Subkriteria</label><br>
    <input type="text" name="nama_subkriteria" 
           value="{{ $subkriteria->nama_subkriteria }}" required><br><br>

    <label>Nilai Skala</label><br>
    <input type="number" name="nilai_skala" 
           value="{{ $subkriteria->nilai_skala }}" required><br><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('subkriteria.index') }}">Kembali</a>