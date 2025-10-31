@props([
    'options' => [
        'terbaru' => 'Terbaru',
        'terlama' => 'Terlama',
    ],
    'name' => 'sort', // nama parameter di URL
])

<form method="GET">
    <select
        name="{{ $name }}"
        onchange="this.form.submit()"
        class="border bg-white border-gray-400 rounded-md p-2 text-sm"
    >
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ request($name) === $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</form>
