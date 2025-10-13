@props([
    'type' => 'button',
    'class' => '',
    'variant' => 'primary',
    'size' => 'md',
])

<button {{ $attributes->merge(['type' => $type, 'class' => "my-2 inline-flex items-center justify-center rounded-md font-medium transition-colors {$class} " . match ($variant) {
    'primary' => 'bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer',
    'secondary' => 'bg-gray-200 text-gray-800 hover:bg-gray-300 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 cursor-pointer',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 cursor-pointer',
    'outline' => 'border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer',
    default => 'bg-indigo-600 text-white hover:bg-indigo-700',
} . ' ' . match ($size) {
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-lg',
    default => 'px-4 py-2 text-base',
}]) }}>
    {{ $slot }}
</button>