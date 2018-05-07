<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Socialite;
use SpotifyWebAPI\SpotifyWebAPI;

class AuthSpotifyController extends Controller
{
    /**
     * Redirect the user to the Spotify authentication page
     * 
     */
    public function spotifyLogin()
    {
        return Socialite::driver('spotify')
                        ->scopes(['user-top-read', 'playlist-modify-public'])
                        ->redirect();
    }

    public function spotifyCallback()
    {
        $user = Socialite::driver('spotify')->user();
        session(['spotify_token' => $user->token]);
        session(['spotify_refresh' => $user->refreshToken]);

        return redirect('/result');
    }
}
