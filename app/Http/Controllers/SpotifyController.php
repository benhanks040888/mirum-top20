<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIException;

use App\Models\Vote;
use App\Models\Chart;
use App\Models\Version;

class SpotifyController extends Controller
{
  public function getResult(SpotifyWebAPI $spotify)
  {
    try {
      $current_version = Version::max('id');

      if (empty($current_version)) {
        $current_version = 0;
      }

      $me = $spotify->me();

      // get current chart
      $your_top20_tracks = Vote::where('username', $me->id)->get();

      $top20_tracks = Chart::where('version_id', $current_version)->get();

      return view('result', compact('top20_tracks', 'your_top20_tracks'));
    }
    catch(SpotifyWebAPIException $e) {
      return redirect('/');
    }
  }

}
