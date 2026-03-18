<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Hasil Analisis Risiko Putus Sekolah
        </h2>
    </x-slot>

    <div class="p-6 space-y-6">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- FILTER PERIODE -->
        <form method="GET" action="{{ route('kepsek.mfep.hasil') }}" class="bg-white p-4 rounded-lg shadow">
            <label class="block text-sm font-medium mb-2">Pilih Periode</label>

            <div class="flex gap-3">
                <select name="id_periode" class="border rounded p-2 w-full">
                    <option value="">-- Pilih Periode --</option>
                    @foreach($periodes as $p)
                        <option value="{{ $p->id_periode }}" {{ $idPeriode == $p->id_periode ? 'selected' : '' }}>
                            {{ $p->tahun_ajaran }} - Semester {{ $p->semester }}
                        </option>
                    @endforeach
                </select>

                <button class="bg-indigo-600 text-white px-4 rounded">
                    Tampilkan
                </button>
            </div>
        </form>

        <!-- TABEL HASIL -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3">Ranking</th>
                        <th class="px-4 py-3">Nama Siswa</th>
                        <th class="px-4 py-3">Nilai</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Faktor Dominan</th>
                        <th class="px-4 py-3">Rekomendasi</th>
                        <th class="px-4 py-3">Keputusan Final</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($hasil as $index => $item)
                        <tr class="border-t align-top">

                            <!-- Ranking -->
                            <td class="px-4 py-3 font-semibold">
                                {{ $index + 1 }}
                            </td>

                            <!-- Nama -->
                            <td class="px-4 py-3">
                                {{ $item->siswa->nama_siswa ?? '-' }}
                            </td>

                            <!-- Nilai -->
                            <td class="px-4 py-3">
                                {{ number_format($item->total_nilai_preferensi, 4) }}
                            </td>

                            <!-- Kategori -->
                            <td class="px-4 py-3">
                                @if($item->kategori_risiko == 'Tinggi')
                                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs">Tinggi</span>
                                @elseif($item->kategori_risiko == 'Sedang')
                                    <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs">Sedang</span>
                                @else
                                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">Rendah</span>
                                @endif
                            </td>

                            <!-- Faktor -->
                            <td class="px-4 py-3">
                                {{ $item->faktor_dominan }}
                            </td>

                            <!-- Rekomendasi -->
<td class="px-4 py-3" style="min-width: 320px;">
    @forelse($item->rekomendasi as $rek)
        <div class="border border-gray-200 rounded-lg p-3 mb-3 bg-white">
            <div class="text-sm text-gray-800 mb-3">
                {{ $rek->deskripsi_rekomendasi }}
            </div>

            <form method="POST" action="{{ route('kepsek.pilih.rekomendasi') }}">
                @csrf
                <input type="hidden" name="id_hasil" value="{{ $item->id_hasil }}">
                <input type="hidden" name="rekomendasi" value="{{ $rek->deskripsi_rekomendasi }}">

                <button type="submit"
                    class="w-full rounded-lg bg-green-600 px-3 py-2 text-sm font-semibold text-white hover:bg-green-700 transition">
                    Pilih sebagai Keputusan Final
                </button>
            </form>
        </div>
    @empty
        <span class="text-gray-400 text-xs">Tidak ada rekomendasi</span>
    @endforelse
</td>

                            <!-- KEPUTUSAN FINAL -->
                            <td class="px-4 py-3">
                                @if($item->tindak_lanjut_final)
                                    <div class="bg-green-50 text-green-700 p-2 rounded text-xs">
                                        {{ $item->tindak_lanjut_final }}
                                    </div>

                                    <div class="text-xs text-gray-400 mt-1">
                                        {{ $item->tanggal_keputusan }}
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">
                                        Belum dipilih
                                    </span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">
                                Data belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>