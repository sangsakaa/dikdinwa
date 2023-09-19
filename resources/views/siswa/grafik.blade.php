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
                <div class=" grid grid-cols-1 sm:grid-cols-1 p-6 text-gray-900 gap-2">
                    <div>
                        <h1>
                            {{ \Carbon\Carbon::parse($startDate)->format('M Y') }}
                        </h1>
                    </div>
                    <div>
                        <table class=" w-full">
                            <thead>
                                <tr>
                                    <th rowspan="2" class=" border">Jenjang</th>
                                    <th colspan="3" class=" border capitalize">keterangan</th>
                                </tr>
                                <tr>

                                    <th class=" border">Sakit</th>
                                    <th class=" border">Izin</th>
                                    <th class=" border">Alfa</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($asramaTerbanyaAlfa as $list)
                                <tr class=" border ">
                                    <td class=" border px-1">{{$list->jenjang}}</td>
                                    <td class=" border px-1 text-center">{{$list->jumlah_sakit}}</td>
                                    <td class=" border px-1 text-center">{{$list->jumlah_izin}}</td>
                                    <td class=" border px-1 text-center">{{$list->jumlah_alfa}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
        </div>
    </div>
</x-app-layout>