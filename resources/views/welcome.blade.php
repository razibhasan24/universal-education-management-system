<?php $title = 'Welcome'; ?>

@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="text-center py-5">
    <div class="mb-4">
        <i class="bi bi-mortarboard-fill text-primary" style="font-size: 5rem;"></i>
    </div>
    <h1 class="fw-bold mb-3">{{ config('app.name', 'Laravel') }}</h1>
    <p class="text-muted mb-4">
        Universal Education Management System foundation is ready.
    </p>

    @auth
        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-5">
            <i class="bi bi-speedometer2"></i> Go to Dashboard
        </a>
    @else
        @if (Route::has('login'))
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-5 me-2">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
        @endif
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-person-plus"></i> Register
            </a>
        @endif
    @endauth
</div>
