@extends('dashboard.partials.layout')
@section('title', 'My Courses')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Available Courses</h3>

        @if ($courses->isEmpty())
            <div class="alert alert-info">
                No courses available at the moment.
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
                    @foreach ($courses as $course)
                        @php
                            $cleanLink = \Illuminate\Support\Str::before($course->link, '&');
                            $videoId = \Illuminate\Support\Str::after($cleanLink, 'v=');
                            $hasAccess = in_array($course->tier, $allowedTiers);
                        @endphp
                        <tr>
                            <td style="width: 160px;">
                                @if ($hasAccess)
                                    <a href="{{ route('course.show', $course->id) }}">
                                        <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                            alt="{{ $course->title }}" class="img-fluid rounded shadow-sm">
                                    </a>
                                @else
                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                        alt="{{ $course->title }}" class="img-fluid rounded shadow-sm opacity-50">
                                @endif
                            </td>
                            <td>{{ $course->title }}</td>
                            <td>{{ Str::limit($course->description, 100) }}</td>
                            <td>
                                <span class="badge bg-primary">{{ ucfirst($course->tier) }}</span>
                                @unless ($hasAccess)
                                    <span class="badge bg-danger ms-2">Locked</span>
                                @endunless
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
