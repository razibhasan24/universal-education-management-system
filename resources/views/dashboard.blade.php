<<<<<<< HEAD
<x-app-layout title="Dashboard" :breadcrumbs="['Dashboard' => null]">

    @section('page-title', 'ড্যাশবোর্ড')
    @section('page-subtitle', 'স্বাগতম, ' . auth()->user()->name . '! আজকের সারসংক্ষেপ')

    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-6 md:p-8 mb-6 shadow-lg">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-40 h-40 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white bn-text">
                    আসসালামু আলাইকুম, {{ explode(' ', auth()->user()->name)[0] }}! 👋
                </h1>
                <p class="text-white/90 mt-1.5 text-sm md:text-base">
                    {{ auth()->user()->institution?->name ?? 'System' }}
                    <span class="mx-2">|</span>
                    <span class="capitalize">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</span>
                </p>
            </div>
            <div class="text-right text-white/90 hidden md:block">
                <p class="text-sm">আজকের তারিখ</p>
                <p class="text-lg font-semibold bn-text">
                    {{ \Carbon\Carbon::now()->locale('bn')->isoFormat('dddd, D MMMM YYYY') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">

        @can('view-students')
            <x-ui.stat-card
                title="Total Students"
                value="{{ number_format($stats['total_students']) }}"
                icon="user-graduate"
                color="blue"
                link="{{ route('students.index') }}"
                trend="up"
                trendValue="+{{ rand(1, 20) }} this month" />
        @endcan

        @can('view-teachers')
            <x-ui.stat-card
                title="Total Teachers"
                value="{{ number_format($stats['total_teachers']) }}"
                icon="chalkboard-teacher"
                color="green"
                link="{{ route('teachers.index') }}" />
        @endcan

        @can('view-classes')
            <x-ui.stat-card
                title="Total Classes"
                value="{{ number_format($stats['total_classes']) }}"
                icon="school"
                color="purple"
                link="{{ route('classes.index') }}" />
        @endcan

        @can('view-student-attendance')
            <x-ui.stat-card
                title="Today's Attendance"
                value="{{ number_format($stats['today_attendance']) }}"
                icon="clipboard-check"
                color="yellow" />
        @endcan

        @can('view-fee-collections')
            <x-ui.stat-card
                title="Today's Fee Collection"
                value="{{ money($stats['today_fee_collection']) }}"
                icon="money-bill-wave"
                color="indigo" />
        @endcan

        @can('view-fee-collections')
            <x-ui.stat-card
                title="This Month Fee"
                value="{{ money($stats['this_month_fee']) }}"
                icon="chart-line"
                color="pink" />
        @endcan

    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="card">
            <div class="card-header">
                <h3 class="font-semibold text-gray-800 dark:text-gray-100">
                    <i class="fas fa-bolt text-yellow-500 mr-2"></i> Quick Actions
                </h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @can('create-students')
                        <a href="{{ route('students.create') }}"
                           class="flex flex-col items-center gap-2 p-4 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 hover:bg-indigo-100 dark:hover:bg-indigo-900/40 transition-colors group">
                            <i class="fas fa-user-plus text-indigo-600 dark:text-indigo-400 text-2xl group-hover:scale-110 transition-transform"></i>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Add Student</span>
                        </a>
                    @endcan

                    @can('collect-fee')
                        <a href="#"
                           class="flex flex-col items-center gap-2 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/40 transition-colors group">
                            <i class="fas fa-money-bill text-green-600 dark:text-green-400 text-2xl group-hover:scale-110 transition-transform"></i>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Collect Fee</span>
                        </a>
                    @endcan

                    @can('take-student-attendance')
                        <a href="#"
                           class="flex flex-col items-center gap-2 p-4 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-colors group">
                            <i class="fas fa-clipboard-check text-yellow-600 dark:text-yellow-400 text-2xl group-hover:scale-110 transition-transform"></i>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Attendance</span>
                        </a>
                    @endcan

                    @can('create-notices')
                        <a href="#"
                           class="flex flex-col items-center gap-2 p-4 rounded-lg bg-pink-50 dark:bg-pink-900/20 hover:bg-pink-100 dark:hover:bg-pink-900/40 transition-colors group">
                            <i class="fas fa-bullhorn text-pink-600 dark:text-pink-400 text-2xl group-hover:scale-110 transition-transform"></i>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">New Notice</span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="font-semibold text-gray-800 dark:text-gray-100">
                    <i class="fas fa-bell text-indigo-500 mr-2"></i> Recent Notices
                </h3>
                <a href="#" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">View All</a>
            </div>
            <div class="card-body">
                <x-ui.empty-state
                    icon="bullhorn"
                    title="No notices yet"
                    message="When new notices are published, they'll appear here." />
            </div>
        </div>
    </div>

    {{-- Test Toast Button (Development এর জন্য, পরে সরিয়ে দিবেন) --}}
    <div class="fixed bottom-4 right-4 z-40 flex flex-col gap-2">
        <button onclick="window.dispatchEvent(new CustomEvent('toast', {detail:{message:'সফলভাবে সেভ হয়েছে!', type:'success'}}))"
                class="btn-success btn-sm shadow-lg">
            <i class="fas fa-check"></i> Test Success Toast
        </button>
        <button onclick="window.dispatchEvent(new CustomEvent('toast', {detail:{message:'কিছু ভুল হয়েছে!', type:'error'}}))"
                class="btn-danger btn-sm shadow-lg">
            <i class="fas fa-times"></i> Test Error Toast
        </button>
    </div>

=======
<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="py-4">
        <div class="row g-4">
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-person-check-fill text-primary" style="font-size: 2.5rem;"></i>
                        <h5 class="mt-3 fw-semibold">{{ __('Account') }}</h5>
                        <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-check2-circle-fill text-success" style="font-size: 2.5rem;"></i>
                        <h5 class="mt-3 fw-semibold">{{ __('Status') }}</h5>
                        <p class="text-muted small mb-0">{{ __('Authenticated') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
</x-app-layout>
