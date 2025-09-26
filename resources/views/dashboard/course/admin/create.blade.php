@extends('dashboard.partials.layout')
@section('title', 'Add Course')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Add New Course</h3>
            <a href="{{ route('course.index') }}" class="btn btn-secondary">← Back to Courses</a>
        </div>

        <div class="card shadow-sm p-4">
            <form action="{{ route('course.store') }}" method="POST">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Course Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="form-control @error('title') is-invalid @enderror" 
                        value="{{ old('title') }}" 
                        required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- YouTube Link --}}
                <div class="mb-3">
                    <label for="link" class="form-label">YouTube Link</label>
                    <input 
                        type="url" 
                        name="link" 
                        id="link" 
                        class="form-control @error('link') is-invalid @enderror" 
                        value="{{ old('link') }}" 
                        placeholder="https://www.youtube.com/watch?v=XXXXXXX"
                        required>
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Course Description</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        class="form-control @error('description') is-invalid @enderror" 
                        rows="3" 
                        required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tier --}}
                <div class="mb-3">
                    <label for="tier" class="form-label">Tier</label>
                    <select 
                        name="tier" 
                        id="tier" 
                        class="form-select @error('tier') is-invalid @enderror" 
                        required>
                        <option value="" disabled selected>Select Tier</option>
                        <option value="intro" {{ old('tier') == 'intro' ? 'selected' : '' }}>Intro</option>
                        <option value="all" {{ old('tier') == 'all' ? 'selected' : '' }}>All</option>
                        <option value="free" {{ old('tier') == 'free' ? 'selected' : '' }}>Free</option>
                        <option value="premium" {{ old('tier') == 'premium' ? 'selected' : '' }}>Premium</option>
                        <option value="advance" {{ old('tier') == 'advance' ? 'selected' : '' }}>Advance</option>
                    </select>
                    @error('tier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Save Course</button>
                </div>
            </form>
        </div>
    </div>
@endsection
