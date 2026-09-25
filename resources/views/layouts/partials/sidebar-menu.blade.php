{{-- ============== DASHBOARD ============== --}}
@can('view-dashboard')
    <a href="{{ route('dashboard') }}"
       class="sidebar-item {{ is_active('dashboard') }}">
        <i class="fas fa-tachometer-alt w-5 text-center"></i>
        <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Dashboard</span>
    </a>
@endcan

{{-- ============== ACADEMIC ============== --}}
@canany(['view-classes', 'view-sections', 'view-subjects', 'view-routines'])
<div x-data="{ open: {{ is_menu_open(['classes', 'sections', 'subjects', 'class-subjects', 'routines']) ? 'true' : 'false' }} }">
    <button @click="open = !open; if(sidebarCollapsed) sidebarCollapsed = false"
            class="sidebar-item w-full justify-between {{ is_menu_open(['classes', 'sections', 'subjects', 'class-subjects', 'routines']) ? 'text-indigo-600 dark:text-indigo-400' : '' }}">
        <div class="flex items-center gap-3 min-w-0">
            <i class="fas fa-book-open w-5 text-center"></i>
            <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Academic</span>
        </div>
        <i class="fas fa-chevron-down text-xs transition-transform"
           :class="open ? 'rotate-180' : ''" x-show="!sidebarCollapsed"></i>
    </button>

    <div x-show="open && !sidebarCollapsed"
         x-collapse
         class="ml-4 pl-4 border-l border-gray-200 dark:border-gray-700 mt-1 space-y-1">
        @can('view-classes')
            <a href="{{ route('classes.index') }}" class="sidebar-subitem {{ is_active('classes') }}">
                <i class="fas fa-circle text-[6px]"></i> Classes
            </a>
        @endcan
        @can('view-sections')
            <a href="{{ route('sections.index') }}" class="sidebar-subitem {{ is_active('sections') }}">
                <i class="fas fa-circle text-[6px]"></i> Sections
            </a>
        @endcan
        @can('view-subjects')
            <a href="{{ route('subjects.index') }}" class="sidebar-subitem {{ is_active('subjects') }}">
                <i class="fas fa-circle text-[6px]"></i> Subjects
            </a>
        @endcan
        @can('assign-subjects')
            <a href="{{ route('class-subjects.index') }}" class="sidebar-subitem {{ is_active('class-subjects') }}">
                <i class="fas fa-circle text-[6px]"></i> Assign Subjects
            </a>
        @endcan
        @can('view-routines')
            <a href="{{ route('routines.index') }}" class="sidebar-subitem {{ is_active('routines') }}">
                <i class="fas fa-circle text-[6px]"></i> Class Routine
            </a>
        @endcan
    </div>
</div>
@endcanany

{{-- ============== STUDENTS ============== --}}
@canany(['view-students', 'view-admissions', 'view-student-attendance'])
<div x-data="{ open: {{ is_menu_open(['students', 'admissions', 'student-attendance']) ? 'true' : 'false' }} }">
    <button @click="open = !open; if(sidebarCollapsed) sidebarCollapsed = false"
            class="sidebar-item w-full justify-between {{ is_menu_open(['students', 'admissions', 'student-attendance']) ? 'text-indigo-600 dark:text-indigo-400' : '' }}">
        <div class="flex items-center gap-3 min-w-0">
            <i class="fas fa-user-graduate w-5 text-center"></i>
            <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Students</span>
        </div>
        <i class="fas fa-chevron-down text-xs transition-transform"
           :class="open ? 'rotate-180' : ''" x-show="!sidebarCollapsed"></i>
    </button>

    <div x-show="open && !sidebarCollapsed" x-collapse
         class="ml-4 pl-4 border-l border-gray-200 dark:border-gray-700 mt-1 space-y-1">
        @can('view-students')
            <a href="{{ route('students.index') }}" class="sidebar-subitem {{ is_active('students.index') }}">
                <i class="fas fa-circle text-[6px]"></i> All Students
            </a>
        @endcan
        @can('create-students')
            <a href="{{ route('students.create') }}" class="sidebar-subitem {{ is_active('students.create') }}">
                <i class="fas fa-circle text-[6px]"></i> Add Student
            </a>
        @endcan
        @can('view-admissions')
            <a href="{{ route('admissions.index') }}" class="sidebar-subitem {{ is_active('admissions') }}">
                <i class="fas fa-circle text-[6px]"></i> Admissions
            </a>
        @endcan
        @can('take-student-attendance')
            <a href="{{ route('student-attendance.index') }}" class="sidebar-subitem {{ is_active('student-attendance') }}">
                <i class="fas fa-circle text-[6px]"></i> Attendance
            </a>
        @endcan
        @can('promote-students')
            <a href="{{ route('promotions.index') }}" class="sidebar-subitem {{ is_active('promotions') }}">
                <i class="fas fa-circle text-[6px]"></i> Promotion
            </a>
        @endcan
    </div>
