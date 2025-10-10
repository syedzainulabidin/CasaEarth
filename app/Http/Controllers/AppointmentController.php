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
        return Auth::user()->role;
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
        $validated = $request->validate([
            'therapist_id' => 'required|exists:therapists,id',
            'day' => 'required|string',
            'slot' => 'required|string',
        ]);

        // If admin, validate user_id too
        if (Auth::user()->role === 'admin') {
            $validated['user_id'] = $request->validate([
                'user_id' => 'required|exists:users,id',
            ])['user_id'];
        } else {
            $validated['user_id'] = Auth::id();
        }

        // Store date as Y-m-d (standard for DB)
        $nextDate = Carbon::now()->next($validated['day'])->format('Y-m-d');

        Appointment::create([
            'user_id' => $validated['user_id'],
            'therapist_id' => $validated['therapist_id'],
            'day' => $validated['day'],
            'date' => $nextDate,
            'slot' => $validated['slot'],
            'status' => 'pending',
        ]);

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

        $data = $this->getRole() === 'admin'
            ? $request->only(['therapist_id', 'user_id', 'status'])
            : $request->only(['therapist_id']);

        $appointment->update($data);

        // === Auto-create Google Meet link when approved ===
        if ($this->getRole() === 'admin' && ($data['status'] ?? null) === 'approved') {
            try {
                $client = new \Google\Client;
                $client->setAuthConfig(storage_path('app/google/credentials.json'));
                $client->addScope(\Google\Service\Calendar::CALENDAR);
                $client->setAccessType('offline');

                $tokenPath = storage_path('app/google/token.json');
                $accessToken = json_decode(file_get_contents($tokenPath), true);
                $client->setAccessToken($accessToken);

                // Refresh if expired
                if ($client->isAccessTokenExpired()) {
                    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                    file_put_contents($tokenPath, json_encode($client->getAccessToken(), JSON_PRETTY_PRINT));
                }

                $service = new \Google\Service\Calendar($client);

                // Prepare start and end times (assuming slot is "16:00-17:00")
                [$startTime, $endTime] = explode('-', $appointment->slot);
                $date = Carbon::createFromFormat('Y-m-d', $appointment->date)->format('Y-m-d');

                $startDateTime = "{$date}T{$startTime}:00";
                $endDateTime = "{$date}T{$endTime}:00";

                $event = new \Google\Service\Calendar\Event([
                    'summary' => 'Therapy Session - CasaEarth',
                    'description' => 'Therapy session between user and therapist via CasaEarth.',
                    'start' => [
                        'dateTime' => $startDateTime,
                        'timeZone' => 'Asia/Karachi',
                    ],
                    'end' => [
                        'dateTime' => $endDateTime,
                        'timeZone' => 'Asia/Karachi',
                    ],
                    'attendees' => [
                        ['email' => $appointment->user->email],
                        ['email' => $appointment->therapist->email],
                    ],
                    'conferenceData' => [
                        'createRequest' => [
                            'requestId' => uniqid(),
                            'conferenceSolutionKey' => ['type' => 'hangoutsMeet'],
                        ],
                    ],
                ]);

                $calendarId = 'primary';
                $event = $service->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);

                $appointment->update(['meet_link' => $event->hangoutLink]);

            } catch (\Exception $e) {
                \Log::error('Google Meet creation failed: ' . $e->getMessage());
            }
        }

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
            ->map(fn($a) => ($a->day ?? '') . '||' . ($a->slot ?? ''))
            ->toArray();

        return response()->json([
            'days' => array_values($days),
            'slots' => array_values($slots),
            'booked' => $booked,
        ]);
    }
}
