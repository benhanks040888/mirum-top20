@extends('layout')

@section('content')
  @include('_partials.header')

  <div class="section">
    <div class="container">
      {{-- <div id="app"></div> --}}

      {{-- <div class="tabs is-centered">
        <ul>
          <li class="is-active"><a>Your Top 20</a></li>
          <li><a>Mirum Top 20</a></li>
        </ul>
      </div> --}}

      <div class="columns">
        <div class="column is-half">
          <h2 class="title is-3">Your Top 20</h2>

          @foreach ($your_top20_tracks as $index => $item)
            <div class="box">
              <div class="columns is-mobile">
                <div class="column is-narrow has-text-grey has-text-centered" style="min-width: 70px;">
                  <div class="is-size-5" style="color: #000">
                    <span>{{ $index + 1 }}</span>
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
              </div>
            </div>
          @endforeach
        </div>
        <div class="column is-half">
          <h2 class="title is-3">Mirum Top 20</h2>

          @foreach ($top20_tracks as $index => $item)
            <div class="box">
              <div class="columns is-mobile">
                <div class="column is-narrow has-text-grey has-text-centered" style="min-width: 70px;">
                  <div class="is-size-5" style="color: #000">
                    <span>{{ $index + 1 }}</span>
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
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection

@section('before_scripts')
  <script>
    window.yourTop20 = {!! $your_top20_tracks !!};
    window.mirumTop20 = {!! $top20_tracks !!};
  </script>
@endsection