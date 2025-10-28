@props(['id', 'title'])

<div id="{{ $id }}" class="fixed inset-0 z-50 items-center justify-center backdrop-blur-sm hidden">
    <div class="bg-white rounded-lg shadow-lg inline-block max-w-[90%] p-6 relative">
        <h2 class="text-xl text-center font-bold mb-4">{{$title}}</h2>
        {{ $slot }}
    </div>
</div>