@extends('dashboard.partials.layout')
@section('title', 'Manage Events')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Events</h3>
            <a href="{{ route('event.create') }}" class="btn btn-dark">
                + New Events
            </a>
        </div>
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>S.no</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Tier</th>
                    <th>Scheduled Date</th>
                    <th>Scheduled Time</th>
                    <th>Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->tier->title }}</td>
                        <td>{{ $event->date_time->format('d/m/Y') }}</td>
                        <td>{{ $event->date_time->format('h:i A') }}</td>
                        <td><a target="_blank" href="{{ $event->link }}">{{ $event->link }}</a></td>
                        <td>
                            <a href="{{ route('event.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('event.destroy', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure, you want to remove {{ $event->title }}?')">
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
