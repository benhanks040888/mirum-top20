@extends('layout')

@section('content')
  @include('_partials.header')

  <div class="section">
    <div class="container">
      @if ($top20_tracks->count() <= 0)
        <h2 class="title has-text-centered is-3">Submit your top 20 tracks by clicking the button above to start contributing!</h2>
      @else
        <div class="level">
          <div class="level-left">
            <div>
              <h2 class="title is-3">Current Top 20</h2>
              <h3 class="subtitle is-6 has-text-grey">(Last update by <strong>{{ $version->last_username }}</strong> at {{ $version->created_at->format('d M Y H:i:s') }})</h3>
            </div>
          </div>
          <div class="level-right">
            <a class="button is-primary" href="https://open.spotify.com/user/benhanks040888/playlist/{{ config('spotify.playlist_id') }}" target="_blank">Play On Spotify</a>
          </div>
        </div>

        @foreach ($top20_tracks as $index => $item)
          <div class="box">
            <div class="columns is-mobile">
              <div class="column is-narrow has-text-grey has-text-centered" style="min-width: 70px;">
                <div class="is-size-5" style="color: #000">
                  <span>{{ $index + 1 }}</span>
                </div>
                <div class="is-size-7">
                  <span><i class="fas {{ getArrowIcon($index + 1, $item->last_position) }}"></i></span> 
                  {{ $item->last_position ? '(' . $item->last_position . ')' : 'NEW' }}
                </div>
              </div>
              
              <div class="column is-narrow">
                <figure class="image is-48x48">
                  <img src="{{ json_decode($item->track_data)->album->images[2]->url }}" alt="{{ $item->track_name }}">
                </figure>
              </div>
              <div class="column">
                <div class="title is-5 has-text-weight-normal">
                  <a href="{{ json_decode($item->track_data)->external_urls->spotify }}" target="_blank">{{ $item->track_name }}</a>
                </div>
                <div class="subtitle is-6 has-text-grey">
                  {{ $item->track_artist }}
                </div>
              </div>
              <div class="column is-narrow">
                <a href="{{ json_decode($item->track_data)->external_urls->spotify }}" target="_blank"><i class="fas fa-play"></i></a>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
@endsection