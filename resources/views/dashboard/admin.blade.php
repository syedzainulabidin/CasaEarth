@extends('dashboard.partials.layout')
@section('title', 'Dashboard')

@section('content')
    <h2>Admin Dashboard</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Your other dashboard content here -->
@endsection