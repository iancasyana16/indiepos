<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="grid grid-cols-2 gap-2">
            <div class="p-2">
                <input type="search" name="search" id="search" placeholder="Search..."
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
                                    <form action="{{ route('order.add', $product->id) }}" method="POST">
                                        @csrf
                                        <x-button :type="'submit'" :variant="'primary'" :size="'sm'">+</x-button>
                                    </form>
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
                        <x-noData>Keranjang kosong</x-noData>
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
                    @foreach ($cart as $id => $item)
                        <div class="flex justify-between items-center">
                            <div class="font-semibold text-xs mb-1">
                                <div class="Banner">{{ $item['name'] }} x {{ $item['qty'] }}</div>
                                <div class="Banner">2mx2m</div>
                            </div>
                            <div class="font-semibold text-xs">
                                {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                    <hr class="my-2">
                    <div class="flex font-bold text-lg mb-1">
                        <div>Total</div>
                        <div class="ml-auto">Rp.
                            {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['qty']), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                <x-button :variant="'primary'" :size="'md'" class="w-full">
                    Create Order
                </x-button>
            </div>
        </div>
    </div>
    </div>
</x-layouts.dashboard>