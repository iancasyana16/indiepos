@props(['for', 'value' => ''])

<label for="{{ $for }}" class="block font-medium text-sm text-gray-700">
    {{ $slot }}
</label>