@props([
    'name',
    'label' => '',
    'checked' => false,
    'required' => false,
    'disabled' => false
])

<div {{ $attributes->merge(['class' => 'form-check']) }}>
    <input type="checkbox"
           class="form-check-input @error($name) is-invalid @enderror"
           name="{{ $name }}"
           id="{{ $name }}"
           value="1"
           @if($checked) checked @endif
           @if($required) required @endif
           @if($disabled) disabled @endif>

    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
