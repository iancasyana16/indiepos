<x-layouts.dashboard>
    <x-navbar />

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <!-- Pendapatan -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h3 class="text-gray-600 text-sm font-semibold">Pendapatan</h3>
                <p class="text-2xl font-bold text-green-600">Rp 12.500.000</p>
            </div>

            <!-- Order Selesai -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h3 class="text-gray-600 text-sm font-semibold">Order Selesai</h3>
                <p class="text-2xl font-bold text-blue-600">128</p>
            </div>

            <!-- Order dalam Proses (Opsional) -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h3 class="text-gray-600 text-sm font-semibold">Order dalam Proses</h3>
                <p class="text-2xl font-bold text-yellow-500">32</p>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-gray-700 text-lg font-semibold mb-4">Statistik Penjualan Bulanan</h3>
            <canvas id="salesChart" height="100"></canvas>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt'],
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: [1200000, 1500000, 1000000, 2000000, 1800000, 2200000, 2500000, 2400000, 2600000, 2750000],
                        backgroundColor: 'rgba(34, 197, 94, 0.2)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
</x-layouts.dashboard>