@props([
    'text' => '',
    'variant' => 'primary',    // primary, secondary, success, danger, warning, info, light, dark
    'size' => '',             // sm, lg
    'split' => false,
    'dropup' => false,
    'dropend' => false,
    'dropstart' => false,
    'noArrow' => false,
    'offset' => '',
    'buttonClass' => '',
    'menuClass' => '',
    'icon' => null
])

@php
    $direction = $dropup ? 'dropup' : ($dropend ? 'dropend' : ($dropstart ? 'dropstart' : 'dropdown'));
    $buttonVariant = $split ? "btn-{$variant}" : "btn-{$variant} dropdown-toggle";
    $buttonSize = $size ? "btn-{$size}" : '';
    $show = $attributes->get('show') ? 'show' : '';
    $menuAlignment = $attributes->get('align') ? 'dropdown-menu-' . $attributes->get('align') : '';
@endphp

<div class="{{ $direction }} {{ $show }}">
    @if($split)
        <div class="btn-group">
            <button type="button" class="btn {{ $buttonVariant }} {{ $buttonSize }} {{ $buttonClass }}">
                @if($icon)<i class="{{ $icon }} me-2"></i>@endif
                {{ $text }}
            </button>
            <button type="button"
                class="btn {{ $buttonVariant }} dropdown-toggle dropdown-toggle-split {{ $buttonSize }} {{ $buttonClass }}"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                @if($offset) data-bs-offset="{{ $offset }}" @endif>
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
        </div>
    @else
        <button type="button"
            class="btn {{ $buttonVariant }} {{ $buttonSize }} {{ $buttonClass }} {{ $noArrow ? 'dropdown-toggle-no-arrow' : '' }}"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            @if($offset) data-bs-offset="{{ $offset }}" @endif>
            @if($icon)<i class="{{ $icon }} me-2"></i>@endif
            {{ $text }}
        </button>
    @endif

    <div class="dropdown-menu {{ $menuAlignment }} {{ $menuClass }}">
        {{ $slot }}
    </div>
</div>
