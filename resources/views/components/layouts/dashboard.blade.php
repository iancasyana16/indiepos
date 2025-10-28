<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <x-sidebar.sidebar id="sidebar" />

        <div
            id="overlay"
            class="fixed inset-0 bg-slate-500/25 hidden z-40 md:hidden"
            onclick="toggleSidebar()">
        </div>

        <div class="flex-1 overflow-y-auto">
            {{ $slot }}
        </div>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            const isHidden = sidebar.classList.contains('-translate-x-full');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden', !isHidden);
        }
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.remove('hidden');
            if (modal) modal.classList.add('flex');
        }
        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.add('hidden');
        }
    </script>
</body>

</html>