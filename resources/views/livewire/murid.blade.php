<div>
    <script>
        function printContent(el) {
            var fullbody = document.body.innerHTML;
            var printContent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = fullbody;
        }
    </script>
    <div class=" flex gap-2 justify-end">
        <form action="/data-siswa" method="post">
            @method('delete')
            @csrf
            <x-button variant="red" class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>Reset Data Siswa</span>
            </x-button>
        </form>
        <div>
            <form action="/Syn" method="get">
                <x-button variant="red" class="justify-center max-w-xs gap-2">
                    <x-icons.github class="w-6 h-6" aria-hidden="true" />
                    <span>Syn</span>
                </x-button>
            </form>
        </div>
        <div>
            <button class=" bg-red-600 py-1 dark:bg-purple-600 mt-1 my-1 w-full  rounded-sm hover:bg-purple-600 text-white px-4 " onclick="printContent('blanko')">
                <x-icons.github class="w-6 h-6 " aria-hidden="true" />
            </button>
        </div>
    </div>
    <div>
        <input type="search" wire:model="search" class=" py-1" placeholder=" cari">
        <select wire:model="perPage" class=" py-1">
            <option>10</option>
            <option>40</option>
            <option>50</option>
            <option>100</option>
            <option>500</option>
        </select>
        <select wire:model="jenjang" class=" py-1">
            <option>Ula</option>
            <option>Wustho</option>
            <option>Ulya</option>
        </select>
        <select wire:model="kelas" class=" py-1">
            @foreach($mapkelas as $item)
            <option>{{$item['nama_kelas']}}</option>
            @endforeach
        </select>

    </div>
    <div id="blanko">
        <div class="  sm:hidden block">
            <div class=" gap-2 flex justify-center py-2">
                <div>
                    <img src="{{asset('asset/images/logo.png')}}" alt="" width="80">
                </div>
                <div class=" py-2  ">
                    <center>
                        <p class=" text-xs uppercase">yayasan perjuangan wahidiyah dan pondok pesantren kedunglo al munadhdhoroh</p>
                        <p class=" uppercase text-2xl ">departemen pendidikan madrasah diniyah</p>
                    </center>
                </div>
            </div>
            <hr class=" border border-green-800 border-b-2">
            <hr>
        </div>
        <div class=" overflow-auto">
            <table class=" mt-2 w-full">
                <thead>
                    <tr class=" border text-sm">
                        <th class=" border">
                            Act
                        </th>
                        <th class=" border py-2">No</th>
                        <th class=" border">NIS</th>
                        <th class=" border">Nama</th>
                        <th class=" border">JK</th>
                        <th class=" border">Asrama</th>
                        <th class=" border">Tempat Lahir</th>
                        <th class=" border">Tanggal Lahir</th>
                        <th class=" border">Kota Asal</th>
                        <th class=" border">Jenjang</th>
                        <th class=" border">Kls</th>

                    </tr>
                </thead>
                <tbody>
                    @if($dataSiswa->count() != null)
                    @foreach ($dataSiswa as $siswa)
                    <tr class=" text-sm even:bg-gray-100 hover:bg-green-100">
                        <td class=" border text-center">
                            <div class=" justify-center flex">
                                <livewire:show-edit-siswa siswa:$siswa></livewire:show-edit-siswa>
                            </div>
                        </td>
                        <td class="py-1 border text-center">{{ $loop->iteration }}</td>
                        <td class=" border text-center">{{ $siswa->nis }}</td>
                        <td class=" border text-left capitalize">{{ strtolower($siswa->nama_siswa) }}</td>
                        <td class=" border text-center">{{ $siswa->jenis_kelamin }}</td>
                        <td class=" border text-center">{{ $siswa->nama_asrama }}</td>
                        <td class=" border text-center">{{ $siswa->tempat_lahir }}</td>
                        <td class=" border text-center">{{ $siswa->tanggal_lahir }}</td>
                        <td class=" border text-center">{{ $siswa->kota_asal }}</td>

                        <td class=" border text-center">{{ $siswa->madrasah_diniyah }}</td>
                        <td class=" border text-center">{{ $siswa->nama_kelas }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" class=" border  text-red-700 text-center font-semibold uppercase">data tidak ditemukan</td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="7" class=" py-1">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>