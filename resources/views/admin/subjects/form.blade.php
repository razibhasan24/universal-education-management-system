@extends('layouts.admin')

@section('title', $subject && $subject->exists ? 'Edit Subject' : 'Add Subject')

@section('page-title')
    <h1 class="h3 fw-semibold mb-0">
        <i class="bi bi-{{ $subject && $subject->exists ? 'pencil' : 'plus-lg' }} me-2"></i>
        {{ $subject && $subject->exists ? 'Edit' : 'Add' }} Subject
    </h1>
@endif

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ $subject && $subject->exists ? route('admin.subjects.update', $subject) : route('admin.subjects.store') }}">
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

                @include('admin.subjects._form', ['subject' => $subject, 'institutions' => $institutions, 'classes' => $classes])

                <div class="d-flex align-items-center gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> {{ $subject && $subject->exists ? 'Update' : 'Create' }}
                    </button>
                    <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
