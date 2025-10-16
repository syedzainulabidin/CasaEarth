@extends('dashboard.partials.layout')
@section('title', 'Edit Guide')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Edit Guide</h3>

        <form action="{{ route('guide.update', $guide->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="guide_title" class="form-label">Guide Title</label>
                <input type="text" name="guide_title" id="guide_title" class="form-control" value="{{ $guide->title }}">
            </div>
            <div class="mb-3">
                <label for="guide_description" class="form-label">Guide Description</label>
                <input type="text" name="guide_description" id="guide_description" class="form-control"
                    value="{{ $guide->description }}">
            </div>
            <div class="mb-3">
                <label for="tier" class="form-label">Choose a Tier</label>
                <select name="tier" id="tier" class="form-select @error('tier') is-invalid @enderror">
                    <option value="" disabled {{ old('tier') ? '' : 'selected' }}>Select your tier</option>
                    @foreach ($tiers as $tier)
                        <option value="{{ strToLower($tier->title) }}"
                            {{ $guide->tier == strToLower($tier->title) ? 'selected' : '' }}>
                            {{ ucfirst($tier->title) }}
                        </option>
                    @endforeach
                </select>
                @error('tier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">PDF File</label>
                <input type="file" name="file" id="file" accept="application/pdf" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('guide.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
