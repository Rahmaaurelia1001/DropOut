<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Ranking Risiko Putus Sekolah
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Menampilkan urutan tingkat risiko siswa berdasarkan hasil perhitungan MFEP.
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
            <form method="GET" action="{{ route('kepsek.ranking') }}" class="bg-white p-4 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
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
                            Tampilkan
                        </button>
                    </div>
                </div>
            </form>

            <div class="mt-4 rounded-xl border border-gray-200 bg-gray-50 p-4 text-sm text-gray-600">
                <span class="font-semibold">Periode:</span>
                @if($periode)
                    {{ $periode->tahun_ajaran }} - Semester {{ $periode->semester }}
                @else
                    -
                @endif

                <span class="mx-2">|</span>

                <span class="font-semibold">Kelas:</span>
                @if(!empty($idKelas))
                    {{ optional($kelasList->firstWhere('id_kelas', $idKelas))->nama_kelas ?? '-' }}
                @else
                    Semua Kelas
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Ranking</th>
                        <th class="px-4 py-3 text-left font-semibold">Nama Siswa</th>
                        <th class="px-4 py-3 text-left font-semibold">Kelas</th>
                        <th class="px-4 py-3 text-left font-semibold">Nilai Preferensi</th>
                        <th class="px-4 py-3 text-left font-semibold">Kategori Risiko</th>
                        <th class="px-4 py-3 text-left font-semibold">Faktor Dominan</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($hasil as $index => $item)
                        <tr>
                            <td class="px-4 py-4 font-semibold text-gray-800">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-4 py-4 text-gray-800">
                                {{ $item->siswa->nama_siswa ?? '-' }}
                            </td>

                            <td class="px-4 py-4 text-gray-700">
                                {{ $item->siswa->kelas->nama_kelas ?? '-' }}
                            </td>

                            <td class="px-4 py-4 text-gray-700">
                                {{ number_format((float) $item->total_nilai_preferensi, 4) }}
                            </td>

                            <td class="px-4 py-4">
                                @if($item->kategori_risiko === 'Tinggi')
                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Tinggi
                                    </span>
                                @elseif($item->kategori_risiko === 'Sedang')
                                    <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                        Sedang
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Rendah
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-4 text-gray-700">
                                {{ $item->faktor_dominan ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-500">
                                Data ranking belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>