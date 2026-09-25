<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <i class="bi bi-mortarboard-fill text-primary"></i>
            <span class="fw-semibold">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Route::has('dashboard'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                           href="{{ route('dashboard') }}" aria-current="{{ request()->routeIs('dashboard') ? 'true' : 'false' }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                @endif
            </ul>

            <div class="d-flex align-items-center gap-2">
                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                  style="width: 32px; height: 32px; font-size: 0.8rem;">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </span>
                            <span class="d-none d-lg-inline">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-fill me-2"></i> Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    @if (Route::has('login'))
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
