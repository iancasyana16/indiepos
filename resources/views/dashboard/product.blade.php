<x-layouts.dashboard>
    <x-navbar />
    <x-toast />
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center">
            <x-search />
            <div class="flex items-center justify-end gap-2">
                <x-button as="link" :variant="'outline'" href="{{ route('product.create') }}">+ Tambah</x-button>
                <x-filter :options="['terbaru' => 'Terbaru', 'terlama' => 'Terlama']" />
            </div>
        </div>
        <div class="mt-4">
            <x-table.table>
                <x-slot:head>
                    <x-table.th>#</x-table.th>
                    <x-table.th>Nama</x-table.th>
                    <x-table.th>Unit</x-table.th>
                    <x-table.th>Harga</x-table.th>
                    <x-table.th>Aksi</x-table.th>
                </x-slot:head>
                <x-slot:body>
                    @foreach($products as $index => $product)
                        <x-table.tr>
                            <x-table.td>{{ $index + 1 }}</x-table.td>
                            <x-table.td>{{ $product->name }}</x-table.td>
                            <x-table.td>{{ $product->unit }}</x-table.td>
                            <x-table.td>Rp {{ number_format($product->price_unit, 0, ',', '.') }}</x-table.td>
                            <x-table.td>
                                <x-button as="link" :variant="'primary'" :size="'sm'"
                                    href="{{ route('product.edit', $product->id) }}">
                                    Edit
                                </x-button>
                                <x-button type="button" :variant="'danger'" :size="'sm'" onclick="openModal('deleteModal')">
                                    Hapus
                                </x-button>
                            </x-table.td>
                        </x-table.tr>
                        <x-modal id="deleteModal">
                            <div class="mt-6 flex justify-center space-x-2">
                                <x-button onclick="closeModal('deleteModal')" :variant="'secondary'">Batal</x-button>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-slot name="title">Konfirmasi Hapus</x-slot>
                                    <x-button type="submit" :variant="'danger'">Hapus</x-button>
                                </form>
                            </div>
                        </x-modal>
                    @endforeach
                </x-slot:body>
            </x-table.table>
            @if ($products->isEmpty())
                <x-noData>Data Produk Belum Ada</x-noData>
            @endif
            <div class="justify-end mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-layouts.dashboard>