<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <div class="flex items-center space-x-4">
                <x-button :variant="'outline'">+ Tambah</x-button>
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
                    @forelse($products as $product)

                    <x-table.tr>
                        <x-table.td>{{ $product->id }}</x-table.td>
                        <x-table.td>{{ $product->name }}</x-table.td>
                        <x-table.td>{{ $product->unit }}</x-table.td>
                        <x-table.td>Rp {{ $product->price_unit }}</x-table.td>
                        <x-table.td>
                            <div class="flex space-x-2">
                                <x-button :variant="'primary'" size="sm">Edit</x-button>
                                <x-button :variant="'danger'" size="sm">Hapus</x-button>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                    @empty

                    <x-table.tr>
                        <x-table.td>Produk tidak ditemukan</x-table.td>
                    </x-table.tr>

                    @endforelse
                </x-slot:body>
            </x-table.table>
        </div>
    </div>
</x-layouts.dashboard>