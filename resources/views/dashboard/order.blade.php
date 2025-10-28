<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="grid grid-cols-2 gap-2">
            <div class="p-2">
                <input type="search" name="search" id="search" placeholder="Cari..."
                    class="border bg-white border-gray-400 rounded-md p-2 w-full mb-5">

                <div class="max-h-110 overflow-hidden bg-slate-600 px-3 rounded-xl hover:overflow-y-auto">
                    @forelse($products as $product)
                        <div class="bg-white shadow-lg flex justify-between rounded-lg items-center my-3 p-3">
                            <div class="flex justify-between items-center w-full">
                                <div class="font-semibold">{{ $product->name }}</div>
                                <div class="flex space-x-2 items-center">
                                    <div class="font-semibold flex">
                                        <p>Rp {{ $product->price_unit }}/</p>
                                        <p>{{ $product->unit }}</p>
                                    </div>

                                    <x-button :type="'button'" :variant="'primary'" :size="'sm'"
                                        onclick="openModal('modal-{{ $product->id }}')">+</x-button>

                                    <x-modal :id="'modal-' . $product->id" :title="'Tambah ' . $product->name">
                                        <form action="{{ route('order.add', $product->id) }}" method="POST"
                                            class="space-y-4">
                                            @csrf
                                            <div>
                                                @if ($product->unit === 'm2')
                                                    <label for="length" class="block font-medium mb-1">Panjang (cm)</label>
                                                    <input type="number" name="length" id="length"
                                                        class="w-full border border-gray-300 rounded-md p-2">

                                                    <label for="width" class="block font-medium mb-1">Lebar (cm)</label>
                                                    <input type="number" name="width" id="width"
                                                        class="w-full border border-gray-300 rounded-md p-2">

                                                    <label for="qty" class="block font-medium mb-1">Jumlah</label>
                                                    <input type="number" name="qty" id="qty" min="1"
                                                        class="w-full border border-gray-300 rounded-md p-2">

                                                    <label for="description" class="block font-medium mb-1">Deskripsi</label>
                                                    <input type="text" name="description" id="description"
                                                        class="w-full border border-gray-300 rounded-md p-2">
                                                @else
                                                    <label for="qty" class="block font-medium mb-1">Jumlah</label>
                                                    <input type="number" name="qty" id="qty" min="1"
                                                        class="w-full border border-gray-300 rounded-md p-2">
                                                @endif
                                            </div>

                                            <div class="flex justify-end space-x-2">
                                                <x-button :type="'button'" :variant="'secondary'" :size="'sm'"
                                                    onclick="closeModal('modal-{{ $product->id }}')">Batal</x-button>
                                                <x-button :type="'submit'" :variant="'primary'" :size="'sm'">
                                                    Tambah ke Keranjang
                                                </x-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </div>
                            </div>
                        </div>
                    @empty
                        <x-noData>Belum Ada Data Produk</x-noData>
                    @endforelse
                </div>
            </div>

            <div class="bg-slate-600 shadow-lg rounded-lg p-5">
                <div class="bg-white rounded-md p-2">
                    <div class="font-semibold">Pesanan Baru</div>
                    <div class="flex justify-between items-center">
                        <div class="font-semibold">Admin</div>
                        <form action="{{ route('order.cart.clear') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <x-button :type="'submit'" :variant="'danger'" :size="'sm'">
                                Hapus Semua
                            </x-button>
                        </form>
                    </div>
                </div>

                <div class="space-y-2">
                    @php
                        $cart = session('cart', []);
                    @endphp

                    @if (empty($cart))
                        <x-noData>Keranjang kosong</x-noData>
                    @else
                        @foreach($cart as $id => $item)
                            <div class="px-3 mt-2 bg-white rounded-md space-y">
                                <div class="flex justify-between items-center">
                                    <div class="font-semibold">{{ $item['name'] }}</div>
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('order.cart.decrement', $id) }}" method="post">
                                            @csrf
                                            <x-button type="submit" :variant="'primary'" :size="'sm'">-</x-button>
                                        </form>
                                        <div class="font-semibold">{{ $item['qty'] }}</div>
                                        <form action="{{ route('order.cart.increment', $id) }}" method="post">
                                            @csrf
                                            <x-button type="submit" :variant="'primary'" :size="'sm'">+</x-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="bg-white rounded-md p-3 mt-2">
                    <div class="font-semibold text-xs mb-3">Rincian</div>
                    @foreach ($cart as $id => $item)
                        <div class="flex justify-between items-center">
                            <div class="font-semibold text-xs mb-1">
                                <div class="Banner">{{ $item['name'] }} x {{ $item['qty'] }}</div>
                            </div>
                            <div class="font-semibold text-xs">
                                @if ($item['unit'] === 'm2')
                                    {{ number_format(($item['length'] * $item['width'] / 10000) * $item['price'] * $item['qty'], 0, ',', '.') }}
                                @else
                                    {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <hr class="my-2">
                    <div class="flex font-bold text-lg mb-1">
                        <div>Total</div>
                        <div class="ml-auto">Rp.
                            {{ number_format(collect($cart)->sum(function ($item) {
                                if ($item['unit'] === 'm2') {
                                    return ($item['length'] * $item['width'] / 10000) * $item['price'] * $item['qty'];
                                } else {
                                    return $item['price'] * $item['qty'];
                                }
                            }), 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <x-button :type="'button'" :variant="'primary'" :size="'md'" class="w-full"
                    onclick="openModal('orderModal')">
                    Buat Pesanan
                </x-button>

                <x-modal id="orderModal" title="Buat Pesanan">
                    <form action="{{ route('order.checkout') }}" method="post">
                        @csrf
                        @method('POST')

                        <label for="name" class="block font-medium mb-1">Nama</label>
                        <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-md p-2">

                        <label for="number" class="block font-medium mb-1">Nomor Telepon</label>
                        <input type="number" name="number" id="number"
                            class="w-full border border-gray-300 rounded-md p-2">

                        <label for="address" class="block font-medium mb-1">Alamat</label>
                        <input type="text" name="address" id="address"
                            class="w-full border border-gray-300 rounded-md p-2">

                        <label for="dp_total" class="block font-medium mb-1">Total Uang Muka (DP)</label>
                        <input type="text" name="dp_total" id="dp_total"
                            class="w-full border border-gray-300 rounded-md p-2">

                        <div class="mt-6 flex justify-end space-x-2">
                            <x-button onclick="closeModal('orderModal')" :variant="'secondary'">Batal</x-button>
                            <form action="{{ route('order.checkout') }}" method="POST">
                                @csrf
                                <x-button type="submit" :variant="'primary'">Konfirmasi</x-button>
                            </form>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>
    </div>
</x-layouts.dashboard>