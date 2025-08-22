@props([
    'title' => '',           // Resource title
    'description' => '',     // Resource description
    'type' => 'pdf',        // File type (pdf, video, audio, image, zip, doc, etc.)
    'size' => null,         // File size in bytes
    'url' => '#',           // Download URL
    'preview_url' => null,  // Preview URL for supported file types
    'downloads' => 0,       // Number of downloads
    'created_at' => null,   // Upload date
    'expires_at' => null,   // Expiration date
    'access' => 'public',   // public, enrolled, premium
    'variant' => 'default', // default, compact, detailed
    'protected' => false    // Whether file requires authentication
])

@php
    $fileTypes = [
        'pdf' => ['icon' => 'fa-file-pdf', 'color' => 'danger'],
        'doc' => ['icon' => 'fa-file-word', 'color' => 'primary'],
        'xls' => ['icon' => 'fa-file-excel', 'color' => 'success'],
        'ppt' => ['icon' => 'fa-file-powerpoint', 'color' => 'warning'],
        'zip' => ['icon' => 'fa-file-archive', 'color' => 'secondary'],
        'video' => ['icon' => 'fa-file-video', 'color' => 'info'],
        'audio' => ['icon' => 'fa-file-audio', 'color' => 'info'],
        'image' => ['icon' => 'fa-file-image', 'color' => 'primary'],
        'code' => ['icon' => 'fa-file-code', 'color' => 'dark'],
        'text' => ['icon' => 'fa-file-alt', 'color' => 'secondary']
    ];

    $fileInfo = $fileTypes[$type] ?? ['icon' => 'fa-file', 'color' => 'secondary'];

    $formatSize = function($bytes) {
        if ($bytes === null) return '';
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, 1) . ' ' . $units[$pow];
    };

    $cardClasses = [
        'resource-download card h-100',
        $variant === 'compact' ? 'card-compact' : '',
        $protected ? 'resource-protected' : '',
        $attributes->get('class')
    ];

    $isExpired = $expires_at && \Carbon\Carbon::parse($expires_at)->isPast();
    $canDownload = !$isExpired && ($access === 'public' || auth()->check());
@endphp

<div class="{{ implode(' ', array_filter($cardClasses)) }}">
    <div class="card-body">
        <div class="d-flex align-items-start">
            <!-- File Icon -->
            <div class="resource-icon me-3">
                <div class="icon-wrapper bg-{{ $fileInfo['color'] }} bg-opacity-10 text-{{ $fileInfo['color'] }}">
                    <i class="fas {{ $fileInfo['icon'] }}"></i>
                </div>
            </div>

            <div class="resource-content flex-grow-1">
                <!-- Resource Header -->
                <div class="resource-header mb-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="resource-title mb-0">{{ $title }}</h5>
                        @if($protected)
                            <i class="fas fa-lock text-warning"
                               data-bs-toggle="tooltip"
                               title="Authentication required"></i>
                        @endif
                    </div>

                    @if($description && $variant !== 'compact')
                        <p class="resource-description text-muted mb-0 mt-1">
                            {{ $description }}
                        </p>
                    @endif
                </div>

                <!-- Resource Meta -->
                <div class="resource-meta d-flex align-items-center text-muted small mb-3">
                    @if($size)
                        <span class="me-3">
                            <i class="fas fa-weight-hanging me-1"></i>
                            {{ $formatSize($size) }}
                        </span>
                    @endif

                    @if($downloads > 0)
                        <span class="me-3">
                            <i class="fas fa-download me-1"></i>
                            {{ $downloads }} {{ Str::plural('download', $downloads) }}
                        </span>
                    @endif

                    @if($created_at)
                        <span class="me-3" title="{{ $created_at }}">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($created_at)->diffForHumans() }}
                        </span>
                    @endif

                    @if($expires_at)
                        <span class="{{ $isExpired ? 'text-danger' : '' }}" title="{{ $expires_at }}">
                            <i class="far fa-clock me-1"></i>
                            {{ $isExpired ? 'Expired' : 'Expires' }}
                            {{ \Carbon\Carbon::parse($expires_at)->diffForHumans() }}
                        </span>
                    @endif
                </div>

                <!-- Resource Actions -->
                <div class="resource-actions d-flex align-items-center">
                    @if($preview_url && in_array($type, ['pdf', 'image', 'video']))
                        <a href="{{ $preview_url }}"
                           class="btn btn-sm btn-light me-2"
                           target="_blank">
                            <i class="fas fa-eye me-1"></i>
                            Preview
                        </a>
                    @endif

                    @if($canDownload)
                        <a href="{{ $url }}"
                           class="btn btn-sm btn-primary"
                           download>
                            <i class="fas fa-download me-1"></i>
                            Download
                        </a>
                    @else
                        <button class="btn btn-sm btn-secondary" disabled>
                            @if($isExpired)
                                <i class="fas fa-clock me-1"></i>
                                Expired
                            @else
                                <i class="fas fa-lock me-1"></i>
                                {{ $access === 'enrolled' ? 'Enroll to Download' : 'Premium Content' }}
                            @endif
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .resource-download {
        transition: all 0.3s ease;
    }

    .resource-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
    }

    .resource-icon .icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .resource-download.card-compact .resource-icon .icon-wrapper {
        width: 36px;
        height: 36px;
        font-size: 1rem;
    }

    .resource-protected {
        position: relative;
    }

    .resource-protected::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--bs-warning) 0%, var(--bs-danger) 100%);
        border-radius: 3px 3px 0 0;
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Resource Download -->
<x-ui.resource-download
    title="Course Syllabus"
    description="Complete course outline and learning objectives"
    type="pdf"
    :size="1024576"
    url="/downloads/syllabus.pdf"
    preview_url="/preview/syllabus.pdf"
    :downloads="150"
    created_at="2023-06-15 10:00:00"
/>

<!-- Protected Premium Resource -->
<x-ui.resource-download
    title="Project Source Code"
    description="Complete source code with documentation"
    type="zip"
    :size="5242880"
    url="/downloads/project.zip"
    access="premium"
    :protected="true"
    created_at="2023-06-10 15:30:00"
    expires_at="2023-12-31 23:59:59"
/>

<!-- Compact Video Resource -->
<x-ui.resource-download
    title="Quick Start Guide"
    type="video"
    :size="20971520"
    url="/downloads/quickstart.mp4"
    preview_url="/preview/quickstart.mp4"
    variant="compact"
/>

<!-- Detailed Document Resource -->
<x-ui.resource-download
    title="Advanced Techniques Handbook"
    description="In-depth guide covering advanced topics and best practices"
    type="doc"
    :size="3145728"
    url="/downloads/handbook.docx"
    :downloads="75"
    access="enrolled"
    variant="detailed"
    created_at="2023-06-01 09:00:00"
/>
--}}
