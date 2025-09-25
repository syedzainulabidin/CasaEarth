@extends('partials.layout')
@section('title', 'Blogs')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center">Our Blogs</h2>

        @if ($blogs->count())
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $blog->heading }}</h5>
                                <p class="card-text">
                                    {{ Str::limit($blog->content, 120) }}
                                </p>
                                <a href="{{ route('blog', $blog->id) }}" class="mt-auto btn btn-primary btn-sm">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center">No blogs available yet.</p>
        @endif
    </div>
@endsection
