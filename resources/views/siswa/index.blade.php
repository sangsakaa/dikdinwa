<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <h2 class="text-xl font-semibold leading-tight">
        {{ __('Dashboard') }}
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
      <span>Dalam Progress Pengembangan</span>
      <div class=" w-full grid grid-cols-1 sm:grid-cols-2 gap-2">
        <div>
          <canvas id="grafik-siswa-id"></canvas>
        </div>
        <div>
          <canvas id="grafik-siswa"></canvas>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var data = @json($dataSiswa);
          var labels = [];
          var counts = [];

          data.forEach(function(item) {
            labels.push(item.madrasah_diniyah + ' - ' + item.jenis_kelamin);
            counts.push(item.total);
          });

          var ctx = document.getElementById('grafik-siswa').getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Jumlah Siswa',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true,
                  stepSize: 1
                }
              }
            }
          });
        });
      </script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var data = @json($dataSiswaMadin);
          var labels = [];
          var counts = [];

          data.forEach(function(item) {
            labels.push(item.madrasah_diniyah);
            counts.push(item.total);
          });

          var ctx = document.getElementById('grafik-siswa-id').getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Jumlah Siswa',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true,
                  stepSize: 1
                }
              }
            }
          });
        });
      </script>
    </div>
  </div>
</x-app-layout>