<x-guest-layout>
<<<<<<< HEAD
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
=======
    <div class="d-flex align-items-center justify-content-center mb-4">
        <i class="bi bi-mortarboard-fill text-primary" style="font-size: 2.5rem;"></i>
        <span class="fw-bold fs-4 ms-2">{{ config('app.name', 'Laravel') }}</span>
    </div>

    <h2 class="text-center fw-semibold mb-4">{{ __('Log in') }}</h2>
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
<<<<<<< HEAD
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
=======
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
<<<<<<< HEAD
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

=======
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
<<<<<<< HEAD
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
=======
        <div class="form-check mb-3">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4">
            @if (Route::has('password.request'))
                <a class="text-decoration-none small" href="{{ route('password.request') }}">
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
                    {{ __('Forgot your password?') }}
                </a>
            @endif

<<<<<<< HEAD
            <x-primary-button class="ms-3">
=======
            <x-primary-button class="px-4 py-2">
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
