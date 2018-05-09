<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
      $top20_tracks = $spotify->getMyTop('tracks', [
          'limit' => 20,
          'time_range' => 'short_term' // long_term | medium_term | short_term
      ]);

      $me = $spotify->me();

      $new_tracks = [];
      foreach ($top20_tracks->items as $key => $item) {
        $pushed_item = array(
          'username'         => $me->id,
          'track_spotify_id' => $item->id,
          'track_name'       => $item->name,
          'track_artist'     => $item->artists[0]->name,
          'track_data'       => json_encode($item),
          'position'         => $key + 1
        );

        array_push($new_tracks, $pushed_item);
      }

      dd($new_tracks);

      // check if username already has records in database
      $has_user_votes = Vote::where('username', $me->id)->count() > 0;
      if ($has_user_votes) {
        // remove old user data

        // add new data

      } else {
        // add new data to votes table
        $new_votes = Vote::create($new_tracks);
      }

      // get current version
      $current_version = Version::max('id');

      if (!empty($current_version)) {
        $current_version = 0;
      }

      // add new version
      $new_version = new Version;
      $new_version->last_username = $me->id;
      $new_version->save();

      $new_chart = [];

      foreach ($top20_tracks->items as $key => $item) {
        $pushed_track = array(
          'version_id'       => $new_version->id,
          'track_spotify_id' => $item->id,
          'track_name'       => $item->name,
          'track_artist'     => $item->artists[0]->name,
          'track_data'       => json_encode($item),
          // how to get these values....
          'position'         => '',
          'total_points'     => '',
          'last_position'    => '',
          'periods_on_chart' => '',
        );

        array_push($new_chart, $pushed_track);
      }

      // check if version already exists

      $chart = Chart::create($new_chart);

      // recount chart total points
      
      return view('result', compact('top20_tracks'));
    }
    catch(SpotifyWebAPIException $e) {
      return redirect('/');
    }
  }

}
