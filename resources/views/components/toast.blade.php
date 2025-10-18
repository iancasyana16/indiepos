    @if (session('success'))
        <div class="toast-item bg-green-500 text-white px-4 py-2 rounded shadow mb-2 transition-opacity duration-300 opacity-100">
            {{ session('success') }}
        </div>
    @endif