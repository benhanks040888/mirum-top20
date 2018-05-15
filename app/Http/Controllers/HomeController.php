<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chart;
use App\Models\Version;

class HomeController extends Controller
{
  public function getIndex()
  {
    $current_version = Version::max('id');
    $top20_tracks = Chart::where('version_id', $current_version)->get();
    return view('index', compact('top20_tracks'));
  }
}
