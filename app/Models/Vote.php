<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Vote extends Model
{
  protected $guarded = [];

  public function isMoreThanOneWeek()
  {
    $now = Carbon::now();
    return $now->diffInWeeks($this->attributes['created_at']) > 0;
  }
}
