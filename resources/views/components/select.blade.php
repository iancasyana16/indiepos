@props([
    'id' => $attributes->get('name'),
    'name',
    'options' => [],
    'selected' => null,
    'placeholder' => '-- Pilih --'
])

<div class="my-2">
    <select
            id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'border border-gray-300 rounded-md p-2 w-full bg-white']) }}>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" @selected(old($name, $selected) == $value)>
            {{ $label }}
        </option>
    @endforeach
</select>
</div>
