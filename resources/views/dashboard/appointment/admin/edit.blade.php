@extends('dashboard.partials.layout')
@section('title', 'Edit Appointment')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Appointment</h3>

    <form action="{{ route('appointment.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="therapist_id" class="form-label">Therapist</label>
            <select name="therapist_id" id="therapist_id" class="form-select" required>
                @foreach ($therapists as $therapist)
                    <option value="{{ $therapist->id }}" {{ $appointment->therapist_id == $therapist->id ? 'selected' : '' }}>
                        {{ $therapist->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <input type="number" name="user_id" id="user_id" class="form-control"
                   value="{{ $appointment->user_id }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="pending"   {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved"  {{ $appointment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected"  {{ $appointment->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
