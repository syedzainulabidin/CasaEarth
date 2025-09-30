@extends('dashboard.partials.layout')
@section('title', 'Book Appointment')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Book Appointment</h3>

        <form action="{{ route('appointment.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="therapist_id" class="form-label">Therapist</label>
                <select name="therapist_id" id="therapist_id" class="form-select" required>
                    <option value="">Select Therapist</option>
                    @foreach ($therapists as $therapist)
                        <option value="{{ $therapist->id }}">{{ $therapist->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- user_id is auto set in controller, no need to show field --}}

            <button type="submit" class="btn btn-primary">Book</button>
            <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
