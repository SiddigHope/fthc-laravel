@props([
    'value' => 0,          // Progress value (0-100)
    'label' => null,       // Progress label
    'showValue' => true,   // Show percentage value
    'size' => '',          // sm, lg
    'type' => 'default',   // default, striped, animated
    'variant' => 'primary',// primary, secondary, success, danger, warning, info
    'rounded' => true,     // Rounded corners
    'height' => null       // Custom height in pixels
])

@php
    $progressClasses = [
        'progress',
        $size ? 'progress-' . $size : '',
        $rounded ? 'rounded-pill' : '',
        $attributes->get('class')
    ];

    $barClasses = [
        'progress-bar',
        'bg-' . $variant,
        $type === 'striped' ? 'progress-bar-striped' : '',
        $type === 'animated' ? 'progress-bar-striped progress-bar-animated' : ''
    ];

    $style = $height ? 'height: ' . $height . 'px;' : '';
@endphp

<div class="progress-wrapper">
    @if($label)
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="small">{{ $label }}</span>
            @if($showValue)
                <span class="small">{{ $value }}%</span>
            @endif
        </div>
    @endif

    <div class="{{ implode(' ', array_filter($progressClasses)) }}" @if($style)style="{{ $style }}"@endif>
        <div class="{{ implode(' ', array_filter($barClasses)) }}"
             role="progressbar"
             style="width: {{ $value }}%"
             aria-valuenow="{{ $value }}"
             aria-valuemin="0"
             aria-valuemax="100">
            @if($showValue && !$label)
                {{ $value }}%
            @endif
        </div>
    </div>
</div>

{{-- Usage Example:
<!-- Simple Progress Bar -->
<x-ui.progress value="75" />

<!-- Progress with Label -->
<x-ui.progress
    value="65"
    label="Course Completion"
    variant="success"
    type="striped"
    size="lg"
/>

<!-- Custom Height Progress -->
<x-ui.progress
    value="90"
    height="10"
    variant="warning"
    :rounded="false"
/>

<!-- Multiple Progress Bars for Course Modules -->
<div class="mb-4">
    <h6>Course Progress by Module</h6>
    <x-ui.progress
        value="100"
        label="Module 1: Introduction"
        variant="success"
        class="mb-3"
    />
    <x-ui.progress
        value="75"
        label="Module 2: Basic Concepts"
        variant="primary"
        class="mb-3"
    />
    <x-ui.progress
        value="50"
        label="Module 3: Advanced Topics"
        variant="info"
        class="mb-3"
    />
    <x-ui.progress
        value="0"
        label="Module 4: Final Project"
        variant="secondary"
    />
</div>
--}}
