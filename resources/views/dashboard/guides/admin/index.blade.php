@extends('dashboard.partials.layout')
@section('title', 'All Appointments')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Guides</h3>
            <a href="{{ route('guide.create') }}" class="btn btn-primary">
                + New Guide
            </a>
        </div>

        @if ($guides->isEmpty())
            <div class="alert alert-info">
                No guide have been uploaded yet.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>S.no</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Tier</th>
                        <th>Actions</th>
                        <th>Super Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guides as $guide)
                        <tr>
                            <td>
                                {{ $guide->id }}
                            </td>
                            <td>
                                {{ $guide->title }}
                            </td>
                            <td>
                                {{ $guide->description }}
                            </td>
                            <td>
                                {{ $guide->tier }}
                            </td>
                            <td>

                                <a href="{{ route('guide.download', $guide->id) }}" target="_blank"
                                    class="btn btn-sm btn-outline-success">
                                    Download
                                </a>


                                <a href="{{ route('guide.view', $guide->id) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('guide.edit', $guide->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('guide.destroy', $guide->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this guide?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
