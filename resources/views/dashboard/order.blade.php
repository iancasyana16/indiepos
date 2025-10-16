<x-layouts.dashboard>
    <div class="bg-white shadow-lg h-15 justify-between flex items-center p-4">
        <h2 class="font-bold text-gray-800">Dashboard</h2>
        <div class="flex items-center space-x-4">
            <h2 class="font-bold text-gray-800">Hi, Admin</h2>
            <img src="https://ui-avatars.com/api/?name=Indie+User&background=4F46E5&color=fff&size=128" alt="Avatar"
                class="w-10 h-10 rounded-full">
        </div>
    </div>
    <div class="p-4">
        <div class="grid grid-cols-2 gap-2">
            <div class="p-2">
                <input type="search" name="search" id="search" placeholder="Search..."
                    class="border bg-white border-gray-400 rounded-md p-2 w-full">
                <div class="flex space-x-4 mt-2">
                    <x-button :variant="'secondary'">Jenis Bahan 1</x-button>
                    <x-button :variant="'secondary'">Jenis Bahan 1</x-button>
                    <x-button :variant="'secondary'">Jenis Bahan 1</x-button>
                </div>
                @forelse($products as $product)
                <div class="bg-white shadow-lg flex justify-between rounded items-center my-3 p-3">
                    <div class="space-y-1">
                        <p>{{ $product->name }}</p>
                        <p>{{ $product->unit }}</p>
                    </div>
                    <div class="text-right">
                        <p>Rp {{ number_format($product->price_unit, 0, ',', '.') }}</p>
                        <form action="{{ route('order.add', $product) }}" method="POST">
                            @csrf
                            <x-button :variant="'primary'" size="sm">Tambah</x-button>
                        </form>
                    </div>
                </div>

                @empty
                <p>Produk kosong</p>
                @endforelse
            </div>
            <div class="bg-white shadow-lg rounded-lg p-5">
                <p>New Order</p>
                <div class="flex justify-between items-center">
                    <p>Admin</p>
                    <a href="" class="text-red-500">Hapus Semua</a>
                </div>

                <div class="bg-white shadow-lg rounded-lg p-5">
                    <p class="font-bold text-lg mb-2">Keranjang Pesanan</p>
                    @php
                    $cart = session('cart', []);
                    @endphp

                    @if (empty($cart))
                    <p class="text-gray-500">Keranjang kosong</p>
                    @else
                    @foreach ($cart as $id => $item)
                    <div class="bg-gray-50 shadow-sm flex justify-between rounded items-center my-2 p-3">
                        <div>
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item['qty'] }}</p>
                        </div>
                    </div>
                    @endforeach

                    <div class="border-t mt-3 pt-2 text-right font-bold">
                        Total: Rp {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['qty']), 0, ',', '.')
                        }}
                    </div>
                    
                    <x-button :variant="'primary'" size="sm" class="w-full">Checkout</x-button>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-layouts.dashboard>