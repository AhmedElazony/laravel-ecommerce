@props(['options', 'name', 'label', 'oldValue'])

@if($label ?? false)
    <x-form.input-label>{{ $label }}</x-form.input-label>
@endif

@foreach($options as $option)
    <div class="form-check">
        <input
            type="radio"
            name="{{  $name }}"
            value="{{ $option }}"
            @class(['form-check-input', 'is-invalid' => $errors->has('status')])
            @checked(old($name, $oldValue) === $option)
        >
        <label class="form-check-label" for="status">{{ ucfirst($option) }}</label>
    </div>
@endforeach

<x-form.input-error :name="$name"/>
