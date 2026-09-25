@extends('layouts.admin')

@section('title', $session->name)

@section('page-title')
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="h3 fw-semibold mb-0">
            <i class="bi bi-calendar-range me-2"></i> {{ $session->name }}
        </h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.academic-sessions.edit', $session) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
            <a href="{{ route('admin.academic-sessions.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Session Details</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Institution</label>
                                <div class="fw-medium">{{ $session->institution->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Session Name</label>
                                <div class="fw-medium">{{ $session->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Start Date</label>
                                <div class="fw-medium">{{ $session->start_date->format('F d, Y') }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">End Date</label>
                                <div class="fw-medium">{{ $session->end_date->format('F d, Y') }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Duration</label>
                                <div class="fw-medium">{{ $session->start_date->diffInDays($session->end_date) }} days</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Status</label>
                                <div>
                                    @if ($session->status === \App\Models\AcademicSession::STATUS_ACTIVE)
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($session->status === \App\Models\AcademicSession::STATUS_UPCOMING)
                                        <span class="badge bg-info">Upcoming</span>
                                    @elseif ($session->status === \App\Models\AcademicSession::STATUS_COMPLETED)
                                        <span class="badge bg-secondary">Completed</span>
                                    @else
                                        <span class="badge bg-secondary">{{ \App\Models\AcademicSession::statusLabel($session->status) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Current Session</label>
                                <div>
                                    @if ($session->isActive() && $session->isCurrent())
                                        <span class="badge bg-success-subtle text-success">Yes - Currently Active</span>
                                    @else
                                        <span class="text-muted">No</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title mb-3">Quick Actions</h6>
                    <div class="d-grid gap-2">
                        @if ($session->status !== \App\Models\AcademicSession::STATUS_ACTIVE)
                            <form action="{{ route('admin.academic-sessions.set-active', $session) }}" method="POST" onsubmit="return confirm('Set {{ $session->name }} as the active session for {{ $session->institution->name }}?')">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    <i class="bi bi-check-circle me-1"></i> Set as Active
                                </button>
                            </form>
                        @else
                            <button class="btn btn-success btn-sm w-100" disabled>
                                <i class="bi bi-check-circle me-1"></i> Already Active
                            </button>
                        @endif
                        <a href="{{ route('admin.academic-sessions.edit', $session) }}" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-pencil me-1"></i> Edit Session
                        </a>
                        <form action="{{ route('admin.academic-sessions.destroy', $session) }}" method="POST" onsubmit="return confirm('Delete {{ $session->name }}? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="bi bi-trash me-1"></i> Delete Session
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
