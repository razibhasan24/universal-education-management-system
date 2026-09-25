@extends('layouts.admin')

@section('title', 'Subjects')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="h3 fw-semibold mb-0">
            <i class="bi bi-book me-2"></i> Subjects
        </h1>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <form method="GET" action="{{ route('admin.subjects.index') }}" class="d-flex gap-2 flex-wrap" style="width: auto;">
            <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search by name, code..." style="width: 240px;">
            <select name="institution_id" class="form-select form-select-sm" style="width: 180px;">
                <option value="">All Institutions</option>
                @foreach ($institutions as $inst)
                    <option value="{{ $inst->id }}" {{ request('institution_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                @endforeach
            </select>
            <select name="class_id" class="form-select form-select-sm" style="width: 180px;">
                <option value="">All Classes</option>
                @foreach ($classes as $cls)
                    <option value="{{ $cls->id }}" {{ request('class_id') == $cls->id ? 'selected' : '' }}>{{ $cls->name }}</option>
                @endforeach
            </select>
            <select name="subject_type" class="form-select form-select-sm" style="width: 150px;">
                <option value="">All Types</option>
                @foreach (\App\Models\Subject::types() as $type)
                    <option value="{{ $type }}" {{ request('subject_type') == $type ? 'selected' : '' }}>{{ \App\Models\Subject::typeLabel($type) }}</option>
                @endforeach
            </select>
            <select name="status" class="form-select form-select-sm" style="width: 130px;">
                <option value="">All Status</option>
                @foreach (\App\Models\Subject::statuses() as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ \App\Models\Subject::statusLabel($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            @if (request('search') || request('institution_id') || request('class_id') || request('subject_type') || request('status'))
                <a href="{{ route('admin.subjects.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
            @endif
        </form>

        <a href="{{ route('admin.subjects.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Subject
        </a>
    </div>

    @if ($subjects->count())
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Institution</th>
                            <th scope="col">Class</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Code</th>
                            <th scope="col" style="width: 80px;">Full Marks</th>
                            <th scope="col" style="width: 80px;">Pass Marks</th>
                            <th scope="col">Type</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td>
                                    <div class="fw-medium">{{ $subject->institution->name }}</div>
                                </td>
                                <td>{{ $subject->schoolClass->name }}</td>
                                <td>
                                    <div class="fw-medium">{{ $subject->name }}</div>
                                </td>
                                <td>{{ $subject->code ?? '—' }}</td>
                                <td class="text-center">{{ $subject->full_marks }}</td>
                                <td class="text-center">{{ $subject->pass_marks }}</td>
                                <td>
                                    @if ($subject->subject_type === \App\Models\Subject::TYPE_COMPULSORY)
                                        <span class="badge bg-primary">Compulsory</span>
                                    @elseif ($subject->subject_type === \App\Models\Subject::TYPE_OPTIONAL)
                                        <span class="badge bg-info">Optional</span>
                                    @elseif ($subject->subject_type === \App\Models\Subject::TYPE_PRACTICAL)
                                        <span class="badge bg-warning">Practical</span>
                                    @else
                                        <span class="badge bg-secondary">{{ \App\Models\Subject::typeLabel($subject->subject_type) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($subject->status === \App\Models\Subject::STATUS_ACTIVE)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">{{ \App\Models\Subject::statusLabel($subject->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.subjects.show', $subject) }}" class="btn btn-sm btn-outline-secondary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete {{ $subject->name }}? This cannot be undone.')">
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
            {{ $subjects->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="card shadow-sm py-4">
            <div class="text-center text-muted">
                <i class="bi bi-book fs-1 d-block mb-2"></i>
                @if (request('search') || request('institution_id') || request('class_id') || request('subject_type') || request('status'))
                    <p class="mb-0">No subjects found matching your filters.</p>
                @else
                    <p class="mb-0">No subjects found yet.</p>
                @endif
            </div>
        </div>
    @endif
@endsection
