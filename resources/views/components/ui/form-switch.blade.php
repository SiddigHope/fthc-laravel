@props([
    'name',
    'label' => '',
    'checked' => false,
    'required' => false,
    'id' => null
])

@php
    $id = $id ?? $name;
@endphp

<div {{ $attributes->merge(['class' => 'form-check form-switch']) }}>
    <input type="checkbox"
           name="{{ $name }}"
           id="{{ $id }}"
           @if($checked) checked @endif
           @if($required) required @endif
           class="form-check-input @error($name) is-invalid @enderror"
           value="1">

    <label for="{{ $id }}" class="form-check-label">
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
