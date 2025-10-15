<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="text-lg font-semibold">Edit Akun</div>
        <div class="mt-4 bg-white p-4 rounded-lg shadow-lg">
            <x-label for="nama" class="font-semibold">Nama</x-label>
            <x-label for="nama">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit minima
                ullam aut saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
            <x-input id="nama" type="text" name="nama" />
            <x-label for="email" class="font-semibold">Email</x-label>
            <x-label for="email">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit minima
                ullam aut
                saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
            <x-input id="email" type="text" name="email" />
            <div class="flex gap-3">
                <div>
                    <x-label for="role" class="font-semibold">Role</x-label>
                    <x-label for="role">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit minima
                        ullam aut
                        saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
                    <x-input id="role" type="text" name="role" />
                </div>
                <div>
                    <x-label for="nomorHp" class="font-semibold">Nomor HP</x-label>
                    <x-label for="nomorHp">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit
                        minima ullam aut
                        saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
                    <x-input id="nomorHp" type="text" name="nomorHp" />
                </div>
            </div>
            <div class="flex justify-end space-x-2">
                <x-button :variant="'danger'">Delete</x-button>
                <x-button :variant="'primary'">Save</x-button>
            </div>
        </div>
    </div>
</x-layouts.dashboard>