</div>
@endcanany

{{-- ============== TEACHERS ============== --}}
@canany(['view-teachers', 'view-teacher-attendance'])
<div x-data="{ open: {{ is_menu_open(['teachers', 'teacher-attendance', 'staffs']) ? 'true' : 'false' }} }">
    <button @click="open = !open; if(sidebarCollapsed) sidebarCollapsed = false"
            class="sidebar-item w-full justify-between {{ is_menu_open(['teachers', 'teacher-attendance', 'staffs']) ? 'text-indigo-600 dark:text-indigo-400' : '' }}">
        <div class="flex items-center gap-3 min-w-0">
            <i class="fas fa-chalkboard-teacher w-5 text-center"></i>
            <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Teachers</span>
        </div>
        <i class="fas fa-chevron-down text-xs transition-transform"
           :class="open ? 'rotate-180' : ''" x-show="!sidebarCollapsed"></i>
    </button>

    <div x-show="open && !sidebarCollapsed" x-collapse
         class="ml-4 pl-4 border-l border-gray-200 dark:border-gray-700 mt-1 space-y-1">
        @can('view-teachers')
            <a href="{{ route('teachers.index') }}" class="sidebar-subitem {{ is_active('teachers') }}">
                <i class="fas fa-circle text-[6px]"></i> All Teachers
            </a>
        @endcan
        @can('view-staffs')
            <a href="{{ route('staffs.index') }}" class="sidebar-subitem {{ is_active('staffs') }}">
                <i class="fas fa-circle text-[6px]"></i> Staffs
            </a>
        @endcan
        @can('take-teacher-attendance')
            <a href="{{ route('teacher-attendance.index') }}" class="sidebar-subitem {{ is_active('teacher-attendance') }}">
                <i class="fas fa-circle text-[6px]"></i> Attendance
            </a>
        @endcan
    </div>
</div>
@endcanany

{{-- ============== EXAM & RESULT ============== --}}
@canany(['view-exams', 'view-results'])
<div x-data="{ open: {{ is_menu_open(['exams', 'exam-marks', 'results']) ? 'true' : 'false' }} }">
    <button @click="open = !open; if(sidebarCollapsed) sidebarCollapsed = false"
            class="sidebar-item w-full justify-between {{ is_menu_open(['exams', 'exam-marks', 'results']) ? 'text-indigo-600 dark:text-indigo-400' : '' }}">
        <div class="flex items-center gap-3 min-w-0">
            <i class="fas fa-file-alt w-5 text-center"></i>
            <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Exams</span>
        </div>
        <i class="fas fa-chevron-down text-xs transition-transform"
           :class="open ? 'rotate-180' : ''" x-show="!sidebarCollapsed"></i>
    </button>

    <div x-show="open && !sidebarCollapsed" x-collapse
         class="ml-4 pl-4 border-l border-gray-200 dark:border-gray-700 mt-1 space-y-1">
        @can('view-exams')
            <a href="{{ route('exams.index') }}" class="sidebar-subitem {{ is_active('exams') }}">
                <i class="fas fa-circle text-[6px]"></i> Manage Exams
            </a>
        @endcan
        @can('entry-exam-marks')
            <a href="{{ route('exam-marks.index') }}" class="sidebar-subitem {{ is_active('exam-marks') }}">
                <i class="fas fa-circle text-[6px]"></i> Marks Entry
            </a>
        @endcan
        @can('view-results')
            <a href="{{ route('results.index') }}" class="sidebar-subitem {{ is_active('results') }}">
                <i class="fas fa-circle text-[6px]"></i> Results
            </a>
        @endcan
    </div>
</div>
@endcanany

