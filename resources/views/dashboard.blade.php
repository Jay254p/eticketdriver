<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">User Statistics</h3>
                        <ul class="mt-2">
                            <li>Total Offences: {{ $totalOffences }}</li>
                            <li>Total Receipts: {{ $totalReceipts }}</li>
                        </ul>
                    </div>

                    <!-- Bar Chart: Number of Offences by Type -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold">Number of Offences by Type</h3>
                        <canvas id="offencesChart" width="400" height="200"></canvas>
                    </div>

                    <!-- Line Chart: Number of Receipts by Month -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold">Number of Receipts by Month</h3>
                        <canvas id="receiptsChart" width="400" height="200"></canvas>
                    </div>
                </div>
                <div>
                    <!-- ... Other content and links ... -->
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script to initialize and render the charts -->
    <script>
        // Offences Chart
        var offencesChart = new Chart(document.getElementById('offencesChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($offencesByType->pluck('offence_type')) !!},
                datasets: [{
                    label: 'Number of Offences',
                    data: {!! json_encode($offencesByType->pluck('total')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false,
                },
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45,
                        }
                    },
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                    }
                }
            }
        });

        // Receipts Chart
        var receiptsChart = new Chart(document.getElementById('receiptsChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($receiptsByMonth->pluck('month')) !!},
                datasets: [{
                    label: 'Number of Receipts',
                    data: {!! json_encode($receiptsByMonth->pluck('total')) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false,
                },
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45,
                        }
                    },
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                    }
                }
            }
        });
    </script>
</x-app-layout>
