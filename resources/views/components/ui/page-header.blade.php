@props([
    'title',
    'subtitle' => null,
    'image' => null,
    'imageAlt' => '',
    'bgClass' => 'bg-light'
])

<section class="{{ $bgClass }} py-5">
    <div class="container">
        <div class="row g-4 g-md-5 align-items-center">
            <div class="col-lg-6">
                <h1 class="mb-3">{{ $title }}</h1>
                @if($subtitle)
                    <p class="mb-0">{{ $subtitle }}</p>
                @endif
                {{ $slot }}
            </div>
            @if($image)
                <div class="col-lg-6 text-lg-end">
                    <img src="{{ asset($image) }}" class="h-300px" alt="{{ $imageAlt }}">
                </div>
            @endif
        </div>
    </div>
</section>
