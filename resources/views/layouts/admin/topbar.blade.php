<header class="admin-topbar sticky-top bg-white border-bottom shadow-sm">
    <nav class="navbar navbar-expand-lg px-3 px-lg-4 py-2">
        <!-- Mobile Sidebar Toggle -->
        <button class="btn btn-outline-secondary d-lg-none me-3" @click="$dispatch('toggle-sidebar')" aria-label="Toggle sidebar">
            <i class="bi bi-list fs-5"></i>
        </button>

        <!-- Breadcrumb / Page Title Area -->
        <div class="flex-grow-1 d-none d-md-block">
            @yield('page-title')
        </div>

        <!-- Right Side Actions -->
        <div class="d-flex align-items-center gap-2">
            <!-- Search -->
            <div class="d-none d-md-flex">
                <div class="position-relative">
                    <input type="search" class="form-control form-control-sm search-input" placeholder="Search students, teachers..." style="width: 280px;">
                    <i class="bi bi-search position-absolute text-muted" style="right: 12px; top: 50%; transform: translateY(-50%);"></i>
                </div>
            </div>

            <!-- Notifications -->
            <div class="nav-item dropdown">
                <a class="nav-link position-relative p-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationBadge" style="display: none;">
                        <span id="notificationCount">0</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg shadow" style="min-width: 360px; max-height: 400px; overflow-y: auto;">
                    <li class="dropdown-header d-flex justify-content-between align-items-center py-2">
                        <h6 class="mb-0">Notifications</h6>
                        <a href="#" class="btn btn-sm btn-link p-0" id="markAllRead">Mark all read</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li id="notificationList">
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-bell-slash fs-1 d-block mb-2"></i>
                            No notifications
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    @if (\Route::has('admin.notifications.index'))
                    <li><a class="dropdown-item text-center" href="{{ route('admin.notifications.index') }}">View all notifications</a></li>
                    @endif
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="nav-item dropdown d-none d-sm-flex">
                <a class="nav-link btn btn-primary btn-sm px-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-plus-lg me-1"></i> Quick Add
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><h6 class="dropdown-header">Create New</h6></li>
                    <li><a class="dropdown-item" href="{{ route('admin.institutions.create') }}"><i class="bi bi-buildings me-2"></i>Institution</a></li>

                    @if (\Route::has('admin.students.create'))
                    <li><a class="dropdown-item" href="{{ route('admin.students.create') }}"><i class="bi bi-person-plus me-2"></i>Student</a></li>
                    @endif

                    @if (\Route::has('admin.teachers.create'))
                    <li><a class="dropdown-item" href="{{ route('admin.teachers.create') }}"><i class="bi bi-person-badge me-2"></i>Teacher</a></li>
                    @endif

                    @if (\Route::has('admin.classes.create'))
                    <li><a class="dropdown-item" href="{{ route('admin.classes.create') }}"><i class="bi bi-collection me-2"></i>Class</a></li>
                    @endif

                    @if (\Route::has('admin.exams.create'))
                    <li><a class="dropdown-item" href="{{ route('admin.exams.create') }}"><i class="bi bi-file-earmark-plus me-2"></i>Exam</a></li>
                    @endif

                    @if (\Route::has('admin.announcements.create'))
                    <li><a class="dropdown-item" href="{{ route('admin.announcements.create') }}"><i class="bi bi-megaphone me-2"></i>Announcement</a></li>
                    @endif

                    @if (\Route::has('admin.fees.create'))
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('admin.fees.create') }}"><i class="bi bi-cash-stack me-2"></i>Fee Record</a></li>
                    @endif
                </ul>
            </div>

            <!-- User Dropdown -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 p-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <span class="d-none d-md-inline fw-medium">{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li class="dropdown-header">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-medium">{{ auth()->user()->name }}</div>
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            </div>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                    @if (\Route::has('admin.settings.index'))
                    <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                    @endif
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
