@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $institution->name ?? '') }}" required>
            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $institution->code ?? '') }}" placeholder="e.g. SCH-001">
            @error('code')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label for="institution_type" class="form-label">Institution Type <span class="text-danger">*</span></label>
            <select class="form-select @error('institution_type') is-invalid @enderror" id="institution_type" name="institution_type" required>
                <option value="">Select type</option>
                @foreach (\App\Models\Institution::types() as $type)
                    <option value="{{ $type }}" {{ old('institution_type', $institution->institution_type ?? '') == $type ? 'selected' : '' }}>{{ \App\Models\Institution::typeLabel($type) }}</option>
                @endforeach
            </select>
            @error('institution_type')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="eiin" class="form-label">EIIN</label>
            <input type="text" class="form-control @error('eiin') is-invalid @enderror" id="eiin" name="eiin" value="{{ old('eiin', $institution->eiin ?? '') }}" placeholder="Educational Institution ID">
            @error('eiin')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $institution->email ?? '') }}">
            @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" required>{{ old('address', $institution->address ?? '') }}</textarea>
            @error('address')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $institution->phone ?? '') }}">
            @error('phone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                @foreach (\App\Models\Institution::statuses() as $status)
                    <option value="{{ $status }}" {{ old('status', $institution->status ?? '') == $status ? 'selected' : '' }}>{{ \App\Models\Institution::statusLabel($status) }}</option>
                @endforeach
            </select>
            @error('status')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo" accept="image/*">
            @error('logo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            @if (! empty($institution->logo))
                <div class="form-text">Current logo is set.</div>
            @endif
        </div>
    </div>
</div>
