<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Bobot Kriteria
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Menampilkan bobot kriteria yang digunakan dalam perhitungan MFEP.
            </p>
        </div>
    </x-slot>

    <div class="p-6">

        <div class="bg-white shadow rounded-2xl overflow-hidden">

            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">No</th>
                        <th class="px-6 py-4 text-left font-semibold">Nama Kriteria</th>
                        <th class="px-6 py-4 text-left font-semibold">Bobot</th>
                        <th class="px-6 py-4 text-left font-semibold">Keterangan</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($kriteria as $index => $k)
                        <tr>
                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $k->nama_kriteria }}
                            </td>

                            <td class="px-6 py-4">
                                {{ number_format($k->bobot, 2) }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $k->keterangan ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">
                                Data kriteria belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <span class="text-sm font-semibold text-blue-700">
                Total Bobot:
            </span>
            <span class="text-sm text-blue-800">
                {{ number_format($kriteria->sum('bobot'), 2) }}
            </span>
        </div>

    </div>
</x-app-layout>