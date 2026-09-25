@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="institution_id" class="form-label">Institution <span class="text-danger">*</span></label>
            <select class="form-select @error('institution_id') is-invalid @endif" id="institution_id" name="institution_id" required>
                <option value="">Select Institution</option>
                @foreach ($institutions as $institution)
                    <option value="{{ $institution->id }}" {{ old('institution_id', $subject->institution_id ?? '') == $institution->id ? 'selected' : '' }}>{{ $institution->name }}</option>
                @endforeach
            </select>
            @error('institution_id')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="class_id" class="form-label">Class <span class="text-danger">*</span></label>
            <select class="form-select @error('class_id') is-invalid @endif" id="class_id" name="class_id" required>
                <option value="">Select Class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}" {{ old('class_id', $subject->class_id ?? '') == $class->id ? 'selected' : '' }}>{{ $class->name }} ({{ $class->institution->name }})</option>
                @endforeach
            </select>
            @error('class_id')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Subject Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @endif" id="name" name="name" value="{{ old('name', $subject->name ?? '') }}" placeholder="e.g. Mathematics, English, Physics" required>
            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control @error('code') is-invalid @endif" id="code" name="code" value="{{ old('code', $subject->code ?? '') }}" placeholder="e.g. MATH, ENG, PHY">
            @error('code')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="full_marks" class="form-label">Full Marks <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('full_marks') is-invalid @endif" id="full_marks" name="full_marks" value="{{ old('full_marks', $subject->full_marks ?? 100) }}" min="1" max="65535" required>
            @error('full_marks')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="pass_marks" class="form-label">Pass Marks <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('pass_marks') is-invalid @endif" id="pass_marks" name="pass_marks" value="{{ old('pass_marks', $subject->pass_marks ?? 33) }}" min="0" max="65535" required>
            @error('pass_marks')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="subject_type" class="form-label">Subject Type <span class="text-danger">*</span></label>
            <select class="form-select @error('subject_type') is-invalid @endif" id="subject_type" name="subject_type" required>
                <option value="">Select Type</option>
                @foreach (\App\Models\Subject::types() as $type)
                    <option value="{{ $type }}" {{ old('subject_type', $subject->subject_type ?? '') == $type ? 'selected' : '' }}>{{ \App\Models\Subject::typeLabel($type) }}</option>
                @endforeach
            </select>
            @error('subject_type')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @endif" id="status" name="status">
                @foreach (\App\Models\Subject::statuses() as $status)
                    <option value="{{ $status }}" {{ old('status', $subject->status ?? '') == $status ? 'selected' : '' }}>{{ \App\Models\Subject::statusLabel($status) }}</option>
                @endforeach
            </select>
            @error('status')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>
</div>
