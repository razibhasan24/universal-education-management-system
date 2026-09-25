<header class="h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between px-4 md:px-6 sticky top-0 z-30">

    {{-- Left Side --}}
    <div class="flex items-center gap-3">
        {{-- Mobile Menu Toggle --}}
        <button @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fas fa-bars text-lg"></i>
        </button>

        {{-- Search (Desktop) --}}
        <div class="hidden md:flex items-center">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text"
                       placeholder="Search students, teachers..."
                       class="w-64 lg:w-80 pl-10 pr-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 border-0 text-sm
                              text-gray-700 dark:text-gray-200 placeholder-gray-500
                              focus:ring-2 focus:ring-indigo-500 focus:bg-white dark:focus:bg-gray-600 transition-all">
            </div>
        </div>
    </div>

    {{-- Right Side --}}
    <div class="flex items-center gap-1 md:gap-2">

        {{-- Current Date --}}
        <div class="hidden lg:block text-sm text-gray-500 dark:text-gray-400 mr-2 bn-text">
            {{ \Carbon\Carbon::now()->locale('bn')->isoFormat('dddd, D MMMM YYYY') }}
        </div>

        {{-- Dark Mode Toggle --}}
        <button @click="darkMode = !darkMode"
                class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                :title="darkMode ? 'Light Mode' : 'Dark Mode'">
            <i class="fas" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
        </button>

        {{-- Notifications --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                    class="relative p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <i class="fas fa-bell"></i>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
            </button>

            <div x-show="open" @click.away="open = false" x-transition x-cloak
                 class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="font-semibold text-sm text-gray-800 dark:text-gray-100">Notifications</h3>
                    <span class="text-xs text-indigo-600 dark:text-indigo-400 cursor-pointer">Mark all read</span>
                </div>
                <div class="max-h-96 overflow-y-auto">
                    <div class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                        <i class="fas fa-bell-slash text-3xl mb-2 opacity-30"></i>
                        <p>No new notifications</p>
                    </div>
                </div>
                <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-700 text-center">
                    <a href="#" class="text-xs text-indigo-600 dark:text-indigo-400 font-medium hover:underline">
                        View all notifications
                    </a>
                </div>
            </div>
        </div>

        {{-- User Dropdown --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                    class="flex items-center gap-2 pl-1 pr-3 py-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <img src="{{ avatar_url() }}"
                     alt="{{ auth()->user()->name }}"
                     class="w-8 h-8 rounded-full object-cover ring-2 ring-indigo-500/30">
                <div class="hidden md:block text-left">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200 leading-tight max-w-[120px] truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-[10px] text-gray-500 dark:text-gray-400 leading-tight capitalize">
                        {{ auth()->user()->getRoleNames()->first() ?? 'User' }}
                    </p>
                </div>
                <i class="fas fa-chevron-down text-xs text-gray-400 hidden md:block"></i>
            </button>

            <div x-show="open" @click.away="open = false" x-transition x-cloak
                 class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50 overflow-hidden">

                {{-- User Info --}}
                <div class="px-4 py-3 bg-gradient-to-br from-indigo-500 to-purple-600 text-white">
                    <div class="flex items-center gap-3">
                        <img src="{{ avatar_url() }}" class="w-12 h-12 rounded-full ring-2 ring-white/50 object-cover">
                        <div class="min-w-0">
                            <p class="font-semibold text-sm truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs opacity-90 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- Menu --}}
                <div class="py-2">
                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <i class="fas fa-user-circle w-4 text-gray-400"></i> My Profile
                    </a>
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <i class="fas fa-key w-4 text-gray-400"></i> Change Password
                    </a>
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <i class="fas fa-cog w-4 text-gray-400"></i> Settings
                    </a>
                </div>

                {{-- Logout --}}
                <div class="border-t border-gray-200 dark:border-gray-700 p-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition-colors">
                            <i class="fas fa-sign-out-alt w-4"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
