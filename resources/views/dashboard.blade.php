<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @section('title', ' | Dashboard' )
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <a href="/syn" class=" bg-red-600 px-4 py-1 hover:text-red-600 hover:bg-teal-300 text-center text-white font-semibold">
        Syn
    </a>
    <div class=" grid grid-cols-1 sm:grid-cols-2 px-6 w-full bg-white">
        <!-- Required chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Chart bar -->
        <div class="p-4">
            <div class=" px-2 font-semibold ">
                <canvas id="jenis_kelamin" class=" font-semibold"></canvas>
                <script>
                    var ctx = document.getElementById('jenis_kelamin').getContext('2d');
                    var studentsChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                                'L',
                                'P'
                            ],
                            datasets: [{
                                label: 'BERDASARKAN JENIS',
                                data: [
                                    <?php echo json_encode($countLakiLaki); ?>,
                                    <?php echo json_encode($countPerempuan); ?>
                                ],
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255,99, 132, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 1

                            }]

                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>

            </div>

        </div>
        <div class="p-4">
            <div class=" px-2 font-semibold ">
                <canvas id="jenjang" class=" font-semibold"></canvas>
                <script>
                    var ctx = document.getElementById('jenjang').getContext('2d');
                    var studentsChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['ULA', 'WUSTHO'],
                            datasets: [{
                                label: 'BERDASARKAN JENJANG',
                                data: [
                                    <?php echo json_encode($Ula); ?>,
                                    <?php echo json_encode($Wustho); ?>
                                ],
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255,99, 132, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 1

                            }]

                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>

            </div>

        </div>


    </div>
</x-app-layout>