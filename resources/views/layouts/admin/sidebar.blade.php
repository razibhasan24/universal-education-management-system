@php
    $sections = [
        'academic' => [
            'admin.students.index',
            'admin.teachers.index',
            'admin.classes.index',
            'admin.subjects.index',
            'admin.exams.index',
            'admin.grades.index',
        ],
        'attendance' => [
            'admin.attendance.index',
            'admin.attendance.reports',
        ],
        'finance' => [
            'admin.fees.index',
            'admin.payments.index',
            'admin.expenses.index',
        ],
        'communication' => [
            'admin.announcements.index',
            'admin.messages.index',
        ],
        'reports' => [
            'admin.reports.academic',
            'admin.reports.financial',
            'admin.reports.attendance',
        ],
        'administration' => [
            'admin.users.index',
            'admin.roles.index',
            'admin.settings.index',
            'admin.logs.index',
        ],
    ];
@endphp

<aside id="adminSidebar" class="admin-sidebar" x-data="{ collapsed: false }" :class="{ 'collapsed': collapsed }">
    <div class="sidebar-header d-flex align-items-center justify-content-between p-3 border-bottom">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand d-flex align-items-center gap-2 text-decoration-none">
            <i class="bi bi-mortarboard-fill text-primary fs-4"></i>
            <span class="fw-semibold fs-5 d-none d-md-inline">EduManage</span>
        </a>
        <button class="btn btn-sm btn-outline-secondary d-md-none" @click="collapsed = !collapsed" aria-label="Toggle sidebar">
            <i class="bi" :class="collapsed ? 'bi-chevron-right' : 'bi-chevron-left'"></i>
        </button>
    </div>

    <nav class="sidebar-nav flex-grow-1 p-3 overflow-auto">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>

            <!-- Institutions -->
            <li class="nav-item mt-3">
                <span class="nav-section text-uppercase text-muted small px-2">Institutions</span>
                <ul class="nav flex-column mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.institutions*') ? 'active' : '' }}"
                           href="{{ route('admin.institutions.index') }}">
                            <i class="bi bi-buildings"></i>
                            <span class="ms-2">All Institutions</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Academic Management -->
            @if (collect($sections['academic'])->contains(fn ($r) => \Route::has($r)))
            <li class="nav-item mt-3">
                <span class="nav-section text-uppercase text-muted small px-2">Academic</span>
                <ul class="nav flex-column mt-1">
                    @if (\Route::has('admin.students.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.students*') ? 'active' : '' }}"
                           href="{{ route('admin.students.index') }}">
                            <i class="bi bi-people-fill"></i>
                            <span class="ms-2">Students</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.teachers.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.teachers*') ? 'active' : '' }}"
                           href="{{ route('admin.teachers.index') }}">
                            <i class="bi bi-person-badge-fill"></i>
                            <span class="ms-2">Teachers</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.classes.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.classes*') ? 'active' : '' }}"
                           href="{{ route('admin.classes.index') }}">
                            <i class="bi bi-collection"></i>
                            <span class="ms-2">Classes</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.subjects.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.subjects*') ? 'active' : '' }}"
                           href="{{ route('admin.subjects.index') }}">
                            <i class="bi bi-book-fill"></i>
                            <span class="ms-2">Subjects</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.exams.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.exams*') ? 'active' : '' }}"
                           href="{{ route('admin.exams.index') }}">
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <span class="ms-2">Exams</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.grades.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.grades*') ? 'active' : '' }}"
                           href="{{ route('admin.grades.index') }}">
                            <i class="bi bi-award-fill"></i>
                            <span class="ms-2">Grades</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            <!-- Attendance -->
            @if (collect($sections['attendance'])->contains(fn ($r) => \Route::has($r)))
            <li class="nav-item mt-3">
                <span class="nav-section text-uppercase text-muted small px-2">Attendance</span>
                <ul class="nav flex-column mt-1">
                    @if (\Route::has('admin.attendance.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.attendance*') ? 'active' : '' }}"
                           href="{{ route('admin.attendance.index') }}">
                            <i class="bi bi-calendar-check-fill"></i>
                            <span class="ms-2">Daily Attendance</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.attendance.reports'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.attendance.reports*') ? 'active' : '' }}"
                           href="{{ route('admin.attendance.reports') }}">
                            <i class="bi bi-graph-up"></i>
                            <span class="ms-2">Reports</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            <!-- Finance -->
            @if (collect($sections['finance'])->contains(fn ($r) => \Route::has($r)))
            <li class="nav-item mt-3">
                <span class="nav-section text-uppercase text-muted small px-2">Finance</span>
                <ul class="nav flex-column mt-1">
                    @if (\Route::has('admin.fees.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.fees*') ? 'active' : '' }}"
                           href="{{ route('admin.fees.index') }}">
                            <i class="bi bi-cash-stack"></i>
                            <span class="ms-2">Fee Management</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.payments.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.payments*') ? 'active' : '' }}"
                           href="{{ route('admin.payments.index') }}">
                            <i class="bi bi-credit-card-fill"></i>
                            <span class="ms-2">Payments</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.expenses.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.expenses*') ? 'active' : '' }}"
                           href="{{ route('admin.expenses.index') }}">
                            <i class="bi bi-receipt"></i>
                            <span class="ms-2">Expenses</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            <!-- Communication -->
            @if (collect($sections['communication'])->contains(fn ($r) => \Route::has($r)))
            <li class="nav-item mt-3">
                <span class="nav-section text-uppercase text-muted small px-2">Communication</span>
                <ul class="nav flex-column mt-1">
                    @if (\Route::has('admin.announcements.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.announcements*') ? 'active' : '' }}"
                           href="{{ route('admin.announcements.index') }}">
                            <i class="bi bi-megaphone-fill"></i>
                            <span class="ms-2">Announcements</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.messages.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}"
                           href="{{ route('admin.messages.index') }}">
                            <i class="bi bi-chat-fill"></i>
                            <span class="ms-2">Messages</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            <!-- Reports -->
            @if (collect($sections['reports'])->contains(fn ($r) => \Route::has($r)))
            <li class="nav-item mt-3">
                <span class="nav-section text-uppercase text-muted small px-2">Reports</span>
                <ul class="nav flex-column mt-1">
                    @if (\Route::has('admin.reports.academic'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reports.academic') ? 'active' : '' }}"
                           href="{{ route('admin.reports.academic') }}">
                            <i class="bi bi-bar-chart-fill"></i>
                            <span class="ms-2">Academic Reports</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.reports.financial'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reports.financial') ? 'active' : '' }}"
                           href="{{ route('admin.reports.financial') }}">
                            <i class="bi bi-currency-dollar"></i>
                            <span class="ms-2">Financial Reports</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.reports.attendance'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reports.attendance') ? 'active' : '' }}"
                           href="{{ route('admin.reports.attendance') }}">
                            <i class="bi bi-clipboard-data-fill"></i>
                            <span class="ms-2">Attendance Reports</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            <!-- System Administration -->
            @if (collect($sections['administration'])->contains(fn ($r) => \Route::has($r)))
            <li class="nav-item mt-3">
                <span class="nav-section text-uppercase text-muted small px-2">Administration</span>
                <ul class="nav flex-column mt-1">
                    @if (\Route::has('admin.users.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}"
                           href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people"></i>
                            <span class="ms-2">Users</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.roles.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.roles*') ? 'active' : '' }}"
                           href="{{ route('admin.roles.index') }}">
                            <i class="bi bi-shield-lock-fill"></i>
                            <span class="ms-2">Roles & Permissions</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.settings.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}"
                           href="{{ route('admin.settings.index') }}">
                            <i class="bi bi-gear-fill"></i>
                            <span class="ms-2">Settings</span>
                        </a>
                    </li>
                    @endif

                    @if (\Route::has('admin.logs.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.logs*') ? 'active' : '' }}"
                           href="{{ route('admin.logs.index') }}">
                            <i class="bi bi-journal-text"></i>
                            <span class="ms-2">Activity Logs</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
    </nav>

    <div class="sidebar-footer p-3 border-top">
        <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                <i class="bi bi-info-circle"></i>
            </div>
            <div class="flex-grow-1 min-w-0">
                <small class="fw-medium text-truncate d-block">Universal Education Management System</small>
                <small class="text-muted">v1.0.0</small>
            </div>
        </div>
    </div>
</aside>

<!-- Mobile Sidebar Overlay -->
<div id="sidebarOverlay" class="sidebar-overlay" @click="$dispatch('close-sidebar')"></div>
