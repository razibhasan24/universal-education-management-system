<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">{{ __('Verify Email') }}</h2>
    </x-slot>

    <div class="py-4">
        <div class="card shadow-sm">
            <div class="card-body text-center p-5">
                <i class="bi bi-envelope-exclamation-fill text-primary" style="font-size: 3rem;"></i>
                <p class="mt-3 mb-4 text-muted">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <x-primary-button>
                            {{ __('Resend Verification Email') }}
                        </x-primary-button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
