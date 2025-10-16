<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <x-button :variant="'secondary'">Terbaru</x-button>
        </div>
        <div class="mt-4">
            <x-table.table>
                <x-slot:head>
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Nama</x-table.th>
                    <x-table.th>Detail</x-table.th>
                    <x-table.th>Total</x-table.th>
                    <x-table.th>Tanggal</x-table.th>
                    <x-table.th>Status</x-table.th>
                </x-slot:head>
                <x-slot:body>
                    <!-- isi tabel bang -->
                </x-slot:body>
            </x-table.table>
            <!-- KETIKA BELUM ADA DATA TAMPILKAN INI -->
            <x-noData>
                Data Riwayat Order Belum Ada
            </x-noData>
        </div>
    </div>
</x-layouts.dashboard>