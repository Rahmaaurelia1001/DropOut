<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Hasil Analisis Risiko Putus Sekolah
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Menampilkan ranking hasil identifikasi risiko putus sekolah berdasarkan periode penilaian.
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

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <form method="GET" action="{{ route('walas.mfep.hasil') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div class="md:col-span-3">
                    <label for="id_periode" class="block text-sm font-medium text-gray-700 mb-2">
                        Filter Periode Penilaian
                    </label>
                    <select name="id_periode" id="id_periode"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">-- Pilih Periode --</option>
                        @foreach($periodes as $item)
                            <option value="{{ $item->id_periode }}" {{ (string) $idPeriode === (string) $item->id_periode ? 'selected' : '' }}>
                                {{ $item->tahun_ajaran ?? '' }} - Semester {{ $item->semester ?? '' }}
                                @if(($item->status ?? '') === 'Aktif')
                                    (Aktif)
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-700 transition">
                        Tampilkan
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Ranking Hasil Identifikasi</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        @if($periode)
                            Periode:
                            <span class="font-medium text-gray-700">
                                {{ $periode->tahun_ajaran ?? '' }} - Semester {{ $periode->semester ?? '' }}
                            </span>
                        @else
                            Belum ada periode yang dipilih.
                        @endif
                    </p>
                </div>

                <a href="{{ route('walas.mfep.index') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 transition">
                    Kembali ke Analisis
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Ranking</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Nama Siswa</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Nilai Preferensi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Kategori Risiko</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Faktor Dominan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Rekomendasi Tindak Lanjut</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($hasil as $index => $item)
                            <tr class="hover:bg-gray-50 transition align-top">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $item->siswa->nama_siswa ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ number_format((float) $item->total_nilai_preferensi, 4) }}
                                </td>

                                <td class="px-6 py-4 text-sm">
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

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->faktor_dominan }}
                                </td>
                                
<td class="px-6 py-4 text-sm text-gray-700 min-w-[320px]">
    @if($item->rekomendasi && $item->rekomendasi->count() > 0)
        <div class="space-y-3">
            @foreach($item->rekomendasi as $rek)
                <div class="rounded-xl border border-gray-200 p-3">
                    <div class="text-sm text-gray-800 mb-3">
                        {{ $rek->deskripsi_rekomendasi }}
                    </div>

                    <form action="{{ route('walas.rekomendasi.updateStatus', $rek->id_rekomendasi) }}" method="POST" class="space-y-2">
                        @csrf
                        @method('PATCH')

                                           <select name="status"
    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
    <option value="belum_diproses" {{ $rek->status === 'belum_diproses' ? 'selected' : '' }}>
        Belum Diproses
    </option>
    <option value="sedang_diproses" {{ $rek->status === 'sedang_diproses' ? 'selected' : '' }}>
        Diproses
    </option>
    <option value="selesai" {{ $rek->status === 'selesai' ? 'selected' : '' }}>
        Selesai
    </option>
</select>

                        <button type="submit"
                            class="w-full inline-flex items-center justify-center rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white hover:bg-indigo-700 transition">
                            Update Status
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <span class="text-gray-400 italic">Belum ada rekomendasi</span>
    @endif
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    Data hasil analisis belum tersedia untuk periode yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>