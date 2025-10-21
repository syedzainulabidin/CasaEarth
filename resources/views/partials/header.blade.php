<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}"
                    alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pricing') ? 'active' : '' }}"
                            href="{{ route('pricing') }}">Pricing</a>
                    </li> --}}
                    <li class="nav-item">
                        <p class="legal nav-link">Legal
                            <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                            <svg width="10" height="10" viewBox="0 -4.5 24 24" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">

                                <title>chevron-down</title>
                                <desc>Created with Sketch Beta.</desc>
                                <defs>

                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    sketch:type="MSPage">
                                    <g id="Icon-Set-Filled" sketch:type="MSLayerGroup"
                                        transform="translate(-574.000000, -1201.000000)" fill="#000000">
                                        <path
                                            d="M597.405,1201.63 C596.576,1200.8 595.23,1200.8 594.401,1201.63 L586.016,1210.88 L577.63,1201.63 C576.801,1200.8 575.455,1200.8 574.626,1201.63 C573.797,1202.46 573.797,1203.81 574.626,1204.64 L584.381,1215.4 C584.83,1215.85 585.429,1216.05 586.016,1216.01 C586.603,1216.05 587.201,1215.85 587.65,1215.4 L597.405,1204.64 C598.234,1203.81 598.234,1202.46 597.405,1201.63"
                                            id="chevron-down" sketch:type="MSShapeGroup">

                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </p>
                        <span class="legal-menu">
                            <a href="{{ route('terms') }}">Terms</a>
                            <a href="{{ route('policy') }}">Policy</a>
                        </span>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link"
                                    style="display: inline; padding: 0; border: none; cursor: pointer;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login-form') ? 'active' : '' }}"
                                href="{{ route('login') }}">Get Started</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('signup-form') ? 'active' : '' }}"
                                href="{{ route('signup') }}">Sign Up</a>
                        </li> --}}
                    @endauth
                    <li class="nav-item">
                        <a href="#" class="lang" data-lang="en">ENG</a>
                        <a href="#" class="lang" data-lang="es">ESP</a>
                    </li>

                    {{--  <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                href="{{ route('about') }}">About</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogs') ? 'active' : '' }}"
                            href="{{ route('blogs') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">Contact</a>
                    </li>
 --}}


                </ul>
            </div>
        </div>
    </nav>
</header>
