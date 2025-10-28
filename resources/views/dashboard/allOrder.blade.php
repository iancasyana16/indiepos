<x-layouts.dashboard>
    <x-navbar />
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
                    <x-table.th>Nama Pesanan</x-table.th>
                    <x-table.th>Deskripsi</x-table.th>
                    <x-table.th>Panjang</x-table.th>
                    <x-table.th>Lebar</x-table.th>
                    <x-table.th>Qty</x-table.th>
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
                            <x-table.td>{{ $order->product->name }}</x-table.td>
                            <x-table.td>{{ $order->description }}</x-table.td>
                            <x-table.td>{{ $order->length }}</x-table.td>
                            <x-table.td>{{ $order->width }}</x-table.td>
                            <x-table.td>{{ $order->qty }}</x-table.td>
                            <x-table.td>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $orderColorClass }}">
                                    {{ Str::title($order->status) }}
                                </span>
                            </x-table.td>
                            <x-table.td>
                                <x-button :size="'sm'">Update</x-button>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </x-slot:body>
            </x-table.table>

            @if ($orders->isEmpty())
                <x-noData>Data Order Belum Ada</x-noData>
            @endif
        </div>
    </div>
</x-layouts.dashboard>