{{-- ============== FEES ============== --}}
@canany(['view-fee-collections', 'collect-fee', 'view-fee-structures'])
<div x-data="{ open: {{ is_menu_open(['fees', 'fee-collections', 'fee-structures', 'due-fees']) ? 'true' : 'false' }} }">
    <button @click="open = !open; if(sidebarCollapsed) sidebarCollapsed = false"
            class="sidebar-item w-full justify-between {{ is_menu_open(['fees', 'fee-collections', 'fee-structures', 'due-fees']) ? 'text-indigo-600 dark:text-indigo-400' : '' }}">
        <div class="flex items-center gap-3 min-w-0">
            <i class="fas fa-money-bill-wave w-5 text-center"></i>
            <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Fees</span>
        </div>
        <i class="fas fa-chevron-down text-xs transition-transform"
           :class="open ? 'rotate-180' : ''" x-show="!sidebarCollapsed"></i>
    </button>

    <div x-show="open && !sidebarCollapsed" x-collapse
         class="ml-4 pl-4 border-l border-gray-200 dark:border-gray-700 mt-1 space-y-1">
        @can('collect-fee')
            <a href="{{ route('fee-collections.create') }}" class="sidebar-subitem {{ is_active('fee-collections.create') }}">
                <i class="fas fa-circle text-[6px]"></i> Collect Fee
            </a>
        @endcan
        @can('view-fee-collections')
            <a href="{{ route('fee-collections.index') }}" class="sidebar-subitem {{ is_active('fee-collections.index') }}">
                <i class="fas fa-circle text-[6px]"></i> Collection List
            </a>
        @endcan
        @can('view-due-fees')
            <a href="{{ route('due-fees.index') }}" class="sidebar-subitem {{ is_active('due-fees') }}">
                <i class="fas fa-circle text-[6px]"></i> Due Fees
            </a>
        @endcan
        @can('view-fee-structures')
            <a href="{{ route('fee-structures.index') }}" class="sidebar-subitem {{ is_active('fee-structures') }}">
                <i class="fas fa-circle text-[6px]"></i> Fee Structure
            </a>
        @endcan
    </div>
</div>
@endcanany

{{-- ============== ACCOUNTS ============== --}}
@canany(['view-vouchers', 'view-trial-balance', 'view-account-heads'])
<div x-data="{ open: {{ is_menu_open(['vouchers', 'account-heads', 'account-groups', 'accounts', 'cheques']) ? 'true' : 'false' }} }">
    <button @click="open = !open; if(sidebarCollapsed) sidebarCollapsed = false"
            class="sidebar-item w-full justify-between {{ is_menu_open(['vouchers', 'account-heads', 'account-groups', 'accounts', 'cheques']) ? 'text-indigo-600 dark:text-indigo-400' : '' }}">
        <div class="flex items-center gap-3 min-w-0">
            <i class="fas fa-calculator w-5 text-center"></i>
            <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Accounts</span>
        </div>
        <i class="fas fa-chevron-down text-xs transition-transform"
           :class="open ? 'rotate-180' : ''" x-show="!sidebarCollapsed"></i>
    </button>

    <div x-show="open && !sidebarCollapsed" x-collapse
         class="ml-4 pl-4 border-l border-gray-200 dark:border-gray-700 mt-1 space-y-1">
        @can('view-vouchers')
            <a href="{{ route('vouchers.index') }}" class="sidebar-subitem {{ is_active('vouchers') }}">
                <i class="fas fa-circle text-[6px]"></i> Vouchers
            </a>
        @endcan
        @can('view-account-heads')
            <a href="{{ route('account-heads.index') }}" class="sidebar-subitem {{ is_active('account-heads') }}">
                <i class="fas fa-circle text-[6px]"></i> Account Heads
            </a>
        @endcan
        @can('view-cash-book')
            <a href="{{ route('accounts.cash-book') }}" class="sidebar-subitem {{ is_active('accounts.cash-book') }}">
                <i class="fas fa-circle text-[6px]"></i> Cash Book
            </a>
        @endcan
        @can('view-ledger')
            <a href="{{ route('accounts.ledger') }}" class="sidebar-subitem {{ is_active('accounts.ledger') }}">
                <i class="fas fa-circle text-[6px]"></i> Ledger
            </a>
        @endcan
        @can('view-trial-balance')
            <a href="{{ route('accounts.trial-balance') }}" class="sidebar-subitem {{ is_active('accounts.trial-balance') }}">
                <i class="fas fa-circle text-[6px]"></i> Trial Balance
            </a>
        @endcan
    </div>
