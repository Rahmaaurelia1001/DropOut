<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Analisis Risiko Putus Sekolah
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Jalankan analisis MFEP berdasarkan data pada periode penilaian yang sedang aktif.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if($periodeAktif)
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-800">Periode Aktif Saat Ini</h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Tahun Ajaran</p>
                        <h4 class="mt-1 text-lg font-semibold text-gray-800">
                            {{ $periodeAktif->tahun_ajaran ?? '-' }}
                        </h4>
                    </div>

                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Semester</p>
                        <h4 class="mt-1 text-lg font-semibold text-gray-800">
                            {{ $periodeAktif->semester ?? '-' }}
                        </h4>
                    </div>

                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Status</p>
                        <h4 class="mt-1 text-lg font-semibold text-green-600">
                            {{ $periodeAktif->status ?? '-' }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Proses Analisis MFEP</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Sistem akan memproses data nilai mapel dan data pendukung berdasarkan periode aktif yang telah ditetapkan admin.
                    </p>
                </div>

                <form action="{{ route('walas.mfep.proses') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-700 transition">
                        Proses Analisis MFEP
                    </button>
                </form>
            </div>
        @else
            <div class="rounded-2xl border border-yellow-200 bg-yellow-50 p-6">
                <h3 class="text-lg font-semibold text-yellow-800">Belum Ada Periode Aktif</h3>
                <p class="mt-2 text-sm text-yellow-700">
                    Saat ini belum ada periode penilaian yang diaktifkan oleh admin. Silakan hubungi admin untuk mengaktifkan periode terlebih dahulu.
                </p>
            </div>
        @endif
    </div>
</x-app-layout>