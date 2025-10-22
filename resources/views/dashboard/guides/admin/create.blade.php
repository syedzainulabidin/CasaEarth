@extends('dashboard.partials.layout')
@section('title', 'Upload Guide')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Upload New Guide</h4>
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

                        {{-- Upload Form --}}
                        <form action="{{ route('guide.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Title --}}
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="form-control" required>
                            </div>

                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            {{-- Tier --}}
                            <div class="mb-3">
                                <label for="tier" class="form-label">Access Tier</label>
                                <select name="tier" id="tier" class="form-select" required>
                                    <option value="">-- Select Tier --</option>
                                    <option value="free" {{ old('tier') == 'free' ? 'selected' : '' }}>Free</option>
                                    <option value="premium" {{ old('tier') == 'premium' ? 'selected' : '' }}>Premium
                                    </option>
                                    <option value="advance" {{ old('tier') == 'advance' ? 'selected' : '' }}>Advance
                                    </option>
                                </select>
                            </div>

                            {{-- PDF File --}}
                            <div class="mb-3">
                                <label for="file" class="form-label">PDF File</label>
                                <input type="file" name="file" id="file" accept="application/pdf"
                                    class="form-control" required>
                            </div>

                            {{-- Submit --}}
                            <div>
                                <button type="submit" class="btn btn-dark">
                                    Upload Guide
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
