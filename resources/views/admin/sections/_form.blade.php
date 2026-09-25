@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="institution_id" class="form-label">Institution <span class="text-danger">*</span></label>
            <select class="form-select @error('institution_id') is-invalid @endif" id="institution_id" name="institution_id" required>
                <option value="">Select Institution</option>
                @foreach ($institutions as $institution)
                    <option value="{{ $institution->id }}" {{ old('institution_id', $section->institution_id ?? '') == $institution->id ? 'selected' : '' }}>{{ $institution->name }}</option>
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
                    <option value="{{ $class->id }}" {{ old('class_id', $section->class_id ?? '') == $class->id ? 'selected' : '' }}>{{ $class->name }} ({{ $class->institution->name }})</option>
                @endforeach
            </select>
            @error('class_id')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Section Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @endif" id="name" name="name" value="{{ old('name', $section->name ?? '') }}" placeholder="e.g. A, B, C, Science, Arts" required>
            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('capacity') is-invalid @endif" id="capacity" name="capacity" value="{{ old('capacity', $section->capacity ?? 0) }}" min="0" max="65535" required>
            @error('capacity')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
            <div class="form-text">Maximum student capacity for this section.</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @endif" id="status" name="status">
                @foreach (\App\Models\Section::statuses() as $status)
                    <option value="{{ $status }}" {{ old('status', $section->status ?? '') == $status ? 'selected' : '' }}>{{ \App\Models\Section::statusLabel($status) }}</option>
                @endforeach
            </select>
            @error('status')<div class="invalid-feedback d-block">{{ $message }}</div>@endif
        </div>
    </div>
</div>
