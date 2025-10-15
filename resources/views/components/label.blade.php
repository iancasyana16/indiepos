@props(['for', 'value' => '', 'class' => ''])

<label for="{{ $for }}" class="block font-medium text-sm text-black {{ $class }}">
    {{ $slot }}
</label>