@extends('layouts.admin')

@section('title', 'Classes')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="h3 fw-semibold mb-0">
            <i class="bi bi-grid-3x3-gap me-2"></i> Classes
        </h1>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <form method="GET" action="{{ route('admin.school-classes.index') }}" class="d-flex gap-2 flex-wrap" style="width: auto;">
            <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search by name, code, institution..." style="width: 260px;">
            <select name="institution_id" class="form-select form-select-sm" style="width: 200px;">
                <option value="">All Institutions</option>
                @foreach ($institutions as $inst)
                    <option value="{{ $inst->id }}" {{ request('institution_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                @endforeach
            </select>
            <select name="academic_session_id" class="form-select form-select-sm" style="width: 200px;">
                <option value="">All Sessions</option>
                @foreach ($sessions as $sess)
                    <option value="{{ $sess->id }}" {{ request('academic_session_id') == $sess->id ? 'selected' : '' }}>{{ $sess->name }}</option>
                @endforeach
            </select>
            <select name="status" class="form-select form-select-sm" style="width: 140px;">
                <option value="">All Status</option>
                @foreach (\App\Models\SchoolClass::statuses() as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ \App\Models\SchoolClass::statusLabel($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            @if (request('search') || request('institution_id') || request('academic_session_id') || request('status'))
                <a href="{{ route('admin.school-classes.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
            @endif
        </form>

        <a href="{{ route('admin.school-classes.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Class
        </a>
    </div>

    @if ($classes->count())
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 40px;">#</th>
                            <th scope="col">Institution</th>
                            <th scope="col">Academic Session</th>
                            <th scope="col">Class Name</th>
                            <th scope="col">Code</th>
                            <th scope="col" style="width: 80px;">Order</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $class)
                            <tr>
                                <td class="text-muted">{{ $class->numeric_order ?: '—' }}</td>
                                <td>
                                    <div class="fw-medium">{{ $class->institution->name }}</div>
                                </td>
                                <td>{{ $class->academicSession->name }}</td>
                                <td>
                                    <div class="fw-medium">{{ $class->name }}</div>
                                </td>
                                <td>{{ $class->code ?? '—' }}</td>
                                <td class="text-center">{{ $class->numeric_order ?? '—' }}</td>
                                <td>
                                    @if ($class->status === \App\Models\SchoolClass::STATUS_ACTIVE)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">{{ \App\Models\SchoolClass::statusLabel($class->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.school-classes.show', $class) }}" class="btn btn-sm btn-outline-secondary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.school-classes.edit', $class) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.school-classes.destroy', $class) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete {{ $class->name }}? This cannot be undone.')">
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
            {{ $classes->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="card shadow-sm py-4">
            <div class="text-center text-muted">
                <i class="bi bi-grid-3x3-gap fs-1 d-block mb-2"></i>
                @if (request('search') || request('institution_id') || request('academic_session_id') || request('status'))
                    <p class="mb-0">No classes found matching your filters.</p>
                @else
                    <p class="mb-0">No classes found yet.</p>
                @endif
            </div>
        </div>
    @endif
@endsection
