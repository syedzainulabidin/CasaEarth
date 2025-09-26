@extends('dashboard.partials.layout')
@section('title', 'Courses')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Courses</h3>
            <a href="{{ route('course.create') }}" class="btn btn-success">
                + Add Course
            </a>
        </div>

        <div class="row">
            @foreach ($courses as $course)
                <div class="col-12 mb-5">
                    <div class="card shadow-sm p-3">
                        {{-- Title --}}
                        <h5 class="mb-3">{{ $course->title }}</h5>

                        {{-- Video --}}
                        <div class="ratio ratio-16x9 mb-3">
                            <iframe 
                                src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($course->link, 'v=') }}" 
                                title="{{ $course->title }}"
                                allowfullscreen>
                            </iframe>
                        </div>

                        {{-- Description --}}
                        <p class="text-muted">{{ $course->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
