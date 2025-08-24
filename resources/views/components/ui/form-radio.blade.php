@props([
    'name',
    'label',
    'options' => [],
    'value' => null,
    'required' => false
])

<div class="mb-4">
    <label class="form-label">{{ $label }} {{ $required ? '*' : '' }}</label>
    <div class="d-flex">
        @foreach($options as $optionValue => $optionLabel)
            <div class="form-check me-4">
                <input
                    class="form-check-input @error($name) is-invalid @enderror"
                    type="radio"
                    name="{{ $name }}"
                    id="{{ $name }}_{{ $optionValue }}"
                    value="{{ $optionValue }}"
                    {{ old($name, $value) == $optionValue ? 'checked' : '' }}
                    @if($required) required @endif
                    {{ $attributes }}
                >
                <label class="form-check-label" for="{{ $name }}_{{ $optionValue }}">
                    {{ $optionLabel }}
                </label>
            </div>
        @endforeach
    </div>
    @error($name)
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>
