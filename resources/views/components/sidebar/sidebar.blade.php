<aside id="{{ $id ?? '' }}"
    class="flex flex-col justify-between h-screen w-64 bg-slate-600 shadow-md
            fixed inset-y-0 left-0 z-50 transform -translate-x-full transition-transform duration-300
            md:translate-x-0 md:static md:flex">
    <!-- Logo Section -->
    <div class="p-4">
        <h1 class="text-2xl font-bold text-white text-center">Setia Budi</h1>
    </div>

    <!-- Navigation Section -->
    <div class="flex-1 flex items-center">
        <nav class="w-full flex flex-col px-4 gap-2 overflow-y-auto">
            <x-sidebar.side-link :route="'dashboard.index'" :activeMatch="'dashboard.*'">Dashboard</x-sidebar.side-link>
            <x-sidebar.side-link :route="'order.index'" :activeMatch="'order.*'">Order</x-sidebar.side-link>
            <x-sidebar.side-link :route="'history-order.index'" :activeMatch="'history-order.*'">History Order</x-sidebar.side-link>
            <x-sidebar.side-link :route="'product.index'" :activeMatch="'product.*'">Produk</x-sidebar.side-link>
            <x-sidebar.side-link :route="'account.index'" :activeMatch="'account.*'">Account</x-sidebar.side-link>
            <x-sidebar.side-link :route="'setting.index'" :activeMatch="'setting.*'">Setting</x-sidebar.side-link>
        </nav>
    </div>

    <!-- Logout Section -->
    <form action="{{ route('logout') }}" method="POST" class="p-4">
        @csrf
        <button type="submit"
            class="block w-full px-4 py-2 text-white text-center bg-red-600 hover:bg-red-800 rounded">
            Logout
        </button>
    </form>
</aside>