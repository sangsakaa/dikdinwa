<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      @section('title', ' | Data Siswa' )
      {{ __('Data Syn') }}
    </h2>
  </x-slot>
  <script>
    toastr.success('Have fun storming the castle!', 'Miracle Max Says')
  </script>
  <div class="p-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="  rounded-lg overflow-hidden w-1/2 px-6">
        <canvas class="p-2" id="myChart"></canvas>
      </div>
      <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [
              @foreach($data as $key => $value)
              '{{date("Y", strtotime($key))}}',
              @endforeach
            ],
            datasets: [{
              label: 'BERDASARKAN TAHUN ANGKATAN ULA dan WUSTHO',
              data: [
                @foreach($data as $key => $value)
                '{{$value}}',
                @endforeach
              ],
              backgroundColor: function(context) {
                var index = context.dataIndex;
                var value = context.dataset.data[index];
                var color = 'rgba(0, 123, 255, ' + (value / 100) + ')';
                return color;
              }
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>
    </div>
    <div class=" bg-white mt-2">
      <div class=" p-4">

        <table class=" w-full">
          <thead>
            <tr class=" px-1 border">
              <th class=" px-1 border">No</th>
              <th class=" px-1 border">NIS</th>
              <th class=" px-1 border">Nama Siswa</th>
              <th class=" px-1 border w-5">Huruf</th>
              <th class=" px-1 border">Jenjang</th>
              <th class=" px-1 border">Angkatan</th>
              <th class=" px-1 border">Tanggal Masuk</th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $dataSiswa as $item)
            <tr class=" even:bg-gray-100">
              <th class=" border px-1">{{$loop->iteration}}</th>
              <td class=" border px-1 text-center">
                <?php
                $count = array_count_values($item->pluck('nis')->toArray());
                if ($count[$item->nis] > 1) {
                  echo '<span class="bg-red-600 text-white px-2 py-1">' . $item->nis . '</span>';
                } else {
                  echo $item->nis;
                }
                ?>
              </td>
              <td class=" border px-1 capitalize">
                @if(strlen($item->nama_siswa) >= 36) <span class=" bg-red-600 text-white px-2 py-1">{{strtolower($item->nama_siswa)}} </span> @else {{strtolower($item->nama_siswa)}} @endif </td>
              <td class=" border px-1 capitalize text-center">{{strlen($item->nama_siswa)}}</td>
              <td class=" border px-1 text-center">{{$item->madrasah_diniyah}}</td>
              <td class=" border px-1 text-center">{{date('Y', strtotime($item->tanggal_masuk))}}</td>
              <td class=" border px-1 text-center">{{date('Y/M/d', strtotime($item->tanggal_masuk))}}</td>


            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</x-app-layout>