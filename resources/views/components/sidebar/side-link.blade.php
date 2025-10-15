@props([
    'route',
    'activeMatch' => null, // opsional
])
@php
    $match = $activeMatch ?? $route . '*';
    $isActive = request()->routeIs($match);
@endphp

<a href="{{ route($route) }}"
    class="my-1 min-w-full rounded block px-4 py-2 transition-colors font-medium
        {{ $isActive
    ? 'bg-indigo-600 text-white'
    : 'text-indigo-600 bg-slate-100 hover:bg-indigo-600 hover:text-white' }}">
    {{ $slot }}
</a>
