@extends('dashboard.partials.layout')
@section('title', 'Blogs')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Blog List</h3>
            <a href="{{ route('blog.create') }}" class="btn btn-dark">
                + Add Blog
            </a>
        </div>

        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Heading</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->heading }}</td>
                        <td>{{ Str::limit($blog->content, 80) }}</td>
                        <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" class="d-inline">
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
