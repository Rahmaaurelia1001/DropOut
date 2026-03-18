<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Master Rekomendasi</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.master-rekomendasi.update', $masterRekomendasi->id_master_rekomendasi) }}" 
              method="POST" 
              class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label>Kategori Risiko</label>
                <select name="kategori_risiko" class="w-full border rounded p-2">
                    @foreach($kategoriOptions as $k)
                        <option value="{{ $k }}" 
                            {{ $masterRekomendasi->kategori_risiko == $k ? 'selected' : '' }}>
                            {{ $k }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Faktor Dominan</label>
                <select name="faktor_dominan" class="w-full border rounded p-2">
                    @foreach($faktorOptions as $f)
                        <option value="{{ $f }}" 
                            {{ $masterRekomendasi->faktor_dominan == $f ? 'selected' : '' }}>
                            {{ $f }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Deskripsi Rekomendasi</label>
                <textarea name="deskripsi_rekomendasi" 
                          class="w-full border rounded p-2">{{ $masterRekomendasi->deskripsi_rekomendasi }}</textarea>
            </div>

            <div>
                <label>Status</label>
                <select name="is_active" class="w-full border rounded p-2">
                    <option value="1" {{ $masterRekomendasi->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$masterRekomendasi->is_active ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>