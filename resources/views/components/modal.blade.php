@props(['id'])

<div id="{{ $id }}" class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 relative">
        <h2 class="text-xl text-center font-bold mb-4">Konfirmasi Hapus</h2>
        {{ $slot }}
    </div>
</div>