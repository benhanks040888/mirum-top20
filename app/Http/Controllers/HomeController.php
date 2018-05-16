<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chart;
use App\Models\Vote;
use App\Models\Version;

use SpotifyWebAPI\SpotifyWebAPI;

class HomeController extends Controller
{
  public function getIndex(SpotifyWebAPI $spotify)
  {
    $version = Version::latest()->first();
    if (!empty($version)) {
      $version_id = $version->id;
    } else {
      $version_id = 0;
    }

    $top20_tracks = Chart::where('version_id', $version_id)->get();

    $votes_users = Vote::groupBy('username')->pluck('username');

    return view('index', compact('version', 'top20_tracks', 'votes_users'));
  }

  public function getUserChart($username)
  {
    $user_chart = Vote::where('username', $username)->get();

    if ($user_chart->isEmpty()) {
      return redirect()->route('home');
    }

    $votes_users = Vote::where('username', '!=', $username)->groupBy('username')->pluck('username');

    return view('chart', compact('user_chart', 'username', 'votes_users'));
  }
}
