<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chart;
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

    return view('index', compact('version', 'top20_tracks'));
  }
}
