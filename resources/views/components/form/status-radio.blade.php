@props(['checked', 'options'])


@foreach ($options as $value)
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="{{ $value }}" value="{{ $value }}"
            @checked(old('status', $checked) == $value)>
        <label class="form-check-label" for="{{ $value }}">
            {{ $value }}
        </label>
    </div>
@endforeach
@error('status')
    <div class="text-danger text-sm">
        {{ $message }}
    </div>
@enderror
