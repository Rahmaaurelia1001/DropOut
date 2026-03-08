<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Mata Pelajaran
        </h2>
    </x-slot>

    <div class="bg-white shadow-sm rounded-2xl p-6 max-w-xl">

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.mapel.update', $mapel->id_mapel) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Mata Pelajaran
                </label>

                <input type="text"
                       name="nama_mapel"
                       value="{{ $mapel->nama_mapel }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    Update
                </button>

                <a href="{{ route('admin.mapel.index') }}"
                   class="border px-4 py-2 rounded-lg">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</x-app-layout>