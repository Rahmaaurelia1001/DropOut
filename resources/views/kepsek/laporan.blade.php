<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Laporan SPK
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Laporan hasil identifikasi risiko putus sekolah siswa berdasarkan perhitungan MFEP.
            </p>
        </div>
    </x-slot>

    <div class="p-6 space-y-6">

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

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <form method="GET" action="{{ route('kepsek.laporan') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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

                    <div>
                        <label class="block text-sm font-medium mb-2">Pilih Kelas</label>
                        <select name="id_kelas" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            <option value="">-- Semua Kelas --</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id_kelas }}" {{ (string) $idKelas === (string) $kelas->id_kelas ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                            Tampilkan Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <div class="mb-6 text-center">
                <h3 class="text-lg font-bold text-gray-800">LAPORAN HASIL SPK RISIKO PUTUS SEKOLAH</h3>
                <p class="text-sm text-gray-600 mt-1">
                    @if($periode)
                        Periode {{ $periode->tahun_ajaran }} - Semester {{ $periode->semester }}
                    @else
                        Periode belum dipilih
                    @endif
                </p>
                <p class="text-sm text-gray-600">
                    @if(!empty($idKelas))
                        Kelas: {{ optional($kelasList->firstWhere('id_kelas', $idKelas))->nama_kelas ?? '-' }}
                    @else
                        Semua Kelas
                    @endif
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="border px-4 py-3 text-left">No</th>
                            <th class="border px-4 py-3 text-left">Nama Siswa</th>
                            <th class="border px-4 py-3 text-left">Kelas</th>
                            <th class="border px-4 py-3 text-left">Nilai Preferensi</th>
                            <th class="border px-4 py-3 text-left">Kategori Risiko</th>
                            <th class="border px-4 py-3 text-left">Faktor Dominan</th>
                            <th class="border px-4 py-3 text-left">Tindak Lanjut Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hasil as $index => $item)
                            <tr>
                                <td class="border px-4 py-3">{{ $index + 1 }}</td>
                                <td class="border px-4 py-3">{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                <td class="border px-4 py-3">{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td class="border px-4 py-3">{{ number_format((float) $item->total_nilai_preferensi, 4) }}</td>
                                <td class="border px-4 py-3">{{ $item->kategori_risiko }}</td>
                                <td class="border px-4 py-3">{{ $item->faktor_dominan ?? '-' }}</td>
                                <td class="border px-4 py-3">{{ $item->tindak_lanjut_final ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border px-4 py-6 text-center text-gray-500">
                                    Data laporan belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('kepsek.laporan.exportPdf', ['id_periode' => $idPeriode, 'id_kelas' => $idKelas]) }}"
                   class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition">
                    Export PDF
                </a>

                <button onclick="window.print()"
                    class="rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700 transition">
                    Cetak Laporan
                </button>
            </div>
        </div>
    </div>
</x-app-layout>