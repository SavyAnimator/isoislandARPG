<style>
        .home-icons  {
            padding: 7px;
            font-size: 15px;
            width: 30px;
            text-align: center;
            text-decoration: none;
            margin: 4px 2px;
            border-radius: 10%;
        }
        .home-icons:hover {
            opacity: 0.7;
            color: white
        }
        .home-icons.fa-deviantart {
        background: #05CC46;
        color: white;
        }

        .home-icons.fa-discord {
        background: #7289DA;
        color: white;
        }

        .home-icons.fa-twitter {
        background: #55ACEE;
        color: white;
        }

        .home-icons.fa-tumblr {
        background: #2c4762;
        color: white;
        }

        .home-icons.fa-patreon {
        background: #f96854;
        color: white;
        }

        .home-icons.fa-instagram {
        background: #e24fbd;
        color: white;
        }
</style>

<hr>
<div class="row">
    <div class="col-md-9">

        <!-- Footer Elements -->
            <a href="{{ url('info/team') }}">The Team</a> •
            <a href="{{ url('info/about') }}">About</a> •
            <a href="{{ url('info/terms') }}">Terms of Service</a> •
            <a href="{{ url('info/privacy') }}">Privacy Policy</a> •
            <a href="http://deviantart.com/isomara-island">DeviantART</a> •
            <a href="{{ url('info/credits') }}">Credits</a>
        <!-- Copyright -->
        <div class="copyright">{{ config('lorekeeper.settings.site_name', 'Lorekeeper') }} &copy; <a href="http://savyanimator.com">Savannah Herr</a> & SLAYERS' STRONGHOLD STUDIOS LLC {{ Carbon\Carbon::now()->year }}</div>
    </div>
    <div class="col-md-3">
        <small>
                @include('widgets._online_count')

            <br>
                <a href="https://www.deviantart.com/isomara-island" class="home-icons fab fa-deviantart"></a>
                <a href="https://discord.gg/62ZGCYFUDu" class="home-icons fab fa-discord"></a>
                <a href="https://bsky.app/profile/isomaraisland.com"><img style="home-icons; margin-bottom:4px; width:29px; border-radius: 10%" src="https://isomara-island.com/images/bluesky.png"></a>
                <a href="https://isomara-arpg.tumblr.com/" class="home-icons fab fa-tumblr"></a>
                <a href="https://twitter.com/IsomaraARPG" class="home-icons fab fa-twitter"></a>
                <a href="https://www.instagram.com/isomaraarpg/" class="home-icons fab fa-instagram"></a>
                <a href="https://www.patreon.com/IsomaraARPG" class="home-icons fab fa-patreon"></a>
        </small>
    </div>
</div>

@if (Config::get('lorekeeper.extensions.scroll_to_top'))
    @include('widgets/_scroll_to_top')
@endif
