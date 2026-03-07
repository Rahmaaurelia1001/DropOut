<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Siswa
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Kelola data siswa dan filter berdasarkan kelas.
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
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                <form method="GET" action="{{ route('admin.siswa.index') }}" class="flex flex-col sm:flex-row gap-3">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Filter Kelas</label>
                        <select name="id_kelas" class="rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Semua Kelas --</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id_kelas }}" {{ request('id_kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }} - {{ $kelas->tahun_ajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit"
                            style="display:inline-block; padding:10px 16px; background:#4f46e5; color:white; border:none; border-radius:8px; font-weight:600; cursor:pointer;">
                            Filter
                        </button>

                        <a href="{{ route('admin.siswa.index') }}"
                           style="display:inline-block; padding:10px 16px; background:#ffffff; color:#374151; border:1px solid #d1d5db; border-radius:8px; text-decoration:none; font-weight:600;">
                            Reset
                        </a>
                    </div>
                </form>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.siswa.create') }}"
                       style="display:inline-block; padding:10px 16px; background:#4f46e5; color:white; border-radius:8px; text-decoration:none; font-weight:600;">
                        Tambah Siswa
                    </a>

                    <a href="{{ route('admin.siswa.import.form') }}"
                       style="display:inline-block; padding:10px 16px; background:#ffffff; color:#374151; border:1px solid #d1d5db; border-radius:8px; text-decoration:none; font-weight:600;">
                        Import Siswa
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">NISN</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">JK</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tanggal Lahir</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Kelas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($siswa as $index => $s)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $s->nisn }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $s->nama_siswa }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $s->jenis_kelamin ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $s->tanggal_lahir ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $s->kelas->nama_kelas ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.siswa.edit', $s->id_siswa) }}"
                                           style="display:inline-block; padding:8px 12px; background:#f59e0b; color:white; border-radius:8px; text-decoration:none; font-weight:600;">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.siswa.destroy', $s->id_siswa) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin hapus?')"
                                                style="display:inline-block; padding:8px 12px; background:#dc2626; color:white; border:none; border-radius:8px; font-weight:600; cursor:pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                    Belum ada data siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>