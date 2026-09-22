@extends('layouts.admin')

@section('title', 'Academic Sessions')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="h3 fw-semibold mb-0">
            <i class="bi bi-calendar-range me-2"></i> Academic Sessions
        </h1>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <form method="GET" action="{{ route('admin.academic-sessions.index') }}" class="d-flex gap-2 flex-wrap" style="width: auto;">
            <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search by name or institution..." style="width: 280px;">
            <select name="institution_id" class="form-select form-select-sm" style="width: 200px;">
                <option value="">All Institutions</option>
                @foreach ($institutions as $inst)
                    <option value="{{ $inst->id }}" {{ request('institution_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                @endforeach
            </select>
            <select name="status" class="form-select form-select-sm" style="width: 150px;">
                <option value="">All Status</option>
                @foreach (\App\Models\AcademicSession::statuses() as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ \App\Models\AcademicSession::statusLabel($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            @if (request('search') || request('institution_id') || request('status'))
                <a href="{{ route('admin.academic-sessions.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
            @endif
        </form>

        <a href="{{ route('admin.academic-sessions.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Session
        </a>
    </div>

    @if ($sessions->count())
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Institution</th>
                            <th scope="col">Session Name</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $session)
                            <tr>
                                <td>
                                    <div class="fw-medium">{{ $session->institution->name }}</div>
                                </td>
                                <td>
                                    <div class="fw-medium">{{ $session->name }}</div>
                                    @if ($session->isActive() && $session->isCurrent())
                                        <span class="badge bg-success-subtle text-success mt-1">Current</span>
                                    @endif
                                </td>
                                <td>{{ $session->start_date->format('M d, Y') }}</td>
                                <td>{{ $session->end_date->format('M d, Y') }}</td>
                                <td>
                                    @if ($session->status === \App\Models\AcademicSession::STATUS_ACTIVE)
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($session->status === \App\Models\AcademicSession::STATUS_UPCOMING)
                                        <span class="badge bg-info">Upcoming</span>
                                    @elseif ($session->status === \App\Models\AcademicSession::STATUS_COMPLETED)
                                        <span class="badge bg-secondary">Completed</span>
                                    @else
                                        <span class="badge bg-secondary">{{ \App\Models\AcademicSession::statusLabel($session->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.academic-sessions.show', $session) }}" class="btn btn-sm btn-outline-secondary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if ($session->status !== \App\Models\AcademicSession::STATUS_ACTIVE)
                                        <form action="{{ route('admin.academic-sessions.set-active', $session) }}" method="POST" class="d-inline" onsubmit="return confirm('Set {{ $session->name }} as the active session for {{ $session->institution->name }}?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Set Active">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="btn btn-sm btn-outline-success disabled" title="Already Active">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                    @endif
                                    <a href="{{ route('admin.academic-sessions.edit', $session) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.academic-sessions.destroy', $session) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete {{ $session->name }}? This cannot be undone.')">
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
            {{ $sessions->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="card shadow-sm py-4">
            <div class="text-center text-muted">
                <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                @if (request('search') || request('institution_id') || request('status'))
                    <p class="mb-0">No academic sessions found matching your filters.</p>
                @else
                    <p class="mb-0">No academic sessions found yet.</p>
                @endif
            </div>
        </div>
    @endif
@endsection
