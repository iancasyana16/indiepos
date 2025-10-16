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
                @forelse($products as $product)
                <div class="bg-white shadow-lg flex justify-between rounded-lg items-center my-3 p-3">
                    <div class="flex justify-between items-center w-full">
                        <div class="font-semibold">{{ $product->name }}</div>
                        <div class="flex space-x-2 items-center">
                            <div class="font-semibold flex">
                                <p>Rp {{ $product->price_unit }}/</p>
                                <p>{{ $product->unit }}</p>
                            </div>
                            <form action="{{ route('order.add', $product->id) }}" method="POST">
                                @csrf
                                <x-button :type="'submit'" :variant="'primary'" :size="'sm'">+</x-button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
            <div class="bg-slate-600 shadow-lg rounded-lg p-5">
                <div class="bg-white rounded-md p-2">
                    <div class="font-semibold">New Order</div>
                    <div class="flex justify-between items-center">
                        <div class="font-semibold">Admin</div>
                        <x-button :variant="'danger'" :size="'sm'">
                            Hapus Semua
                        </x-button>
                    </div>
                </div>
                <div class="space-y-2">
                    @php
                    $cart = session('cart', []);
                    @endphp

                    @if (empty($cart))
                    <p>Belum ada produk yang mau dipesan</p>
                    @else
                    @foreach($cart as $id => $item)

                    <div class="px-3 mt-2 bg-white rounded-md space-y">
                        <div class="flex justify-between items-center">
                            <div class="font-semibold">{{ $item['name'] }}</div>
                            <div class="flex items-center space-x-2">
                                <x-button :variant="'primary'" :size="'sm'">-</x-button>
                                <div class="font-semibold">{{ $item['qty'] }}</div>
                                <x-button :variant="'primary'" :size="'sm'">+</x-button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="bg-white rounded-md p-3 mt-2">
                    <div class="font-semibold text-xs mb-3">Rincian</div>
                    <div class="flex justify-between items-center">
                        <div class="font-semibold text-xs mb-1">
                            <div class="Banner">Banner x10</div>
                            <div class="Banner">2mx2m</div>
                        </div>
                        <div class="font-semibold text-xs">Rp.100.000,00</div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="font-semibold text-xs mb-1">
                            <div class="Banner">Baju x10</div>
                            <div class="Banner">1pcs</div>
                        </div>
                        <div class="font-semibold text-xs">Rp.100.000,00</div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="font-semibold text-xs mb-1">
                            <div class="Banner">Ganci x10</div>
                            <div class="Banner">1pcs</div>
                        </div>
                        <div class="font-semibold text-xs">Rp.100.000,00</div>
                    </div>
                    <hr class="my-2">
                    <div class="flex font-bold text-lg mb-1">
                        <div>Total</div>
                        <div class="ml-auto">Rp.300.000,00</div>
                    </div>
                    <x-button :variant="'primary'" :size="'md'" class="w-full">
                        Create Order
                    </x-button>
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
                            <p class="font-semibold">{{ $item['name'] }} x{{ $item['qty'] }}</p>
                            <p class="text-sm text-gray-500">ukuran: 5mx5m</p>
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