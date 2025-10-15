<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <div class="flex items-center space-x-4">
                <x-button :variant="'outline'">+ Tambah</x-button>
                <x-button :variant="'secondary'">Terbaru</x-button>
            </div>
        </div>
        <div class="mt-4">
            <x-table.table>
                <x-slot:head>
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Nama</x-table.th>
                    <x-table.th>Unit</x-table.th>
                    <x-table.th>Harga</x-table.th>
                    <x-table.th>Aksi</x-table.th>
                </x-slot:head>
                <x-slot:body>
                    <x-table.tr>
                        <x-table.td>1</x-table.td>
                        <x-table.td>Spanduk</x-table.td>
                        <x-table.td>m2</x-table.td>
                        <x-table.td>Rp 10.000</x-table.td>
                        <x-table.td>
                            <div class="flex space-x-2">
                                <x-button :variant="'primary'" size="sm">Edit</x-button>
                                <x-button :variant="'danger'" size="sm">Hapus</x-button>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td>2</x-table.td>
                        <x-table.td>Baju</x-table.td>
                        <x-table.td>pcs</x-table.td>
                        <x-table.td>Rp 80.000</x-table.td>
                        <x-table.td>
                            <div class="flex space-x-2">
                                <x-button :variant="'primary'" size="sm">Edit</x-button>
                                <x-button :variant="'danger'" size="sm">Hapus</x-button>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td>3</x-table.td>
                        <x-table.td>Gantungan Kunci</x-table.td>
                        <x-table.td>pcs</x-table.td>
                        <x-table.td>Rp 5.000</x-table.td>
                        <x-table.td>
                            <div class="flex space-x-2">
                                <x-button :variant="'primary'" size="sm">Edit</x-button>
                                <x-button :variant="'danger'" size="sm">Hapus</x-button>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                </x-slot:body>
            </x-table.table>
        </div>
    </div>
</x-layouts.dashboard>