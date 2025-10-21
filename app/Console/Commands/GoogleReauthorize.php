<?php

namespace App\Console\Commands;

use Google\Client;
use Illuminate\Console\Command;

class GoogleReauthorize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:reauthorize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Authorize Google Calendar API and save a new token.json file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $credentialsPath = storage_path('app/google/credentials.json');
        $tokenPath = storage_path('app/google/token.json');

        if (! file_exists($credentialsPath)) {
            $this->error("❌ credentials.json not found at: $credentialsPath");

            return 1;
        }

        $client = new Client;
        $client->setApplicationName('Google Calendar API');
        $client->setScopes(\Google\Service\Calendar::CALENDAR);
        $client->setAuthConfig($credentialsPath);
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setRedirectUri('http://localhost:8000/auth/google/callback');

        $authUrl = $client->createAuthUrl();
        $this->info("👉 Open this URL in your browser:\n\n$authUrl\n");

        $authCode = $this->ask('Enter the authorization code from Google');

        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

        if (isset($accessToken['error'])) {
            $this->error('❌ Error fetching access token: '.$accessToken['error_description']);

            return 1;
        }

        if (! file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }

        file_put_contents($tokenPath, json_encode($accessToken));
        $this->info("✅ New token.json saved successfully at: $tokenPath");

        return 0;
    }
}
