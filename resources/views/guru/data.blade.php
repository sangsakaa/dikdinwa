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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <!-- Tambahkan kolom-kolom lain sesuai dengan data dari API -->
                            </tr>
                        </thead>
                        <tbody>
                            <ul>
                                @foreach ($guru as $dataSiswa)
                                <li>
                                    <h2>Siswa dari <span class=" text-red-600 font-semibold uppercase"></span></h2>
                                    <ul>
                                        @foreach ($dataSiswa['siswa'] as $siswaItem)
                                        <li>{{ $siswaItem['nama_siswa'] }} - {{ $siswaItem['nis'] }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>