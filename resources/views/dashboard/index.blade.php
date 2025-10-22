<x-layouts.dashboard>
    <x-navbar />

    <div class="p-6">
        <div class="flex justify-end mb-4">
            <form method="GET" action="{{ route('dashboard.index') }}">
                <select name="filter" onchange="this.form.submit()" class="border-gray-300 rounded-md">
                    <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                    <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                    <option value="year" {{ $filter == 'year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h3 class="text-gray-600 text-sm font-semibold">Pendapatan</h3>
                <p class="text-2xl font-bold text-green-600">
                    Rp {{ number_format($pendapatan, 0, ',', '.') }}
                </p>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-4">
                <h3 class="text-gray-600 text-sm font-semibold">Order Selesai</h3>
                <p class="text-2xl font-bold text-blue-600">{{ $order_selesai }}</p>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-4">
                <h3 class="text-gray-600 text-sm font-semibold">Order dalam Proses</h3>
                <p class="text-2xl font-bold text-yellow-500">{{ $order_proses }}</p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-gray-700 text-lg font-semibold mb-4">Statistik Penjualan Bulanan</h3>
            <div class="relative w-full" style="height: 350px;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        window.dashboardLabels = @json($tanggal_labels);
        window.dashboardPendapatan = @json($chart_pendapatan);
        window.dashboardOrder = @json($chart_order);
    </script>

    @vite('resources/js/chart.js')
</x-layouts.dashboard>
