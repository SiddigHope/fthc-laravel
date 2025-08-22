<!-- Header START -->
<header class="navbar-light navbar-sticky header-static">
    <!-- Nav START -->
    <nav class="navbar navbar-expand-xl">
        <div class="container-fluid px-3 px-xl-5">
            <!-- Logo START -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="light-mode-item navbar-brand-item" src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                <img class="dark-mode-item navbar-brand-item" src="{{ asset('assets/images/logo-light.svg') }}" alt="logo">
            </a>
            <!-- Logo END -->

            <!-- Responsive navbar toggler -->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-animation">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>

            <!-- Main navbar START -->
            <div class="navbar-collapse w-100 collapse" id="navbarCollapse">
                <!-- Nav Main menu START -->
                <ul class="navbar-nav navbar-nav-scroll me-auto">
                    <!-- Nav items -->
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">{{ __('messages.about') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">{{ __('messages.contact') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('messages.courses') }}</a></li>
                </ul>
                <!-- Nav Main menu END -->

                <!-- Language Switcher START -->
                <div class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle" href="#" id="languageSwitcher" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe me-2"></i>{{ __('messages.language') }}
                    </a>
                    <ul class="dropdown-menu min-w-auto" aria-labelledby="languageSwitcher">
                        <li><a class="dropdown-item" href="{{ route('locale.switch', 'ar') }}"><img class="fa-fw me-2" src="{{ asset('assets/images/flags/sa.svg') }}" alt="">العربية</a></li>
                        <li><a class="dropdown-item" href="{{ route('locale.switch', 'en') }}"><img class="fa-fw me-2" src="{{ asset('assets/images/flags/uk.svg') }}" alt="">English</a></li>
                    </ul>
                </div>
                <!-- Language Switcher END -->

                <!-- Nav Search START -->
                <div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">
                    <div class="nav-item w-100">
                        <form class="position-relative">
                            <input class="form-control pe-5 bg-transparent" type="search" placeholder="{{ __('messages.search_placeholder') }}" aria-label="{{ __('messages.search') }}">
                            <button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 "></i></button>
                        </form>
                    </div>
                </div>
                <!-- Nav Search END -->
            </div>
            <!-- Main navbar END -->

            <!-- Profile START -->
            <div class="dropdown ms-1 ms-lg-0">
                <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/01.jpg') }}" alt="avatar">
                </a>
                <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
                    <!-- Profile info -->
                    <li class="px-3">
                        <div class="d-flex align-items-center">
                            <!-- Avatar -->
                            <div class="avatar me-3">
                                <img class="avatar-img rounded-circle shadow" src="{{ asset('assets/images/avatar/01.jpg') }}" alt="avatar">
                            </div>
                            <div>
                                <a class="h6" href="#">Guest User</a>
                                <p class="small m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <hr>
                    </li>
                    <!-- Links -->
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person fa-fw me-2"></i>{{ __('messages.profile') }}</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>{{ __('messages.settings') }}</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>{{ __('messages.help') }}</a></li>
                    <li><a class="dropdown-item bg-danger-soft-hover" href="#"><i class="bi bi-power fa-fw me-2"></i>{{ __('messages.sign_out') }}</a></li>
                </ul>
            </div>
            <!-- Profile START -->
        </div>
    </nav>
    <!-- Nav END -->
</header>
<!-- Header END -->
