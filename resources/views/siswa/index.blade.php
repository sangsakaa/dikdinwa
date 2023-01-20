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
  <div class="p-4 grid sm:grid-cols-2 gap-2 grid-cols-1">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:w-full">
      <div class="  rounded-lg overflow-hidden w-full sm:w-full px-6">
        <canvas class="p-2 sm:w-full" id="myChart"></canvas>
      </div>
      <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [
              @foreach($Ula as $key => $value)
              '{{date("Y", strtotime($key))}}',
              @endforeach
            ],
            datasets: [{
              label: 'ULA',
              data: [
                @foreach($Ula as $key => $value)
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
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:w-full">
      <div class="  rounded-lg overflow-hidden w-full sm:w-full px-6">
        <canvas class="p-2 sm:w-full" id="wustho"></canvas>
      </div>
      <script>
        var ctx = document.getElementById('wustho').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [
              @foreach($Wustho as $key => $value)
              '{{date("Y", strtotime($key))}}',
              @endforeach
            ],
            datasets: [{
              label: 'WUSTHO',
              data: [
                @foreach($Wustho as $key => $value)
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
  </div>
</x-app-layout>