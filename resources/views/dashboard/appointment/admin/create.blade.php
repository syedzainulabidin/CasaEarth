@extends('dashboard.partials.layout')
@section('title', 'Create Appointment')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Create Appointment</h3>

        <form action="{{ route('appointment.store') }}" method="POST">
            @csrf

            {{-- User Selection --}}
            <div class="mb-3">
                <label for="user_id" class="form-label">Select User</label>
                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                    <option value="">-- Choose User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Therapist selection --}}
            <div class="mb-3">
                <label for="therapist_id" class="form-label">Therapist</label>
                <select name="therapist_id" id="therapist_id" class="form-select" required>
                    <option value="">Select Therapist</option>
                    @foreach ($therapists as $therapist)
                        <option value="{{ $therapist->id }}">{{ $therapist->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Day selection (hidden until therapist selected) --}}
            <div class="mb-3 d-none" id="day-container">
                <label for="day" class="form-label">Available Days</label>
                <select name="day" id="day" class="form-select" required></select>
            </div>

            {{-- Slot selection (hidden until day selected) --}}
            <div class="mb-3 d-none" id="slot-container">
                <label for="slot" class="form-label">Available Time Slots</label>
                <select name="slot" id="slot" class="form-select" required></select>
            </div>

            <button type="submit" class="btn btn-primary">Create Appointment</button>
            <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    {{-- === AJAX SCRIPT === --}}
    <script>
        function formatTo12Hour(time24) {
            const [hour, minute] = time24.split(':');
            const date = new Date();
            date.setHours(parseInt(hour), parseInt(minute));
            return date.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const therapistSelect = document.getElementById('therapist_id');
            const dayContainer = document.getElementById('day-container');
            const slotContainer = document.getElementById('slot-container');
            const daySelect = document.getElementById('day');
            const slotSelect = document.getElementById('slot');

            therapistSelect.addEventListener('change', function() {
                const therapistId = this.value;
                if (!therapistId) {
                    dayContainer.classList.add('d-none');
                    slotContainer.classList.add('d-none');
                    return;
                }

                fetch(`/dashboard/appointment/${therapistId}/availability`)
                    .then(response => response.json())
                    .then(data => {
                        daySelect.innerHTML = '';
                        slotSelect.innerHTML = '';

                        if (data.days.length === 0) {
                            daySelect.innerHTML = '<option value="">No available days</option>';
                        } else {
                            daySelect.innerHTML = '<option value="">Select Day</option>';
                            data.days.forEach(day => {
                                daySelect.innerHTML += `<option value="${day}">${day}</option>`;
                            });
                        }

                        dayContainer.classList.remove('d-none');
                        slotContainer.classList.add('d-none');

                        daySelect.onchange = () => {
                            const selectedDay = daySelect.value;
                            if (!selectedDay) {
                                slotContainer.classList.add('d-none');
                                return;
                            }

                            slotSelect.innerHTML = '<option value="">Select Slot</option>';
                            data.slots.forEach(slot => {
                                const key = `${selectedDay}||${slot}`;
                                if (!data.booked.includes(key)) {
                                    const [start24, end24] = slot.split('-').map(s => s.trim());
                                    const start12 = formatTo12Hour(start24);
                                    const end12 = formatTo12Hour(end24);
                                    const formattedSlot = `${start12} - ${end12}`;

                                    slotSelect.innerHTML +=
                                        `<option value="${slot}">${formattedSlot}</option>`;
                                }
                            });

                            slotContainer.classList.remove('d-none');
                        };
                    })
                    .catch(err => {
                        console.error('Error fetching availability:', err);
                        dayContainer.classList.add('d-none');
                        slotContainer.classList.add('d-none');
                    });
            });
        });
    </script>
@endsection
