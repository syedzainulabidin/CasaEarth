<?php

require __DIR__.'/vendor/autoload.php';

use Google\Client;

$client = new Client;
$client->setApplicationName('Google Calendar API');
$client->setScopes(Google\Service\Calendar::CALENDAR);
$client->setAuthConfig(__DIR__.'/storage/app/google/credentials.json');

$client->setAccessType('offline');
$client->setPrompt('consent');

$tokenPath = 'storage/app/google/token.json';
if (file_exists($tokenPath)) {
    unlink($tokenPath); // remove old token if still there
}

// Generate the auth URL
$client->setRedirectUri('http://localhost:8000/auth/google/callback');

$authUrl = $client->createAuthUrl();

printf("Open this link in your browser:\n%s\n\n", $authUrl);

// Paste the authorization code
echo 'Enter verification code: ';
$authCode = trim(fgets(STDIN));

// Exchange code for access token
$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
$client->setAccessToken($accessToken);

// Save the token for later
if (! file_exists(dirname($tokenPath))) {
    mkdir(dirname($tokenPath), 0700, true);
}
file_put_contents($tokenPath, json_encode($client->getAccessToken()));

echo "✅ New token.json saved successfully!\n";
