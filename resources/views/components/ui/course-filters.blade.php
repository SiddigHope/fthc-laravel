@props([
    'categories' => [],      // Array of course categories
    'levels' => [],         // Array of course levels
    'ratings' => [5,4,3,2,1], // Rating filter options
    'languages' => [],      // Array of course languages
    'priceRanges' => [],    // Array of price ranges
    'durations' => [],      // Array of duration ranges
    'instructors' => [],    // Array of instructors
    'skills' => [],         // Array of skills/topics
    'selectedFilters' => [], // Currently selected filters
    'action' => null,       // Form action URL
    'method' => 'GET',      // Form method
    'layout' => 'default',  // default, compact, horizontal
    'collapsible' => true   // Allow sections to collapse
])

@php
    $defaultPriceRanges = [
        ['id' => 'free', 'name' => 'Free', 'min' => 0, 'max' => 0],
        ['id' => 'paid', 'name' => 'Paid', 'min' => 0.01, 'max' => null],
        ['id' => 'under_50', 'name' => 'Under $50', 'min' => 0.01, 'max' => 50],
        ['id' => '50_100', 'name' => '$50 - $100', 'min' => 50, 'max' => 100],
        ['id' => 'over_100', 'name' => 'Over $100', 'min' => 100, 'max' => null]
    ];

    $defaultDurations = [
        ['id' => '0_2', 'name' => '0-2 Hours', 'min' => 0, 'max' => 120],
        ['id' => '3_6', 'name' => '3-6 Hours', 'min' => 180, 'max' => 360],
        ['id' => '7_12', 'name' => '7-12 Hours', 'min' => 420, 'max' => 720],
        ['id' => '13_20', 'name' => '13-20 Hours', 'min' => 780, 'max' => 1200],
        ['id' => '21_plus', 'name' => '21+ Hours', 'min' => 1260, 'max' => null]
    ];

    $defaultLevels = [
        ['id' => 'beginner', 'name' => 'Beginner'],
        ['id' => 'intermediate', 'name' => 'Intermediate'],
        ['id' => 'advanced', 'name' => 'Advanced']
    ];

    $priceRanges = !empty($priceRanges) ? $priceRanges : $defaultPriceRanges;
    $durations = !empty($durations) ? $durations : $defaultDurations;
    $levels = !empty($levels) ? $levels : $defaultLevels;
@endphp

