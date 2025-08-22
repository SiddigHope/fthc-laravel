@props([
    'src' => null,           // Image source URL
    'alt' => '',             // Alt text for image
    'size' => 'md',          // xs, sm, md, lg, xl
    'shape' => 'circle',      // circle, square, rounded
    'status' => null,        // online, offline, away, busy
    'statusPosition' => 'bottom-end', // top-start, top-end, bottom-start, bottom-end
    'bordered' => false,      // Add border
    'borderColor' => 'white', // Border color
    'initials' => null,      // Text to show when no image
    'backgroundColor' => 'primary', // Background color for initials
    'group' => false,        // Part of avatar group
    'href' => null           // Optional link
])

@php
    $sizes = [
        'xs' => ['avatar' => 'avatar-xs', 'status' => '8px', 'font' => 'fs-6'],
        'sm' => ['avatar' => 'avatar-sm', 'status' => '10px', 'font' => 'fs-5'],
        'md' => ['avatar' => '', 'status' => '12px', 'font' => 'fs-4'],
        'lg' => ['avatar' => 'avatar-lg', 'status' => '14px', 'font' => 'fs-3'],
        'xl' => ['avatar' => 'avatar-xl', 'status' => '16px', 'font' => 'fs-2']
    ];

    $shapes = [
        'circle' => 'rounded-circle',
        'square' => '',
        'rounded' => 'rounded'
    ];

    $statusColors = [
        'online' => 'bg-success',
        'offline' => 'bg-secondary',
        'away' => 'bg-warning',
        'busy' => 'bg-danger'
    ];

    $avatarClasses = [
        'avatar',
        $sizes[$size]['avatar'],
        $shapes[$shape],
        $group ? 'avatar-group-item' : '',
        $attributes->get('class')
    ];

    $imgClasses = [
        $shapes[$shape],
        $bordered ? 'border border-2 border-' . $borderColor : ''
    ];
@endphp

@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => implode(' ', array_filter($avatarClasses))]) }}>
@else
<div {{ $attributes->merge(['class' => implode(' ', array_filter($avatarClasses))]) }}>
@endif

    @if($src)
        <img src="{{ asset($src) }}"
             alt="{{ $alt }}"
             class="{{ implode(' ', array_filter($imgClasses)) }}">
    @elseif($initials)
        <div class="{{ implode(' ', array_filter($imgClasses)) }} bg-{{ $backgroundColor }} text-white d-flex align-items-center justify-content-center {{ $sizes[$size]['font'] }}">
            {{ Str::upper(Str::limit($initials, 2, '')) }}
        </div>
    @endif

    @if($status)
        <span class="position-absolute {{ $statusPosition }} translate-middle p-1 {{ $statusColors[$status] }} border border-white rounded-circle"
              style="width: {{ $sizes[$size]['status'] }}; height: {{ $sizes[$size]['status'] }}">
            <span class="visually-hidden">{{ ucfirst($status) }}</span>
        </span>
    @endif

@if($href)
</a>
@else
</div>
@endif

{{-- Usage Example:
<!-- Simple Avatar -->
<x-ui.avatar
    src="path/to/image.jpg"
    alt="User Name"
/>

<!-- Avatar with Status -->
<x-ui.avatar
    src="path/to/image.jpg"
    alt="User Name"
    size="lg"
    status="online"
    statusPosition="bottom-end"
    bordered
    borderColor="white"
/>

<!-- Initials Avatar -->
<x-ui.avatar
    initials="John Doe"
    backgroundColor="primary"
    size="xl"
    shape="rounded"
/>

<!-- Avatar Group -->
<div class="avatar-group">
    <x-ui.avatar
        src="path/to/image1.jpg"
        alt="User 1"
        group
    />
    <x-ui.avatar
        src="path/to/image2.jpg"
        alt="User 2"
        group
    />
    <x-ui.avatar
        initials="+3"
        backgroundColor="secondary"
        group
    />
</div>

<!-- Linked Avatar -->
<x-ui.avatar
    src="path/to/image.jpg"
    alt="User Name"
    href="/profile"
    size="lg"
/>
--}}
