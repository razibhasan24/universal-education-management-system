@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('page-title')
    <h1 class="h3 fw-semibold mb-0">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-people-fill fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-uppercase small fw-medium text-muted d-block mb-1">Students</div>
                        <div class="h4 fw-semibold mb-0">{{ $studentsCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-person-badge-fill fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-uppercase small fw-medium text-muted d-block mb-1">Teachers</div>
                        <div class="h4 fw-semibold mb-0">{{ $teachersCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-collection fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-uppercase small fw-medium text-muted d-block mb-1">Classes</div>
                        <div class="h4 fw-semibold mb-0">{{ $classesCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-cash-stack fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-uppercase small fw-medium text-muted d-block mb-1">Pending Fees</div>
                        <div class="h4 fw-semibold mb-0">{{ $pendingFees }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm h-100">
        <div class="card-header bg-transparent d-flex align-items-center justify-content-between py-2">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-clock-history me-2"></i> Recent Activity
            </h5>
            <a href="#" class="small text-decoration-none">View all</a>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @forelse ($recentActivity as $activity)
                    <div class="list-group-item d-flex align-items-center py-2">
                        <div class="flex-shrink-0 text-muted me-3">
                            <i class="bi {{ $activity['icon'] ?? 'bi-circle' }}"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="small">{{ $activity['message'] ?? '' }}</div>
                            <div class="text-muted small">
                                {{ $activity['time'] ?? '' }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted small">
                        <i class="bi bi-bell-slash fs-1 d-block mb-2"></i>
                        No recent activity yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
