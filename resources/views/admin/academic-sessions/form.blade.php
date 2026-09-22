@extends('layouts.admin')

@section('title', $session && $session->exists ? 'Edit Academic Session' : 'Add Academic Session')

@section('page-title')
    <h1 class="h3 fw-semibold mb-0">
        <i class="bi bi-{{ $session && $session->exists ? 'pencil' : 'plus-lg' }} me-2"></i>
        {{ $session && $session->exists ? 'Edit' : 'Add' }} Academic Session
    </h1>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ $session && $session->exists ? route('admin.academic-sessions.update', $session) : route('admin.academic-sessions.store') }}">
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

                @include('admin.academic-sessions._form', ['session' => $session, 'institutions' => $institutions])

                <div class="d-flex align-items-center gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> {{ $session && $session->exists ? 'Update' : 'Create' }}
                    </button>
                    <a href="{{ route('admin.academic-sessions.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
