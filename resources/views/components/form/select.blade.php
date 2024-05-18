@props([
    'name',
    'oldValue',
    'items',
    'label',
])

<x-form.input-label >{{ $label }}</x-form.input-label>

<select name="{{ $name }}" id="{{ $name }}" @class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has($name),
    ])>
    @foreach ($items as $item)
        <option value="{{ $item }}"
                name="{{ $name }}" @selected(old($name, $oldValue) === $item)>
            {{ ucfirst($item) }}
        </option>
    @endforeach
</select>

<x-form.input-error :name="$name"/>
