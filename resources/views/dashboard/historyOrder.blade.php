<x-layouts.dashboard>
    <x-navbar title="istory Order"/>
    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <x-button :variant="'secondary'">Terbaru</x-button>
        </div>
        <div class="mt-4">
            @if($orders->isEmpty())
                <x-noData>Data Riwayat Order Belum Ada</x-noData>
            @else
                <x-table.table>
                    <x-slot:head>
                        <x-table.th class="w-10">#</x-table.th>
                        <x-table.th>Nama</x-table.th>
                        <x-table.th>No. HP</x-table.th>
                        <x-table.th>Total</x-table.th>
                        <x-table.th>Tanggal</x-table.th>
                        <x-table.th>Status</x-table.th>
                        <x-table.th>Aksi</x-table.th>
                    </x-slot:head>

                    <x-slot:body>
                        @foreach ($orders as $order)
                            <x-table.tr>
                                <x-table.td>{{ $loop->iteration }}</x-table.td>
                                <x-table.td>{{ $order->customer->name }}</x-table.td>
                                <x-table.td>{{ $order->customer->number ?? '-' }}</x-table.td>
                                <x-table.td>Rp {{ number_format($order->price_total, 0, ',', '.') }}</x-table.td>
                                <x-table.td>{{ $order->order_date }}</x-table.td>
                                <x-table.td>
                                    @if ($order->status === 'dipesan')
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                            Dipesan
                                        </span>
                                    @elseif ($order->status === 'selesai')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </x-table.td>
                                <x-table.td>
                                    <x-button class="text-blue-600 text-sm">
                                        Ubah Status
                                    </x-button>
                                </x-table.td>
                            </x-table.tr>
                        @endforeach
                    </x-slot:body>
                </x-table.table>
            @endif
        </div>
    </div>
</x-layouts.dashboard>