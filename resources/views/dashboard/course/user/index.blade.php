@extends('dashboard.partials.layout')
@section('title', 'My Courses')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Available Courses</h3>

        @if ($userCourses->isEmpty())
            <div class="alert alert-info">
                No courses available for your current tier.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Tier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userCourses as $course)
                        @php
                            // Get YouTube video ID
                            $cleanLink = \Illuminate\Support\Str::before($course->link, '&');
                            $videoId = \Illuminate\Support\Str::after($cleanLink, 'v=');
                        @endphp
                        <tr>
                            <td style="width: 160px;">
                                <a href="{{ route('course.show', $course->id) }}">
                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                        alt="{{ $course->title }}" class="img-fluid rounded shadow-sm">
                                </a>

                            </td>
                            <td>{{ $course->title }}</td>
                            <td>{{ Str::limit($course->description, 100) }}</td>
                            <td><span class="badge bg-primary">{{ ucfirst($course->tier) }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
