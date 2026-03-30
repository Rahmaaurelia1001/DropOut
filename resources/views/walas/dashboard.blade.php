<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Wali Kelas
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Monitoring awal siswa dan pengolahan analisis risiko putus sekolah pada kelas yang Anda ampu.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-800">
                Selamat datang, {{ Auth::user()->name }}
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                Anda login sebagai wali kelas.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
                <p class="text-sm text-gray-500">Kelas yang Diampu</p>
                <h3 class="mt-2 text-3xl font-bold text-indigo-600">
                    {{ Auth::user()->id_kelas ?? '-' }}
                </h3>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
                <p class="text-sm text-gray-500">Peran Pengguna</p>
                <h3 class="mt-2 text-2xl font-bold text-gray-800">
                    Wali Kelas
                </h3>
            </div>
        </div>

        

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-800">Menu Utama</h3>
            <p class="text-sm text-gray-500 mt-1">
                Pilih menu sesuai tahapan penggunaan sistem.
            </p>

            <div class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('walas.import.index') }}"
                   class="block rounded-2xl border border-indigo-100 bg-indigo-50 p-5 hover:bg-indigo-100 transition">
                    <h4 class="text-base font-semibold text-indigo-700">Import Data</h4>
                    <p class="mt-2 text-sm text-gray-600">
                        Upload data nilai mapel dan data pendukung untuk periode penilaian.
                    </p>
                </a>

                

                <a href="{{ route('walas.mfep.index') }}"
                   class="block rounded-2xl border border-emerald-100 bg-emerald-50 p-5 hover:bg-emerald-100 transition">
                    <h4 class="text-base font-semibold text-emerald-700">Analisis Risiko</h4>
                    <p class="mt-2 text-sm text-gray-600">
                        Jalankan perhitungan MFEP berdasarkan data yang sudah diunggah.
                    </p>
                </a>

                <a href="{{ route('walas.mfep.hasil', ['id_periode' => 1]) }}"
                   class="block rounded-2xl border border-amber-100 bg-amber-50 p-5 hover:bg-amber-100 transition">
                    <h4 class="text-base font-semibold text-amber-700">Hasil Analisis</h4>
                    <p class="mt-2 text-sm text-gray-600">
                        Lihat hasil identifikasi risiko putus sekolah siswa.
                    </p>
                </a>

                
            </div>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-800">Alur Penggunaan Sistem</h3>
            <ol class="mt-3 list-decimal pl-5 text-sm text-gray-600 space-y-2">
                <li>Upload data nilai mapel dan data pendukung pada menu <strong>Import Data</strong>.</li>
                <li>Buka menu <strong>Analisis Risiko</strong> untuk memilih semester/periode penilaian.</li>
                <li>Klik proses analisis untuk menjalankan perhitungan MFEP.</li>
                <li>Lihat hasil analisis siswa berdasarkan nilai preferensi, kategori risiko, dan faktor dominan.</li>
            </ol>
        </div>
    </div>
</x-app-layout>