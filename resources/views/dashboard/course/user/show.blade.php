@extends('dashboard.partials.layout')
@section('title', $course->title)

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h3 class="mb-3">{{ $course->title }}</h3>
            <div class="ratio ratio-16x9 mb-3" id="course-video">
                <iframe
                    src="https://www.youtube-nocookie.com/embed/{{ $videoId }}?rel=0&modestbranding=1&controls=0&disablekb=1"
                    title="{{ $course->title }}" frameborder="0" allowfullscreen>
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
@push('scripts')
    <script>
        (function() {
            let devtoolsOpen = false;
            const threshold = 160;

            setInterval(function() {
                const widthThreshold = window.outerWidth - window.innerWidth > threshold;
                const heightThreshold = window.outerHeight - window.innerHeight > threshold;
                if (widthThreshold || heightThreshold) {
                    if (!devtoolsOpen) {
                        devtoolsOpen = true;
                        document.getElementById('course-video')?.remove();
                        alert('Unnecessary Action may remove video');
                        location.reload();
                    }
                } else {
                    devtoolsOpen = false;
                }
            }, 1000);
        })();
    </script>
@endpush
