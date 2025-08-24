@props([
    'icon',
    'count',
    'suffix' => '',
    'label',
    'color' => 'primary'
])

<div class="col-sm-6 col-xl-3">
    <div class="d-flex justify-content-center align-items-center p-4 bg-{{ $color }} bg-opacity-10 rounded-3">
        <span class="display-6 lh-1 text-{{ $color }} mb-0"><i class="{{ $icon }}"></i></span>
        <div class="ms-4 h6 fw-normal mb-0">
            <div class="d-flex">
                <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{ $count }}" data-purecounter-delay="200">{{ $count }}</h5>
                @if($suffix)
                    <span class="mb-0 h5">{{ $suffix }}</span>
                @endif
            </div>
            <p class="mb-0">{{ $label }}</p>
        </div>
    </div>
</div>
