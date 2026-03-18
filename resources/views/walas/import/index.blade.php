<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Import Data Akademik
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Kelola file import nilai dan data pendukung untuk analisis risiko putus sekolah.
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

        @if($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5">
                <p class="text-sm text-gray-500">Total File Import</p>
                <h3 class="mt-2 text-3xl font-bold text-gray-800">{{ $imports->count() }}</h3>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5">
                <p class="text-sm text-gray-500">Import Nilai Mapel</p>
                <h3 class="mt-2 text-3xl font-bold text-blue-600">
                    {{ $imports->where('jenis_data', 'nilai_mapel')->count() }}
                </h3>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5">
                <p class="text-sm text-gray-500">Import Evaluasi</p>
                <h3 class="mt-2 text-3xl font-bold text-emerald-600">
                    {{ $imports->where('jenis_data', 'evaluasi')->count() }}
                </h3>
            </div>
        </div>

        
</form>

        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 p-6 border-b border-gray-100">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Riwayat Import</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Daftar file Excel yang pernah Anda upload ke sistem.
                    </p>
                </div>

                <a href="{{ route('walas.import.create') }}"
                   class="inline-block rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition">
                    Upload File
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Nama File</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Jenis Data</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tanggal Upload</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Path File</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($imports as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $item->nama_file }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($item->jenis_data == 'nilai_mapel')
                                        <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                            Nilai Mapel
                                        </span>
                                    @elseif($item->jenis_data == 'evaluasi')
                                        <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            Evaluasi
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                            {{ ucfirst($item->jenis_data) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_upload)->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $item->file_path }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                    Belum ada file yang diupload.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>