</div>
@endcanany

{{-- ============== LIBRARY ============== --}}
@can('view-books')
    <a href="{{ route('books.index') }}"
       class="sidebar-item {{ is_active('books') }}">
        <i class="fas fa-book w-5 text-center"></i>
        <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Library</span>
    </a>
@endcan

{{-- ============== NOTICES ============== --}}
@can('view-notices')
    <a href="{{ route('notices.index') }}"
       class="sidebar-item {{ is_active('notices') }}">
        <i class="fas fa-bullhorn w-5 text-center"></i>
        <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Notices</span>
    </a>
@endcan

{{-- ============== REPORTS ============== --}}
@canany(['view-student-reports', 'view-fee-reports', 'view-account-reports'])
<div x-data="{ open: {{ is_menu_open(['reports']) ? 'true' : 'false' }} }">
    <button @click="open = !open; if(sidebarCollapsed) sidebarCollapsed = false"
            class="sidebar-item w-full justify-between {{ is_menu_open(['reports']) ? 'text-indigo-600 dark:text-indigo-400' : '' }}">
        <div class="flex items-center gap-3 min-w-0">
            <i class="fas fa-chart-bar w-5 text-center"></i>
            <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Reports</span>
        </div>
        <i class="fas fa-chevron-down text-xs transition-transform"
           :class="open ? 'rotate-180' : ''" x-show="!sidebarCollapsed"></i>
    </button>

    <div x-show="open && !sidebarCollapsed" x-collapse
         class="ml-4 pl-4 border-l border-gray-200 dark:border-gray-700 mt-1 space-y-1">
        <a href="{{ route('reports.students') }}" class="sidebar-subitem">Student Report</a>
        <a href="{{ route('reports.attendance') }}" class="sidebar-subitem">Attendance Report</a>
        <a href="{{ route('reports.fees') }}" class="sidebar-subitem">Fee Report</a>
        <a href="{{ route('reports.accounts') }}" class="sidebar-subitem">Account Report</a>
    </div>
</div>
@endcanany

{{-- ============== SETTINGS ============== --}}
@canany(['view-settings', 'view-users', 'view-roles'])
<div x-data="{ open: {{ is_menu_open(['settings', 'users', 'roles', 'institutions', 'academic-years']) ? 'true' : 'false' }} }">
    <button @click="open = !open; if(sidebarCollapsed) sidebarCollapsed = false"
            class="sidebar-item w-full justify-between {{ is_menu_open(['settings', 'users', 'roles', 'institutions', 'academic-years']) ? 'text-indigo-600 dark:text-indigo-400' : '' }}">
        <div class="flex items-center gap-3 min-w-0">
            <i class="fas fa-cog w-5 text-center"></i>
            <span x-show="!sidebarCollapsed" x-transition class="sidebar-text">Settings</span>
        </div>
        <i class="fas fa-chevron-down text-xs transition-transform"
           :class="open ? 'rotate-180' : ''" x-show="!sidebarCollapsed"></i>
    </button>

    <div x-show="open && !sidebarCollapsed" x-collapse
         class="ml-4 pl-4 border-l border-gray-200 dark:border-gray-700 mt-1 space-y-1">
        @can('edit-institution-settings')
            <a href="{{ route('settings.institution') }}" class="sidebar-subitem {{ is_active('settings.institution') }}">
                <i class="fas fa-circle text-[6px]"></i> Institution
            </a>
        @endcan
        @can('view-academic-years')
            <a href="{{ route('academic-years.index') }}" class="sidebar-subitem {{ is_active('academic-years') }}">
                <i class="fas fa-circle text-[6px]"></i> Academic Year
            </a>
        @endcan
        @can('list-users')
            <a href="{{ route('users.index') }}" class="sidebar-subitem {{ is_active('users') }}">
                <i class="fas fa-circle text-[6px]"></i> Users
            </a>
        @endcan
        @can('list-roles')
            <a href="{{ route('roles.index') }}" class="sidebar-subitem {{ is_active('roles') }}">
                <i class="fas fa-circle text-[6px]"></i> Roles
            </a>
        @endcan
        @can('view-settings')
            <a href="{{ route('settings.general') }}" class="sidebar-subitem {{ is_active('settings.general') }}">
                <i class="fas fa-circle text-[6px]"></i> General
            </a>
        @endcan
    </div>
</div>
@endcanany
