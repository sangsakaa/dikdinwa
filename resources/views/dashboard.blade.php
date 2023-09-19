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

                <div class=" w-full grid grid-cols-1 sm:grid-cols-1 gap-2 ">
                    <div class=" grid grid-cols-1 sm:grid-cols-2">
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Grafik Jenjang</h2>
                            <canvas id="grafik-siswa-id"></canvas>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Grafik Jenis Kelamin</h2>
                            <canvas id="grafik-siswa"></canvas>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Grafik Rekapitulasi Harian</h2>
                        <label for="jenjangFilter">Pilih Jenjang:</label>
                        <select id="jenjangFilter" class="py-1 text-sm">
                            <option value="Semua">Semua</option>
                            <option value="Ula">01 - Ula</option>
                            <option value="Wustho">02 - Wustho</option>
                            <option value="Ulya">03 - Ulya</option>
                            <!-- Tambahkan opsi untuk jenjang lainnya sesuai kebutuhan -->
                        </select>
                        <script>
                            // Menangkap elemen dropdown jenjang
                            var jenjangFilter = document.getElementById('jenjangFilter');

                            // Menambahkan event listener untuk menangani perubahan dalam filter jenjang
                            jenjangFilter.addEventListener('change', function() {
                                var selectedJenjang = jenjangFilter.value;

                                // Filter data berdasarkan jenjang yang dipilih
                                var filteredData = data.filter(function(item) {
                                    return selectedJenjang === 'Semua' || item.jenjang === selectedJenjang;
                                });

                                // Update grafik dengan data yang telah difilter
                                myChart.data.labels = filteredData.map(function(item) {
                                    return item.tgl + ' ' + item.jenjang;
                                });
                                myChart.data.datasets[0].data = filteredData.map(function(item) {
                                    return item.jumlah_sakit;
                                });
                                myChart.data.datasets[1].data = filteredData.map(function(item) {
                                    return item.jumlah_izin;
                                });
                                myChart.data.datasets[2].data = filteredData.map(function(item) {
                                    return item.jumlah_alfa;
                                });

                                // Memperbarui grafik
                                myChart.update();
                            });
                        </script>
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
                    var data = <?php echo json_encode($rekapHarian); ?>;
                    // @json($rekapHarian); // Mengambil data dari Blade

                    var jenjang = data.map(function(item) {
                        return item.tgl + ' ' + item.jenjang;
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
                        type: 'line',
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
                                backgroundColor: 'rgba(255, 206, 86, 0.2)', // Warna latar belakang batang
                                borderColor: 'rgba(255, 206, 86, 1)', // Warna batang
                                borderWidth: 1
                            }, {
                                label: ' Alfa',
                                data: jumlahAlfa,

                                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna latar belakang batang
                                borderColor: 'rgba(255, 99, 132, 1)', // Warna batang
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
            <div>

                <script>
                    var jenjangFilter = document.getElementById('jenjangFilter');
                    jenjangFilter.addEventListener('change', function() {
                        var selectedJenjang = jenjangFilter.value;
                        var filteredLabels = [];
                        var filteredJumlahSakit = [];
                        var filteredJumlahIzin = [];
                        var filteredJumlahAlfa = [];

                        if (selectedJenjang === 'Semua') {
                            // Jika pengguna memilih "Semua", tampilkan semua data
                            filteredLabels = labels;
                            filteredJumlahSakit = jumlahSakit;
                            filteredJumlahIzin = jumlahIzin;
                            filteredJumlahAlfa = jumlahAlfa;
                        } else {
                            // Filter data berdasarkan jenjang yang dipilih
                            rekapBulanData.forEach(function(item) {
                                if (item.jenjang === selectedJenjang) {
                                    filteredLabels.push(item.jenjang + ' - ' + item.tahun + '-' + item.bulan);
                                    filteredJumlahSakit.push(item.jumlah_sakit);
                                    filteredJumlahIzin.push(item.jumlah_izin);
                                    filteredJumlahAlfa.push(item.jumlah_alfa);
                                }
                            });
                        }

                        // Perbarui grafik dengan data yang sudah difilter
                        chart.data.labels = filteredLabels;
                        chart.data.datasets[0].data = filteredJumlahSakit;
                        chart.data.datasets[1].data = filteredJumlahIzin;
                        chart.data.datasets[2].data = filteredJumlahAlfa;
                        chart.update();
                    });
                </script>

                <h2 id="bulan" class="text-xl font-semibold mb-4">Grafik Rekap Bulanan</h2>
                <div class="flex flex-col space-y-4">
                    <canvas id="rekapBulan"></canvas>
                    <script>
                        var rekapBulanData = <?php echo json_encode($rekapBulan); ?>;
                        var labels = [];
                        var jumlahSakit = [];
                        var jumlahIzin = [];
                        var jumlahAlfa = [];

                        // Mengambil data dari PHP dan mempersiapkan data untuk grafik
                        rekapBulanData.forEach(function(item) {
                            labels.push(item.jenjang + ' - ' + item.tahun + '-' + item.bulan);
                            jumlahSakit.push(item.jumlah_sakit);
                            jumlahIzin.push(item.jumlah_izin);
                            jumlahAlfa.push(item.jumlah_alfa);
                        });

                        var ctx = document.getElementById('rekapBulan').getContext('2d');

                        var chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Jumlah Sakit',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    data: jumlahSakit
                                }, {
                                    label: 'Jumlah Izin',
                                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                                    borderColor: 'rgba(255, 159, 64, 1)',
                                    borderWidth: 1,
                                    data: jumlahIzin
                                }, {
                                    label: 'Jumlah Alfa',

                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1,
                                    data: jumlahAlfa
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
        </div>
</x-app-layout>