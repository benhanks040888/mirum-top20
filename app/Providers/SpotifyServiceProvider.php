<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;

class SpotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SpotifyWebAPI::class, function ($app) {
            $client = new SpotifyWebAPI;

            $session = new Session(
                config('services.spotify.client_id'),
                config('services.spotify.client_secret'),
                config('services.spotify.redirect')
            );

            $scopes = [
                'user-top-read'
            ];

            if (session()->has('spotify_token')) {
                $accessToken = session('spotify_token');
            } else {
                $session->requestCredentialsToken($session);
    
                $accessToken = $session->getAccessToken();
            }

            $client->setAccessToken($accessToken);

            return $client;
        });
    }
}
