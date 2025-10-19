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
                    <x-label for="email" class="font-semibold">Email</x-label>
                    <x-input id="email" type="email" name="email" value="{{ old('email', $account->email) }}" />
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <x-label for="role" class="font-semibold">Role</x-label>
                            <x-input id="role" type="text" name="role" value="{{ old('role', $account->role) }}" />
                        </div>
                        <div>
                            <x-label for="nomorHp" class="font-semibold">Nomor HP</x-label>
                            <x-input id="nomorHp" type="tel" name="number"
                                value="{{ old('number', $account->number) }}" />
                        </div>
                    </div>
                    <div class="mt-1">
                        <x-button :type="'button'" :variant="'secondary'" onclick="openModal('resetPasswordModal')">Reset Password</x-button>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <x-button type="button" onclick="openModal('deleteModal')" :variant="'danger'"
                            :size="'sm'">Delete</x-button>
                        <x-button :type="'submit'" :variant="'primary'">Save</x-button>
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
                <x-slot name="title">Reset Password</x-slot>
                <x-button type="submit" :variant="'danger'">Reset</x-button>
            </form>
        </div>
    </x-modal>
</x-layouts.dashboard>