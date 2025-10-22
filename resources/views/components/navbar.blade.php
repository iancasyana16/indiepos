@props(['title'])
<div class="bg-white shadow-lg h-15 justify-between flex items-center p-4">
    <div class="flex gap-4">
        {{-- <h2 class="font-bold text-gray-800 md:hidden">☰</h2> --}}
        <h2 class="font-bold text-gray-800">{{$title ?? 'Dashboard'}}</h2>
    </div>
    <div class="flex items-center space-x-4">
        <h2 class="font-bold text-gray-800">Hi, Admin</h2>
        <img src="https://ui-avatars.com/api/?name=Indie+User&background=4F46E5&color=fff&size=128" alt="Avatar"
            class="w-10 h-10 rounded-full">
    </div>
</div>