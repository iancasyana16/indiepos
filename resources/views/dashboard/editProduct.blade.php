<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="text-lg font-semibold">Edit Produk</div>
        <div class="mt-4 bg-white p-4 rounded-lg shadow-lg">
            <x-label for="product_name" class="font-semibold">Nama Produk</x-label>
            <x-label for="product_name">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit minima
                ullam aut saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
            <x-input id="product_name" type="text" name="product_name" />
            <div class="flex gap-3">
                <div>
                    <x-label for="harga" class="font-semibold">Harga</x-label>
                    <x-label for="harga">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit minima
                        ullam aut
                        saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
                    <x-input id="harga" type="text" name="harga" />
                </div>
                <div>
                    <x-label for="unit" class="font-semibold">Unit</x-label>
                    <x-label for="unit">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit
                        minima ullam aut
                        saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
                    <x-input id="unit" type="text" name="unit" />
                </div>
            </div>
            <div class="flex justify-end space-x-2">
                <x-button :variant="'danger'">Delete</x-button>
                <x-button :variant="'primary'">Save</x-button>
            </div>
        </div>
    </div>
</x-layouts.dashboard>