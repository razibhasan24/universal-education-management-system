@extends('layouts.admin')

@section('title', $class->name)

@section('page-title')
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="h3 fw-semibold mb-0">
            <i class="bi bi-grid-3x3-gap me-2"></i> {{ $class->name }}
        </h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.school-classes.edit', $class) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
            <a href="{{ route('admin.school-classes.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
@endif

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Class Details</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Institution</label>
                                <div class="fw-medium">{{ $class->institution->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Academic Session</label>
                                <div class="fw-medium">{{ $class->academicSession->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Class Name</label>
                                <div class="fw-medium">{{ $class->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Code</label>
                                <div class="fw-medium">{{ $class->code ?? '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Numeric Order</label>
                                <div class="fw-medium">{{ $class->numeric_order ?? '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Status</label>
                                <div>
                                    @if ($class->status === \App\Models\SchoolClass::STATUS_ACTIVE)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">{{ \App\Models\SchoolClass::statusLabel($class->status) }}</span>
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
                        <a href="{{ route('admin.school-classes.edit', $class) }}" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-pencil me-1"></i> Edit Class
                        </a>
                        <form action="{{ route('admin.school-classes.destroy', $class) }}" method="POST" onsubmit="return confirm('Delete {{ $class->name }}? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="bi bi-trash me-1"></i> Delete Class
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
