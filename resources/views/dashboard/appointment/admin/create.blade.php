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

        {{-- Charges display (hidden initially) --}}
        <div class="mb-3 d-none" id="charges-container">
            <label for="charges" class="form-label">Therapist Charges</label>
            <p class="charges bg-primary d-inline p-2 rounded text-light">35$</p>
        </div>

        {{-- Calendar (hidden until therapist selected) --}}
        <div class="mb-3 d-none" id="date-container">
            <label for="date" class="form-label">Select Date</label>
            <input type="text" id="date" name="date" class="form-control" readonly required>
        </div>

        {{-- Slot selection (hidden until date selected) --}}
        <div class="mb-3 d-none" id="slot-container">
            <label for="slot" class="form-label">Available Time Slots</label>
            <select name="slot" id="slot" class="form-select" required></select>
        </div>

        <button type="submit" class="btn btn-primary">Create Appointment</button>
        <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

{{-- Flatpickr --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
.flatpickr-day.fp-full-booked {
    background: #ff4d4d !important;
    color: #fff !important;
    border-radius: 4px;
}
</style>

<script>
function formatTo12Hour(time24) {
    const [hour, minute] = time24.split(':');
    const date = new Date();
    date.setHours(parseInt(hour), parseInt(minute));
    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });
}

// Local Y-M-D (avoid UTC offset)
function ymd(date) {
    const y = date.getFullYear();
    const m = String(date.getMonth() + 1).padStart(2, '0');
    const d = String(date.getDate()).padStart(2, '0');
    return `${y}-${m}-${d}`;
}

document.addEventListener('DOMContentLoaded', function() {
    const therapistSelect = document.getElementById('therapist_id');
    const dateContainer = document.getElementById('date-container');
    const chargesContainer = document.getElementById('charges-container');
    const slotContainer = document.getElementById('slot-container');
    const dateInput = document.getElementById('date');
    const slotSelect = document.getElementById('slot');
    const chargesElement = document.querySelector('.charges');
    let calendar = null;

    therapistSelect.addEventListener('change', function() {
        const therapistId = this.value;

        // Reset state
        if (calendar) {
            calendar.destroy();
            calendar = null;
        }
        dateInput.value = '';
        slotSelect.innerHTML = '';
        slotContainer.classList.add('d-none');
        dateContainer.classList.add('d-none');
        chargesContainer.classList.add('d-none'); // Hide charges initially

        if (!therapistId) return;

        fetch(`/dashboard/appointment/${therapistId}/availability`)
            .then(res => res.json())
            .then(data => {
                data.days = Array.isArray(data.days) ? data.days : [];
                data.slots = Array.isArray(data.slots) ? data.slots : [];
                data.booked = data.booked && typeof data.booked === 'object' ? data.booked : {};

                const dayMap = {
                    'Sunday': 0, 'Monday': 1, 'Tuesday': 2, 'Wednesday': 3,
                    'Thursday': 4, 'Friday': 5, 'Saturday': 6
                };

                const fullyBooked = {};
                for (const [dateStr, slotsArray] of Object.entries(data.booked)) {
                    if (Array.isArray(slotsArray) && slotsArray.length === data.slots.length) {
                        fullyBooked[dateStr] = true;
                    }
                }

                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                tomorrow.setHours(0, 0, 0, 0);

                calendar = flatpickr(dateInput, {
                    dateFormat: 'Y-m-d',
                    minDate: tomorrow,
                    enable: [
                        function(date) {
                            const dateStr = ymd(date);
                            if (date < tomorrow) return false;
                            const weekday = date.getDay();
                            const dayName = Object.keys(dayMap).find(k => dayMap[k] === weekday);
                            if (!data.days.includes(dayName)) return false;
                            if (fullyBooked[dateStr]) return false;
                            return true;
                        }
                    ],
                    onDayCreate: function(_, __, ___, dayElem) {
                        const dateStr = ymd(dayElem.dateObj);
                        dayElem.classList.remove('fp-full-booked');
                        dayElem.removeAttribute('title');
                        if (fullyBooked[dateStr]) {
                            dayElem.classList.add('fp-full-booked');
                            dayElem.title = 'Fully booked';
                        }
                    },
                    onChange: function(selectedDates) {
                        if (!selectedDates.length) return;

                        const selectedDate = selectedDates[0];
                        const selectedDateStr = ymd(selectedDate);

                        slotSelect.innerHTML = '<option value="">Select Slot</option>';
                        let has = false;
                        data.slots.forEach(slot => {
                            const bookedForDate = Array.isArray(data.booked[selectedDateStr]) ? data.booked[selectedDateStr] : [];
                            if (!bookedForDate.includes(slot)) {
                                has = true;
                                const [start24, end24] = slot.split('-').map(s => s.trim());
                                slotSelect.innerHTML += `<option value="${slot}">${formatTo12Hour(start24)} - ${formatTo12Hour(end24)}</option>`;
                            }
                        });

                        if (!has) {
                            slotContainer.classList.add('d-none');
                            alert('No slots available for the selected date.');
                            dateInput.value = '';
                            return;
                        }

                        slotContainer.classList.remove('d-none');
                    }
                });

                // Display charges
                chargesContainer.classList.remove('d-none');
                chargesElement.innerText = `$${data.charges}`;

                // Show calendar
                dateContainer.classList.remove('d-none');
                slotContainer.classList.add('d-none');
            })
            .catch(err => {
                console.error('Error fetching availability:', err);
                if (calendar) { calendar.destroy(); calendar = null; }
                dateContainer.classList.add('d-none');
                chargesContainer.classList.add('d-none');
                slotContainer.classList.add('d-none');
            });
    });
});
</script>
@endsection
