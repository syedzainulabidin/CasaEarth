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

        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Video</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Tier</th>
                    <th>Is new ?</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    @php
                        // Extract YouTube video ID
                        $cleanLink = \Illuminate\Support\Str::before($course->link, '&');
                        $videoId = \Illuminate\Support\Str::after($cleanLink, 'v=');
                    @endphp
                    <tr>
                        <td style="width: 180px;">
                            <a href="{{ route('course.show', $course->id) }}">
                                <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                    alt="{{ $course->title }} Thumbnail" class="img-fluid rounded shadow-sm">
                            </a>
                        </td>
                        <td>{{ $course->title }}</td>
                        <td>{{ Str::limit($course->description, 100) }}</td>
                        <td>{{ ucfirst($course->tier) }}</td>
                        <td>{{ $course->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('course.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('course.destroy', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
