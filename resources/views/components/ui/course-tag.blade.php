@props([
    'tags' => [],            // Array of tag objects or strings
    'variant' => 'default',  // default, pill, outline, minimal
    'size' => 'md',         // sm, md, lg
    'color_scheme' => null,  // Bootstrap color classes or custom colors
    'clickable' => true,     // Make tags clickable
    'removable' => false,    // Show remove button
    'max_tags' => null,      // Maximum number of tags to display
    'show_count' => false,   // Show total tag count
    'with_icon' => false,    // Show tag icon if available
    'truncate' => false      // Truncate long tag names
])

@php
    // Process tags array to standardize format
    $processedTags = collect($tags)->map(function($tag) {
        if (is_string($tag)) {
            return ['name' => $tag, 'slug' => Str::slug($tag)];
        }
        return $tag;
    });

    // Apply max tags limit if specified
    if ($max_tags) {
        $hiddenCount = count($processedTags) - $max_tags;
        $processedTags = $processedTags->take($max_tags);
    }

    // Generate container classes
    $containerClasses = [
        'course-tags',
        'variant-' . $variant,
        'size-' . $size,
        $clickable ? 'clickable' : '',
        $attributes->get('class')
    ];

    // Generate tag classes based on variant
    $tagClasses = match($variant) {
        'pill' => 'rounded-pill',
        'outline' => 'border border-2',
        'minimal' => 'bg-transparent',
        default => 'rounded'
    };

    // Color schemes for tags
    $colors = ['primary', 'success', 'info', 'warning', 'danger', 'secondary'];
@endphp

<div class="{{ implode(' ', array_filter($containerClasses)) }}">
    <div class="tags-wrapper d-flex flex-wrap gap-2 align-items-center">
        @foreach($processedTags as $index => $tag)
            @php
                $tagColor = $color_scheme ?? $colors[$index % count($colors)];
                $tagTextClass = $variant === 'minimal' ? 'text-'.$tagColor : '';
                $tagBgClass = $variant === 'minimal' ? 'bg-'.$tagColor.'-subtle' : 'bg-'.$tagColor;
                $tagBorderClass = $variant === 'outline' ? 'border-'.$tagColor : '';
            @endphp

            <div class="tag-item {{ $tagClasses }} {{ $tagBgClass }} {{ $tagBorderClass }} {{ $tagTextClass }}">
                @if($clickable)
                    <a href="{{ route('courses.tag', $tag['slug']) }}"
                       class="tag-link d-inline-flex align-items-center">
                @endif

                @if($with_icon && isset($tag['icon']))
                    <i class="{{ $tag['icon'] }} me-1"></i>
                @endif

                <span class="tag-name {{ $truncate ? 'text-truncate' : '' }}">
                    {{ $tag['name'] }}
                </span>

                @if(isset($tag['count']) && $show_count)
                    <span class="tag-count ms-1">({{ $tag['count'] }})</span>
                @endif

                @if($clickable)
                    </a>
                @endif

                @if($removable)
                    <button type="button"
                            class="btn-close btn-close-white ms-2"
                            aria-label="Remove tag"
                            onclick="removeTag('{{ $tag['slug'] }}')"></button>
                @endif
            </div>
        @endforeach

        @if(isset($hiddenCount) && $hiddenCount > 0)
            <div class="more-tags tag-item {{ $tagClasses }} bg-light text-dark"
                 data-bs-toggle="tooltip"
                 title="{{ $hiddenCount }} more {{ Str::plural('tag', $hiddenCount) }}">
                +{{ $hiddenCount }}
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .course-tags {
        --tag-font-size: 0.875rem;
        --tag-padding: 0.5rem 0.75rem;
    }

    /* Size Variants */
    .course-tags.size-sm {
        --tag-font-size: 0.75rem;
        --tag-padding: 0.25rem 0.5rem;
    }

    .course-tags.size-lg {
        --tag-font-size: 1rem;
        --tag-padding: 0.75rem 1rem;
    }

    /* Tag Item Styles */
    .course-tags .tag-item {
        display: inline-flex;
        align-items: center;
        padding: var(--tag-padding);
        font-size: var(--tag-font-size);
        color: var(--bs-white);
        transition: all 0.2s ease;
    }

    /* Minimal Variant */
    .course-tags.variant-minimal .tag-item {
        color: inherit;
    }

    /* Clickable Tags */
    .course-tags.clickable .tag-item {
        cursor: pointer;
    }

    .course-tags.clickable .tag-item:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    /* Tag Link */
    .course-tags .tag-link {
        color: inherit;
        text-decoration: none;
    }

    /* Tag Name */
    .course-tags .tag-name.text-truncate {
        max-width: 150px;
    }

    /* Tag Count */
    .course-tags .tag-count {
        font-size: 0.85em;
        opacity: 0.9;
    }

    /* More Tags Indicator */
    .course-tags .more-tags {
        cursor: help;
    }

    /* Remove Button */
    .course-tags .btn-close {
        font-size: calc(var(--tag-font-size) * 0.8);
        padding: 0.25rem;
    }

    /* Icon Styles */
    .course-tags .tag-item i {
        font-size: calc(var(--tag-font-size) * 1.1);
    }

    /* Outline Variant */
    .course-tags.variant-outline .tag-item {
        background-color: transparent !important;
        border-width: 1px !important;
    }

    /* Animation */
    .course-tags .tag-item {
        animation: tagFadeIn 0.3s ease-in-out;
    }

    @keyframes tagFadeIn {
        from {
            opacity: 0;
            transform: translateY(5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@push('scripts')
@if($removable)
<script>
    function removeTag(slug) {
        // Emit custom event for tag removal
        const event = new CustomEvent('tag-removed', {
            detail: { slug: slug }
        });
        document.dispatchEvent(event);

        // Find and remove the tag element with animation
        const tagElement = event.target.closest('.tag-item');
        if (tagElement) {
            tagElement.style.opacity = '0';
            tagElement.style.transform = 'scale(0.8)';
            setTimeout(() => tagElement.remove(), 300);
        }
    }
</script>
@endif
@endpush

{{-- Usage Examples:
<!-- Default Tags -->
<x-ui.course-tag
    :tags="['Web Development', 'JavaScript', 'React']"
/>

<!-- Pill Style Tags with Icons -->
<x-ui.course-tag
    :tags="[
        ['name' => 'HTML', 'slug' => 'html', 'icon' => 'fab fa-html5'],
        ['name' => 'CSS', 'slug' => 'css', 'icon' => 'fab fa-css3'],
        ['name' => 'JavaScript', 'slug' => 'javascript', 'icon' => 'fab fa-js']
    ]"
    variant="pill"
    :with_icon="true"
/>

<!-- Minimal Tags with Count -->
<x-ui.course-tag
    :tags="[
        ['name' => 'Design', 'slug' => 'design', 'count' => 42],
        ['name' => 'UI/UX', 'slug' => 'ui-ux', 'count' => 28],
        ['name' => 'Figma', 'slug' => 'figma', 'count' => 15]
    ]"
    variant="minimal"
    :show_count="true"
    size="lg"
/>

<!-- Removable Tags with Max Limit -->
<x-ui.course-tag
    :tags="['PHP', 'Laravel', 'MySQL', 'API', 'Backend']"
    variant="outline"
    :removable="true"
    :max_tags="3"
    size="sm"
/>
--}}
