@props(
    [
        'class' => ''
    ]
)

<td class="px-6 text-md py-2 whitespace-nowrap {{ $class }}">
    {{ $slot }}
</td>