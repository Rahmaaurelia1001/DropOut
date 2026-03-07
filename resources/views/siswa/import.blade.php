<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Import Data Siswa
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Upload file Excel untuk menambahkan data siswa secara massal.
            </p>
        </div>
    </x-slot>

    <div class="max-w-3xl">
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                <p class="font-semibold mb-2">Terjadi kesalahan:</p>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <form action="{{ route('admin.siswa.import.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="id_kelas" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pilih Kelas
                    </label>
                    <select name="id_kelas" id="id_kelas"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}">
                                {{ $k->nama_kelas }} - {{ $k->tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="file_excel" class="block text-sm font-semibold text-gray-700 mb-2">
                        File Excel
                    </label>
                    <input type="file" name="file_excel" id="file_excel"
                        class="block w-full rounded-xl border border-gray-300 bg-white text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-indigo-700">
                    <p class="mt-2 text-sm text-gray-500">
                        Format file yang didukung: .xls dan .xlsx
                    </p>
                </div>

                <div class="rounded-xl bg-blue-50 border border-blue-100 p-4">
                    <h4 class="text-sm font-semibold text-blue-800 mb-2">Format Template Siswa</h4>
                    <ul class="list-disc list-inside text-sm text-blue-700 space-y-1">
                        <li>Kolom 1: NIS / NISN</li>
                        <li>Kolom 2: Nama Siswa</li>
                        <li>Kolom 3: Jenis Kelamin (L/P)</li>
                        <li>Kolom 4: Tanggal Lahir</li>
                    </ul>
                </div>

                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                        class="inline-flex items-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                        Import Siswa
                    </button>

                    <a href="{{ route('admin.siswa.index') }}"
                        class="inline-flex items-center rounded-xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>