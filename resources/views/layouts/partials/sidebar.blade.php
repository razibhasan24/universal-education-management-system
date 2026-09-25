<aside class="fixed top-0 left-0 bottom-0 z-50 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 flex flex-col
       -translate-x-full lg:translate-x-0"
       :class="{
           'w-64': !sidebarCollapsed,
           'w-20': sidebarCollapsed,
           'translate-x-0': sidebarOpen,
           'lg:w-20': sidebarCollapsed,
           'lg:w-64': !sidebarCollapsed
       }">

    {{-- Logo / Brand --}}
    <div class="h-16 flex items-center justify-between px-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 min-w-0"
           x-show="!sidebarCollapsed" x-transition>
            <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-school text-white text-lg"></i>
            </div>
            <div class="min-w-0">
                <h1 class="text-sm font-bold text-gray-800 dark:text-gray-100 truncate">SMS</h1>
                <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate">School Management</p>
            </div>
        </a>

        <a href="{{ route('dashboard') }}" x-show="sidebarCollapsed" x-transition
           class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mx-auto">
            <i class="fas fa-school text-white text-lg"></i>
        </a>

        {{-- Mobile Close Button --}}
        <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500">
            <i class="fas fa-times"></i>
        </button>
    </div>

    {{-- Menu Items --}}
    <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-1 scrollbar-thin">
        @include('layouts.partials.sidebar-menu')
    </nav>

    {{-- Sidebar Footer / Collapse Toggle --}}
    <div class="border-t border-gray-200 dark:border-gray-700 p-2 hidden lg:block">
        <button @click="sidebarCollapsed = !sidebarCollapsed"
                class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fas" :class="sidebarCollapsed ? 'fa-angle-double-right' : 'fa-angle-double-left'"></i>
            <span x-show="!sidebarCollapsed" x-transition>Collapse</span>
        </button>
    </div>
</aside>
