@extends('dashboard.partials.layout')

@section('title', 'Edit Tier')

@section('content')
    <div class="container mt-5">
        <h2>Edit Tier</h2>

        <form action="{{ route('tier.update', $tier->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tier Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $tier->title) }}" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Price ($)</label>
                <input type="number" name="price" class="form-control" step="0.01"
                    value="{{ old('price', $tier->price) }}" required>
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Includes (Add or remove)</label>
                <div id="includes-wrapper">
                                 @php
                    // Use old input if available (after validation failure)
                    $includes = old('includes');

                    if (is_null($includes)) {
                        // Otherwise decode from DB
                        $rawIncludes = $tier->includes;

                        if (is_string($rawIncludes)) {
                            $decoded = json_decode($rawIncludes, true);
                            if (is_string($decoded)) {
                                $decoded = json_decode($decoded, true);
                            }
                            $includes = $decoded;
                        } elseif (is_array($rawIncludes)) {
                            $includes = $rawIncludes;
                        } else {
                            $includes = [];
                        }
                    }

                    // Final safety fallback
                    $includes = is_array($includes) ? $includes : [];
                @endphp

                @forelse ($includes as $item)
                    <div class="d-flex mb-2 gap-2">
                        <input type="text" name="includes[]" class="form-control" value="{{ $item }}">
                        <button type="button" class="btn btn-danger btn-sm remove-include">&times;</button>
                    </div>
                @empty
                    <div class="d-flex mb-2 gap-2">
                        <input type="text" name="includes[]" class="form-control" placeholder="Feature">
                        <button type="button" class="btn btn-danger btn-sm remove-include">&times;</button>
                    </div>
                @endforelse
                </div>
                <button type="button" id="add-include" class="btn btn-sm btn-secondary">+ Add Feature</button>
            </div>

            <button type="submit" class="btn btn-primary">Update Tier</button>
        </form>
    </div>

    <script>
        const wrapper = document.getElementById('includes-wrapper');
        const addBtn = document.getElementById('add-include');

        function createIncludeInput(value = '') {
            const div = document.createElement('div');
            div.className = 'd-flex mb-2 gap-2';
            div.innerHTML = `
            <input type="text" name="includes[]" class="form-control" placeholder="Feature" value="${value}">
            <button type="button" class="btn btn-danger btn-sm remove-include">&times;</button>
        `;
            return div;
        }

        addBtn.addEventListener('click', () => {
            wrapper.appendChild(createIncludeInput());
        });

        wrapper.addEventListener('click', e => {
            if (e.target.classList.contains('remove-include')) {
                e.target.closest('.d-flex').remove();
            }
        });
    </script>
@endsection
