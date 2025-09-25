    @push('styles')
        <style>
            @media (max-width: 768px) {
                #sidebar {
                    position: fixed;
                    z-index: 1030;
                    top: 0;
                    left: -250px;
                    height: 100vh;
                    transition: all 0.3s;
                }

                #sidebar.show {
                    left: 0;
                }

                #sidebarToggle {
                    position: fixed;
                    top: 10px;
                    left: 10px;
                    z-index: 1040;
                }
            }
        </style>
    @endpush
    @section('sidebar')
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-white" style="width: 250px; height: 100vh;"
            id="sidebar">
            <a href="{{ route('dashboard') }}"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">YourApp</span>
            </a>

            <hr>

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-house-door me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('therapist.index') }}"
                        class="nav-link text-white {{ request()->routeIs('therapist.index') ? 'active' : '' }}">
                        <i class="bi bi-house-door me-2"></i> Therapist
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('blog.index') }}"
                        class="nav-link text-white {{ request()->routeIs('blog.index') ? 'active' : '' }}">
                        <i class="bi bi-house-door me-2"></i> Blogs
                    </a>
                </li>
                <li>
                    <a href="" class="nav-link text-white {{ request()->routeIs('profile') ? 'active' : '' }}">
                        <i class="bi bi-person me-2"></i> Profile
                    </a>
                </li>
                <li>
                    <a href="" class="nav-link text-white {{ request()->routeIs('settings') ? 'active' : '' }}">
                        <i class="bi bi-gear me-2"></i> Settings
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link text-white btn btn-link w-100 text-start px-0">
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
