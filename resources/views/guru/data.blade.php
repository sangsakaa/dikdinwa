<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @section('title', ' | Syn' )
            {{ __('Data Guru') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" flex grid-cols-2 sm:grid-cols-2 p-6 text-gray-900 gap-2">
                    <table class="table w-full">
                        <thead>
                            <tr class=" border px-1">
                                <th class=" border">No</th>
                                <th class=" border">Nama</th>
                                <th class=" border">JK</th>
                                <th class=" border">Jenjang</th>
                                <th class=" border">Status</th>
                                <!-- Tambahkan kolom-kolom lain sesuai dengan data dari API -->
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($guru as $dataSiswa)
                            @foreach ($dataSiswa['guru'] as $siswaItem)
                            @if (is_array($siswaItem))
                            <tr class="border px-1 even:bg-gray-200">
                                <th class="border px-1">
                                    {{ $loop->iteration}}
                                </th>
                                <td class="border px-1 capitalize">
                                    {{ strtolower($siswaItem['nama_guru'] ?? '') }}
                                </td>
                                <td class="border px-1 text-center">
                                    {{ $siswaItem['jenis_kelamin'] ?? '' }}
                                </td>
                                <td class="border px-1 text-center">
                                    {{ $siswaItem['jenjang'] ?? '' }}
                                </td>
                                <td class="border px-1 text-center">
                                    {{ $siswaItem['status'] ?? '' }}
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach


                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>