<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Hasil Analisis Risiko Putus Sekolah
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Menampilkan hasil identifikasi risiko putus sekolah siswa pada kelas yang Anda ampu.
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
            <form method="GET" action="{{ route('walas.mfep.hasil') }}" class="bg-white p-4 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium mb-2">Pilih Periode</label>
                        <select name="id_periode" class="border rounded p-2 w-full">
                            <option value="">-- Pilih Periode --</option>
                            @foreach($periodes as $p)
                                <option value="{{ $p->id_periode }}" {{ (string) $idPeriode === (string) $p->id_periode ? 'selected' : '' }}>
                                    {{ $p->tahun_ajaran }} - Semester {{ $p->semester }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded w-full">
                            Tampilkan
                        </button>
                    </div>
                </div>
            </form>

            <div class="bg-white rounded-lg shadow p-4 mt-4">
                <p class="text-sm text-gray-600">
                    <span class="font-semibold">Periode:</span>
                    @if($periode)
                        {{ $periode->tahun_ajaran }} - Semester {{ $periode->semester }}
                    @else
                        -
                    @endif
                </p>
            </div>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Ranking Hasil Identifikasi</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        @if($periode)
                            Periode:
                            <span class="font-medium text-gray-700">
                                {{ $periode->tahun_ajaran }} - Semester {{ $periode->semester }}
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
                                    {{ $item->faktor_dominan ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700" style="min-width: 380px;">
    @php
        $rekomendasiTerpilih = $item->rekomendasi->firstWhere('is_selected', 1);

        if (!$rekomendasiTerpilih && !empty($item->tindak_lanjut_final)) {
            $rekomendasiTerpilih = $item->rekomendasi
                ->firstWhere('deskripsi_rekomendasi', $item->tindak_lanjut_final);
        }

        $rekomendasiFinal = $rekomendasiTerpilih?->deskripsi_rekomendasi ?? $item->tindak_lanjut_final;
        $statusRekomendasi = $rekomendasiTerpilih?->status ?? 'belum_diproses';
    @endphp

    @if($rekomendasiFinal)
        <div class="border border-gray-200 rounded-xl p-3 bg-white">
            <div class="mb-2 text-sm font-medium text-gray-800">
                {{ $rekomendasiFinal }}
            </div>

            @if($statusRekomendasi === 'belum_diproses')
                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Belum Diproses</span>
            @elseif($statusRekomendasi === 'sedang_diproses')
                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded">Sedang Diproses</span>
            @else
                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">Selesai</span>
            @endif

            <form action="{{ route('walas.rekomendasi.updateStatus', $item->id_hasil) }}" method="POST" class="mt-3">
                @csrf

                <div class="space-y-2">
                    <select name="status"
                        onchange="this.form.submit()"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                        <option value="belum_diproses" {{ $statusRekomendasi === 'belum_diproses' ? 'selected' : '' }}>
                            Belum Diproses
                        </option>
                        <option value="sedang_diproses" {{ $statusRekomendasi === 'sedang_diproses' ? 'selected' : '' }}>
                            Sedang Diproses
                        </option>
                        <option value="selesai" {{ $statusRekomendasi === 'selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>
                    </select>
                </div>
            </form>
        </div>
    @else
        <span class="text-gray-400 italic">Belum ada rekomendasi final yang sinkron dari kepala sekolah</span>
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