<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Dashboard Kepala Sekolah
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Ringkasan hasil identifikasi risiko putus sekolah siswa.
            </p>
        </div>
    </x-slot>

    <div class="p-6 space-y-6">

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <form method="GET" action="{{ route('kepsek.dashboard') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Pilih Periode</label>
                    <select name="id_periode" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        <option value="">-- Pilih Periode --</option>
                        @foreach($periodes as $p)
                            <option value="{{ $p->id_periode }}" {{ (string) $idPeriode === (string) $p->id_periode ? 'selected' : '' }}>
                                {{ $p->tahun_ajaran }} - Semester {{ $p->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                        Tampilkan
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl shadow p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Total Siswa Dianalisis</p>
                <h3 class="mt-2 text-3xl font-bold text-gray-800">{{ $totalSiswa }}</h3>
            </div>

            <div class="bg-white rounded-2xl shadow p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Risiko Tinggi</p>
                <h3 class="mt-2 text-3xl font-bold text-red-600">{{ $jumlahTinggi }}</h3>
            </div>

            <div class="bg-white rounded-2xl shadow p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Risiko Sedang</p>
                <h3 class="mt-2 text-3xl font-bold text-yellow-600">{{ $jumlahSedang }}</h3>
            </div>

            <div class="bg-white rounded-2xl shadow p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Risiko Rendah</p>
                <h3 class="mt-2 text-3xl font-bold text-green-600">{{ $jumlahRendah }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Risiko Siswa</h3>
                <div style="max-width: 420px; margin: 0 auto;">
                    <canvas id="chartRisiko"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Ringkas</h3>

                <div class="space-y-4">
                    <div class="rounded-xl bg-blue-50 border border-blue-100 p-4">
                        <p class="text-sm text-blue-700 font-medium">Periode Aktif Ditampilkan</p>
                        <p class="text-lg font-semibold text-blue-900 mt-1">
                            @if($periode)
                                {{ $periode->tahun_ajaran }} - Semester {{ $periode->semester }}
                            @else
                                -
                            @endif
                        </p>
                    </div>

                    <div class="rounded-xl bg-purple-50 border border-purple-100 p-4">
                        <p class="text-sm text-purple-700 font-medium">Faktor Dominan Terbanyak</p>
                        <p class="text-lg font-semibold text-purple-900 mt-1">
                            {{ $faktorDominanTerbanyak ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 border border-gray-200 p-4">
                        <p class="text-sm text-gray-600">
                            Dashboard ini menampilkan ringkasan hasil analisis MFEP untuk membantu kepala sekolah memantau distribusi tingkat risiko putus sekolah siswa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartRisiko');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Tinggi', 'Sedang', 'Rendah'],
                datasets: [{
                    data: [{{ $jumlahTinggi }}, {{ $jumlahSedang }}, {{ $jumlahRendah }}]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

    {{-- Status Rekomendasi per Kelas --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-gray-800">Status Rekomendasi per Kelas</h3>
        <p class="text-sm text-gray-500 mt-1">
            Monitoring progres tindak lanjut rekomendasi oleh wali kelas pada setiap kelas.
        </p>
    </div>

    @if($statusPerKelas->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($statusPerKelas as $item)
                <div class="rounded-2xl border border-gray-200 p-4 bg-white">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-bold text-gray-800">
                            {{ $item->nama_kelas }}
                        </h4>
                        <span class="text-sm text-gray-500">
                            Total: {{ $item->total }}
                        </span>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div class="rounded-xl bg-gray-50 p-4 text-center">
                            <div class="text-3xl font-bold text-gray-700">{{ $item->belum }}</div>
                            <div class="text-sm text-gray-500 mt-1">Belum</div>
                        </div>

                        <div class="rounded-xl bg-blue-50 p-4 text-center">
                            <div class="text-3xl font-bold text-blue-600">{{ $item->proses }}</div>
                            <div class="text-sm text-blue-600 mt-1">Proses</div>
                        </div>

                        <div class="rounded-xl bg-green-50 p-4 text-center">
                            <div class="text-3xl font-bold text-green-600">{{ $item->selesai }}</div>
                            <div class="text-sm text-green-600 mt-1">Selesai</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="rounded-xl border border-dashed border-gray-300 p-6 text-center text-gray-500">
            Data status rekomendasi per kelas belum tersedia.
        </div>
    @endif
</div>
</x-app-layout>