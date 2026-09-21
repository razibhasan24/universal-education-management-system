@extends('layouts.admin')

@section('title', 'View Institution')

@section('page-title')
    <h1 class="h3 fw-semibold mb-0">
        <i class="bi bi-eye me-2"></i> Institution Profile
    </h1>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="text-muted small">Name</div>
                            <div>{{ $institution->name }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-muted small">Institution Type</div>
                            <div>{{\App\Models\Institution::typeLabel($institution->institution_type)}}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-muted small">Code</div>
                            <div>{{ $institution->code ?? '—' }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-muted small">EIIN</div>
                            <div>{{ $institution->eiin ?? '—' }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-muted small">Email</div>
                            <div>{{ $institution->email ?? '—' }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-muted small">Phone</div>
                            <div>{{ $institution->phone ?? '—' }}</div>
                        </div>

                        <div class="col-12">
                            <div class="text-muted small">Address</div>
                            <div>{{ $institution->address ?? '—' }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-muted small">Status</div>
                            <div>
                                @if ($institution->status === \App\Models\Institution::STATUS_ACTIVE)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-muted small">Created</div>
                            <div>{{ $institution->created_at?->format('M d, Y g:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.institutions.edit', $institution) }}" class="btn btn-primary">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <form action="{{ route('admin.institutions.destroy', $institution) }}" method="POST" onsubmit="return confirm('Delete {{ $institution->name }}? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </form>
                <a href="{{ route('admin.institutions.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-transparent">
                    <span class="text-muted small">Logo</span>
                </div>
                <div class="card-body text-center">
                    @if ($institution->logo)
                        <img src="{{ asset('storage/' . $institution->logo) }}" alt="Logo" class="img-fluid rounded" style="max-height: 200px; object-fit: contain;">
                    @else
                        <div class="text-muted">
                            <i class="bi bi-image fs-1 d-block mb-2"></i> No logo uploaded.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
