<aside class="flex flex-col justify-between w-64 bg-slate-600 shadow-md h-screen sticky top-0">
    <!-- Logo Section -->
    <div class="p-4">
        <h1 class="text-2xl font-bold text-white text-center">Setia Budi</h1>
    </div>

    <!-- Navigation Section -->
    <nav class="p-4">
        <div class="flex flex-col items-start justify-center h-full">
            <x-sidebar.side-link :route="'dashboard'">
                Dashboard
            </x-sidebar.side-link>
            <x-sidebar.side-link :route="'order'">
                Order
            </x-sidebar.side-link>
            <x-sidebar.side-link :route="'history-order'">
                History Order
            </x-sidebar.side-link>
            <x-sidebar.side-link :route="'product'">
                Produk
            </x-sidebar.side-link>
            <x-sidebar.side-link :route="'account'">
                Account
            </x-sidebar.side-link>
            <x-sidebar.side-link :route="'setting'">
                Setting
            </x-sidebar.side-link>
        </div>
    </nav>

    <!-- Logout Section -->
    <div class="p-4">
        <a href="" class="block px-4 py-2 text-white hover:bg-red-800 bg-red-600 rounded">
            Logout
        </a>
    </div>
</aside>