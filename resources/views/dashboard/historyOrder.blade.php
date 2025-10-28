<x-layouts.dashboard>
    <x-navbar title="History Order"/>
    <x-toast />

    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <x-button :variant="'secondary'">Terbaru</x-button>
        </div>

        <div class="mt-4">
            <x-table.table>
                <x-slot:head>
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Nama</x-table.th>
                    <x-table.th>Total</x-table.th>
                    <x-table.th>Tanggal</x-table.th>
                    <x-table.th>Status</x-table.th>
                    <x-table.th>Aksi</x-table.th>
                </x-slot:head>

                <x-slot:body>
                    @foreach ($orders as $index => $order)
                        @php
                            $orderStatusColors = [
                                'selesai' => 'bg-green-100 text-green-700 border border-green-400',
                                'diproses' => 'bg-blue-100 text-blue-700 border border-blue-400',
                                'belum lunas' => 'bg-red-100 text-red-700 border border-red-400',
                            ];
                            $orderColorClass = $orderStatusColors[strtolower($order->status)] ?? 'bg-gray-100 text-gray-700';
                        @endphp

                        <x-table.tr>
                            <x-table.td>{{ $index + 1 }}</x-table.td>
                            <x-table.td>{{ $order->customer['name'] }}</x-table.td>
                            <x-table.td>{{ 'Rp.' . number_format($order->price_total, 0, ',', '.') }}</x-table.td>
                            <x-table.td>{{ $order->order_date }}</x-table.td>
                            <x-table.td>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $orderColorClass }}">
                                    {{ Str::title($order->status) }}
                                </span>
                            </x-table.td>
                            <x-table.td>
                                <div class="flex space-x-2 items-center">
                                    {{-- Tombol buka modal --}}
                                    <x-button size="sm" onclick="openModal('detailOrder{{ $order->id }}')">
                                        Detail
                                    </x-button>

                                    {{-- Modal Detail --}}
                                    <x-modal :id="'detailOrder' . $order->id" title="Detail Order">
                                        <div class="space-y-4 text-sm text-gray-700">
                                            {{-- Info Utama --}}
                                            <div
                                                class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex flex-wrap items-center justify-between gap-4">
                                                <p class="font-medium text-gray-800">
                                                    <span class="font-semibold">Nama:</span> {{ $order->customer['name'] }}
                                                </p>
                                                <p class="font-medium text-gray-800">
                                                    <span class="font-semibold">Total:</span>
                                                    <span class="text-green-600 font-semibold">
                                                        Rp{{ number_format($order->price_total, 0, ',', '.') }}
                                                    </span>
                                                </p>
                                                <p>
                                                    <span class="font-semibold">DP:</span>
                                                    Rp{{ number_format($order->dp_total, 0, ',', '.') }}
                                                </p>

                                                <p>
                                                    <span class="font-semibold">Pelunasan Saat Ini:</span>
                                                    Rp{{ number_format($order->remaining_payment ?? 0, 0, ',', '.') }}
                                                </p>
                                                <div class="mt-2 flex items-center gap-3">
                                                    <span class="font-semibold">Status:</span>
                                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $orderColorClass }}">
                                                        {{ Str::title($order->status) }}
                                                    </span>
                                                    @if(Auth::user()->role === 'kasir')
                                                        <form action="{{ route('kasir.order.update', $order->id) }}" method="POST" class="inline-flex items-center gap-2">
                                                            @csrf
                                                            @method('PUT')

                                                            <input 
                                                                type="number" 
                                                                name="remaining_payment" 
                                                                class="border border-gray-300 rounded px-2 py-1 text-xs w-28"
                                                                placeholder="Input Pelunasan (Rp)" 
                                                                min="0" required
                                                            >

                                                            <x-button type="submit" :variant="'primary'" :size="'sm'">
                                                                Simpan
                                                            </x-button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- Detail Item Pesanan --}}
                                            @if ($order->items->isNotEmpty())
                                                <div>
                                                    <h3 class="font-semibold text-gray-800 mb-2 border-b pb-1">Item Pesanan</h3>
                                                    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                                                        <x-table.table>
                                                            <x-slot:head
                                                                class="bg-gray-100 text-gray-800 uppercase text-xs font-semibold">
                                                                <x-table.th>Produk</x-table.th>
                                                                <x-table.th>Ukuran</x-table.th>
                                                                <x-table.th>Qty</x-table.th>
                                                                <x-table.th>Harga</x-table.th>
                                                                <x-table.th>Status</x-table.th>
                                                            </x-slot:head>
                                                            <x-slot:body>
                                                                @foreach ($order->items as $item)
                                                                    @php
                                                                        $itemStatusColors = [
                                                                            'selesai' => 'bg-green-200 text-green-800',
                                                                            'didesain' => 'bg-blue-200 text-blue-800',
                                                                            'menunggu desain' => 'bg-red-200 text-red-800',
                                                                        ];
                                                                        $itemColorClass = $itemStatusColors[strtolower($item->status)] ?? 'bg-gray-200 text-gray-800';
                                                                    @endphp
                                                                    <x-table.tr>
                                                                        <x-table.td
                                                                            class="px-4 py-2">{{ $item->product->name ?? '-' }}</x-table.td>
                                                                        <x-table.td class="px-4 py-2">{{ $item->length }} ×
                                                                            {{ $item->width }}</x-table.td>
                                                                        <x-table.td class="px-4 py-2">{{ $item->qty }}</x-table.td>
                                                                        <x-table.td class="px-4 py-2">
                                                                            Rp{{ number_format($item->price, 0, ',', '.') }}
                                                                        </x-table.td>
                                                                        <x-table.td class="px-4 py-2">
                                                                            @if(Auth::user()->role === 'desainer')
                                                                                <form action="{{ route('desainer.order-item.update', $item->id) }}" method="POST" class="flex items-center gap-1">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <select name="status" class="border border-gray-300 rounded px-2 py-1 text-sm">
                                                                                        <option value="menunggu desain" {{ $item->status === 'menunggu desain' ? 'selected' : '' }}>Menunggu Desain</option>
                                                                                        <option value="didesain" {{ $item->status === 'didesain' ? 'selected' : '' }}>Didesain</option>
                                                                                        <option value="selesai" {{ $item->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                                                    </select>
                                                                                    <x-button type="submit" :variant="'primary'" :size="'sm'">Ubah</x-button>
                                                                                </form>
                                                                            @else
                                                                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $itemColorClass }}">
                                                                                    {{ Str::title($item->status) }}
                                                                                </span>
                                                                            @endif
                                                                        </x-table.td>
                                                                    </x-table.tr>
                                                                @endforeach
                                                            </x-slot:body>
                                                        </x-table.table>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="mt-3 text-gray-500 italic text-center">
                                                    Tidak ada item untuk order ini.
                                                </p>
                                            @endif
                                        </div>

                                        {{-- Footer Modal --}}
                                        <div class="mt-6 text-right">
                                            <x-button onclick="closeModal('detailOrder{{ $order->id }}')"
                                                variant="secondary">
                                                Tutup
                                            </x-button>
                                        </div>
                                    </x-modal>
                                </div>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </x-slot:body>
            </x-table.table>

            @if ($orders->isEmpty())
                <x-noData>Data Riwayat Order Belum Ada</x-noData>
            @endif
        </div>
    </div>
</x-layouts.dashboard>