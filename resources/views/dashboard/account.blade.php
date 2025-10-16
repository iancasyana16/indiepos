<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="flex justify-between items-center">
            <x-search />
            <div class="flex items-center space-x-4">
                <x-button :as="'link'" :variant="'outline'" href="{{ route('account.create') }}">+ Tambah</x-button>
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
                    @forelse($users as $user)

                    <x-table.tr>
                        <x-table.td>{{ $user->id }}</x-table.td>
                        <x-table.td>{{ $user->role }}</x-table.td>
                        <x-table.td>{{ $user->email }}</x-table.td>
                        <x-table.td>{{ $user->number }}</x-table.td>
                        <x-table.td>{{ $user->name }}</x-table.td>
                        <x-table.td>
                            <x-button as="link" :variant="'primary'" :size="'sm'"
                                href="{{ route('account.edit', $user->id) }}">
                                Edit
                            </x-button>
                            <x-button type="submit" :variant="'danger'" :size="'sm'">
                                Hapus
                            </x-button>
                        </x-table.td>
                    </x-table.tr>
                    @empty
                    <!-- KETKA BELUM ADA DATA TAMPILKAN INI -->
                    <x-noData>
                        Data User Belum Ada
                    </x-noData>
                    @endforelse
                </x-slot:body>
            </x-table.table>
        </div>
    </div>
</x-layouts.dashboard>