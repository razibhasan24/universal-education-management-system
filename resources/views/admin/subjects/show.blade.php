@extends('layouts.admin')

@section('title', $subject->name)

@section('page-title')
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="h3 fw-semibold mb-0">
            <i class="bi bi-book me-2"></i> {{ $subject->name }}
        </h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-sm btn-outline-secondary">
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
                    <h5 class="card-title mb-4">Subject Details</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Institution</label>
                                <div class="fw-medium">{{ $subject->institution->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Class</label>
                                <div class="fw-medium">{{ $subject->schoolClass->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Subject Name</label>
                                <div class="fw-medium">{{ $subject->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Code</label>
                                <div class="fw-medium">{{ $subject->code ?? '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Full Marks</label>
                                <div class="fw-medium">{{ $subject->full_marks }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Pass Marks</label>
                                <div class="fw-medium">{{ $subject->pass_marks }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Subject Type</label>
                                <div>
                                    @if ($subject->subject_type === \App\Models\Subject::TYPE_COMPULSORY)
                                        <span class="badge bg-primary">Compulsory</span>
                                    @elseif ($subject->subject_type === \App\Models\Subject::TYPE_OPTIONAL)
                                        <span class="badge bg-info">Optional</span>
                                    @elseif ($subject->subject_type === \App\Models\Subject::TYPE_PRACTICAL)
                                        <span class="badge bg-warning text-dark">Practical</span>
                                    @else
                                        <span class="badge bg-secondary">{{ \App\Models\Subject::typeLabel($subject->subject_type) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Status</label>
                                <div>
                                    @if ($subject->status === \App\Models\Subject::STATUS_ACTIVE)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">{{ \App\Models\Subject::statusLabel($subject->status) }}</span>
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
                        <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-pencil me-1"></i> Edit Subject
                        </a>
                        <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" onsubmit="return confirm('Delete {{ $subject->name }}? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="bi bi-trash me-1"></i> Delete Subject
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
