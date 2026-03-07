<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Wali Kelas
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Monitoring awal siswa pada kelas yang Anda ampu.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-800">
                Selamat datang, {{ Auth::user()->name }}
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                Anda login sebagai wali kelas.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
                <p class="text-sm text-gray-500">Kelas yang Diampu</p>
                <h3 class="mt-2 text-3xl font-bold text-indigo-600">
                    {{ Auth::user()->id_kelas ?? '-' }}
                </h3>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
                <p class="text-sm text-gray-500">Menu Utama</p>
                <div class="mt-4">
                    <a href="{{ route('walas.import.index') }}"
                        class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                        Import Data Akademik
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>