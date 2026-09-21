<x-guest-layout>
    <div class="d-flex align-items-center justify-content-center mb-4">
        <i class="bi bi-mortarboard-fill text-primary" style="font-size: 2.5rem;"></i>
        <span class="fw-bold fs-4 ms-2">{{ config('app.name', 'Laravel') }}</span>
    </div>

    <h2 class="text-center fw-semibold mb-3">{{ __('Forgot your password?') }}</h2>
    <p class="text-center text-muted small mb-4">
        {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="d-flex align-items-center justify-content-end mt-4">
            <x-primary-button class="px-4 py-2">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
