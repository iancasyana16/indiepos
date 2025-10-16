<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="text-lg font-semibold">Edit Produk</div>
            <div class="mt-4">
                <form action="{{ route('product.update', $product->id) }}" method="post">
                    @csrf
                    @method('put')
                    <x-label for="product_name" class="font-semibold">Nama Produk</x-label>
                    <x-input id="product_name" type="text" name="name" value="{{ old('name', $product->name) }}" />
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <x-label for="harga" class="font-semibold">Harga</x-label>
                            <x-input id="harga" type="number" name="price_unit" value="{{ old('price_unit', $product->price_unit) }}" />
                        </div>
                        <div>
                            <x-label for="unit" class="font-semibold">Unit</x-label>
                            <x-input id="unit" type="text" name="unit" value="{{ old('unit', $product->unit) }}" />
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <x-button :variant="'danger'">Delete</x-button>
                        <x-button :type="'submit'" :variant="'primary'">Save</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.dashboard>