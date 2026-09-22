@extends('layouts.admin')

@section('title', $section && $section->exists ? 'Edit Section' : 'Add Section')

@section('page-title')
    <h1 class="h3 fw-semibold mb-0">
        <i class="bi bi-{{ $section && $section->exists ? 'pencil' : 'plus-lg' }} me-2"></i>
        {{ $section && $section->exists ? 'Edit' : 'Add' }} Section
    </h1>
@endif

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ $section && $section->exists ? route('admin.sections.update', $section) : route('admin.sections.store') }}">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @include('admin.sections._form', ['section' => $section, 'institutions' => $institutions, 'classes' => $classes])

                <div class="d-flex align-items-center gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> {{ $section && $section->exists ? 'Update' : 'Create' }}
                    </button>
                    <a href="{{ route('admin.sections.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
