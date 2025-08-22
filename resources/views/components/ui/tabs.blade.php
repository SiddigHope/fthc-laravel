@props([
    'id',
    'tabs' => [],           // Array of ['id' => 'tab1', 'title' => 'Tab 1', 'icon' => 'fas fa-home'] items
    'activeTab' => null,    // Active tab ID
    'type' => 'tabs',       // tabs, pills
    'vertical' => false,    // Vertical tabs
    'justified' => false,   // Equal width tabs
    'filled' => false,      // Filled background
    'fadeEffect' => true    // Content fade effect
])

@php
    $navClasses = [
        'nav',
        "nav-{$type}",
        $vertical ? 'flex-column' : '',
        $justified ? 'nav-justified' : '',
        $filled ? 'nav-fill' : '',
        $attributes->get('class')
    ];

    // If no active tab is specified, use the first tab
    $activeTab = $activeTab ?? $tabs[0]['id'] ?? null;
@endphp

<div class="{{ $vertical ? 'd-flex align-items-start' : '' }}">
    {{-- Nav tabs --}}
    <ul class="{{ implode(' ', array_filter($navClasses)) }}"
        id="{{ $id }}"
        role="tablist">
        @foreach($tabs as $tab)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $tab['id'] === $activeTab ? 'active' : '' }}"
                        id="{{ $tab['id'] }}-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#{{ $tab['id'] }}-content"
                        type="button"
                        role="tab"
                        aria-controls="{{ $tab['id'] }}-content"
                        aria-selected="{{ $tab['id'] === $activeTab ? 'true' : 'false' }}">
                    @if(isset($tab['icon']))
                        <i class="{{ $tab['icon'] }} me-2"></i>
                    @endif
                    {{ $tab['title'] }}
                </button>
            </li>
        @endforeach
    </ul>

    {{-- Tab content --}}
    <div class="tab-content {{ $vertical ? 'flex-grow-1 ms-3' : 'mt-2' }}" id="{{ $id }}Content">
        {{ $slot }}
    </div>
</div>

{{-- Usage Example:
@php
    $tabItems = [
        ['id' => 'home', 'title' => 'Home', 'icon' => 'fas fa-home'],
        ['id' => 'profile', 'title' => 'Profile', 'icon' => 'fas fa-user'],
        ['id' => 'contact', 'title' => 'Contact', 'icon' => 'fas fa-envelope']
    ];
@endphp

<x-ui.tabs id="myTabs" :tabs="$tabItems" type="pills" justified>
    <div class="tab-pane fade show active" id="home-content" role="tabpanel" aria-labelledby="home-tab">
        Home content
    </div>
    <div class="tab-pane fade" id="profile-content" role="tabpanel" aria-labelledby="profile-tab">
        Profile content
    </div>
    <div class="tab-pane fade" id="contact-content" role="tabpanel" aria-labelledby="contact-tab">
        Contact content
    </div>
</x-ui.tabs>
--}}
