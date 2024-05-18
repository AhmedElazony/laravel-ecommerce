@props([
    'name',
    'oldValue',
    'label'
])

@if($label ?? false)
    <x-form.input-label>{{ $label }}</x-form.input-label>
@endif
<textarea
    {{ $attributes->merge([
        'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
        'name' => $name,
    ])}}
>{{ old($name, $oldValue) }}</textarea>

<x-form.input-error :name="$name"/>
