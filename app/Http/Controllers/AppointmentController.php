<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Therapist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    private function getRole()
    {
        return Auth::user()->role; // assuming `role` column exists
    }

    public function index()
    {
        $appointments = Appointment::all();
        $userAppointments = Appointment::where('user_id', Auth::id())->get();

        return match ($this->getRole()) {
            'admin' => view('dashboard.appointment.admin.index', compact('appointments')),
            'user' => view('dashboard.appointment.user.index', compact('userAppointments')),
            default => abort(403, 'Unauthorized access.'),
        };
    }

    public function create()
    {
        $therapists = Therapist::all();
        $users = User::where('role', 'user')->get();

        return match ($this->getRole()) {
            'admin' => view('dashboard.appointment.admin.create', compact('therapists', 'users')),
            'user' => view('dashboard.appointment.user.create', compact('therapists')),
            default => abort(403, 'Unauthorized access.'),
        };
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'therapist_id' => 'required|exists:therapists,id',
                'day' => 'required|string',
                'slot' => 'required|string',
            ]);

            $nextDate = Carbon::now()->next($validated['day'])->format('d-m-Y');

            Appointment::create([
                'user_id' => $validated['user_id'],
                'therapist_id' => $validated['therapist_id'],
                'day' => $validated['day'],
                'date' => $nextDate,
                'slot' => $validated['slot'],
                'status' => 'pending',
            ]);
        } else {
            $validated = $request->validate([
                'therapist_id' => 'required|exists:therapists,id',
                'day' => 'required|string',
                'slot' => 'required|string',
            ]);

            $nextDate = Carbon::now()->next($validated['day'])->format('d-m-Y');

            Appointment::create([
                'user_id' => Auth::id(),
                'therapist_id' => $validated['therapist_id'],
                'day' => $validated['day'],
                'date' => $nextDate,
                'slot' => $validated['slot'],
                'status' => 'pending',
            ]);
        }

        return redirect()->route('appointment.index')
            ->with('success', 'Appointment created successfully!');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($this->getRole() === 'user' && $appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $therapists = Therapist::all();

        return match ($this->getRole()) {
            'admin' => view('dashboard.appointment.admin.edit', compact('appointment', 'therapists')),
            'user' => view('dashboard.appointment.user.edit', compact('appointment', 'therapists')),
        };
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($this->getRole() === 'user' && $appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $appointment->update(
            $this->getRole() === 'admin'
                ? $request->only(['therapist_id', 'user_id', 'status'])
                : $request->only(['therapist_id']) // user can only change therapist
        );

        return back()->with('success', 'Appointment updated successfully.');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($this->getRole() === 'user' && $appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $appointment->delete();

        return back()->with('success', 'Appointment deleted successfully.');
    }

    public function getAvailability($id)
    {
        $therapist = Therapist::findOrFail($id);

        $days = json_decode($therapist->days, true) ?: [];
        $slots = json_decode($therapist->slots, true) ?: [];

        $booked = Appointment::where('therapist_id', $id)
            ->whereIn('status', ['pending', 'approved'])
            ->get()
            ->map(fn ($a) => ($a->day ?? '').'||'.($a->slot ?? ''))
            ->toArray();

        return response()->json([
            'days' => array_values($days),
            'slots' => array_values($slots),
            'booked' => $booked,
        ]);
    }
}
