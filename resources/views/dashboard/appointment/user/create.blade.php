@extends('dashboard.partials.layout')
@section('title', 'Book Appointment')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Book New Appointment</h3>

        <form action="{{ route('appointment.store') }}" method="POST">
            @csrf

            {{-- Select Therapist --}}
            <div class="mb-3">
                <label for="therapist_id" class="form-label">Select Therapist</label>
                <select name="therapist_id" id="therapist_id" class="form-select @error('therapist_id') is-invalid @enderror"
                    required>
                    <option value="">-- Choose Therapist --</option>
                    @foreach ($therapists as $therapist)
                        <option value="{{ $therapist->id }}" {{ old('therapist_id') == $therapist->id ? 'selected' : '' }}>
                            {{ $therapist->name }}
                        </option>
                    @endforeach
                </select>
                @error('therapist_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Book Appointment</button>
        </form>
    </div>
@endsection
