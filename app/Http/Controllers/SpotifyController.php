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
      $top20_tracks = $spotify->getMyTop('tracks', [
          'limit' => 20,
          'time_range' => 'short_term' // long_term | medium_term | short_term
      ]);

      $me = $spotify->me();

      $now = Carbon::now()->toDateTimeString();

      $new_tracks = [];
      foreach ($top20_tracks->items as $key => $item) {
        $pushed_item = array(
          'username'         => $me->id,
          'track_spotify_id' => $item->id,
          'track_name'       => $item->name,
          'track_artist'     => $item->artists[0]->name,
          'track_data'       => json_encode($item),
          'position'         => $key + 1,
          'created_at'       => $now,
          'updated_at'       => $now
        );

        array_push($new_tracks, $pushed_item);
      }

      // check if username already has records in database
      $user_votes = Vote::where('username', $me->id);
      $has_user_votes = $user_votes->count() > 0;
      if ($has_user_votes) {
        // remove old user data
        $deletingUserVotes = $user_votes->delete();
      }

      // add new data to votes table
      $new_votes = Vote::insert($new_tracks);

      // get current version
      $current_version = Version::max('id');

      if (empty($current_version)) {
        $current_version = 0;
      }

      // read from the votes table, sum the total points to get the order to insert to charts table
      $all_votes = Vote::selectRaw('*, SUM(21-position) as total_points')
                        ->groupBy('track_spotify_id')
                        ->orderBy('total_points', 'desc')
                        ->take(20)
                        ->get();

      // get current chart
      $current_chart = Chart::where('version_id', $current_version)->get();

      // add new version
      $new_version = new Version;
      $new_version->last_username = $me->id;
      $new_version->save();

      $new_chart = [];

      foreach ($all_votes as $key => $item) {
        $track_current_chart = $current_chart->firstWhere('track_spotify_id', $item->track_spotify_id);

        $pushed_track = array(
          'version_id'       => $new_version->id,
          'track_spotify_id' => $item->track_spotify_id,
          'track_name'       => $item->track_name,
          'track_artist'     => $item->track_artist,
          'track_data'       => $item->track_data,
          // how to get these values....
          'position'         => $key + 1,
          'total_points'     => $item->total_points,
          'last_position'    => $track_current_chart ? $track_current_chart->position : null,
          'periods_on_chart' => $current_chart->where('track_spotify_id', $item->track_spotify_id)->count() + 1,
          'created_at'       => $now,
          'updated_at'       => $now
        );

        array_push($new_chart, $pushed_track);
      }

      // check if version already exists

      $chart = Chart::insert($new_chart);

      // recount chart total points
      
      return view('result', compact('top20_tracks'));
    }
    catch(SpotifyWebAPIException $e) {
      return redirect('/');
    }
  }

}
