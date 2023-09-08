<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <h2 class="text-xl font-semibold leading-tight">

        @section('title', ' | Data Siswa' )
      </h2>
      <form action="/data-siswa" method="post">
        @method('delete')
        @csrf
        <x-button variant="red" class="justify-center max-w-xs gap-2">
          <x-icons.github class="w-6 h-6" aria-hidden="true" />
          <span>Reset Data Siswa</span>
        </x-button>
      </form>

    </div>
  </x-slot>
  <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    <div class=" bg-white  justify-between ">
      <div class=" py-1">
        <form action="/data-siswa" method="get" class="  text-sm gap-1 flex">
          <input type="text" name="cari" value="{{ request('cari') }}" class=" dark:bg-dark-bg border border-green-800 text-green-800 rounded-md py-1 " placeholder=" Cari .." autofocus>
          <x-button type="submit" variant="red" class=" px-2  py-1     rounded-md text-white">
            Cari </x-button>
        </form>
      </div>
      <div class=" overflow-auto">
        <table class=" w-full">
          <thead>
            <tr class=" border text-sm">
              <th class=" border py-2">No</th>
              <th class=" border">NIS</th>
              <th class=" border">Nama Siswa</th>
              <th class=" border">JK</th>
              <!-- <th class=" border">Asrama</th> -->
              <!-- <th class=" border">Tempat Lahir</th> -->
              <!-- <th class=" border">Tanggal Lahir</th> -->
              <!-- <th class=" border">Kota Asal</th> -->
              <!-- <th class=" border">Nama Lembaga</th> -->
              <th class=" border">Jenjang</th>
              <!-- <th class=" border">Tanggal Masuk</th> -->
            </tr>
          </thead>
          <tbody>
            @if($dataSiswa->count() != null)
            @foreach ($dataSiswa as $siswa)
            <tr class=" text-sm even:bg-gray-100 hover:bg-green-100">
              <td class="py-1 border text-center">{{ $loop->iteration }}</td>
              <td class=" border text-center">{{ $siswa->nis }}</td>
              <td class=" border text-left">{{ $siswa->nama_siswa }}</td>
              <td class=" border text-center">{{ $siswa->jenis_kelamin }}</td>
              <!-- <td class=" border text-center">{{ $siswa->nama_asrama }}</td> -->
              <!-- <td class=" border text-center">{{ $siswa->tempat_lahir }}</td> -->
              <!-- <td class=" border text-center">{{ $siswa->tanggal_lahir }}</td> -->
              <!-- <td class=" border text-center">{{ $siswa->kota_asal }}</td> -->
              <!-- <td class=" border text-center">{{ $siswa->nama_lembaga }}</td> -->
              <td class=" border text-center">{{ $siswa->madrasah_diniyah }}</td>
              <!-- <td class=" border text-center">{{ $siswa->tanggal_masuk }}</td> -->
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="5" class=" border  text-red-700 text-center font-semibold uppercase">data tidak ditemukan</td>
            </tr>
            @endif
            <tr>
              <td colspan="5" class=" py-1">
                {{$dataSiswa}}
              </td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</x-app-layout>