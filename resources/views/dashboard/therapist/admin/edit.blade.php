@extends('dashboard.partials.layout') {{-- or your main layout --}}
@section('title', 'Edit: ' . $therapist->name)

@section('content')
    <div class="container mt-4">
        <h3>Edit Therapist</h3>

        <form action="{{ route('therapist.update', $therapist->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $therapist->name) }}" required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $therapist->email) }}"
                    required>
            </div>

            {{-- Specialization --}}
            <div class="mb-3">
                <label class="form-label">Specialization</label>
                <input type="text" name="specialization" class="form-control"
                    value="{{ old('specialization', $therapist->specialization) }}" required>
            </div>

            {{-- Slots --}}
            <div class="mb-3">
                <label class="form-label">Slots</label>
                <div id="slots-wrapper">
                    @foreach (json_decode($therapist->slots, true) as $slot)
                        @php
                            [$start, $end] = explode('-', $slot);
                        @endphp
                        <div class="row g-2 mb-2 align-items-center slot-row">
                            <div class="col">
                                <input type="time" class="form-control start-time" value="{{ $start }}" required>
                            </div>
                            <div class="col">
                                <input type="time" class="form-control end-time" value="{{ $end }}" required>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-danger remove-slot">X</button>
                            </div>
                            {{-- Hidden input to store combined value --}}
                            <input type="hidden" name="slots[]" value="{{ $slot }}">
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-sm btn-primary" id="add-slot">+ Add Slot</button>
            </div>


            {{-- Days --}}
            <div class="mb-3">
                <label class="form-label">Days</label>
                <div id="days-wrapper">
                    @foreach (json_decode($therapist->days, true) as $day)
                        <div class="input-group mb-2">
                            <input type="text" name="days[]" class="form-control" value="{{ $day }}" required>
                            <button type="button" class="btn btn-danger remove-day">X</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-sm btn-primary" id="add-day">+ Add Day</button>
            </div>

            {{-- Charges --}}
            <div class="mb-3">
                <label class="form-label">Charges</label>
                <input type="text" name="charges" class="form-control" value="{{ old('charges', $therapist->charges) }}"
                    required>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-success">Update Therapist</button>
            <a href="{{ route('therapist.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    {{-- Small JS for dynamic fields --}}
    <script>
        // Add Slot
        function updateHiddenInput(row) {
            let start = row.querySelector('.start-time').value;
            let end = row.querySelector('.end-time').value;
            row.querySelector('input[type=hidden]').value = start + '-' + end;
        }

        // Listen to changes in start/end time
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('start-time') || e.target.classList.contains('end-time')) {
                let row = e.target.closest('.slot-row');
                updateHiddenInput(row);
            }
        });

        // Add new slot row
        document.getElementById('add-slot').addEventListener('click', function() {
            let wrapper = document.getElementById('slots-wrapper');
            let div = document.createElement('div');
            div.classList.add('row', 'g-2', 'mb-2', 'align-items-center', 'slot-row');
            div.innerHTML = `
            <div class="col">
                <input type="time" class="form-control start-time" required>
            </div>
            <div class="col">
                <input type="time" class="form-control end-time" required>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-danger remove-slot">X</button>
            </div>
            <input type="hidden" name="slots[]" value="">
        `;
            wrapper.appendChild(div);
        });

        // Remove slot
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-slot')) {
                e.target.closest('.slot-row').remove();
            }
        });
        // Add Day
        document.getElementById('add-day').addEventListener('click', function() {
            let wrapper = document.getElementById('days-wrapper');
            let div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
            <input type="text" name="days[]" class="form-control" required>
            <button type="button" class="btn btn-danger remove-day">X</button>
        `;
            wrapper.appendChild(div);
        });

        // Remove Day
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-day')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endsection
