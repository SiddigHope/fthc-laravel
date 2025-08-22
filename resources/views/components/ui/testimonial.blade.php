@props([
    'avatar' => null,
    'name' => '',
    'position' => '',
    'rating' => 5,
    'style' => 'default',  // default, modern, minimal
    'background' => false,  // Add background color
    'bordered' => false,    // Add border
    'shadow' => true       // Add shadow
])

@php
    $cardClasses = [
        'card',
        'h-100',
        $style === 'minimal' ? 'border-0' : '',
        $background ? 'bg-light' : '',
        $bordered ? 'border' : 'border-0',
        $shadow ? 'shadow' : '',
        $attributes->get('class')
    ];
@endphp

<div class="{{ implode(' ', array_filter($cardClasses)) }}">
    <div class="card-body">
        @if($style === 'modern')
            <!-- Modern Style -->
            <div class="d-flex mb-3">
                @if($avatar)
                    <div class="avatar avatar-lg me-3">
                        <img class="avatar-img rounded-circle" src="{{ $avatar }}" alt="{{ $name }}">
                    </div>
                @endif
                <div>
                    <h6 class="mb-0">{{ $name }}</h6>
                    @if($position)
                        <p class="mb-0 small text-muted">{{ $position }}</p>
                    @endif
                </div>
            </div>
            <!-- Rating -->
            @if($rating)
                <ul class="list-inline mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <li class="list-inline-item me-0">
                            <i class="fas fa-star {{ $i <= $rating ? 'text-warning' : 'text-light' }}"></i>
                        </li>
                    @endfor
                </ul>
            @endif
            <!-- Content -->
            <p class="mb-0">
                {{ $slot }}
            </p>

        @elseif($style === 'minimal')
            <!-- Minimal Style -->
            <div class="text-center">
                <!-- Rating -->
                @if($rating)
                    <ul class="list-inline mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            <li class="list-inline-item me-0">
                                <i class="fas fa-star {{ $i <= $rating ? 'text-warning' : 'text-light' }}"></i>
                            </li>
                        @endfor
                    </ul>
                @endif
                <!-- Content -->
                <p class="mb-3">
                    {{ $slot }}
                </p>
                <!-- Info -->
                @if($avatar)
                    <div class="avatar avatar-md mx-auto mb-2">
                        <img class="avatar-img rounded-circle" src="{{ $avatar }}" alt="{{ $name }}">
                    </div>
                @endif
                <h6 class="mb-0">{{ $name }}</h6>
                @if($position)
                    <p class="mb-0 small text-muted">{{ $position }}</p>
                @endif
            </div>

        @else
            <!-- Default Style -->
            <!-- Content -->
            <div class="position-relative">
                <span class="display-3 text-primary position-absolute start-0 top-0 opacity-10">
                    <i class="bi bi-quote"></i>
                </span>
                <p class="mb-3 ps-3">
                    {{ $slot }}
                </p>
            </div>
            <!-- Rating -->
            @if($rating)
                <ul class="list-inline mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <li class="list-inline-item me-0">
                            <i class="fas fa-star {{ $i <= $rating ? 'text-warning' : 'text-light' }}"></i>
                        </li>
                    @endfor
                </ul>
            @endif
            <!-- Info -->
            <div class="d-flex">
                @if($avatar)
                    <div class="avatar avatar-md me-3">
                        <img class="avatar-img rounded-circle" src="{{ $avatar }}" alt="{{ $name }}">
                    </div>
                @endif
                <div>
                    <h6 class="mb-0">{{ $name }}</h6>
                    @if($position)
                        <p class="mb-0 small text-muted">{{ $position }}</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Usage Example:
<x-ui.testimonial
    name="John Doe"
    position="Web Developer"
    avatar="path/to/avatar.jpg"
    rating="4.5"
    style="modern"
    background
    bordered
>
    This is an excellent course! The instructor explains everything clearly and provides practical examples.
</x-ui.testimonial>
--}}
