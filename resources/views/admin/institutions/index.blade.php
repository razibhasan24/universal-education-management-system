@extends('layouts.admin')

@section('title', 'Institutions')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="h3 fw-semibold mb-0">
            <i class="bi bi-buildings me-2"></i> Institutions
        </h1>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <form method="GET" action="{{ route('admin.institutions.index') }}" class="position-relative" style="width: 320px;">
            <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm pe-5" placeholder="Search by name, code, EIIN...">
            <i class="bi bi-search position-absolute text-muted" style="right: 8px; top: 50%; transform: translateY(-50%);"></i>
        </form>

        <a href="{{ route('admin.institutions.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Institution
        </a>
    </div>

    @if ($institutions->count())
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Code</th>
                            <th scope="col">EIIN</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($institutions as $institution)
                            <tr>
                                <td>
                                    <div class="fw-medium">{{ $institution->name }}</div>
                                    @if ($institution->logo)
                                        <img src="{{ asset('storage/' . $institution->logo) }}" alt="Logo" class="d-none d-sm-inline-block mt-1" width="32" height="32" style="object-fit: cover; border-radius: 4px;">
                                    @endif
                                </td>
                                <td>{{ \App\Models\Institution::typeLabel($institution->institution_type) }}</td>
                                <td>{{ $institution->code ?? '—' }}</td>
                                <td>{{ $institution->eiin ?? '—' }}</td>
                                <td>{{ $institution->email ?? '—' }}</td>
                                <td>
                                    @if ($institution->status === \App\Models\Institution::STATUS_ACTIVE)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.institutions.show', $institution) }}" class="btn btn-sm btn-outline-secondary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.institutions.edit', $institution) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.institutions.destroy', $institution) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete {{ $institution->name }}? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $institutions->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="card shadow-sm py-4">
            <div class="text-center text-muted">
                <i class="bi bi-building-check fs-1 d-block mb-2"></i>
                @if (request('search'))
                    <p class="mb-0">No institutions found for "<strong>{{ request('search') }}</strong>".</p>
                @else
                    <p class="mb-0">No institutions found yet.</p>
                @endif
            </div>
        </div>
    @endif
@endsection
