@extends('dashboard.partials.layout')
@section('title', 'All Appointments')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">All Appointments</h3>

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
                        <th>Booked At</th>
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
                            <td>{{ $appointment->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                {{-- Approve --}}
                                <form action="{{ route('appointment.update', $appointment->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" 
                                        class="btn btn-sm btn-success"
                                        @if($appointment->status === 'approved' || $appointment->status === 'completed' || $appointment->status === 'rejected') disabled @endif>
                                        Approve
                                    </button>
                                </form>

                                {{-- Reject --}}
                                <form action="{{ route('appointment.update', $appointment->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" 
                                        class="btn btn-sm btn-danger"
                                        @if($appointment->status === 'rejected' || $appointment->status === 'completed') disabled @endif>
                                        Reject
                                    </button>
                                </form>

                                {{-- Completed --}}
                                <form action="{{ route('appointment.update', $appointment->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" 
                                        class="btn btn-sm btn-primary"
                                        @if($appointment->status === 'completed' || $appointment->status === 'rejected') disabled @endif>
                                        Completed
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
