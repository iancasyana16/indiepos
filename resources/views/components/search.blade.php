@props([
    'name' => 'search',
    'placeholder' => 'Cari...',
])

<form method="GET" class="w-full">
    <input
        type="search"
        name="{{ $name }}"
        value="{{ request($name) }}"
        placeholder="{{ $placeholder }}"
        class="border bg-white border-gray-400 rounded-md p-2 w-full"
    >
</form>
