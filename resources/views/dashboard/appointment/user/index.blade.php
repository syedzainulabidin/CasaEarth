@extends('dashboard.partials.layout')
@section('title', 'My Appointments')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>My Appointments</h3>
            <a href="{{ route('appointment.create') }}" class="btn btn-primary">
                + Book New Appointment
            </a>
        </div>

        @if ($userAppointments->isEmpty())
            <div class="alert alert-info">
                You haven’t booked any appointments yet.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Therapist</th>
                        <th>Status</th>
                        <th>Booked At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userAppointments as $appointment)
                        <tr>
                            <td>{{ $appointment->therapist->name }}</td>
                            <td>
                                @if ($appointment->status === 'approved')
                                <span class="badge bg-info">Approved</span>
                            @elseif($appointment->status   === 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @elseif($appointment->status === 'completed')
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                            </td>
                            <td>{{ $appointment->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
