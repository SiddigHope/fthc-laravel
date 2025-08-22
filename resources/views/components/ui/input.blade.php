@props([
    'type' => 'text',
    'name' => '',
    'id' => null,
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'helper' => null,
    'leadingIcon' => null,
    'trailingIcon' => null,
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'autofocus' => false,
    'error' => null,
    'size' => null, // sm, lg
    'floating' => false
])

@php
    $id = $id ?? $name;
    $inputClasses = [
        'form-control',
        $size ? 'form-control-'.$size : '',
        $error ? 'is-invalid' : '',
        ($leadingIcon || $trailingIcon) ? 'ps-5' : '',
        $attributes->get('class')
    ];

    $wrapperClasses = [
        'mb-3',
        $floating ? 'form-floating' : '',
        ($leadingIcon || $trailingIcon) ? 'position-relative' : ''
    ];
@endphp

<div class="{{ implode(' ', array_filter($wrapperClasses)) }}">
    @if($label && !$floating)
        <label for="{{ $id }}" class="form-label">
            {{ $label }}
            @if($required)<span class="text-danger">*</span>@endif
        </label>
    @endif

    @if($leadingIcon)
        <i class="{{ $leadingIcon }} position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        value="{{ old($name, $value) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $autofocus ? 'autofocus' : '' }}
        {{ $attributes->merge(['class' => implode(' ', array_filter($inputClasses))]) }}
    >

    @if($trailingIcon)
        <i class="{{ $trailingIcon }} position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
    @endif

    @if($label && $floating)
        <label for="{{ $id }}">
            {{ $label }}
            @if($required)<span class="text-danger">*</span>@endif
        </label>
    @endif

    @if($helper && !$error)
        <div class="form-text">{{ $helper }}</div>
    @endif

    @if($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
