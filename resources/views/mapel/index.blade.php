<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mata Pelajaran
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Daftar mata pelajaran yang digunakan dalam sistem.
            </p>
        </div>
    </x-slot>

    <div class="bg-white shadow-sm rounded-2xl p-6">
        @if(session('success'))
            <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div style="margin-bottom: 16px;">
            <a href="{{ route('admin.mapel.create') }}"
               style="display:inline-block; padding:10px 16px; background:#4f46e5; color:white; border-radius:8px; text-decoration:none; font-weight:600;">
                Tambah Mapel
            </a>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Nama Mata Pelajaran</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($mapel as $index => $item)
                <tr>
                    <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 text-sm font-medium">{{ $item->nama_mapel }}</td>
                    <td class="px-4 py-3 text-sm" style="display:flex; gap:10px;">
                        <a href="{{ route('admin.mapel.edit', $item->id_mapel) }}"
                           style="color:#2563eb; text-decoration:none; font-weight:600;">
                            Edit
                        </a>

                        <form action="{{ route('admin.mapel.destroy', $item->id_mapel) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Yakin hapus mata pelajaran ini?')"
                                style="color:#dc2626; background:none; border:none; font-weight:600; cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>