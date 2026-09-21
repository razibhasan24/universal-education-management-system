@extends('layouts.admin')

@section('title', $institution && $institution->exists ? 'Edit Institution' : 'Add Institution')

@section('page-title')
    <h1 class="h3 fw-semibold mb-0">
        <i class="bi bi-{{ $institution && $institution->exists ? 'pencil' : 'plus-lg' }} me-2"></i>
        {{ $institution && $institution->exists ? 'Edit' : 'Add' }} Institution
    </h1>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ $institution && $institution->exists ? route('admin.institutions.update', $institution) : route('admin.institutions.store') }}" enctype="multipart/form-data">
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

                @include('admin.institutions._form', ['institution' => $institution])

                <div class="d-flex align-items-center gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> {{ $institution && $institution->exists ? 'Update' : 'Create' }}
                    </button>
                    <a href="{{ route('admin.institutions.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