<form action="{{ $action }}" method="{{ $method }}" class="course-filters {{ $layout }} {{ $attributes->get('class') }}">
    <!-- Categories Filter -->
    @if(!empty($categories))
        <div class="filter-section mb-4">
            <div class="filter-header d-flex justify-content-between align-items-center {{ $collapsible ? 'collapsed' : '' }}"
                 data-bs-toggle="{{ $collapsible ? 'collapse' : '' }}"
                 data-bs-target="#categoriesCollapse"
                 aria-expanded="{{ $collapsible ? 'false' : 'true' }}">
                <h6 class="mb-0">Categories</h6>
                @if($collapsible)
                    <i class="fas fa-chevron-down"></i>
                @endif
            </div>

            <div class="collapse {{ $collapsible ? '' : 'show' }}" id="categoriesCollapse">
                <div class="filter-body pt-2">
                    @foreach($categories as $category)
                        <div class="form-check">
                            <input type="checkbox"
                                   class="form-check-input"
                                   id="category_{{ $category['id'] }}"
                                   name="categories[]"
                                   value="{{ $category['id'] }}"
                                   {{ in_array($category['id'], $selectedFilters['categories'] ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="category_{{ $category['id'] }}">
                                {{ $category['name'] }}
                                @if(isset($category['count']))
                                    <span class="text-muted ms-1">({{ $category['count'] }})</span>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Price Range Filter -->
    <div class="filter-section mb-4">
        <div class="filter-header d-flex justify-content-between align-items-center {{ $collapsible ? 'collapsed' : '' }}"
             data-bs-toggle="{{ $collapsible ? 'collapse' : '' }}"
             data-bs-target="#priceCollapse"
             aria-expanded="{{ $collapsible ? 'false' : 'true' }}">
            <h6 class="mb-0">Price</h6>
            @if($collapsible)
                <i class="fas fa-chevron-down"></i>
            @endif
        </div>

        <div class="collapse {{ $collapsible ? '' : 'show' }}" id="priceCollapse">
            <div class="filter-body pt-2">
                @foreach($priceRanges as $range)
                    <div class="form-check">
                        <input type="radio"
                               class="form-check-input"
                               id="price_{{ $range['id'] }}"
                               name="price_range"
                               value="{{ $range['id'] }}"
                               {{ ($selectedFilters['price_range'] ?? '') === $range['id'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="price_{{ $range['id'] }}">
                            {{ $range['name'] }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Rating Filter -->
    <div class="filter-section mb-4">
        <div class="filter-header d-flex justify-content-between align-items-center {{ $collapsible ? 'collapsed' : '' }}"
             data-bs-toggle="{{ $collapsible ? 'collapse' : '' }}"
             data-bs-target="#ratingCollapse"
             aria-expanded="{{ $collapsible ? 'false' : 'true' }}">
            <h6 class="mb-0">Rating</h6>
            @if($collapsible)
                <i class="fas fa-chevron-down"></i>
            @endif
        </div>

        <div class="collapse {{ $collapsible ? '' : 'show' }}" id="ratingCollapse">
            <div class="filter-body pt-2">
                @foreach($ratings as $rating)
                    <div class="form-check">
                        <input type="radio"
                               class="form-check-input"
                               id="rating_{{ $rating }}"
                               name="rating"
                               value="{{ $rating }}"
                               {{ ($selectedFilters['rating'] ?? '') == $rating ? 'checked' : '' }}>
                        <label class="form-check-label" for="rating_{{ $rating }}">
                            <div class="d-flex align-items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating ? 'text-warning' : 'text-muted' }} small"></i>
                                @endfor
                                <span class="ms-1">& up</span>
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Level Filter -->
    <div class="filter-section mb-4">
        <div class="filter-header d-flex justify-content-between align-items-center {{ $collapsible ? 'collapsed' : '' }}"
             data-bs-toggle="{{ $collapsible ? 'collapse' : '' }}"
             data-bs-target="#levelCollapse"
             aria-expanded="{{ $collapsible ? 'false' : 'true' }}">
            <h6 class="mb-0">Level</h6>
            @if($collapsible)
                <i class="fas fa-chevron-down"></i>
            @endif
        </div>

        <div class="collapse {{ $collapsible ? '' : 'show' }}" id="levelCollapse">
            <div class="filter-body pt-2">
                @foreach($levels as $level)
                    <div class="form-check">
                        <input type="checkbox"
                               class="form-check-input"
                               id="level_{{ $level['id'] }}"
                               name="levels[]"
                               value="{{ $level['id'] }}"
                               {{ in_array($level['id'], $selectedFilters['levels'] ?? []) ? 'checked' : '' }}>
                        <label class="form-check-label" for="level_{{ $level['id'] }}">
                            {{ $level['name'] }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Duration Filter -->
    <div class="filter-section mb-4">
        <div class="filter-header d-flex justify-content-between align-items-center {{ $collapsible ? 'collapsed' : '' }}"
             data-bs-toggle="{{ $collapsible ? 'collapse' : '' }}"
             data-bs-target="#durationCollapse"
             aria-expanded="{{ $collapsible ? 'false' : 'true' }}">
            <h6 class="mb-0">Duration</h6>
            @if($collapsible)
                <i class="fas fa-chevron-down"></i>
            @endif
        </div>

        <div class="collapse {{ $collapsible ? '' : 'show' }}" id="durationCollapse">
            <div class="filter-body pt-2">
                @foreach($durations as $duration)
                    <div class="form-check">
                        <input type="radio"
                               class="form-check-input"
                               id="duration_{{ $duration['id'] }}"
                               name="duration"
                               value="{{ $duration['id'] }}"
                               {{ ($selectedFilters['duration'] ?? '') === $duration['id'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="duration_{{ $duration['id'] }}">
                            {{ $duration['name'] }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Languages Filter -->
    @if(!empty($languages))
        <div class="filter-section mb-4">
            <div class="filter-header d-flex justify-content-between align-items-center {{ $collapsible ? 'collapsed' : '' }}"
                 data-bs-toggle="{{ $collapsible ? 'collapse' : '' }}"
                 data-bs-target="#languageCollapse"
                 aria-expanded="{{ $collapsible ? 'false' : 'true' }}">
                <h6 class="mb-0">Language</h6>
                @if($collapsible)
                    <i class="fas fa-chevron-down"></i>
                @endif
            </div>

            <div class="collapse {{ $collapsible ? '' : 'show' }}" id="languageCollapse">
                <div class="filter-body pt-2">
                    @foreach($languages as $language)
                        <div class="form-check">
                            <input type="checkbox"
                                   class="form-check-input"
                                   id="language_{{ $language['id'] }}"
                                   name="languages[]"
                                   value="{{ $language['id'] }}"
                                   {{ in_array($language['id'], $selectedFilters['languages'] ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="language_{{ $language['id'] }}">
                                {{ $language['name'] }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Instructors Filter -->
    @if(!empty($instructors))
        <div class="filter-section mb-4">
            <div class="filter-header d-flex justify-content-between align-items-center {{ $collapsible ? 'collapsed' : '' }}"
                 data-bs-toggle="{{ $collapsible ? 'collapse' : '' }}"
                 data-bs-target="#instructorCollapse"
                 aria-expanded="{{ $collapsible ? 'false' : 'true' }}">
                <h6 class="mb-0">Instructor</h6>
                @if($collapsible)
                    <i class="fas fa-chevron-down"></i>
                @endif
            </div>

            <div class="collapse {{ $collapsible ? '' : 'show' }}" id="instructorCollapse">
                <div class="filter-body pt-2">
                    @foreach($instructors as $instructor)
                        <div class="form-check">
                            <input type="checkbox"
                                   class="form-check-input"
                                   id="instructor_{{ $instructor['id'] }}"
                                   name="instructors[]"
                                   value="{{ $instructor['id'] }}"
                                   {{ in_array($instructor['id'], $selectedFilters['instructors'] ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="instructor_{{ $instructor['id'] }}">
                                {{ $instructor['name'] }}
                                @if(isset($instructor['count']))
                                    <span class="text-muted ms-1">({{ $instructor['count'] }})</span>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Skills/Topics Filter -->
    @if(!empty($skills))
        <div class="filter-section mb-4">
            <div class="filter-header d-flex justify-content-between align-items-center {{ $collapsible ? 'collapsed' : '' }}"
                 data-bs-toggle="{{ $collapsible ? 'collapse' : '' }}"
                 data-bs-target="#skillsCollapse"
                 aria-expanded="{{ $collapsible ? 'false' : 'true' }}">
                <h6 class="mb-0">Skills</h6>
                @if($collapsible)
                    <i class="fas fa-chevron-down"></i>
                @endif
            </div>

            <div class="collapse {{ $collapsible ? '' : 'show' }}" id="skillsCollapse">
                <div class="filter-body pt-2">
                    @foreach($skills as $skill)
                        <div class="form-check">
                            <input type="checkbox"
                                   class="form-check-input"
                                   id="skill_{{ $skill['id'] }}"
                                   name="skills[]"
                                   value="{{ $skill['id'] }}"
                                   {{ in_array($skill['id'], $selectedFilters['skills'] ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="skill_{{ $skill['id'] }}">
                                {{ $skill['name'] }}
                                @if(isset($skill['count']))
                                    <span class="text-muted ms-1">({{ $skill['count'] }})</span>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Filter Actions -->
    <div class="filter-actions">
        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
        <button type="reset" class="btn btn-light w-100 mt-2">Clear All</button>
    </div>
</form>

@push('styles')
<style>
    .course-filters .filter-section {
        border-bottom: 1px solid var(--bs-border-color);
    }

    .course-filters .filter-header {
        padding: 0.5rem 0;
        cursor: pointer;
    }

    .course-filters .filter-header i {
        transition: transform 0.2s;
    }

    .course-filters .filter-header.collapsed i {
        transform: rotate(-90deg);
    }

    .course-filters .filter-body {
        padding-bottom: 1rem;
    }

    .course-filters.horizontal {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .course-filters.horizontal .filter-section {
        border-bottom: none;
        margin-bottom: 0;
    }

    .course-filters.compact .filter-body {
        max-height: 200px;
        overflow-y: auto;
    }
</style>
@endpush

{{-- Usage Example:
@php
    $categories = [
        ['id' => 1, 'name' => 'Web Development', 'count' => 150],
        ['id' => 2, 'name' => 'Design', 'count' => 120],
        ['id' => 3, 'name' => 'Business', 'count' => 80]
    ];

    $languages = [
        ['id' => 'en', 'name' => 'English'],
        ['id' => 'es', 'name' => 'Spanish'],
        ['id' => 'fr', 'name' => 'French']
    ];

    $instructors = [
        ['id' => 1, 'name' => 'John Doe', 'count' => 15],
        ['id' => 2, 'name' => 'Jane Smith', 'count' => 12]
    ];

    $skills = [
        ['id' => 1, 'name' => 'JavaScript', 'count' => 50],
        ['id' => 2, 'name' => 'Python', 'count' => 45],
        ['id' => 3, 'name' => 'UI Design', 'count' => 30]
    ];
@endphp

<!-- Default Course Filters -->
<x-ui.course-filters
    :categories="$categories"
    :languages="$languages"
    :instructors="$instructors"
    :skills="$skills"
    action="{{ route('courses.index') }}"
/>

<!-- Compact Course Filters -->
<x-ui.course-filters
    :categories="$categories"
    :languages="$languages"
    layout="compact"
    :collapsible="false"
    action="{{ route('courses.index') }}"
/>

<!-- Horizontal Course Filters -->
<x-ui.course-filters
    :categories="$categories"
    :languages="$languages"
    layout="horizontal"
    :collapsible="false"
    action="{{ route('courses.index') }}"
/>
--}}
