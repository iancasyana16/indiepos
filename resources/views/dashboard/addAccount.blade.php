<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="text-lg font-semibold">Tambah Akun</div>
            <div class="mt-4">
                <form action="" method="POST">
                    @csrf
                    <x-label for="name" class="font-semibold">Nama</x-label>
                    <x-input id="name" type="text" name="name" />
                    <x-label for="email" class="font-semibold">Email</x-label>
                    <x-input id="email" type="text" name="email" />
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <x-label for="role" class="font-semibold">Role</x-label>
                            <x-input id="role" type="text" name="role" />
                        </div>
                        <div>
                            <x-label for="number" class="font-semibold">Nomor HP</x-label>
                            <x-input id="number" type="text" name="number" />
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