@props(['title', 'type' => 'text', 'name', 'value' => ''])

@isset($title)
    <label> {{ $title }}</label>
@endisset

<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }} />
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
