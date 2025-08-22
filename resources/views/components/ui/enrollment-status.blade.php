@props([
    'status' => 'enrolled',    // enrolled, completed, expired, pending, cancelled
    'enrollment_date' => null, // Date of enrollment
    'expiry_date' => null,    // Access expiry date
    'progress' => null,       // Course progress percentage
    'certificate' => null,    // Certificate details if completed
    'last_activity' => null,  // Last activity date
    'access_type' => 'full',  // full, limited, lifetime
    'variant' => 'default',   // default, compact, detailed
    'can_extend' => false,    // Whether user can extend access
    'can_upgrade' => false    // Whether user can upgrade access
])

@php
    $statusColors = [
        'enrolled' => 'primary',
        'completed' => 'success',
        'expired' => 'danger',
        'pending' => 'warning',
        'cancelled' => 'secondary'
    ];

    $statusIcons = [
        'enrolled' => 'fa-graduation-cap',
        'completed' => 'fa-check-circle',
        'expired' => 'fa-clock',
        'pending' => 'fa-hourglass-half',
        'cancelled' => 'fa-times-circle'
    ];

    $color = $statusColors[$status] ?? 'primary';
    $icon = $statusIcons[$status] ?? 'fa-info-circle';

    $cardClasses = [
        'enrollment-status-card card',
        'border-' . $color,
        $variant === 'compact' ? 'card-compact' : '',
        $attributes->get('class')
    ];

    $formatDate = function($date) {
        return $date ? \Carbon\Carbon::parse($date)->format('M d, Y') : '';
    };

    $getRemainingDays = function() use ($expiry_date) {
        if (!$expiry_date) return null;
        $days = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($expiry_date), false);
        return $days > 0 ? $days : 0;
    };

    $remainingDays = $getRemainingDays();
    $isExpiringSoon = $remainingDays !== null && $remainingDays <= 7 && $remainingDays > 0;
@endphp

<div class="{{ implode(' ', array_filter($cardClasses)) }}">
    <div class="card-body">
        <!-- Status Header -->
        <div class="status-header d-flex align-items-center mb-3">
            <div class="status-icon me-3">
                <div class="icon-wrapper bg-{{ $color }} bg-opacity-10 text-{{ $color }}">
                    <i class="fas {{ $icon }}"></i>
                </div>
            </div>

            <div class="status-content">
                <h5 class="status-title mb-1">
                    {{ ucfirst($status) }}
                    @if($access_type === 'lifetime')
                        <span class="badge bg-success ms-2">Lifetime Access</span>
                    @endif
                </h5>
                @if($enrollment_date)
                    <p class="status-subtitle text-muted mb-0 small">
                        Enrolled on {{ $formatDate($enrollment_date) }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Status Details -->
        @if($variant !== 'compact')
            <div class="status-details mb-3">
                <!-- Progress Bar -->
                @if($progress !== null)
                    <div class="progress-section mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small">Course Progress</span>
                            <span class="small text-muted">{{ $progress }}%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-{{ $color }}"
                                 role="progressbar"
                                 style="width: {{ $progress }}%"
                                 aria-valuenow="{{ $progress }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Access Period -->
                @if($access_type !== 'lifetime')
                    <div class="access-period small mb-2">
                        <i class="far fa-calendar-alt text-muted me-2"></i>
                        @if($expiry_date)
                            Access until {{ $formatDate($expiry_date) }}
                            @if($isExpiringSoon)
                                <span class="badge bg-warning text-dark ms-2">
                                    Expires in {{ $remainingDays }} {{ Str::plural('day', $remainingDays) }}
                                </span>
                            @endif
                        @else
                            Unlimited access
                        @endif
                    </div>
                @endif

                <!-- Last Activity -->
                @if($last_activity && $variant === 'detailed')
                    <div class="last-activity small mb-2">
                        <i class="far fa-clock text-muted me-2"></i>
                        Last active {{ \Carbon\Carbon::parse($last_activity)->diffForHumans() }}
                    </div>
                @endif

                <!-- Certificate Info -->
                @if($certificate && $status === 'completed')
                    <div class="certificate-info small mb-2">
                        <i class="fas fa-award text-warning me-2"></i>
                        Certificate earned on {{ $formatDate($certificate['date']) }}
                        @if(isset($certificate['grade']))
                            with grade {{ $certificate['grade'] }}
                        @endif
                    </div>
                @endif
            </div>
        @endif

        <!-- Status Actions -->
        <div class="status-actions">
            @if($status === 'expired')
                @if($can_extend)
                    <button class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-sync-alt me-1"></i>
                        Extend Access
                    </button>
                @endif
            @elseif($status === 'enrolled')
                @if($can_upgrade)
                    <button class="btn btn-warning btn-sm me-2">
                        <i class="fas fa-arrow-up me-1"></i>
                        Upgrade Access
                    </button>
                @endif
                @if($progress === 100)
                    <button class="btn btn-success btn-sm">
                        <i class="fas fa-award me-1"></i>
                        Get Certificate
                    </button>
                @endif
            @elseif($status === 'completed' && $certificate)
                <a href="#" class="btn btn-primary btn-sm">
                    <i class="fas fa-download me-1"></i>
                    Download Certificate
                </a>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .enrollment-status-card {
        transition: all 0.3s ease;
    }

    .status-icon .icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .card-compact .status-icon .icon-wrapper {
        width: 36px;
        height: 36px;
        font-size: 1rem;
    }

    .progress {
        background-color: var(--bs-gray-200);
    }

    .progress-bar {
        transition: width 0.5s ease;
    }

    .certificate-info .fa-award {
        color: #ffc107;
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Enrollment Status -->
<x-ui.enrollment-status
    status="enrolled"
    enrollment_date="2023-06-01"
    expiry_date="2023-12-31"
    :progress="65"
    last_activity="2023-06-20 15:30:00"
/>

<!-- Completed Course with Certificate -->
<x-ui.enrollment-status
    status="completed"
    enrollment_date="2023-05-01"
    :progress="100"
    :certificate="[
        'date' => '2023-06-15',
        'grade' => 'A'
    ]"
    variant="detailed"
/>

<!-- Expired Access with Extension Option -->
<x-ui.enrollment-status
    status="expired"
    enrollment_date="2023-01-01"
    expiry_date="2023-06-01"
    :progress="45"
    :can_extend="true"
/>

<!-- Lifetime Access Status -->
<x-ui.enrollment-status
    status="enrolled"
    enrollment_date="2023-06-01"
    access_type="lifetime"
    :progress="30"
    variant="compact"
/>
--}}
