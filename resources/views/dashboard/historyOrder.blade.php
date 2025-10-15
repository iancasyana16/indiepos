<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <x-button :variant="'secondary'">Terbaru</x-button>
        </div>
        <div class="mt-4">
            <x-table.table>
                <x-slot name="head">
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Nama</x-table.th>
                    <x-table.th>Detail</x-table.th>
                    <x-table.th>Total</x-table.th>
                    <x-table.th>Tanggal</x-table.th>
                    <x-table.th>Status</x-table.th>
                </x-slot>
                <x-slot name="body">
                    <x-table.tr>
                        <x-table.td>TRX00211</x-table.td>
                        <x-table.td>Parhan</x-table.td>
                        <x-table.td>Banner 2x1</x-table.td>
                        <x-table.td>Rp25.000</x-table.td>
                        <x-table.td>20-06-2024</x-table.td>
                        <x-table.td>
                            <span class="px-3 inline-flex leading-5 font-semibold text-xs rounded-full bg-green-100 text-green-800">
                                order
                            </span>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td>TRX00211</x-table.td>
                        <x-table.td>Parhan</x-table.td>
                        <x-table.td>Banner 2x1</x-table.td>
                        <x-table.td>Rp25.000</x-table.td>
                        <x-table.td>20-06-2024</x-table.td>
                        <x-table.td>
                            <span class="px-3 inline-flex leading-5 font-semibold text-xs rounded-full bg-green-100 text-green-800">
                                order
                            </span>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td>TRX00211</x-table.td>
                        <x-table.td>Parhan</x-table.td>
                        <x-table.td>Banner 2x1</x-table.td>
                        <x-table.td>Rp25.000</x-table.td>
                        <x-table.td>20-06-2024</x-table.td>
                        <x-table.td>
                            <span class="px-3 inline-flex leading-5 font-semibold text-xs rounded-full bg-green-100 text-green-800">
                                order
                            </span>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td>TRX00211</x-table.td>
                        <x-table.td>Parhan</x-table.td>
                        <x-table.td>Banner 2x1</x-table.td>
                        <x-table.td>Rp25.000</x-table.td>
                        <x-table.td>20-06-2024</x-table.td>
                        <x-table.td>
                            <span class="px-3 inline-flex leading-5 font-semibold text-xs rounded-full bg-green-100 text-green-800">
                                order
                            </span>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td>TRX00211</x-table.td>
                        <x-table.td>Parhan</x-table.td>
                        <x-table.td>Banner 2x1</x-table.td>
                        <x-table.td>Rp25.000</x-table.td>
                        <x-table.td>20-06-2024</x-table.td>
                        <x-table.td>
                            <span class="px-3 inline-flex leading-5 font-semibold text-xs rounded-full bg-green-100 text-green-800">
                                order
                            </span>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td>TRX00211</x-table.td>
                        <x-table.td>Parhan</x-table.td>
                        <x-table.td>Banner 2x1</x-table.td>
                        <x-table.td>Rp25.000</x-table.td>
                        <x-table.td>20-06-2024</x-table.td>
                        <x-table.td>
                            <span class="px-3 inline-flex leading-5 font-semibold text-xs rounded-full bg-green-100 text-green-800">
                                order
                            </span>
                        </x-table.td>
                    </x-table.tr>
                </x-slot>
            </x-table.table>
        </div>
    </div>
</x-layouts.dashboard>