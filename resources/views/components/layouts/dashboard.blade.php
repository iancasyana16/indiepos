<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen gap-3">
        <!-- Sidebar -->
        <x-sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-3">
            {{ $slot }}
        </div>
    </div>
</body>

</html>