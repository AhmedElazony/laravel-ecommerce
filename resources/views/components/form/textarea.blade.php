@props([
    'name',
    'oldValue',
    'label'
])

<textarea
    {{ $attributes->merge([
        'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
        'name' => $name,
    ])}}
>{{ old($name, $oldValue) }}</textarea>
