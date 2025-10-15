<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <div class="flex items-center space-x-4">
                <x-button as="link" :variant="'outline'" href="{{ route('product-add') }}">+ Tambah</x-button>
                <x-button :variant="'secondary'">Terbaru</x-button>
            </div>
        </div>
        <div class="mt-4">
            <x-table.table>
                <x-slot:head>
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Nama</x-table.th>
                    <x-table.th>Unit</x-table.th>
                    <x-table.th>Harga</x-table.th>
                    <x-table.th>Aksi</x-table.th>
                </x-slot:head>
                <x-slot:body>
                    <!-- isi tabel bang -->
                </x-slot:body>
            </x-table.table>
            <!-- KETIKA BELUM ADA DATA TAMPILKAN INI -->
            <x-noData>
                Data Produk Belum Ada
            </x-noData>
        </div>
    </div>
</x-layouts.dashboard>