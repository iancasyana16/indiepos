<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="text-lg font-semibold">Tambah Produk</div>
            <div class="mt-4">
                <form action="{{ route('product.store') }}" method="post">
                    @csrf
                    <x-label for="product_name" class="font-semibold">Nama Produk</x-label>
                    <x-input id="product_name" type="text" name="name" />
                    @error('product_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <x-label for="unit" class="font-semibold">Unit</x-label>
                            <x-select id="unit" :name="'unit'" :options="['pcs' => 'pcs', 'm2' => 'm2',  'cm2' => 'cm2']" />
                            @error('unit')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <x-label for="harga" class="font-semibold">Harga</x-label>
                            <x-input id="harga" type="number" name="price_unit" />
                            @error('price_unit')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <x-button :type="'submit'" :variant="'primary'">Add</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.dashboard>