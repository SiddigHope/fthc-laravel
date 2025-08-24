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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                           href="{{ route('home') }}">{{ __('messages.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}"
                           href="{{ route('courses.index') }}">{{ __('messages.courses') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                           href="{{ route('about') }}">{{ __('messages.about') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                           href="{{ route('contact') }}">{{ __('messages.contact') }}</a>
                    </li>
                </ul>

                <!-- Right header -->
                <div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">
                    <!-- Theme switch -->
                    <div class="nav-item btn-group">
                        <button class="btn btn-light btn-sm mb-0" id="theme-switch" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('messages.theme_light') }}">
                           <i class="fas fa-moon fa-solid"></i>
                        </button>
                    </div>

                    <!-- Language switch -->
                    {{-- <div class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe me-2"></i>
                            <span class="d-none d-lg-inline-block">{{ app()->getLocale() === 'en' ? 'English' : 'العربية' }}</span>
                        </a>
                        <ul class="dropdown-menu min-w-auto" aria-labelledby="languageDropdown">
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                                   href="{{ route('locale.switch', 'en') }}">
                                    {{ __('messages.english') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() === 'ar' ? 'active' : '' }}"
                                   href="{{ route('locale.switch', 'ar') }}">
                                    {{ __('messages.arabic') }}
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
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
                {{-- <div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">
                    <div class="nav-item w-100">
                        <form class="position-relative">
                            <input class="form-control pe-5 bg-transparent" type="search" placeholder="{{ __('messages.search_placeholder') }}" aria-label="{{ __('messages.search') }}">
                            <button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 "></i></button>
                        </form>
                    </div>
                </div> --}}
                <!-- Nav Search END -->

                <!-- Profile START -->
                <div class="nav-item ms-2 ms-md-3 dropdown">
                    @auth
                        <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/default.svg') }}" alt="avatar">
                        </a>
                        <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
                            <!-- Profile info -->
                            <li class="px-3">
                                <div class="d-flex align-items-center">
                                    <!-- Avatar -->
                                    <div class="avatar me-3">
                                        <img class="avatar-img rounded-circle shadow" src="{{ asset('assets/images/avatar/default.svg') }}" alt="avatar">
                                    </div>
                                    <div>
                                        <p class="h6 mb-0">{{ Auth::user()->name }}</p>
                                        <small>{{ Auth::user()->usrEmail }}</small>
                                    </div>
                                </div>
                                <hr>
                            </li>
                            <!-- Links -->
                            <li>
                                <a class="dropdown-item" href="#"><i class="bi bi-person fa-fw me-2"></i>{{ __('messages.profile') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('my-learnings') }}">
                                    <i class="bi bi-mortarboard fa-fw me-2"></i>{{ __('messages.my_learnings') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>{{ __('messages.settings') }}</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item bg-danger-soft-hover">
                                        <i class="bi bi-power fa-fw me-2"></i>{{ __('messages.sign_out') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <div class="ms-2">
                            <a href="{{ route('login') }}" class="btn btn-sm btn-primary me-2">{{ __('messages.login') }}</a>
                            <a href="{{ route('register') }}" class="btn btn-sm btn-success">{{ __('messages.register') }}</a>
                        </div>
                    @endauth
                </div>
                <!-- Profile END -->
            </div>
            <!-- Main navbar END -->
        </div>
    </nav>
    <!-- Nav END -->
</header>
<!-- Header END -->
