<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @section('title', ' | Syn' )
            {{ __('Data Syn') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" flex grid-cols-2 sm:grid-cols-2 p-6 text-gray-900 gap-2">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Status</th>
                                <!-- Tambahkan kolom-kolom lain sesuai dengan data dari API -->
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($guru as $dataSiswa)
                            @foreach ($dataSiswa['guru'] as $siswaItem)
                            <tr>
                                <td>
                                    {{ $siswaItem['nama_guru'] }}

                                </td>
                                <td>

                                    {{ $siswaItem['status'] }}
                                </td>
                            </tr>
                            @endforeach
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>