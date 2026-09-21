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
</x-app-layout>
