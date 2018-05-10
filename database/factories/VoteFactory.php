<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Vote::class, function (Faker $faker) {
  static $number = 1;

  return [
    'username'         => 'alisa',
    'track_spotify_id' => $faker->isbn13,
    'track_name'       => $faker->sentence(3),
    'track_artist'     => $faker->name,
    'track_data'       => '',
    'position'         => $number++
  ];
});
