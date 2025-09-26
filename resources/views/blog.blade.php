@extends('partials.layout')
@section('title', $blog->heading)

@section('content')
    <div class="container py-5">
        <h2 class="mb-3">{{ $blog->heading }}</h2>
        <p class="text-muted">Published on {{ $blog->created_at->format('F j, Y') }}</p>
        <div class="mt-4">
            {!! nl2br(e($blog->content)) !!}
        </div>

        <a href="{{ route('blogs') }}" class="bstn btn-secondary mt-4">← Back to Blogs</a>
    </div>
@endsection
