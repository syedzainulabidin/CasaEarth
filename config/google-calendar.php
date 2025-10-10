<?php

return [
    'default_auth_profile' => env('GOOGLE_CALENDAR_AUTH_PROFILE', 'oauth'),
    'auth_profiles' => [
        'oauth' => [
            'credentials_json' => storage_path('app/google-calendar/oauth-credentials.json'),
            'token_json' => storage_path('app/google-calendar/admin-token.json'),
        ],
    ],
    'calendar_id' => env('GOOGLE_CALENDAR_ID', 'primary'),
];