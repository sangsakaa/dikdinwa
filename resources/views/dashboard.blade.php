<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black" class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>Star on Github</span>
            </x-button>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div>
            <div class=" bg-white   ">
                <span>Dalam Progress Pengembangan</span>
                <div class=" w-full grid grid-cols-1 sm:grid-cols-2 gap-2 ">
                    <div>
                        <canvas id="grafik-siswa-id"></canvas>
                    </div>
                    <div>
                        <canvas id="grafik-siswa"></canvas>
                    </div>
                    <div>
                        <canvas id="barChart"></canvas>
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
                <script>
                    var data = @json($rekapHarian); // Mengambil data dari Blade

                    var jenjang = data.map(function(item) {
                        return item.jenjang;
                    });

                    var jumlahSakit = data.map(function(item) {
                        return item.jumlah_sakit;
                    });

                    var jumlahIzin = data.map(function(item) {
                        return item.jumlah_izin;
                    });

                    var jumlahAlfa = data.map(function(item) {
                        return item.jumlah_alfa;
                    });

                    var ctx = document.getElementById('barChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: jenjang,
                            datasets: [{
                                label: ' Sakit',
                                data: jumlahSakit,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang batang
                                borderColor: 'rgba(75, 192, 192, 1)', // Warna batang
                                borderWidth: 1
                            }, {
                                label: ' Izin',
                                data: jumlahIzin,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna latar belakang batang
                                borderColor: 'rgba(255, 99, 132, 1)', // Warna batang
                                borderWidth: 1
                            }, {
                                label: ' Alfa',
                                data: jumlahAlfa,
                                backgroundColor: 'rgba(255, 206, 86, 0.2)', // Warna latar belakang batang
                                borderColor: 'rgba(255, 206, 86, 1)', // Warna batang
                                borderWidth: 1
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