@props([
    'placeholder' => 'Search courses...',
    'type' => 'default',       // default, advanced, overlay
    'categories' => null,      // Array of categories for advanced search
    'buttonText' => 'Search',
    'size' => '',              // sm, lg
    'rounded' => true,
    'withFilters' => false,
    'action' => null,          // Form action URL
    'method' => 'GET'
])

@php
    $formClasses = [
        $type === 'overlay' ? 'search-overlay' : 'search-form',
        $attributes->get('class')
    ];

    $inputClasses = [
        'form-control',
        $size ? 'form-control-' . $size : '',
        $rounded ? 'rounded-pill' : '',
        $type === 'overlay' ? 'border-0 shadow-none bg-transparent' : ''
    ];

    $buttonClasses = [
        'btn',
        $size ? 'btn-' . $size : '',
        $rounded ? 'rounded-pill' : '',
        $type === 'overlay' ? 'btn-link text-dark' : 'btn-primary'
    ];
@endphp

@if($type === 'overlay')
    <div class="search-overlay position-relative">
@endif

<form action="{{ $action }}" method="{{ $method }}" class="{{ implode(' ', array_filter($formClasses)) }}">
    @if($type === 'advanced')
        <div class="row g-3">
            <!-- Search input -->
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="search"
                           name="q"
                           class="{{ implode(' ', array_filter($inputClasses)) }} border-start-0"
                           placeholder="{{ $placeholder }}"
                           value="{{ request('q') }}">
                </div>
            </div>

            <!-- Categories dropdown -->
            @if($categories)
                <div class="col-md-4">
                    <select name="category" class="form-select {{ $rounded ? 'rounded-pill' : '' }}">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}" {{ request('category') == $category['id'] ? 'selected' : '' }}>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Search button -->
            <div class="col-md-2">
                <button type="submit" class="{{ implode(' ', array_filter($buttonClasses)) }} w-100">
                    {{ $buttonText }}
                </button>
            </div>

            @if($withFilters)
                <div class="col-12 mt-4">
                    <div class="collapse" id="searchFilters">
                        <div class="card card-body">
                            <div class="row g-3">
                                <!-- Price Range -->
                                <div class="col-sm-6 col-md-4">
                                    <label class="form-label">Price Range</label>
                                    <select name="price_range" class="form-select">
                                        <option value="">Any Price</option>
                                        <option value="free" {{ request('price_range') === 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="paid" {{ request('price_range') === 'paid' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                </div>

                                <!-- Level -->
                                <div class="col-sm-6 col-md-4">
                                    <label class="form-label">Level</label>
                                    <select name="level" class="form-select">
                                        <option value="">All Levels</option>
                                        <option value="beginner" {{ request('level') === 'beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate" {{ request('level') === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="advanced" {{ request('level') === 'advanced' ? 'selected' : '' }}>Advanced</option>
                                    </select>
                                </div>

                                <!-- Duration -->
                                <div class="col-sm-6 col-md-4">
                                    <label class="form-label">Duration</label>
                                    <select name="duration" class="form-select">
                                        <option value="">Any Duration</option>
                                        <option value="short" {{ request('duration') === 'short' ? 'selected' : '' }}>0-2 Hours</option>
                                        <option value="medium" {{ request('duration') === 'medium' ? 'selected' : '' }}>3-6 Hours</option>
                                        <option value="long" {{ request('duration') === 'long' ? 'selected' : '' }}>7+ Hours</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    @else
        <div class="input-group">
            @if($type !== 'overlay')
                <span class="input-group-text bg-transparent border-end-0">
                    <i class="fas fa-search"></i>
                </span>
            @endif

            <input type="search"
                   name="q"
                   class="{{ implode(' ', array_filter($inputClasses)) }} {{ $type !== 'overlay' ? 'border-start-0' : '' }}"
                   placeholder="{{ $placeholder }}"
                   value="{{ request('q') }}">

            @if($type === 'overlay')
                <button type="submit" class="{{ implode(' ', array_filter($buttonClasses)) }} position-absolute end-0 top-50 translate-middle-y">
                    <i class="fas fa-search"></i>
                </button>
            @else
                <button type="submit" class="{{ implode(' ', array_filter($buttonClasses)) }}">
                    {{ $buttonText }}
                </button>
            @endif
        </div>
    @endif

    @if($withFilters && $type !== 'advanced')
        <div class="mt-2">
            <button class="btn btn-link btn-sm text-decoration-none p-0"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#searchFilters"
                    aria-expanded="false">
                <i class="fas fa-sliders-h me-1"></i> Advanced Filters
            </button>
        </div>
    @endif
</form>

@if($type === 'overlay')
    </div>
@endif

{{-- Usage Example:
<!-- Simple Search -->
<x-ui.search />

<!-- Advanced Search with Categories -->
@php
    $categories = [
        ['id' => 1, 'name' => 'Web Development'],
        ['id' => 2, 'name' => 'Design'],
        ['id' => 3, 'name' => 'Business']
    ];
@endphp

<x-ui.search
    type="advanced"
    :categories="$categories"
    placeholder="What do you want to learn?"
    buttonText="Find Courses"
    size="lg"
    :withFilters="true"
    action="{{ route('courses.search') }}"
/>

<!-- Overlay Search -->
<x-ui.search
    type="overlay"
    placeholder="Type to search..."
    size="lg"
/>
--}}
