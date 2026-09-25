@extends('layouts.admin')

@section('title', $class && $class->exists ? 'Edit Class' : 'Add Class')

@section('page-title')
    <h1 class="h3 fw-semibold mb-0">
        <i class="bi bi-{{ $class && $class->exists ? 'pencil' : 'plus-lg' }} me-2"></i>
        {{ $class && $class->exists ? 'Edit' : 'Add' }} Class
    </h1>
@endif

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ $class && $class->exists ? route('admin.school-classes.update', $class) : route('admin.school-classes.store') }}">
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

                @include('admin.school-classes._form', ['class' => $class, 'institutions' => $institutions, 'sessions' => $sessions])

                <div class="d-flex align-items-center gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> {{ $class && $class->exists ? 'Update' : 'Create' }}
                    </button>
                    <a href="{{ route('admin.school-classes.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
