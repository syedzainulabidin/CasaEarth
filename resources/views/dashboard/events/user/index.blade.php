@extends('dashboard.partials.layout')
@section('title', 'Events')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">All Events</h3>
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>S.no</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Scheduled Date</th>
                    <th>Scheduled Time</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($myevents as $event)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->date_time->format('d/m/Y') }}</td>
                        <td>{{ $event->date_time->format('h:i A') }}</td>
                        <td><a target="_blank" href="{{ $event->link }}">{{ $event->link }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
