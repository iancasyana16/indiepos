<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="text-lg font-semibold">Tambah Akun</div>
            <div class="mt-4">
                <form action="{{ route('account.store') }}" method="POST">
                    @csrf
                    <x-label for="name" class="font-semibold">Nama</x-label>
                    <x-input id="name" type="text" name="name" />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <x-label for="email" class="font-semibold">Email</x-label>
                    <x-input id="email" type="email" name="email" />
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <x-label for="role" class="font-semibold">Role</x-label>
                            <x-select id="role" name="role" :options="['admin' => 'admin', 'desainer' => 'desainer', 'kasir' => 'kasir']" />
                            @error('role')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <x-label for="number" class="font-semibold">Nomor HP</x-label>
                            <x-input id="number" type="tel" name="number" />
                            @error('number')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <x-button :type="'submit'" :variant="'primary'">Add</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.dashboard>