@extends('dashboard.partials.layout')
@section('title', 'Edit Guide')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Edit Guide</h3>

        <form action="{{ route('event.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="event_title" class="form-label">event Title</label>
                <input type="text" name="event_title" id="event_title" class="form-control" value="{{ $event->title }}">
            </div>
            <div class="mb-3">
                <label for="event_description" class="form-label">event Description</label>
                <input type="text" name="event_description" id="event_description" class="form-control"
                    value="{{ $event->description }}">
            </div>
            <div class="mb-3">
                <label for="event_date_time" class="form-label">event date_time</label>
                <input type="datetime-local" name="event_date_time" id="event_date_time" class="form-control"
                    value="{{ $event->date_time }}">
            </div>
            <div class="mb-3">
                <label for="tier" class="form-label">Choose a Tier</label>
                <select name="tier" id="tier" class="form-select @error('tier') is-invalid @enderror">
                    <option value="" disabled {{ old('tier') ? '' : 'selected' }}>Select your tier</option>
                    @foreach ($tiers as $tier)
                        <option value="{{ $tier->id }}"
                            {{ $event->tier_id == strToLower($tier->id) ? 'selected' : '' }}>
                            {{ ucfirst($tier->title) }}
                        </option>
                    @endforeach
                </select>
                @error('tier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="event_link" class="form-label">event link</label>
                <input type="text" name="event_link" id="event_link" class="form-control" value="{{ $event->link }}">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('event.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
