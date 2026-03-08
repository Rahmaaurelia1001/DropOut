<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Preview Import Data
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Periksa data sebelum disimpan ke database.
            </p>
        </div>
    </x-slot>

    <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">

        <div class="mb-4">
            <p class="text-sm text-gray-500">
                Jenis Data:
                <span class="font-semibold text-gray-800">{{ ucfirst($jenis_data) }}</span>
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <tbody>
                    @foreach($rows as $index => $row)
                        @if($index > 10)
                            @break
                        @endif
                        <tr>
                            @foreach($row as $cell)
                                <td class="border px-4 py-2 text-sm">
                                    {{ $cell }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex gap-3">

            {{-- tombol konfirmasi import --}}
            <form action="{{ route('walas.import.store') }}" method="POST">
                @csrf
                <input type="hidden" name="jenis_data" value="{{ $jenis_data }}">

                <button type="submit"
                    class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Konfirmasi Import
                </button>
            </form>

            {{-- tombol batal --}}
            <a href="{{ route('walas.import.create') }}"
                class="px-5 py-2.5 bg-gray-300 rounded-lg hover:bg-gray-400 transition">
                Batal
            </a>

        </div>

    </div>
</x-app-layout>