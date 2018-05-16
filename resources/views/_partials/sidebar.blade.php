<div class="sidebar">
  <h2 class="title is-3">Others' Top 20</h2>

  {{-- <div class="content">
    <p>View others' top 20 tracks</p>
    <a class="button is-primary" href="{{ route('login.spotify') }}">
      <span class="icon is-small">
        <i class="fab fa-spotify"></i>
      </span>
      <span>
        Submit Your Top 20
      </span>
    </a>
  </div> --}}

  @if (currentRouteName() != 'home')
    <p><a href="{{ route('home') }}"><span class="icon"><i class="fas fa-music"></i></span> Mirum Top 20</a></p>
  @endif

  @foreach ($items as $u)
    <p><a href="{{ route('user.chart', $u) }}"><span class="icon"><i class="fas fa-music"></i></span> {{ $u }}'s Top 20</a></p>
  @endforeach
</div>
