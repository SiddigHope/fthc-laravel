<ul class="dropdown-menu" aria-labelledby="categoryMenu">
    <!-- Development Category -->
    <li class="dropdown-submenu dropend">
        <a class="dropdown-item dropdown-toggle" href="#">Development</a>
        <ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">
            <!-- Web Development Submenu -->
            <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-toggle" href="#">Web Development</a>
                <ul class="dropdown-menu" data-bs-popper="none">
                    <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'css']) }}">CSS</a></li>
                    <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'javascript']) }}">JavaScript</a></li>
                    <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'angular']) }}">Angular</a></li>
                    <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'php']) }}">PHP</a></li>
                    <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'html']) }}">HTML</a></li>
                    <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'react']) }}">React</a></li>
                </ul>
            </li>
            <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'data-science']) }}">Data Science</a></li>
            <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'mobile-development']) }}">Mobile Development</a></li>
            <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'programming-languages']) }}">Programming Languages</a></li>
            <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'software-testing']) }}">Software Testing</a></li>
            <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'software-engineering']) }}">Software Engineering</a></li>
        </ul>
    </li>

    <!-- Design Category -->
    <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'design']) }}">Design</a></li>

    <!-- Marketing Category -->
    <li class="dropdown-submenu dropend">
        <a class="dropdown-item dropdown-toggle" href="#">Marketing</a>
        <div class="dropdown-menu dropdown-menu-start dropdown-width-lg" data-bs-popper="none">
            <div class="row p-4">
                <!-- Get Started Column -->
                <div class="col-xl-6 col-xxl-4 mb-4 mb-xl-0">
                    <h6 class="mb-0">Get started</h6>
                    <hr>
                    <ul class="list-unstyled">
                        <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'market-research']) }}">Market Research</a></li>
                        <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'advertising']) }}">Advertising</a></li>
                        <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'consumer-behavior']) }}">Consumer Behavior</a></li>
                        <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'digital-marketing']) }}">Digital Marketing</a></li>
                        <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'marketing-ethics']) }}">Marketing Ethics</a></li>
                        <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'social-media-marketing']) }}">Social Media Marketing</a></li>
                        <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'public-relations']) }}">Public Relations</a></li>
                        <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'seo']) }}">SEO</a></li>
                        <li><a class="dropdown-item" href="{{ route('courses.category', ['category' => 'business-marketing']) }}">Business Marketing</a></li>
                    </ul>
                </div>

                <!-- Degree Column -->
                <div class="col-xl-6 col-xxl-4 mb-4 mb-xl-0">
                    <h6 class="mb-0">Degree</h6>
                    <hr>
                    <!-- University Item -->
                    <div class="d-flex mb-4 position-relative">
                        <img src="{{ asset('assets/images/client/uni-logo-01.svg') }}" class="icon-md" alt="">
                        <div class="ms-3">
                            <a class="stretched-link h6 mb-0" href="#">American Century University, New Mexico</a>
                            <p class="mb-0 small">Bachelor of computer science</p>
                        </div>
                    </div>
                    <!-- University Item -->
                    <div class="d-flex mb-4 position-relative">
                        <img src="{{ asset('assets/images/client/uni-logo-02.svg') }}" class="icon-md" alt="">
                        <div class="ms-3">
                            <a class="stretched-link h6 mb-0" href="#">Indiana State University</a>
                            <p class="mb-0 small">Masters of business administration</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
