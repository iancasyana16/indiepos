<x-layouts.dashboard>
    <x-navbar />
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
                </x-slot:head>
                <x-slot:body>
                    @foreach ($orders as $index => $order )
                    <x-table.tr>
                        <x-table.td>{{ $index + 1 }}</x-table.td>
                        <x-table.td>{{ $order->customer['name'] }}</x-table.td>
                        <x-table.td>{{ $order->price_total }}</x-table.td>
                        <x-table.td>{{ $order->created_at }}</x-table.td>
                        <x-table.td>{{ $order->status }}</x-table.td>
                    </x-table.tr>
                    @endforeach
                </x-slot:body>
            </x-table.table>
            @if ($orders->isEmpty())
            <x-noData>
                Data Riwayat Order Belum Ada
            </x-noData>
            @endif
        </div>
    </div>
</x-layouts.dashboard>