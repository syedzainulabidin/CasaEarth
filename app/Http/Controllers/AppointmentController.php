<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Therapist;
use App\Models\User;
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
            // Admin must select both user and therapist
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'therapist_id' => 'required|exists:therapists,id',
            ]);

            Appointment::create([
                'user_id' => $validated['user_id'],
                'therapist_id' => $validated['therapist_id'],
                'status' => 'pending',
            ]);
        } else {
            // User should NOT provide user_id manually
            $validated = $request->validate([
                'therapist_id' => 'required|exists:therapists,id',
            ]);

            Appointment::create([
                'user_id' => Auth::user()->id, // automatically assign logged-in user
                'therapist_id' => $validated['therapist_id'],
                'status' => 'pending',
            ]);
        }

        return redirect()->route('appointment.index')->with('success', 'Appointment created successfully!');
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
}
