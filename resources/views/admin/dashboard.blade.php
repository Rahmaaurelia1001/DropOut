<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
                <p class="text-sm text-gray-500">Ringkasan data sistem identifikasi siswa putus sekolah</p>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('admin.user.index') }}" class="bg-white shadow-sm rounded-lg p-4 hover:bg-gray-50 transition border border-gray-100">
                        <h3 class="font-semibold text-gray-800">Manajemen User</h3>
                        <p class="text-sm text-gray-500 mt-1">Kelola akun admin, wali kelas, dan kepala sekolah.</p>
                    </a>

                    <a href="{{ route('admin.kelas.index') }}" class="bg-white shadow-sm rounded-lg p-4 hover:bg-gray-50 transition border border-gray-100">
                        <h3 class="font-semibold text-gray-800">Data Kelas</h3>
                        <p class="text-sm text-gray-500 mt-1">Kelola data kelas dan tahun ajaran.</p>
                    </a>

                    <a href="{{ route('admin.siswa.index') }}" class="bg-white shadow-sm rounded-lg p-4 hover:bg-gray-50 transition border border-gray-100">
                        <h3 class="font-semibold text-gray-800">Data Siswa</h3>
                        <p class="text-sm text-gray-500 mt-1">Kelola data siswa berdasarkan kelas.</p>
                    </a>

                    <a href="{{ route('admin.kriteria.index') }}" class="bg-white shadow-sm rounded-lg p-4 hover:bg-gray-50 transition border border-gray-100">
                        <h3 class="font-semibold text-gray-800">Data Kriteria</h3>
                        <p class="text-sm text-gray-500 mt-1">Kelola kriteria penilaian risiko putus sekolah.</p>
                    </a>

                    <a href="{{ route('admin.subkriteria.index') }}" class="bg-white shadow-sm rounded-lg p-4 hover:bg-gray-50 transition border border-gray-100">
                        <h3 class="font-semibold text-gray-800">Data Subkriteria</h3>
                        <p class="text-sm text-gray-500 mt-1">Kelola subkriteria dan nilai skala penilaian.</p>
                    </a>

                    <a href="{{ route('admin.periode.index') }}" class="bg-white shadow-sm rounded-lg p-4 hover:bg-gray-50 transition border border-gray-100">
                        <h3 class="font-semibold text-gray-800">Periode Penilaian</h3>
                        <p class="text-sm text-gray-500 mt-1">Kelola periode aktif dan riwayat penilaian.</p>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                    <h2 class="text-sm font-medium text-gray-500">Total User</h2>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalUsers }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                    <h2 class="text-sm font-medium text-gray-500">Total Kelas</h2>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalKelas }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                    <h2 class="text-sm font-medium text-gray-500">Total Siswa</h2>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalSiswa }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                    <h2 class="text-sm font-medium text-gray-500">Total Kriteria</h2>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalKriteria }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                    <h2 class="text-sm font-medium text-gray-500">Total Subkriteria</h2>
                    <p class="text-3xl font-bold text-pink-600 mt-2">{{ $totalSubkriteria }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                    <h2 class="text-sm font-medium text-gray-500">Total Periode Penilaian</h2>
                    <p class="text-3xl font-bold text-amber-600 mt-2">{{ $totalPeriode }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Siswa Terbaru</h2>
                        <a href="{{ route('admin.siswa.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                            Lihat semua
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NISN</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($siswaTerbaru as $index => $siswa)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $siswa->nama_siswa }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $siswa->nisn }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-4 text-sm text-center text-gray-500">
                                            Belum ada data siswa
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Periode Terbaru</h2>
                        <a href="{{ route('admin.periode.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                            Lihat semua
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tahun Ajaran</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Semester</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($periodeTerbaru as $index => $periode)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $periode->tahun_ajaran }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $periode->semester }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @if($periode->status == 'aktif')
                                                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-4 text-sm text-center text-gray-500">
                                            Belum ada data periode
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>