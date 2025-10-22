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

        {{-- user cannot change status, only therapist --}}

        <button type="submit" class="btn btn-dark">Update</button>
        <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
