@extends('dashboard.partials.layout')
@section('title', 'Book Appointment')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Book Appointment</h3>

    <form action="{{ route('appointment.store') }}" method="POST">
        @csrf

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

        <button type="submit" class="btn btn-primary">Book Appointment</button>
        <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

{{-- Flatpickr CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
/* styling for fully booked day */
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

// Local Y-M-D (no timezone shift)
function ymd(date) {
    const y = date.getFullYear();
    const m = String(date.getMonth() + 1).padStart(2, '0');
    const d = String(date.getDate()).padStart(2, '0');
    return `${y}-${m}-${d}`;
}

document.addEventListener('DOMContentLoaded', function() {
    const therapistSelect = document.getElementById('therapist_id');
    const dateContainer = document.getElementById('date-container');
    const slotContainer = document.getElementById('slot-container');
    const dateInput = document.getElementById('date');
    const slotSelect = document.getElementById('slot');
    let calendar = null;

    therapistSelect.addEventListener('change', function() {
        const therapistId = this.value;

        // clean previous state
        if (calendar) {
            calendar.destroy();
            calendar = null;
        }
        dateInput.value = '';
        slotSelect.innerHTML = '';
        slotContainer.classList.add('d-none');
        dateContainer.classList.add('d-none');

        if (!therapistId) return;

        fetch(`/dashboard/appointment/${therapistId}/availability`)
            .then(res => res.json())
            .then(data => {
                // defensive defaults
                data.days = Array.isArray(data.days) ? data.days : [];
                data.slots = Array.isArray(data.slots) ? data.slots : [];
                data.booked = data.booked && typeof data.booked === 'object' ? data.booked : {};

                const dayMap = {
                    'Sunday': 0, 'Monday': 1, 'Tuesday': 2, 'Wednesday': 3,
                    'Thursday': 4, 'Friday': 5, 'Saturday': 6
                };

                // Build a map of fully-booked dates only (we won't mark partial)
                const fullyBooked = {};
                for (const [dateStr, slotsArray] of Object.entries(data.booked)) {
                    if (Array.isArray(slotsArray) && slotsArray.length === data.slots.length) {
                        fullyBooked[dateStr] = true;
                    }
                }

                // tomorrow (local) as minDate
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                tomorrow.setHours(0,0,0,0);

                // Initialize flatpickr
                calendar = flatpickr(dateInput, {
                    dateFormat: 'Y-m-d',
                    minDate: tomorrow,
                    // enable only dates that are: therapist working day AND not fully booked
                    enable: [
                        function(date) {
                            // local ymd
                            const dateStr = ymd(date);

                            // Not before tomorrow
                            if (date < tomorrow) return false;

                            // is it therapist working day?
                            const weekday = date.getDay();
                            const dayName = Object.keys(dayMap).find(k => dayMap[k] === weekday);
                            if (!data.days.includes(dayName)) return false;

                            // fully booked -> disable
                            if (fullyBooked[dateStr]) return false;

                            return true; // enabled
                        }
                    ],
                    onDayCreate: function(_, __, ___, dayElem) {
                        // apply styling for fully booked days using local ymd
                        const dateStr = ymd(dayElem.dateObj);

                        // remove stale class just in case (important when re-rendering)
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

                        // populate slot dropdown with slots that are NOT booked on that exact date
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
                            // This should not happen because fully-booked days are disabled, but guard anyway
                            slotContainer.classList.add('d-none');
                            alert('No slots available for the selected date.');
                            dateInput.value = '';
                            return;
                        }

                        slotContainer.classList.remove('d-none');
                    }
                });

                // show calendar area
                dateContainer.classList.remove('d-none');
                slotContainer.classList.add('d-none');
                slotSelect.innerHTML = '';
            })
            .catch(err => {
                console.error('Error fetching availability:', err);
                if (calendar) { calendar.destroy(); calendar = null; }
                dateContainer.classList.add('d-none');
                slotContainer.classList.add('d-none');
            });
    });
});
</script>
@endsection
