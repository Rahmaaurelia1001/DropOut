<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Riwayat Analisis Siswa
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Lihat perkembangan hasil analisis risiko putus sekolah siswa dari periode ke periode.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

        @if(session('success'))
            <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <form action="{{ route('walas.riwayat') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                <input
                    type="text"
                    name="keyword"
                    value="{{ $keyword }}"
                    placeholder="Masukkan NISN atau nama siswa"
                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >

                <button type="submit"
                    class="rounded-xl bg-indigo-600 px-5 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                    Cari
                </button>
            </form>
        </div>

        @if($keyword && !$siswa)
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                Siswa tidak ditemukan.
            </div>
        @endif

        @if($siswa)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5">
                    <p class="text-sm text-gray-500">NISN</p>
                    <h3 class="mt-2 text-xl font-bold text-gray-800">{{ $siswa->nisn }}</h3>
                </div>

                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5">
                    <p class="text-sm text-gray-500">Nama Siswa</p>
                    <h3 class="mt-2 text-xl font-bold text-gray-800">{{ $siswa->nama_siswa }}</h3>
                </div>

                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5">
                    <p class="text-sm text-gray-500">Jumlah Riwayat Analisis</p>
                    <h3 class="mt-2 text-xl font-bold text-indigo-600">{{ $riwayat->count() }}</h3>
                </div>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Timeline Perkembangan Risiko</h3>
                <p class="text-sm text-gray-500 mb-6">
                    Riwayat hasil analisis siswa dari periode awal hingga periode terakhir.
                </p>

                @if($riwayat->count() > 0)
                    <div class="space-y-6">
                        @foreach($riwayat as $index => $item)
                            <div class="relative pl-8">
                                @if(!$loop->last)
                                    <div class="absolute left-3 top-8 h-full w-0.5 bg-gray-200"></div>
                                @endif

                                <div class="absolute left-0 top-1.5 h-6 w-6 rounded-full
                                    @if($item->kategori_risiko === 'Tinggi')
                                        bg-red-100 text-red-600
                                    @elseif($item->kategori_risiko === 'Sedang')
                                        bg-yellow-100 text-yellow-600
                                    @else
                                        bg-green-100 text-green-600
                                    @endif
                                    flex items-center justify-center text-xs font-bold">
                                    {{ $index + 1 }}
                                </div>

                                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5 shadow-sm">
                                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-3">
                                        <div>
                                            <h4 class="text-base font-semibold text-gray-800">
                                                {{ $item->periode->tahun_ajaran ?? 'Periode' }}
                                                @if(isset($item->periode->semester))
                                                    - Semester {{ $item->periode->semester }}
                                                @else
                                                    - ID {{ $item->id_periode }}
                                                @endif
                                            </h4>

                                            <p class="text-sm text-gray-500 mt-1">
                                                Tanggal proses:
                                                {{ $item->tanggal_proses ? \Carbon\Carbon::parse($item->tanggal_proses)->format('d-m-Y H:i') : '-' }}
                                            </p>
                                        </div>

                                        <div>
                                            @if($item->kategori_risiko === 'Tinggi')
                                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                    Risiko Tinggi
                                                </span>
                                            @elseif($item->kategori_risiko === 'Sedang')
                                                <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                    Risiko Sedang
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                    Risiko Rendah
                                                </span>
                                            @endif

                                            
                                        </div>
                                    </div>

                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 text-sm">
                                        <div class="rounded-xl bg-white p-4 border border-gray-100">
                                            <p class="text-gray-500">Nilai Preferensi</p>
                                            <p class="mt-1 font-semibold text-gray-800">
                                                {{ number_format((float) $item->total_nilai_preferensi, 4) }}
                                            </p>
                                        </div>

                                        <div class="rounded-xl bg-white p-4 border border-gray-100">
                                            <p class="text-gray-500">Faktor Dominan</p>
                                            <p class="mt-1 font-semibold text-gray-800">
                                                {{ $item->faktor_dominan }}
                                            </p>
                                        </div>

                                        <div class="rounded-xl bg-white p-4 border border-gray-100">
                                            <p class="text-gray-500">Keputusan Final</p>
                                            <p class="mt-1 font-semibold text-gray-800">
                                                {{ $item->tindak_lanjut_final ?? 'Belum ada keputusan final' }}
                                            </p>
                                        </div>

                                        <div class="rounded-xl bg-white p-4 border border-gray-100">
                                            <p class="text-gray-500">Tanggal Keputusan</p>
                                            <p class="mt-1 font-semibold text-gray-800">
                                                {{ $item->tanggal_keputusan ? \Carbon\Carbon::parse($item->tanggal_keputusan)->format('d-m-Y H:i') : '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    @php
                                        $rekomendasiTerpilih = $item->rekomendasi->where('is_selected', 1)->first();
                                    @endphp

                                    @if($rekomendasiTerpilih)
                                        <div class="mt-4 rounded-xl border border-indigo-100 bg-indigo-50 p-4">
                                            <p class="text-sm font-medium text-indigo-700">Tindak Lanjut Terpilih</p>
                                            <p class="mt-1 text-sm text-gray-700">
                                                {{ $rekomendasiTerpilih->deskripsi_rekomendasi }}
                                            </p>

                                            <p class="mt-2 text-xs text-gray-500">
                                                Status pelaksanaan:
                                                <span class="font-semibold">
                                                    {{ str_replace('_', ' ', $rekomendasiTerpilih->status) }}
                                                </span>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-xl border border-gray-200 bg-gray-50 px-6 py-10 text-center text-gray-500">
                        Belum ada riwayat analisis untuk siswa ini.
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>