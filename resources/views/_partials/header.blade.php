<div class="hero is-primary is-bold">
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title is-2">Mirum Top 20 <span class="icon is-size-3"><i class="fas fa-music"></i></span></h1>
            <h2 class="subtitle">Collaborated top 20 songs of Mirum troopers' favorites</h2>

            @if (currentRouteName() == 'home')
                <a class="button is-primary is-inverted is-outlined" href="{{ route('login.spotify') }}">
                    <span class="icon is-small">
                        <i class="fab fa-spotify"></i>
                    </span>
                    <span>
                        Contribute with your Spotify
                    </span>
                </a>
                <p class="has-text-white-ter is-size-6 is-italic">You can only submit once per week</p>
            @else
                <a class="button is-primary is-inverted is-outlined" href="{{ route('home') }}">
                    <span class="icon is-small">
                        <i class="fas fa-home"></i>
                    </span>
                    <span>
                        Back to Home
                    </span>
                </a>
            @endif
        </div>
    </div>
</div>