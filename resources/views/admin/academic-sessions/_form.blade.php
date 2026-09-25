@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="institution_id" class="form-label">Institution <span class="text-danger">*</span></label>
            <select class="form-select @error('institution_id') is-invalid @endif" id="institution_id" name="institution_id" required>
                <option value="">Select Institution</option>
                @foreach ($institutions as $institution)
                    <option value="{{ $institution->id }}" {{ old('institution_id', $session->institution_id ?? '') == $institution->id ? 'selected' : '' }}>{{ $institution->name }}</option>
                @endforeach
            </select>
            @error('institution_id')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Session Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @endif" id="name" name="name" value="{{ old('name', $session->name ?? '') }}" placeholder="e.g. 2025-2026" required>
            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('start_date') is-invalid @endif" id="start_date" name="start_date" value="{{ old('start_date', $session->start_date?->format('Y-m-d') ?? '') }}" required>
            @error('start_date')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('end_date') is-invalid @endif" id="end_date" name="end_date" value="{{ old('end_date', $session->end_date?->format('Y-m-d') ?? '') }}" required>
            @error('end_date')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @endif" id="status" name="status">
                @foreach (\App\Models\AcademicSession::statuses() as $status)
                    <option value="{{ $status }}" {{ old('status', $session->status ?? '') == $status ? 'selected' : '' }}>{{ \App\Models\AcademicSession::statusLabel($status) }}</option>
                @endforeach
            </select>
            @error('status')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
            <div class="form-text">Set as <strong>Active</strong> to make this the current session for the institution.</div>
        </div>
    </div>
</div>
