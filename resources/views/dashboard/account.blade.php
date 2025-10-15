<x-layouts.dashboard>
    <x-navbar/>
    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <div class="flex items-center space-x-4">
                <x-button :variant="'outline'">+ Tambah</x-button>
            </div>
        </div>
        <div class="mt-4">
            <x-table.table>
                <x-slot:head>
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Role</x-table.th>
                    <x-table.th>Email</x-table.th>
                    <x-table.th>Nomor</x-table.th>
                    <x-table.th>Nama</x-table.th>
                    <x-table.th>Aksi</x-table.th>
                </x-slot:head>
                <x-slot:body>
                    <x-table.tr>
                        <x-table.td>USR001</x-table.td>
                        <x-table.td>Admin</x-table.td>
                        <x-table.td>iancasyana@gmail.com</x-table.td>
                        <x-table.td>083101497425</x-table.td>
                        <x-table.td>Casyana</x-table.td>
                        <x-table.td>
                            <div class="flex space-x-2">
                                <x-button :variant="'primary'" size="sm">Edit</x-button>
                                <x-button :variant="'danger'" size="sm">Hapus</x-button>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td>USR002</x-table.td>
                        <x-table.td>Desainer</x-table.td>
                        <x-table.td>ilham@gmail.com</x-table.td>
                        <x-table.td>083101497425</x-table.td>
                        <x-table.td>Ilham</x-table.td>
                        <x-table.td>
                            <div class="flex space-x-2">
                                <x-button :variant="'primary'" size="sm">Edit</x-button>
                                <x-button :variant="'danger'" size="sm">Hapus</x-button>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td>USR003</x-table.td>
                        <x-table.td>Kasir</x-table.td>
                        <x-table.td>farhan@gmail.com</x-table.td>
                        <x-table.td>083101497425</x-table.td>
                        <x-table.td>Farhan</x-table.td>
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