@props([
    'items' => [],
    'direction' => 'horizontal',
    'type' => 'default'
])

<div class="card card-body shadow p-4">
    <div @class([
        'd-flex gap-4',
        'flex-column' => $direction === 'vertical',
        'text-center' => $type === 'icon'
    ])>
        @foreach($items as $icon => $item)
            <div @class([
                'flex-grow-1' => $direction === 'horizontal',
                'text-center' => $type === 'icon'
            ])>
                @if($type === 'icon')
                    <div class="icon-lg bg-primary rounded-circle text-white mx-auto mb-3">
                        <i class="{{ $icon }}"></i>
                    </div>
                    <h4>{{ $item['title'] }}</h4>
                    <p class="mb-0">{{ $item['description'] }}</p>
                @else
                    <div class="d-flex align-items-center">
                        <i class="{{ $icon }} text-primary me-2 fs-4"></i>
                        <div>
                            <h5 class="mb-1">{{ $item['title'] }}</h5>
                            <p class="mb-0">{{ $item['description'] }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
