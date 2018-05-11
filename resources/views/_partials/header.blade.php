<div class="hero is-primary is-bold">
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title is-2">Mirum Top 20</h1>
            <h2 class="subtitle">Top 20 songs based on contributions from all Mirum Troopers</h2>

            @if (currentRouteName() == 'home')
                <a class="button is-primary is-inverted is-outlined" href="{{ route('login.spotify') }}">
                    <span class="icon is-small">
                        <i class="fab fa-spotify"></i>
                    </span>
                    <span>
                        Contribute with your Spotify
                    </span>
                </a>
            @endif
        </div>
    </div>
</div>