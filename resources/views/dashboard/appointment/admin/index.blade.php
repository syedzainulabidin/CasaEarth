@extends('dashboard.partials.layout')
@section('title', 'All Appointments')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Appointments</h3>
            <a href="{{ route('appointment.create') }}" class="btn btn-dark">
                + New Appointment
            </a>
        </div>

        @if ($appointments->isEmpty())
            <div class="alert alert-info">
                No appointments have been booked yet.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>User</th>
                        <th>Therapist</th>
                        <th>Status</th>
                        <th>Slot</th>
                        <th>Appointment</th>
                        <th>Meet Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->user->name }}</td>
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
                            <td><a href="{{ $appointment->meet_link ?? '' }}"
                                    target="_blank">{{ $appointment->meet_link ?? '' }}</td>
                            </a>
                            <td>
                                {{-- Approve --}}
                                <form action="{{ route('appointment.update', $appointment->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-sm btn-success"
                                        @if ($appointment->status !== 'pending') disabled @endif>
                                        Approve
                                    </button>
                                </form>

                                {{-- Reject --}}
                                <form action="{{ route('appointment.update', $appointment->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        @if ($appointment->status !== 'pending') disabled @endif>
                                        Reject
                                    </button>
                                </form>

                                {{-- Completed
                                <form action="{{ route('appointment.update', $appointment->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn btn-sm btn-primary"
                                        @if ($appointment->status !== 'approved') disabled @endif>
                                        Completed
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
