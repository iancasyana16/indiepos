<x-layouts.dashboard>
    <x-navbar />
    <div class="p-4">
        <div class="text-lg font-semibold">Tambah Akun</div>
        <div class="mt-4 bg-white p-4 rounded-lg shadow-lg">
            <form action="{{ route('account.store') }}" method="post">
                @csrf
                <x-label for="name" class="font-semibold">Nama</x-label>
                <x-label for="name">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit minima
                    ullam aut saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
                <x-input id="name" type="text" name="name" />
                <x-label for="email" class="font-semibold">Email</x-label>
                <x-label for="email">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit minima
                    ullam aut
                    saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
                <x-input id="email" type="email" name="email" />
                <div class="flex gap-3">
                    <div>
                        <x-label for="role" class="font-semibold">Role</x-label>
                        <x-label for="role">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit minima
                            ullam aut
                            saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
                        <x-input id="role" type="text" name="role" />
                    </div>
                    <div>
                        <x-label for="number" class="font-semibold">Nomor HP</x-label>
                        <x-label for="number">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit
                            minima ullam aut
                            saepe molestias ea illo voluptate culpa optio perspiciatis?</x-label>
                        <x-input id="number" type="text" name="number" />
                    </div>
                </div>
                <div class="flex justify-end">
                    <x-button :type="'submit'" :variant="'primary'">Add</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.dashboard>