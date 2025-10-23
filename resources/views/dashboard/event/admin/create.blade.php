@extends('dashboard.partials.layout')
@section('title', 'Create Event')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Create New Event</h4>
                    </div>

                    <div class="card-body">
                        {{-- Show validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Create Event Form --}}
                        <form action="{{ route('event.store') }}" method="POST">
                            @csrf

                            {{-- Event Title --}}
                            <div class="mb-3">
                                <label for="event_title" class="form-label">Event Title</label>
                                <input type="text" name="event_title" id="event_title" value="{{ old('event_title') }}"
                                    class="form-control" required>
                            </div>

                            {{-- Event Description --}}
                            <div class="mb-3">
                                <label for="event_description" class="form-label">Event Description</label>
                                <textarea name="event_description" id="event_description" rows="4" class="form-control" required>{{ old('event_description') }}</textarea>
                            </div>

                            {{-- Event Date Time --}}
                            <div class="mb-3">
                                <label for="event_date_time" class="form-label">Event Date & Time</label>
                                <input type="datetime-local" name="event_date_time" id="event_date_time" value="{{ old('event_date_time') }}"
                                    class="form-control" required>
                            </div>

                            {{-- Tier --}}
                            <div class="mb-3">
                                <label for="tier" class="form-label">Choose a Tier</label>
                                <select name="tier" id="tier" class="form-select" required>
                                    <option value="" disabled {{ old('tier') ? '' : 'selected' }}>-- Select Tier --</option>
                                    @foreach ($tiers as $tier)
                                        <option value="{{ $tier->id }}" {{ old('tier') == $tier->id ? 'selected' : '' }}>
                                            {{ ucfirst($tier->title) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Event Link --}}
                            <div class="mb-3">
                                <label for="event_link" class="form-label">Event Link</label>
                                <input type="url" name="event_link" id="event_link" value="{{ old('event_link') }}"
                                    class="form-control" required>
                            </div>

                            {{-- Submit --}}
                            <div>
                                <button type="submit" class="btn btn-dark">
                                    Create Event
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
