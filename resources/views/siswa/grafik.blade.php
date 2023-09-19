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
                                <tr class=" border border-black bg-gray-200">
                                    <th rowspan="2" class=" border border-black">Jenjang</th>
                                    <th rowspan="2" class=" border border-black">Sesi</th>
                                    <th rowspan="2" class=" border border-black">Jml Siswa</th>
                                    <th colspan="7" class=" border border-black capitalize">keterangan</th>
                                </tr>
                                <tr class=" border-black bg-gray-200">
                                    <th class=" border border-black">Hadir</th>
                                    <th class=" border border-black">Rata Rata <br>Hadir</th>
                                    <th class=" border border-black">Sakit</th>
                                    <th class=" border border-black">Izin</th>
                                    <th class=" border border-black">Alfa</th>
                                    <th class=" border border-black">Presentasi <br> Kehadiran</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($asramaTerbanyaAlfa as $list)
                                <tr class="border border-black even:bg-gray-200">
                                    <td class="border border-black px-1">{{$list->jenjang}}</td>
                                    <td class="border border-black px-1 text-center">
                                        {{$list->jumlah_tgl}}
                                    </td>
                                    <td class="border border-black px-1 text-center">
                                        <?php
                                        $totalKehadiran = $list->jumlah_hadir + $list->jumlah_sakit + $list->jumlah_izin + $list->jumlah_alfa;
                                        $presentasiKehadiran = $totalKehadiran / $list->jumlah_tgl;
                                        ?>
                                        {{ number_format($presentasiKehadiran) }}

                                    </td>
                                    <td class="border border-black px-1 text-center">{{$list->jumlah_hadir}}</td>
                                    <td class="border border-black px-1 text-center">
                                        <?php
                                        $totalKehadiran = $list->jumlah_hadir + $list->jumlah_sakit + $list->jumlah_izin + $list->jumlah_alfa;
                                        $presentasiKehadiran = ($list->jumlah_hadir) / $list->jumlah_tgl;
                                        ?>
                                        {{ number_format($presentasiKehadiran, 0,2) }}
                                    </td>

                                    <td class="border border-black px-1 text-center">{{$list->jumlah_sakit}}</td>
                                    <td class="border border-black px-1 text-center">{{$list->jumlah_izin}}</td>
                                    <td class="border border-black px-1 text-center">{{$list->jumlah_alfa}}</td>
                                    <td class="border border-black px-1 text-center">
                                        <?php
                                        $totalKehadiran = $list->jumlah_hadir + $list->jumlah_sakit + $list->jumlah_izin + $list->jumlah_alfa;
                                        $presentasiKehadiran = ($list->jumlah_hadir / $totalKehadiran) * 100;
                                        ?>
                                        {{ number_format($presentasiKehadiran, 2) }}%
                                    </td>
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