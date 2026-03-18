<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Master Rekomendasi</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.master-rekomendasi.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label>Kategori Risiko</label>
                <select name="kategori_risiko" class="w-full border rounded p-2">
                    @foreach($kategoriOptions as $k)
                        <option value="{{ $k }}">{{ $k }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Faktor Dominan</label>
                <select name="faktor_dominan" class="w-full border rounded p-2">
                    @foreach($faktorOptions as $f)
                        <option value="{{ $f }}">{{ $f }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Deskripsi Rekomendasi</label>
                <textarea name="deskripsi_rekomendasi" class="w-full border rounded p-2"></textarea>
            </div>

            <div>
                <label>Status</label>
                <select name="is_active" class="w-full border rounded p-2">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>