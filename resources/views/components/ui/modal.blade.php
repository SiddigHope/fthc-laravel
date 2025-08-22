@props([
    'id',
    'title' => null,
    'size' => '',           // sm, lg, xl
    'fullscreen' => false,   // true, sm-down, md-down, lg-down, xl-down, xxl-down
    'scrollable' => false,
    'centered' => true,
    'staticBackdrop' => false,
    'closeButton' => true,
    'footer' => null
])

@php
    $modalClasses = [
        'modal fade',
        $attributes->get('class')
    ];

    $dialogClasses = [
        'modal-dialog',
        $size ? 'modal-' . $size : '',
        $centered ? 'modal-dialog-centered' : '',
        $scrollable ? 'modal-dialog-scrollable' : '',
        $fullscreen ? ($fullscreen === true ? 'modal-fullscreen' : 'modal-fullscreen-' . $fullscreen) : ''
    ];
@endphp

<div id="{{ $id }}"
    class="{{ implode(' ', array_filter($modalClasses)) }}"
    tabindex="-1"
    aria-labelledby="{{ $id }}Label"
    aria-hidden="true"
    @if($staticBackdrop) data-bs-backdrop="static" data-bs-keyboard="false" @endif>

    <div class="{{ implode(' ', array_filter($dialogClasses)) }}">
        <div class="modal-content">
            @if($title || $closeButton)
                <div class="modal-header">
                    @if($title)
                        <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                    @endif

                    @if($closeButton)
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    @endif
                </div>
            @endif

            <div class="modal-body">
                {{ $slot }}
            </div>

            @if($footer)
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Usage Example:
<x-ui.modal id="exampleModal" title="Modal Title" size="lg">
    <x-slot:footer>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </x-slot:footer>

    Modal content here...
</x-ui.modal>

<!-- Trigger button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch modal
</button>
--}}
