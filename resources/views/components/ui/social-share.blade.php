@props([
    'url' => null,           // URL to share
    'title' => null,         // Title to share
    'description' => null,   // Description to share
    'image' => null,         // Image URL to share
    'platforms' => ['facebook', 'twitter', 'linkedin', 'whatsapp', 'telegram', 'email'], // Platforms to show
    'size' => 'md',          // sm, md, lg
    'variant' => 'icon',     // icon, text, icon-text
    'rounded' => false,      // Rounded buttons
    'outline' => false,      // Outline style
    'block' => false         // Full width buttons
])

@php
    $url = $url ?? url()->current();
    $title = $title ?? config('app.name');
    $description = $description ?? '';

    $sizes = [
        'sm' => 'btn-sm',
        'md' => '',
        'lg' => 'btn-lg'
    ];

    $platforms = array_map('strtolower', $platforms);

    $shareUrls = [
        'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
        'twitter' => "https://twitter.com/intent/tweet?url={$url}&text=" . urlencode($title),
        'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title=" . urlencode($title) . "&summary=" . urlencode($description),
        'whatsapp' => "https://wa.me/?text=" . urlencode($title . ' ' . $url),
        'telegram' => "https://t.me/share/url?url={$url}&text=" . urlencode($title),
        'email' => "mailto:?subject=" . urlencode($title) . "&body=" . urlencode($description . '\n\n' . $url)
    ];

    $icons = [
        'facebook' => 'fab fa-facebook-f',
        'twitter' => 'fab fa-twitter',
        'linkedin' => 'fab fa-linkedin-in',
        'whatsapp' => 'fab fa-whatsapp',
        'telegram' => 'fab fa-telegram-plane',
        'email' => 'fas fa-envelope'
    ];

    $colors = [
        'facebook' => 'btn-facebook',
        'twitter' => 'btn-twitter',
        'linkedin' => 'btn-linkedin',
        'whatsapp' => 'btn-success',
        'telegram' => 'btn-info',
        'email' => 'btn-secondary'
    ];

    $names = [
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'linkedin' => 'LinkedIn',
        'whatsapp' => 'WhatsApp',
        'telegram' => 'Telegram',
        'email' => 'Email'
    ];

    $buttonClasses = [
        $sizes[$size],
        $rounded ? 'rounded-pill' : '',
        $block ? 'w-100' : '',
        $variant === 'icon' ? 'btn-icon' : ''
    ];
@endphp

<div class="social-share d-flex {{ $block ? 'flex-column' : 'flex-wrap' }} gap-2">
    @foreach($platforms as $platform)
        @if(isset($shareUrls[$platform]))
            <a href="{{ $shareUrls[$platform] }}"
               target="_blank"
               rel="noopener noreferrer"
               class="btn {{ $outline ? 'btn-outline-' . substr($colors[$platform], 4) : $colors[$platform] }} {{ implode(' ', array_filter($buttonClasses)) }}"
               title="Share on {{ $names[$platform] }}"
               onclick="window.open(this.href, 'share-{{ $platform }}', 'width=600,height=400'); return false;">

                <i class="{{ $icons[$platform] }}"></i>
                @if($variant !== 'icon')
                    <span class="{{ $variant === 'icon-text' ? 'ms-2' : '' }}">{{ $names[$platform] }}</span>
                @endif
            </a>
        @endif
    @endforeach
</div>

@push('styles')
<style>
    .social-share .btn-facebook { --bs-btn-bg: #3b5998; --bs-btn-border-color: #3b5998; --bs-btn-hover-bg: #2d4373; --bs-btn-hover-border-color: #2d4373; }
    .social-share .btn-twitter { --bs-btn-bg: #1da1f2; --bs-btn-border-color: #1da1f2; --bs-btn-hover-bg: #0c85d0; --bs-btn-hover-border-color: #0c85d0; }
    .social-share .btn-linkedin { --bs-btn-bg: #0077b5; --bs-btn-border-color: #0077b5; --bs-btn-hover-bg: #005582; --bs-btn-hover-border-color: #005582; }

    .social-share .btn-icon {
        width: 2.5rem;
        height: 2.5rem;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .social-share .btn-sm.btn-icon {
        width: 2rem;
        height: 2rem;
    }

    .social-share .btn-lg.btn-icon {
        width: 3rem;
        height: 3rem;
    }
</style>
@endpush

{{-- Usage Example:
<!-- Icon Only Social Share -->
<x-ui.social-share
    url="https://example.com"
    title="Check out this awesome page!"
    description="This is a detailed description of the content."
    :platforms="['facebook', 'twitter', 'linkedin']"
    variant="icon"
    rounded
/>

<!-- Icon with Text Social Share -->
<x-ui.social-share
    :platforms="['facebook', 'twitter', 'whatsapp', 'telegram']"
    variant="icon-text"
    size="lg"
/>

<!-- Text Only Social Share with Outline Style -->
<x-ui.social-share
    variant="text"
    outline
    block
/>
--}}
