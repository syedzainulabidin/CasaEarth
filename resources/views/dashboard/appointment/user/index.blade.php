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
                        <th>Slot</th>
                        <th>Appointment Date</th>
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
                                @elseif($appointment->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @elseif($appointment->status === 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td>@php
                                [$start, $end] = explode('-', $appointment->slot);
                                $startFormatted = \Carbon\Carbon::createFromFormat('H:i', $start)->format('h:i A');
                                $endFormatted = \Carbon\Carbon::createFromFormat('H:i', $end)->format('h:i A');
                            @endphp

                                {{ $startFormatted }} - {{ $endFormatted }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($appointment->date)->format('d-m-Y (l)') }}</td>

                            <td>{{ $appointment->created_at->format('d-m-Y (l)') }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
