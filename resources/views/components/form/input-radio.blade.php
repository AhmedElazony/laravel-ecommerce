@props(['options', 'name', 'oldValue'])

@foreach($options as $option)
    <div class="form-check">
        <input
            type="radio"
            name="status"
            value="{{ $option }}"
            @class(['form-check-input', 'is-invalid' => $errors->has('status')])
            @checked(old($name, $oldValue) === $option)
        >
        <label class="form-check-label" for="status">{{ ucfirst($option) }}</label>
    </div>
@endforeach
