<x-guest-layout>
<<<<<<< HEAD
=======
    <div class="d-flex align-items-center justify-content-center mb-4">
        <i class="bi bi-mortarboard-fill text-primary" style="font-size: 2.5rem;"></i>
        <span class="fw-bold fs-4 ms-2">{{ config('app.name', 'Laravel') }}</span>
    </div>

    <h2 class="text-center fw-semibold mb-4">{{ __('Reset Password') }}</h2>

>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
<<<<<<< HEAD
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
=======
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
<<<<<<< HEAD
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
=======
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control mt-1"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
<<<<<<< HEAD
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
=======
        <div class="mb-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="form-control mt-1"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-flex align-items-center justify-content-end mt-4">
            <x-primary-button class="px-4 py-2">
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
