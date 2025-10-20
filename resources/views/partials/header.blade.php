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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pricing') ? 'active' : '' }}"
                            href="{{ route('pricing') }}">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <p class="legal nav-link">Legal</p>
                        <span class="legal-menu">
                            <a href="{{ route('terms') }}">Terms</a>
                            <a href="{{ route('policy') }}">Policy</a>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a href="" class="lang active">ENG</a>
                        <a href="" class="lang">ESP</a>
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

                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link"
                                    style="display: inline; padding: 0; border: none; cursor: pointer;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login-form') ? 'active' : '' }}"
                                href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('signup-form') ? 'active' : '' }}"
                                href="{{ route('signup') }}">Sign Up</a>
                        </li>
                    @endauth --}}

                </ul>
            </div>
        </div>
    </nav>
</header>

@push('scripts')
    <script>
        let menu = document.querySelector('.legal-menu');
        document.querySelector('.legal').addEventListener('click', () => {
            menu.classList.toggle('active')
        })
    </script>
@endpush
