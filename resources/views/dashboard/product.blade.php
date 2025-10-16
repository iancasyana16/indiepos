<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <div class="flex items-center space-x-4">
                <x-button as="link" :variant="'outline'" href="{{ route('product.create') }}">+ Tambah</x-button>
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
                        <x-table.td>Rp {{ number_format($product->price_unit, 0, ',', '.') }}</x-table.td>
                        <x-table.td>
                            <x-button as="link" :variant="'primary'" :size="'sm'"
                                href="{{ route('product.edit', $product->id) }}">
                                Edit
                            </x-button>
                            <x-button type="submit" :variant="'danger'" :size="'sm'">
                                Hapus
                            </x-button>
                        </x-table.td>
                    </x-table.tr>
                    @empty
                    <x-noData>Data Produk Belum Ada</x-noData>
                    @endforelse
                </x-slot:body>
            </x-table.table>
        </div>
    </div>
</x-layouts.dashboard>