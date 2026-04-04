<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Dashboard Kepala Sekolah
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Ringkasan hasil identifikasi risiko putus sekolah siswa berdasarkan perhitungan MFEP.
            </p>
        </div>
    </x-slot>

    <div class="p-6 space-y-6">

        {{-- Filter Periode --}}
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <form method="GET" action="{{ route('kepsek.dashboard') }}">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Periode</label>
                        <select name="id_periode" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Periode --</option>
                            @foreach($periodes as $p)
                                <option value="{{ $p->id_periode }}" {{ (string) $idPeriode === (string) $p->id_periode ? 'selected' : '' }}>
                                    {{ $p->tahun_ajaran }} - Semester {{ $p->semester }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit"
                            class="w-full md:w-auto rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                            Tampilkan Dashboard
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Ringkasan Periode --}}
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 border border-indigo-100 rounded-2xl p-5">
            <p class="text-sm text-indigo-700 font-medium">Periode Ditampilkan</p>
            <h3 class="text-lg font-bold text-indigo-900 mt-1">
                @if($periode)
                    {{ $periode->tahun_ajaran }} - Semester {{ $periode->semester }}
                @else
                    Periode belum dipilih
                @endif
            </h3>
        </div>

        {{-- Kartu Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <p class="text-sm text-gray-500">Total Siswa Dianalisis</p>
                <h3 class="mt-2 text-3xl font-bold text-gray-800">{{ $totalSiswa }}</h3>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-red-100 p-5">
                <p class="text-sm text-red-500">Risiko Tinggi</p>
                <h3 class="mt-2 text-3xl font-bold text-red-600">{{ $jumlahTinggi }}</h3>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-yellow-100 p-5">
                <p class="text-sm text-yellow-600">Risiko Sedang</p>
                <h3 class="mt-2 text-3xl font-bold text-yellow-600">{{ $jumlahSedang }}</h3>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-green-100 p-5">
                <p class="text-sm text-green-600">Risiko Rendah</p>
                <h3 class="mt-2 text-3xl font-bold text-green-600">{{ $jumlahRendah }}</h3>
            </div>
        </div>

        {{-- Konten Utama --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            {{-- Chart --}}
            <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Distribusi Risiko Siswa</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Grafik distribusi siswa berdasarkan kategori risiko putus sekolah.
                    </p>
                </div>

                <div class="flex justify-center">
                    <div style="width: 100%; max-width: 420px;">
                        <canvas id="chartRisiko"></canvas>
                    </div>
                </div>
            </div>

            {{-- Info Ringkas --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Ringkas</h3>

                <div class="space-y-4">
                    <div class="rounded-xl bg-purple-50 border border-purple-100 p-4">
                        <p class="text-sm text-purple-700 font-medium">Faktor Dominan Terbanyak</p>
                        <p class="text-lg font-bold text-purple-900 mt-1">
                            {{ $faktorDominanTerbanyak ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 border border-gray-200 p-4">
                        <p class="text-sm text-gray-700 leading-relaxed">
                            Dashboard ini membantu kepala sekolah memantau distribusi tingkat risiko siswa,
                            melihat faktor dominan yang paling sering muncul, dan menjadi dasar dalam
                            pengambilan keputusan tindak lanjut.
                        </p>
                    </div>

                    <div class="rounded-xl bg-blue-50 border border-blue-100 p-4">
                        <p class="text-sm text-blue-700 font-medium">Kesimpulan Singkat</p>
                        <ul class="mt-2 text-sm text-blue-900 space-y-1">
                            <li>Total siswa dianalisis: <span class="font-semibold">{{ $totalSiswa }}</span></li>
                            <li>Risiko tinggi: <span class="font-semibold">{{ $jumlahTinggi }}</span></li>
                            <li>Risiko sedang: <span class="font-semibold">{{ $jumlahSedang }}</span></li>
                            <li>Risiko rendah: <span class="font-semibold">{{ $jumlahRendah }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartRisiko');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Risiko Tinggi', 'Risiko Sedang', 'Risiko Rendah'],
                datasets: [{
                    data: [{{ $jumlahTinggi }}, {{ $jumlahSedang }}, {{ $jumlahRendah }}],
                    backgroundColor: ['#ef4444', '#f59e0b', '#22c55e'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-app-layout>