<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="text-lg font-semibold mb-4">Edit Profile</div>

            <form action="{{ route('setting.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-3">
                    <div>
                        <x-label for="name" class="font-semibold">Nama</x-label>
                        <x-input id="name" type="text" name="name" value="{{ old('name', $account->name) }}" />
                    </div>

                    <div>
                        <x-label for="email" class="font-semibold">Email</x-label>
                        <x-input id="email" type="text" name="email" value="{{ old('email', $account->email) }}" />
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <x-label for="role" class="font-semibold">Role</x-label>
                            <x-input id="role" type="text" name="role" value="{{ old('role', $account->role) }}" />
                        </div>
                        <div>
                            <x-label for="number" class="font-semibold">Nomor HP</x-label>
                            <x-input id="number" type="text" name="number" value="{{ old('number', $account->number) }}" />
                        </div>
                    </div>

                    <div>
                        <x-label for="password" class="font-semibold">Password (opsional)</x-label>
                        <x-input id="password" type="password" name="password" placeholder="Kosongkan jika tidak diganti" />
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <x-button :type="'submit'" :variant="'primary'">Simpan</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.dashboard>
