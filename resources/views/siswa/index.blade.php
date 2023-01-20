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
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:w-full">
      <div class="   rounded-lg overflow-hidden w-full sm:w-full px-6">
        <canvas class="p-2 sm:w-full" id="myChart"></canvas>
      </div>
      <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [
              @foreach($result as $key => $value)
              '{{date("Y", strtotime($key))}}',
              @endforeach
            ],
            datasets: [{
              label: 'ULA',
              data: [
                @foreach($result as $key => $value)
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
    <div class=" py-4">
      <div class=" p-6 bg-white">

      </div>
    </div>
  </div>
</x-app-layout>