@props([
    'title' => '',           // Certificate title
    'recipient' => '',      // Recipient name
    'course' => '',         // Course name
    'completion_date' => null, // Date of completion
    'instructor' => null,    // Instructor details
    'duration' => '',       // Course duration
    'grade' => null,        // Final grade or score
    'skills' => [],         // Skills acquired
    'certificate_id' => '',  // Unique certificate ID
    'logo' => null,         // Organization logo
    'background' => null,    // Certificate background image
    'variant' => 'default', // default, minimal, preview
    'orientation' => 'landscape', // landscape, portrait
    'downloadable' => true  // Whether certificate can be downloaded
])

@php
    $containerClasses = [
        'certificate-container',
        'certificate-' . $orientation,
        $variant === 'preview' ? 'certificate-preview' : '',
        $attributes->get('class')
    ];

    $formatDate = function($date) {
        return $date ? \Carbon\Carbon::parse($date)->format('F d, Y') : '';
    };
@endphp

<div class="{{ implode(' ', array_filter($containerClasses)) }}">
    <div class="certificate"
         style="{{ $background ? "background-image: url('" . asset($background) . "')" : '' }}">

        <!-- Certificate Header -->
        <div class="certificate-header text-center mb-4">
            @if($logo)
                <img src="{{ asset($logo) }}"
                     class="certificate-logo mb-3"
                     alt="Organization logo">
            @endif

            <h6 class="text-muted text-uppercase mb-2">Certificate of Completion</h6>
            <h2 class="certificate-title mb-0">{{ $title }}</h2>
        </div>

        <!-- Certificate Body -->
        <div class="certificate-body text-center mb-4">
            <p class="recipient-text mb-1">This is to certify that</p>
            <h3 class="recipient-name mb-3">{{ $recipient }}</h3>
            <p class="course-text mb-1">has successfully completed the course</p>
            <h4 class="course-name mb-3">{{ $course }}</h4>

            @if($completion_date)
                <p class="completion-date mb-3">
                    on {{ $formatDate($completion_date) }}
                </p>
            @endif

            @if($duration || $grade)
                <div class="certificate-details d-flex justify-content-center gap-4 mb-3">
                    @if($duration)
                        <div class="detail-item">
                            <span class="text-muted">Duration:</span>
                            <span class="fw-bold">{{ $duration }}</span>
                        </div>
                    @endif

                    @if($grade)
                        <div class="detail-item">
                            <span class="text-muted">Grade:</span>
                            <span class="fw-bold">{{ $grade }}</span>
                        </div>
                    @endif
                </div>
            @endif

            @if(count($skills) > 0 && $variant === 'default')
                <div class="certificate-skills mb-4">
                    <h6 class="text-muted mb-2">Skills Acquired</h6>
                    <div class="skills-list d-flex flex-wrap justify-content-center gap-2">
                        @foreach($skills as $skill)
                            <span class="badge bg-light text-dark">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Certificate Footer -->
        <div class="certificate-footer">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    @if($certificate_id)
                        <div class="certificate-id small text-muted">
                            Certificate ID: {{ $certificate_id }}
                        </div>
                    @endif
                </div>

                <div class="col-md-4 text-center">
                    @if($instructor)
                        <div class="instructor-signature">
                            @if(isset($instructor['signature']))
                                <img src="{{ asset($instructor['signature']) }}"
                                     class="signature-image mb-2"
                                     alt="Instructor signature">
                            @endif
                            <div class="instructor-name">{{ $instructor['name'] }}</div>
                            <div class="instructor-title small text-muted">{{ $instructor['title'] }}</div>
                        </div>
                    @endif
                </div>

                <div class="col-md-4 text-center">
                    @if($variant !== 'preview' && $downloadable)
                        <div class="certificate-actions">
                            <a href="#" class="btn btn-sm btn-primary download-certificate">
                                <i class="fas fa-download me-1"></i>
                                Download PDF
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if($variant === 'preview')
            <div class="certificate-watermark">PREVIEW</div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .certificate-container {
        padding: 2rem;
        background-color: var(--bs-light);
        border-radius: 0.5rem;
    }

    .certificate {
        background-color: white;
        border: 1px solid var(--bs-border-color);
        padding: 3rem;
        position: relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .certificate-landscape {
        aspect-ratio: 1.414 / 1;
    }

    .certificate-portrait {
        aspect-ratio: 1 / 1.414;
    }

    .certificate-preview {
        transform: scale(0.8);
        transform-origin: top center;
    }

    .certificate-logo {
        max-height: 80px;
        width: auto;
    }

    .certificate-title {
        color: var(--bs-primary);
        font-family: 'Times New Roman', serif;
    }

    .recipient-name {
        color: var(--bs-dark);
        font-family: 'Brush Script MT', cursive;
        font-size: 2.5rem;
    }

    .course-name {
        color: var(--bs-primary);
        font-weight: 600;
    }

    .signature-image {
        max-height: 60px;
        width: auto;
    }

    .certificate-watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        font-size: 6rem;
        opacity: 0.1;
        color: var(--bs-primary);
        pointer-events: none;
        font-weight: bold;
        white-space: nowrap;
    }

    .certificate-preview .certificate {
        pointer-events: none;
    }

    @media print {
        .certificate-container {
            padding: 0;
            background-color: transparent;
        }

        .certificate {
            border: none;
        }

        .certificate-actions {
            display: none;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle certificate download
        document.querySelectorAll('.download-certificate').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                window.print();
            });
        });
    });
</script>
@endpush

{{-- Usage Examples:
<!-- Default Certificate -->
<x-ui.certificate
    title="Web Development Mastery"
    recipient="John Doe"
    course="Advanced Web Development"
    completion_date="2023-06-20"
    duration="12 weeks"
    grade="A"
    certificate_id="WD-2023-001"
    logo="images/logo.png"
    background="images/certificate-bg.jpg"
    :skills="['HTML5', 'CSS3', 'JavaScript', 'React', 'Node.js']"
    :instructor="[
        'name' => 'Dr. Jane Smith',
        'title' => 'Lead Instructor',
        'signature' => 'images/signatures/jane-smith.png'
    ]"
/>

<!-- Minimal Certificate -->
<x-ui.certificate
    title="Course Completion"
    recipient="Alice Johnson"
    course="Digital Marketing Fundamentals"
    completion_date="2023-06-15"
    certificate_id="DM-2023-042"
    variant="minimal"
    orientation="portrait"
/>

<!-- Preview Certificate -->
<x-ui.certificate
    title="Data Science Certification"
    recipient="Bob Wilson"
    course="Data Science and Machine Learning"
    completion_date="2023-06-18"
    duration="16 weeks"
    grade="95%"
    :skills="['Python', 'Machine Learning', 'Data Analysis']"
    variant="preview"
    :downloadable="false"
/>
--}}
