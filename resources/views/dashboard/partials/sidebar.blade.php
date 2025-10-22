    @section('sidebar')
        <div class="d-flex fixed flex-column flex-shrink-0 p-3 bg-dark text-white" id="sidebar">
            <a href="{{ route('home') }}"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">CasaEarth</span>
            </a>

            <hr>

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link text-white {{ request()->routeIs('dashboard') ? 'bg-secondary' : '' }}">
                        <i class="bi bi-house-door me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('therapist.index') }}"
                        class="nav-link text-white {{ request()->routeIs('therapist.*') ? 'bg-secondary' : '' }}">
                        <i class="bi bi-house-door me-2"></i> Therapist
                    </a>
                </li>
                {{-- ! === * Admin Gate * === --}}
                @can('admin-view')
                    <li class="nav-item">
                        <a href="{{ route('blog.index') }}"
                            class="nav-link text-white {{ request()->routeIs('blog.*') ? 'bg-secondary' : '' }}">
                            <i class="bi bi-house-door me-2"></i> Blogs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tier.index') }}"
                            class="nav-link text-white {{ request()->routeIs('tier.*') ? 'bg-secondary' : '' }}">
                            <i class="bi bi-house-door me-2"></i> Tier
                        </a>
                    </li>
                @endcan
                @can('user-view')
                    <li class="nav-item">
                        <a href="{{ route('plan.index') }}"
                            class="nav-link text-white {{ request()->routeIs('plan.*') ? 'bg-secondary' : '' }}">
                            <i class="bi bi-house-door me-2"></i> Plan
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('course.index') }}"
                        class="nav-link text-white {{ request()->routeIs('course.*') ? 'bg-secondary' : '' }}">
                        <i class="bi bi-house-door me-2"></i> Course
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('appointment.index') }}"
                        class="nav-link text-white {{ request()->routeIs('appointment.*') ? 'bg-secondary' : '' }}">
                        <i class="bi bi-house-door me-2"></i> Appointment
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guide.index') }}"
                        class="nav-link text-white {{ request()->routeIs('guide.*') ? 'bg-secondary' : '' }}">
                        <i class="bi bi-house-door me-2"></i> Guide
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my.guides') }}"
                        class="nav-link text-white {{ request()->routeIs('my.guides') ? 'bg-secondary' : '' }}">
                        <i class="bi bi-house-door me-2"></i> My Guide
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.index') }}"
                        class="nav-link text-white {{ request()->routeIs('profile.*') ? 'bg-secondary' : '' }}">
                        <i class="bi bi-person me-2"></i> Profile
                    </a>
                </li>
                <li>
                    <a href=""
                        class="nav-link text-white {{ request()->routeIs('settings') ? 'bg-secondary' : '' }}">
                        <i class="bi bi-gear me-2"></i> Settings
                    </a>
                </li>
                <li>
                    <form method="POST" class="nav-link" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white btn w-100 text-start p-0">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>

            <hr>

            <div class="text-white">
                <small>Logged in as: <strong>{{ Auth::user()->name }}</strong></small>
            </div>
        </div>
    @endsection


    @push('scripts')
        <script>
            // Sidebar toggle script
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
        </script>
    @endpush
