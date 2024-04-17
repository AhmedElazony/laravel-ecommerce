@props([
    'type' => 'text',
    'name',
    'oldValue' => '',
])

<input
    {{ $attributes->merge([
        'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
        'type' => $type,
        'name' => $name,
        'value' => old($name, $oldValue)
    ])}}
/>
