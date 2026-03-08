<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Upload File Import
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Upload file Excel data rapor atau presensi untuk diproses ke sistem.
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
            <form action="{{ route('walas.import.preview') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="jenis_data" class="block text-sm font-semibold text-gray-700 mb-2">
    Jenis Data Import
</label>
<select name="jenis_data" id="jenis_data"
    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
    <option value="">-- Pilih Jenis Data Import --</option>
    <option value="rapor" {{ old('jenis_data') == 'rapor' ? 'selected' : '' }}>
        Rapor / Evaluasi Siswa
    </option>
    <option value="presensi" {{ old('jenis_data') == 'presensi' ? 'selected' : '' }}>
        Presensi
    </option>
</select>
<p class="mt-2 text-sm text-gray-500">
    Gunakan opsi <b>Rapor / Evaluasi Siswa</b> untuk file gabungan yang berisi nilai rata-rata, pekerjaan ortu, pendidikan ortu, dan data S/I/A.
</p>
                </div>

                <div>
                    <label for="file_excel" class="block text-sm font-semibold text-gray-700 mb-2">
                        File Excel
                    </label>
                    <input type="file" name="file_excel" id="file_excel"
                        class="block w-full rounded-xl border border-gray-300 bg-white text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-indigo-700">
                    <p class="mt-2 text-sm text-gray-500">
                        Format file yang didukung: <span class="font-medium">.xls</span> dan <span class="font-medium">.xlsx</span>
                    </p>
                </div>

                <div class="rounded-xl bg-blue-50 border border-blue-100 p-4">
                    <h4 class="text-sm font-semibold text-blue-800 mb-2">Catatan Upload</h4>
                    <ul class="list-disc list-inside text-sm text-blue-700 space-y-1">
                        <li>Pastikan file sesuai format template yang digunakan sistem.</li>
                        <li>Pilih <b>Rapor</b> untuk file evaluasi siswa yang berisi nilai rata-rata, pekerjaan ortu, pendidikan ortu, dan data S/I/A.</li>
                        <li>Pilih <b>Presensi</b> jika nantinya Anda mengupload file kehadiran terpisah.</li>
                        <li>File yang diupload akan tersimpan di riwayat import.</li>
                    </ul>
                </div>

                <div class="mt-6">
    <button type="submit"
        style="display:inline-block; padding:10px 16px; background:#4f46e5; color:white; border:none; border-radius:8px; text-decoration:none; font-weight:600; cursor:pointer;">
        Upload File
    </button>

    <a href="{{ route('walas.import.index') }}"
        style="display:inline-block; margin-left:10px; padding:10px 16px; background:#ffffff; color:#374151; border:1px solid #d1d5db; border-radius:8px; text-decoration:none; font-weight:600;">
        Kembali
    </a>
</div>
            </form>
        </div>
    </div>
</x-app-layout>