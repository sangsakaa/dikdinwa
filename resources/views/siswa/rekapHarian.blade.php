<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <h2 class="text-xl font-semibold leading-tight">

        @section('title', ' | Data Siswa' )
      </h2>
      <div class=" flex justify-end gap-2">
        <div>
          <form action="/rekap-siswa-harian" method="post">
            @method('delete')
            @csrf
            <x-button variant="red" class="justify-center max-w-xs gap-2">
              <x-icons.github class="w-6 h-6" aria-hidden="true" />
              <span>Reset Data </span>
            </x-button>
          </form>
        </div>
        <div>
          <form action="/Syn-rekap-harian" method="get">
            <x-button variant="red" class="justify-center max-w-xs gap-2">
              <x-icons.github class="w-6 h-6" aria-hidden="true" />
              <span>Syn</span>
            </x-button>
          </form>
        </div>
      </div>

    </div>
  </x-slot>
  <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    <div class=" bg-white  justify-between ">
      <div class=" py-1">
        <div class="  ">
          <form action="/rekap-siswa-harian" method="get" class="mr-auto">
            <input type="date" name="tgl" class="py-1 dark:bg-dark-bg" value="{{ $tgl->toDateString() }}">
            <button class=" bg-red-600 py-1 dark:bg-purple-600 mt-1 my-1 rounded-sm hover:bg-purple-600 text-white px-4 ">
              Pilih Tanggal
            </button>
          </form>
        </div>
      </div>
      <div class=" overflow-auto">
        <div class=" flex gap-2 grid-cols-2">
          <div>Tanggal</div>
          <div> : {{ \Carbon\Carbon::parse($tgl->toDateString())->isoFormat('dddd, DD MMMM Y') }}</div>
        </div>
        <table class=" w-full">
          <thead>
            <tr class=" border text-sm">
              <th class=" border py-2">No</th>

              <th class=" border">Nama Siswa</th>
              <th class=" border">Ket</th>
              <th class=" border">Jenjang</th>
              <th class=" border">Asrama</th>
              <th class=" border">Kls</th>

            </tr>
          </thead>
          <tbody>
            @if($rekapHarian->count() != null)
            @foreach ($rekapHarian as $siswa)
            <tr class=" text-sm even:bg-gray-100 hover:bg-green-100">
              <td class="py-1 border text-center">{{ $loop->iteration }}</td>

              <td class=" border text-left  capitalize px-1">{{ strtolower($siswa->nama_siswa) }}</td>
              <td class=" border text-center">{{ $siswa->nama_kelas }}</td>
              <td class=" border text-center">{{ $siswa->jenjang }}</td>
              <td class=" border text-center">{{ $siswa->nama_asrama }}</td>
              <td class=" border text-center capitalize">{{ $siswa->keterangan }}</td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="6" class=" border  text-red-700 text-center font-semibold uppercase">data tidak ditemukan</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>

</x-app-layout>