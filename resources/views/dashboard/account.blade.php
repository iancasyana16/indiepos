<x-layouts.dashboard>
    <x-navbar />
    <x-toast />
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
                    @foreach($users as $user)
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
                                <x-button type="button" onclick="openModal('deleteModal')" :variant="'danger'" :size="'sm'">
                                    Hapus
                                </x-button>
                            </x-table.td>
                        </x-table.tr>
                        <x-modal id="deleteModal">
                            <div class="mt-6 flex justify-center space-x-2">
                                <x-button onclick="closeModal('deleteModal')" :variant="'secondary'">Batal</x-button>
                                <form action="{{ route('account.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-slot name="title">Hapus User</x-slot>
                                    <x-button type="submit" :variant="'danger'">Hapus</x-button>
                                </form>
                            </div>
                        </x-modal>
                    @endforeach
                </x-slot:body>
            </x-table.table>
            @if ($users->isEmpty())
                <x-noData>Data User Belum Ada</x-noData>
            @endif
        </div>
    </div>
</x-layouts.dashboard>