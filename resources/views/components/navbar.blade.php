@props(['title'])
@php
    $name = Auth::user()->name ?? null;
@endphp
<div class="bg-white shadow-lg flex justify-between items-center p-4 sticky top-0 z-30">
    <div class="flex items-center gap-4">
        <button class="md:hidden text-gray-800 text-2xl" onclick="toggleSidebar()">☰</button>
        <h2 class="font-bold text-gray-800">{{$title ?? 'Dashboard'}}</h2>
    </div>
    <div class="flex items-center space-x-4">
        <h2 class="font-bold text-gray-800">Hai, {{$name}}</h2>
        <img src="https://ui-avatars.com/api/?name=Indie+User&background=4F46E5&color=fff&size=128" alt="Avatar"
            class="w-10 h-10 rounded-full">
    </div>
</div>