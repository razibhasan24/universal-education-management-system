@extends('layouts.admin')

@section('title', 'Sections')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="h3 fw-semibold mb-0">
            <i class="bi bi-diagram-3 me-2"></i> Sections
        </h1>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <form method="GET" action="{{ route('admin.sections.index') }}" class="d-flex gap-2 flex-wrap" style="width: auto;">
            <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search by section, class, institution..." style="width: 260px;">
            <select name="institution_id" class="form-select form-select-sm" style="width: 200px;">
                <option value="">All Institutions</option>
                @foreach ($institutions as $inst)
                    <option value="{{ $inst->id }}" {{ request('institution_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                @endforeach
            </select>
            <select name="class_id" class="form-select form-select-sm" style="width: 200px;">
                <option value="">All Classes</option>
                @foreach ($classes as $cls)
                    <option value="{{ $cls->id }}" {{ request('class_id') == $cls->id ? 'selected' : '' }}>{{ $cls->name }} ({{ $cls->institution->name }})</option>
                @endforeach
            </select>
            <select name="status" class="form-select form-select-sm" style="width: 140px;">
                <option value="">All Status</option>
                @foreach (\App\Models\Section::statuses() as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ \App\Models\Section::statusLabel($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            @if (request('search') || request('institution_id') || request('class_id') || request('status'))
                <a href="{{ route('admin.sections.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
            @endif
        </form>

        <a href="{{ route('admin.sections.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Section
        </a>
    </div>

    @if ($sections->count())
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Institution</th>
                            <th scope="col">Class</th>
                            <th scope="col">Section Name</th>
                            <th scope="col" style="width: 100px;">Capacity</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <td>
                                    <div class="fw-medium">{{ $section->institution->name }}</div>
                                </td>
                                <td>{{ $section->schoolClass->name }}</td>
                                <td>
                                    <div class="fw-medium">{{ $section->name }}</div>
                                </td>
                                <td class="text-center">{{ $section->capacity ?: '—' }}</td>
                                <td>
                                    @if ($section->status === \App\Models\Section::STATUS_ACTIVE)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">{{ \App\Models\Section::statusLabel($section->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.sections.show', $section) }}" class="btn btn-sm btn-outline-secondary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.sections.edit', $section) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete {{ $section->name }}? This cannot be undone.')">
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
            {{ $sections->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="card shadow-sm py-4">
            <div class="text-center text-muted">
                <i class="bi bi-diagram-3 fs-1 d-block mb-2"></i>
                @if (request('search') || request('institution_id') || request('class_id') || request('status'))
                    <p class="mb-0">No sections found matching your filters.</p>
                @else
                    <p class="mb-0">No sections found yet.</p>
                @endif
            </div>
        </div>
    @endif
@endsection
