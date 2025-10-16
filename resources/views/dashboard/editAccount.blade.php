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
                            <x-input id="nomorHp" type="tel" name="number" value="{{ old('number', $account->number) }}" />
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <x-button :variant="'danger'">Delete</x-button>
                        <x-button :type="'submit'" :variant="'primary'">Save</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.dashboard>