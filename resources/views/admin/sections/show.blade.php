@extends('layouts.admin')

@section('title', $section->name)

@section('page-title')
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="h3 fw-semibold mb-0">
            <i class="bi bi-diagram-3 me-2"></i> {{ $section->name }}
        </h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.sections.edit', $section) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
            <a href="{{ route('admin.sections.index') }}" class="btn btn-sm btn-outline-secondary">
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
                    <h5 class="card-title mb-4">Section Details</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Institution</label>
                                <div class="fw-medium">{{ $section->institution->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Class</label>
                                <div class="fw-medium">{{ $section->schoolClass->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Section Name</label>
                                <div class="fw-medium">{{ $section->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Capacity</label>
                                <div class="fw-medium">{{ $section->capacity ?: '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Status</label>
                                <div>
                                    @if ($section->status === \App\Models\Section::STATUS_ACTIVE)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">{{ \App\Models\Section::statusLabel($section->status) }}</span>
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
                        <a href="{{ route('admin.sections.edit', $section) }}" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-pencil me-1"></i> Edit Section
                        </a>
                        <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" onsubmit="return confirm('Delete {{ $section->name }}? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="bi bi-trash me-1"></i> Delete Section
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
