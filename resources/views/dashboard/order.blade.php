<x-layouts.dashboard>
    <div class="bg-white shadow-lg h-15 justify-between flex items-center p-4">
        <h2 class="font-bold text-gray-800">Dashboard</h2>
        <div class="flex items-center space-x-4">
            <h2 class="font-bold text-gray-800">Hi, Admin</h2>
            <img src="https://ui-avatars.com/api/?name=Indie+User&background=4F46E5&color=fff&size=128" alt="Avatar"
                class="w-10 h-10 rounded-full">
        </div>
    </div>
    <div class="p-4">
        <div class="grid grid-cols-2 gap-2">
            <div class="p-2">
                <input type="search" name="search" id="search" placeholder="Search..." class="border bg-white border-gray-400 rounded-md p-2 w-full">
                <div class="flex space-x-4 mt-2">
                    <x-button :variant="'secondary'">Jenis Bahan 1</x-button>
                    <x-button :variant="'secondary'">Jenis Bahan 1</x-button>
                    <x-button :variant="'secondary'">Jenis Bahan 1</x-button>
                </div>
                <div class="bg-white shadow-lg flex justify-between rounded items-center my-3 p-3">
                    <div class="space-y-1">
                        <p>Banner</p>
                        <p>Jenis Bahan</p>
                    </div>
                    <div class="">
                        Rp.1000.000,00/m2
                    </div>
                </div>
                <div class="bg-white shadow-lg flex justify-between rounded items-center my-3 p-3">
                    <div class="space-y-1">
                        <p>Banner</p>
                        <p>Jenis Bahan</p>
                    </div>
                    <div class="">
                        Rp.1000.000,00/m2
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-5">
                <p>New Order</p>
                <div class="flex justify-between items-center">
                    <p>Admin</p>
                    <a href="" class="text-red-500">Hapus Semua</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>