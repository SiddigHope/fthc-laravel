@props(['stats'])

<div class="row g-4">
    @foreach($stats as $icon => $stat)
        <div class="col-sm-6 col-lg-3">
            <div class="card card-body shadow text-center h-100">
                <div class="icon-lg bg-{{ $stat['color'] ?? 'primary' }} rounded-circle text-white mx-auto mb-3">
                    <i class="{{ $icon }}"></i>
                </div>
                <h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{ $stat['value'] }}" data-purecounter-duration="1">0</h2>
                <span class="mb-0 h6 fw-light">{{ $stat['label'] }}</span>
            </div>
        </div>
    @endforeach
</div>
