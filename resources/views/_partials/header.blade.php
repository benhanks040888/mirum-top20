<div class="modal js-modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box" style="padding: 30px;">
            <div class="content">
                <h2 class="has-text-centered">What is this?</h2>
                <p>When you login with your Spotify account, this app will get your top 20 tracks from the past 4 weeks, then put them in a "pool" to be compared with other people's top 20.</p>
                <p>Then it's simple scoring system. Number 1 songs from each users will be given 20 points, number 2 songs 19 points, so on until number 20 songs will get 1 point.</p>
                <p>All the tracks will then be calculated and sorted to form the new top 20. This top 20 tracks will be uploaded to the Spotify playlist which you can follow to get the latest updated top 20 when more people contribute.</p>
                <p>One user can only contribute/submit their top 20 once a week, this is to prevent users from submitting their top 20 over and over again.</p>
            </div>
        </div>
    </div>
    <button class="modal-close is-large js-toggle-modal" aria-label="close"></button>
</div>

<div class="hero is-primary is-bold">
    <a class="what js-toggle-modal button is-primary is-inverted is-outlined">
        <span class="icon">
          <i class="fas fa-question"></i>
        </span>
    </a>
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