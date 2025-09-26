@extends('dashboard.partials.layout')
@section('title', 'Edit Course')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Edit Course</h3>
        <a href="{{ route('course.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <form action="{{ route('course.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Course Title</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $course->title) }}"
                required
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Link --}}
        <div class="mb-3">
            <label for="link" class="form-label">YouTube Link</label>
            <input 
                type="url" 
                name="link" 
                id="link" 
                class="form-control @error('link') is-invalid @enderror"
                value="{{ old('link', $course->link) }}"
                required
            >
            @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Video Preview --}}
        <div class="mb-3">
            @php
                $cleanLink = \Illuminate\Support\Str::before($course->link, '&');
                $videoId = \Illuminate\Support\Str::after($cleanLink, 'v=');
                if (! $videoId && str_contains($cleanLink, 'youtu.be/')) {
                    $videoId = \Illuminate\Support\Str::after($cleanLink, 'youtu.be/');
                }
            @endphp

            @if($videoId)
                <div class="ratio ratio-16x9">
                    <iframe 
                        src="https://www.youtube.com/embed/{{ $videoId }}" 
                        title="{{ $course->title }}" 
                        allowfullscreen>
                    </iframe>
                </div>
            @endif
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea 
                name="description" 
                id="description" 
                class="form-control @error('description') is-invalid @enderror"
                rows="4"
                required>{{ old('description', $course->description) }}</textarea>
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
                required
            >
                <option value="">-- Select Tier --</option>
                @foreach (['intro','all','free','premium','advance'] as $tier)
                    <option value="{{ $tier }}" {{ old('tier', $course->tier) === $tier ? 'selected' : '' }}>
                        {{ ucfirst($tier) }}
                    </option>
                @endforeach
            </select>
            @error('tier')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>
@endsection
