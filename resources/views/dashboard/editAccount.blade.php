<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="text-lg font-semibold">Edit Akun</div>
            <div class="mt-4">
                <form action="{{ route('account.update', $account) }}" method="post">
                    @csrf
                    @method('put')
                    <x-label for="nama" class="font-semibold">Nama</x-label>
                    <x-input id="nama" type="text" name="name" value="{{ old('name', $account->name) }}" />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <x-label for="email" class="font-semibold">Email</x-label>
                    <x-input id="email" type="email" name="email" value="{{ old('email', $account->email) }}" />
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <x-label for="role" class="font-semibold">Role</x-label>
                            <x-select id="role" name="role" :options="['admin' => 'admin', 'desainer' => 'desainer', 'kasir' => 'kasir']" :value="old('role', $account->role)" />
                            @error('role')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <x-label for="nomorHp" class="font-semibold">Nomor HP</x-label>
                            <x-input id="nomorHp" type="tel" name="number"
                                value="{{ old('number', $account->number) }}" />
                            @error('number')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-1">
                            <x-button :type="'button'" :variant="'secondary'"
                                onclick="openModal('resetPasswordModal')">Reset Kata Sandi</x-button>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <x-button type="button" onclick="openModal('deleteModal')" :variant="'danger'"
                                :size="'sm'">Hapus</x-button>
                            <x-button :type="'submit'" :variant="'primary'">Simpan</x-button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <x-modal id="deleteModal">
        <div class="mt-6 flex justify-center space-x-2">
            <x-button onclick="closeModal('deleteModal')" :variant="'secondary'">Batal</x-button>
            <form action="{{ route('account.destroy', $account->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-slot name="title">Hapus User</x-slot>
                <x-button type="submit" :variant="'danger'">Hapus</x-button>
            </form>
        </div>
    </x-modal>
    <x-modal id="resetPasswordModal">
        <div class="mt-6 flex justify-center space-x-2">
            <x-button onclick="closeModal('resetPasswordModal')" :variant="'secondary'">Batal</x-button>
            <form action="{{ route('account.reset-password', $account->id) }}" method="POST">
                @csrf
                <x-slot name="title">Reset Kata Sandi</x-slot>
                <x-button type="submit" :variant="'danger'">Reset</x-button>
            </form>
        </div>
    </x-modal>
</x-layouts.dashboard>