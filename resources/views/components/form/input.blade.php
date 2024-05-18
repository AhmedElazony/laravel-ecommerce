@props([
    'type' => 'text',
    'name',
    'oldValue' => '',
    'label'
])

@if($label ?? false)
    <x-form.input-label>{{ $label }}</x-form.input-label>
@endif

<input
    {{ $attributes->merge([
        'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
        'type' => $type,
        'name' => $name,
        'value' => old($name) === null ? $oldValue : old($name)
    ])}}
/>

<x-form.input-error :name="$name"/>
