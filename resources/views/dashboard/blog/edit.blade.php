@extends('dashboard.partials.layout')
@section('title', 'Edit Blog')

@section('content')
    <div class="container mt-4">
        <h3>Edit Blog</h3>

        <form action="{{ route('blog.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Heading --}}
            <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" name="heading" class="form-control"
                       value="{{ old('heading', $blog->heading) }}" required>
                @error('heading')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- Content --}}
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="6" class="form-control" required>{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-success">Update Blog</button>
            <a href="{{ route('blog.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
