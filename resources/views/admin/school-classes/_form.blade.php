@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="institution_id" class="form-label">Institution <span class="text-danger">*</span></label>
            <select class="form-select @error('institution_id') is-invalid @endif" id="institution_id" name="institution_id" required>
                <option value="">Select Institution</option>
                @foreach ($institutions as $institution)
                    <option value="{{ $institution->id }}" {{ old('institution_id', $class->institution_id ?? '') == $institution->id ? 'selected' : '' }}>{{ $institution->name }}</option>
                @endforeach
            </select>
            @error('institution_id')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="academic_session_id" class="form-label">Academic Session <span class="text-danger">*</span></label>
            <select class="form-select @error('academic_session_id') is-invalid @endif" id="academic_session_id" name="academic_session_id" required>
                <option value="">Select Session</option>
                @foreach ($sessions as $session)
                    <option value="{{ $session->id }}" {{ old('academic_session_id', $class->academic_session_id ?? '') == $session->id ? 'selected' : '' }}>{{ $session->name }} ({{ $session->institution->name }})</option>
                @endforeach
            </select>
            @error('academic_session_id')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Class Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @endif" id="name" name="name" value="{{ old('name', $class->name ?? '') }}" placeholder="e.g. Class 6, Level 1, XI" required>
            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control @error('code') is-invalid @endif" id="code" name="code" value="{{ old('code', $class->code ?? '') }}" placeholder="e.g. C6, L1, XI-Sci">
            @error('code')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
            <div class="form-text">Optional short code for this class.</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="numeric_order" class="form-label">Numeric Order</label>
            <input type="number" class="form-control @error('numeric_order') is-invalid @endif" id="numeric_order" name="numeric_order" value="{{ old('numeric_order', $class->numeric_order ?? 0) }}" min="0" max="65535">
            @error('numeric_order')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
            <div class="form-text">Used for sorting classes.</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @endif" id="status" name="status">
                @foreach (\App\Models\SchoolClass::statuses() as $status)
                    <option value="{{ $status }}" {{ old('status', $class->status ?? '') == $status ? 'selected' : '' }}>{{ \App\Models\SchoolClass::statusLabel($status) }}</option>
                @endforeach
            </select>
            @error('status')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>
</div>
