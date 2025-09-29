@extends('dashboard.partials.layout')
@section('title', 'Therapists')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Available Therapists</h3>

    @if($therapists->isEmpty())
        <div class="alert alert-info">
            No therapists available at the moment.
        </div>
    @else
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($therapists as $therapist)
                    <tr>
                        <td>{{ $therapist->name }}</td>
                        <td>{{ $therapist->specialization ?? '—' }}</td>
                        <td>{{ $therapist->email }}</td>
                        <td>
                            <a href="{{ route('appointment.create', $therapist->id) }}" 
                               class="btn btn-sm btn-success">
                                Book Appointment
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
