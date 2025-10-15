@props(['type' => 'text', 'name', 'value' => '', 'placeholder' => ''])

<div class="my-2">
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
        class="border border-gray-300 rounded-md p-2 w-full bg-white" />
</div>