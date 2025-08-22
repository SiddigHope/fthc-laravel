@props([
    'type' => 'info',      // primary, secondary, success, danger, warning, info, light, dark
    'dismissible' => false,
    'icon' => null,
    'title' => null,
    'rounded' => true,
    'border' => false,      // left, top, right, bottom, true (all sides)
    'light' => false       // light variant of the alert
])

@php
    $baseClass = 'alert';
    $variantClass = $light ? "alert-soft-{$type}" : "alert-{$type}";
    $dismissibleClass = $dismissible ? 'alert-dismissible fade show' : '';
    $roundedClass = $rounded ? 'rounded-3' : '';

    // Border classes
    $borderClass = '';
    if ($border === 'left') {
        $borderClass = 'border-start border-4';
    } elseif ($border === 'top') {
        $borderClass = 'border-top border-4';
    } elseif ($border === 'right') {
        $borderClass = 'border-end border-4';
    } elseif ($border === 'bottom') {
        $borderClass = 'border-bottom border-4';
    } elseif ($border === true) {
        $borderClass = 'border border-4';
    }

    $classes = trim("$baseClass $variantClass $dismissibleClass $roundedClass $borderClass " . ($attributes->get('class') ?? ''));
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} role="alert">
    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif

    <div class="d-flex">
        @if($icon)
            <div class="me-3">
                <i class="{{ $icon }} fs-5"></i>
            </div>
        @endif

        <div>
            @if($title)
                <h5 class="alert-heading">{{ $title }}</h5>
            @endif

            {{ $slot }}
        </div>
    </div>
</div>
