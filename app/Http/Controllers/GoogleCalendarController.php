<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GoogleCalendarController extends Controller
{
    // Step 3A: Redirect admin to Google OAuth consent screen
    public function connect()
    {
        $client = new Client;
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope('https://www.googleapis.com/auth/calendar');
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setRedirectUri(route('google.calendar.callback'));

        return redirect()->away($client->createAuthUrl());
    }

    // Step 3B: Handle Google OAuth callback and store tokens
    public function callback(Request $request)
    {
        $client = new Client;
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setRedirectUri(route('google.calendar.callback'));

        if ($request->has('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($request->code);

            // Save tokens to session temporarily (we’ll persist them later)
            // Save tokens permanently to storage
            $tokenPath = storage_path('app/google/token.json');
            file_put_contents($tokenPath, json_encode($token, JSON_PRETTY_PRINT));

            return response()->json([
                'message' => 'Connected to Google Calendar successfully!',
                'token' => $token,
            ]);

        }

        return response()->json(['error' => 'Authorization code missing.'], 400);
    }

    public function createMeetingEvent()
    {
        $client = new Client;
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(Calendar::CALENDAR);
        $client->setAccessType('offline');

        // Load stored access token
        $tokenPath = storage_path('app/google/token.json');
        if (! file_exists($tokenPath)) {
            return response()->json(['error' => 'Google token not found. Please connect first.']);
        }

        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);

        // Refresh token if expired
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }

        $service = new Calendar($client);

        // Create event details
        $event = new Calendar\Event([
            'summary' => 'Therapy Session',
            'description' => 'Scheduled therapy meeting between user and therapist.',
            'start' => [
                'dateTime' => '2025-10-11T16:00:00',
                'timeZone' => 'Asia/Karachi',
            ],
            'end' => [
                'dateTime' => '2025-10-11T17:00:00',
                'timeZone' => 'Asia/Karachi',
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

        return response()->json([
            'message' => 'Meeting created successfully!',
            'meet_link' => $event->hangoutLink,
            'event_id' => $event->id,
        ]);
    }
}
