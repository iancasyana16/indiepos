<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <div class="flex items-center space-x-4">
                <x-button :as="'link'" :variant="'outline'" href="{{ route('account-add') }}">+ Tambah</x-button>
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
                    <!-- isi tabel bang -->
                </x-slot:body>
            </x-table.table>
            <!-- KETKA BELUM ADA DATA TAMPILKAN INI -->
            <x-noData>
                Data User Belum Ada
            </x-noData>
        </div>
    </div>
</x-layouts.dashboard>