@props([
    'as' => 'button',
    'type' => 'button',
    'href' => '#',
    'class' => '',
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $variants = [
        'primary' => 'bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2',
        'secondary' => 'bg-slate-600 text-white hover:bg-slate-700 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2',
        'outline' => 'bg-green-100 border border-green-300 text-green-700 hover:bg-green-300 focus:ring-2 focus:ring-green-500 focus:ring-offset-2',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-6 py-3 text-lg',
    ];

    $variantClass = $variants[$variant] ?? $variants['primary'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

@if ($as === 'button')
    <button
        type="{{ $type }}"
        {{ $attributes->merge([
            'class' => "my-2 inline-flex items-center justify-center rounded-md font-medium transition-colors cursor-pointer $variantClass $sizeClass $class"
        ]) }}
    >
        {{ $slot }}
    </button>
@else
    <a
        href="{{ $href }}"
        {{ $attributes->merge([
            'class' => "my-2 inline-flex items-center justify-center rounded-md font-medium transition-colors $variantClass $sizeClass $class"
        ]) }}
    >
        {{ $slot }}
    </a>
@endif
