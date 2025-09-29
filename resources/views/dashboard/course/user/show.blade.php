@extends('dashboard.partials.layout')
@section('title', $course->title)

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h3 class="mb-3">{{ $course->title }}</h3>

        <div class="ratio ratio-16x9 mb-3">
            <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                    title="{{ $course->title }}"
                    frameborder="0"
                    allowfullscreen>
            </iframe>
        </div>

        <p class="text-muted mb-2">{{ $course->description }}</p>
        <span class="badge bg-primary">Tier: {{ ucfirst($course->tier) }}</span>

        <div class="mt-3">
            <a href="{{ route('course.index') }}" class="btn btn-secondary">← Back to Courses</a>
        </div>
    </div>
</div>
@endsection
