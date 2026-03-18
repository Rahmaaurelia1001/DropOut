<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Master Rekomendasi
        </h2>
    </x-slot>

    <div class="p-6 space-y-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.master-rekomendasi.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
            + Tambah Rekomendasi
        </a>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Faktor</th>
                        <th class="px-4 py-3">Rekomendasi</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($masterRekomendasi as $item)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $item->kategori_risiko }}</td>
                            <td class="px-4 py-3">{{ $item->faktor_dominan }}</td>
                            <td class="px-4 py-3">{{ $item->deskripsi_rekomendasi }}</td>

                            <td class="px-4 py-3">
                                @if($item->is_active)
                                    <span class="text-green-600 font-semibold">Aktif</span>
                                @else
                                    <span class="text-red-600 font-semibold">Nonaktif</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center space-x-2">

                                <!-- EDIT -->
                                <a href="{{ route('admin.master-rekomendasi.edit', $item->id_master_rekomendasi) }}"
                                   class="text-blue-600">
                                    Edit
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('admin.master-rekomendasi.destroy', $item->id_master_rekomendasi) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus data?')"
                                        class="text-red-600">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">
                                Belum ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>