<x-guest-layout>
<<<<<<< HEAD
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

=======
    <div class="d-flex align-items-center justify-content-center mb-4">
        <i class="bi bi-shield-lock-fill text-primary" style="font-size: 2.5rem;"></i>
        <span class="fw-bold fs-4 ms-2">{{ config('app.name', 'Laravel') }}</span>
    </div>

    <h2 class="text-center fw-semibold mb-3">{{ __('Confirm Password') }}</h2>
    <p class="text-center text-muted small mb-4">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </p>

>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
<<<<<<< HEAD
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
=======
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="d-flex align-items-center justify-content-end mt-4">
            <x-primary-button class="px-4 py-2">
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
