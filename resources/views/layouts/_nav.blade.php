<nav class="navbar navbar-expand-md navbar-item bg-light" id="headerNav">
 <div class="container-fluid">

    <a href="{{ url('/') }}"><div class="island" alt="IsoIsland"></div>
		<!--<a class="navbar-brand" href="{{ url('/') }}">
            {{ config('lorekeeper.settings.site_name', 'Lorekeeper') }}-->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                </li>
					<li class="nav-item dropdown">
                        <a id="communityDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							Community
                        </a>

                        <div class="dropdown-menu" aria-labelledby="communityDropdown">
							@if(Auth::check() && Auth::user()->is_news_unread && Config::get('lorekeeper.extensions.navbar_news_notif'))
							<a class="dropdown-item text-warning" href="{{ url('news') }}"><i class="fas fa-bell"></i>  News</a>
							@else
							<a class="dropdown-item" href="{{ url('news') }}">
								<i class="far fa-newspaper"></i>  News</a>
							@endif
                            <a class="dropdown-item" href="{{ url('gallery') }}">
                                <i class="fas fa-paint-brush"></i>  Art Gallery
                            </a>
                            <a class="dropdown-item" href="{{ url('/features') }}">
                                <i class="fas fa-star"></i>  Monthly Features
                            </a>
                            <a class="dropdown-item" href="{{ url('forum') }}">
                                <i class="far fa-comments"></i>  Forums
                            </a>
                            <a class="dropdown-item" href="{{ url('forms') }}">
                                <i class="fas fa-poll-h"></i> Forms & Polls
                            </a>
							<a class="dropdown-item" href="{{ url('users') }}">
								<i class="fas fa-users"></i>  Players List
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="https://www.deviantart.com/isomara-island">
							    <i class="fab fa-deviantart"></i> DeviantArt
                            </a>
							<a class="dropdown-item" href="https://www.deviantart.com/isomaraindex/journal/Group-Chat-Rules-Regulations-628748123">
                                <i class="fab fa-discord"></i> Discord
                            </a>
                            <a class="dropdown-item" href="https://bsky.app/profile/isomaraisland.com">
                                <i class="fab fa-bluesky"></i> Bluesky
                            </a>
                            <a class="dropdown-item" href="https://isomara-arpg.tumblr.com/">
							    <i class="fab fa-tumblr"></i> Tumblr
                            </a>
                            <a class="dropdown-item" href="https://twitter.com/IsomaraARPG">
							    <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a class="dropdown-item" href="https://www.instagram.com/isomaraarpg/">
							    <i class="fab fa-instagram"></i> Instagram
                            </a>
							<a class="dropdown-item" href="https://www.patreon.com/IsomaraARPG">
							    <i class="fab fa-patreon"></i> Patreon
							</a>
                        </div>
                    </li>

					<li class="nav-item dropdown">
                    <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Roam
                    </a>

                    <div class="dropdown-menu" aria-labelledby="browseDropdown">
                        <a class="dropdown-item" href="{{ url('island') }}">
                            <i class="fas fa-map-marker-alt"></i>  Iso Island
                        </a>
						<a class="dropdown-item" href="{{ url('map') }}">
                            <i class="fas fa-map-marked-alt"></i>  Extended Map
                        </a>
						<a class="dropdown-item" href="{{ url('shops') }}">
                            <i class="fas fa-store"></i>  Shops
                        </a>
                        <a class="dropdown-item" href="{{ url('redeem-code') }}">
                            <i class="fas fa-hashtag"></i>  Redeem Secret Codes
                        </a>
                    </div>
					</li>
					<li class="nav-item dropdown">
                        <a id="queueDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Activities
                        </a>

                        <div class="dropdown-menu" aria-labelledby="queueDropdown">
                            <a class="dropdown-item" href="{{ url('explore') }}">
                                <i class="fas fa-mountain"></i> Exploration
                            </a>
                            <a class="dropdown-item" href="{{ url('training') }}">
                                <i class="fas fa-dumbbell"></i> Training
                            </a>
                            <a class="dropdown-item" href="{{ url('voyage') }}">
                                <i class="fas fa-water"></i> Voyaging
                            </a>
                            <a class="dropdown-item" href="{{ url('classes') }}">
                                Classes
                            </a>
                            <a class="dropdown-item" href="{{ url('crafting') }}">
                                Crafting
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('pavilion') }}">
                                <i class="fas fa-store-alt"></i>  Prompt Pavilion
                            </a>
                            <a class="dropdown-item" href="{{ url('club') }}">
                                <i class="fab fa-fort-awesome"></i>  Isoling Club
                            </a>
							<a class="dropdown-item" href="{{ url('tame') }}">
                                Taming Companions
                            </a>
							<a class="dropdown-item" href="{{ url('achieve') }}">
                                <i class="fas fa-award"></i> Achievements
                            </a>
                        </div>
                    </li>
					<li class="nav-item dropdown">
                    <a id="gameDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Games
                    </a>

                    <div class="dropdown-menu" aria-labelledby="browseDropdown">
                        <a class="dropdown-item" href="{{ url('sink-or-soar') }}">
                            Sink or Soar
                        </a>
						<a class="dropdown-item" href="{{ url('race') }}">
                            <i class="fas fa-flag-checkered"></i>  Goom Races
                        </a>
						<a class="dropdown-item" href="{{ url('wishingwell') }}">
                            <i class="fas fa-fill"></i> Wishful Well
                        </a>
						<a class="dropdown-item" href="{{ url('cache') }}">
                            <i class="far fa-gem"></i>  Queen's Cache
                        </a>
						<a class="dropdown-item" href="{{ url('pool') }}">
                            <i class="fas fa-fish"></i>  Tide Pools
                        </a>
						<a class="dropdown-item" href="{{ url('dash') }}">
                            <i class="fas fa-dungeon"></i>  Dungeon Dash
                        </a>
                        {{--<a class="dropdown-item" href="{{ url(__('dailies.dailies')) }}">
                        {{__('dailies.dailies')}}
                        </a>--}}
                    </div>
					</li>
					@if(Auth::check())
					<li class="nav-item dropdown">
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							Account
                        </a>

                        <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                            <a class="dropdown-item" href="{{ url('me') }}">
                                <i class="far fa-user"></i>  My Account
                            </a>
							<a class="dropdown-item" href="{{ url('characters') }}">
                                My Characters
                            </a>
                            <a class="dropdown-item" href="{{ url('characters/myos') }}">
                                My MYO Slots
                            </a>
                            <a class="dropdown-item" href="{{ url('inventory') }}">
                                <i class="fas fa-box"></i> Inventory
                            </a>
                            <a class="dropdown-item" href="{{ url('bank') }}">
                                <i class="fas fa-coins"></i> Bank
                            </a>
							<div class="dropdown-divider"></div>
                            <!--<a class="dropdown-item" href="{{ url('level') }}">
                                Level Area 500!
                            </a>
                            <a class="dropdown-item" href="{{ url('awardcase') }}">
                                Awards
                            </a>-->
							<a class="dropdown-item" href="{{ url('characters/transfers/incoming') }}">
                                <i class="fas fa-exchange-alt"></i> Character Transfers
                            </a>
							<a class="dropdown-item" href="{{ url('trades/open') }}">
                                <i class="fas fa-sync-alt"></i> Item & Character Trades
                            </a>

                            <a class="dropdown-item" href="{{ url('submissions') }}">
                                <i class="fas fa-store-alt"></i> Activity/Prompt Submissions
                            </a>
                            {{--<a class="dropdown-item" href="{{ url('submissions?type=draft') }}">
                                Submission Drafts
                            </a>--}}
                            <a class="dropdown-item" href="{{ url('claims') }}">
                                <i class="fas fa-exclamation-circle"></i> Claims
                            </a>
                            {{--<a class="dropdown-item" href="{{ url('claims?type=draft') }}">
                                Claim Drafts
                            </a>--}}
                            <a class="dropdown-item" href="{{ url('designs') }}">
                                <i class="far fa-check-square"></i> Design Approvals
                            </a>
                            <a class="dropdown-item" href="{{ url('surrenders') }}">
                                Character Donations
                            </a>
                            <div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{ url('reports') }}">
                                My Reports
                            </a>
                        </div>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a id="loreDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Inhabitants
                    </a>

                    <div class="dropdown-menu" aria-labelledby="loreDropdown">
						<a class="dropdown-item" href="{{ url('masterlist') }}">
                            <i class="fas fa-dragon"></i> Character Masterlist
                        </a>
                        <a class="dropdown-item" href="{{ url('myos') }}">
                            <i class="fas fa-egg"></i>  MYO Slot Masterlist
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/info/inhabitants') }}">
                            <i class="fas fa-users"></i></i> Island Inhabitants
                        </a>
                        <a class="dropdown-item" href="{{ url('NPCs') }}">
                            <i class="fas fa-users"></i></i> Meet the NPCs
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('sales') }}">
                            <i class="fas fa-hands"></i></i> Adopts & Sales
                        </a>
                        <a class="dropdown-item" href="{{ url('raffles') }}">
                            <i class="fas fa-ticket-alt"></i> Raffles
                        </a>
                    </div>
                </li>
				<li class="nav-item dropdown">
                    <a id="helpdropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Resources
                    </a>

                    <div class="dropdown-menu" aria-labelledby="helpdropdown">
						<a class="dropdown-item" href="{{ url('faq') }}">
                            <i class="fas fa-question"></i> Frequently Asked Questions
                        <a class="dropdown-item" href="{{ url('reports/bug-reports') }}">
                            <i class="far fa-question-circle"></i> Support Center
                        </a>
                        <div class="dropdown-divider"></div>
                        <div class="sidebar-section-header">Guides & Information</div>
						<a class="dropdown-item" href="{{ url('guide') }}">
                            <i class="fas fa-bookmark"></i> Beginner's Guide
                        </a>
                        <a class="dropdown-item" href="{{ url('info/currency') }}">
                            <img src="images/data/currencies/1-icon.png"> Earn In-Game Currency
                        </a>
                        <a class="dropdown-item" href="{{ url('info/hunger') }}">
                            <i class="fas fa-drumstick-bite"></i> Hunger Mechanic
                        </a>
                        <a class="dropdown-item" href="{{ url('info/ailments') }}">
                            <i class="fas fa-snowflake"></i> Inflictions & Ailments
                        </a>
                        <a class="dropdown-item" href="{{ url('care') }}">
                            <i class="fas fa-hand-holding-heart"></i> Companion Care Drops
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('info/myo') }}">
                            <i class="fas fa-portrait"></i> MYO Slot Information
                        </a>
                        <a class="dropdown-item" href="{{ url('design') }}">
                            <i class="fas fa-paint-brush"></i> Character Design Guide
                        </a>
                        <a class="dropdown-item" style="padding-left: 15%" href="{{ url('/world/kitchensink') }}">
                            <i class="fas fa-paint-brush"></i> All Species Trait Index
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('world') }}">
                            <i class="fas fa-book-open"></i> ARPG Index
                        </a>
                        <a class="dropdown-item" href="{{ url('glossary') }}">
                            <i class="fas fa-list"></i>  Glossary [WIP]
						</a>
                    </div>
                </li>

				<li class="nav-item dropdown">
                    <a id="eventdropdown" class="glow nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Bubbling Under
                    </a>

                    <div class="dropdown-menu" aria-labelledby="eventdropdown">
                        <a class="dropdown-item" href="{{ url('info/blub') }}">
                            <i class="fas fa-water"></i> Bubbling Under  Plot Teaser (First Page)
                        </a>
						<a class="dropdown-item" href="{{ url('info/blub2') }}">
                            <i class="fas fa-water"></i> Bubbling Under Plot Comic (Latest Page)
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/shops/9') }}">
                            <i class="fas fa-shopping-basket"></i> Treat Trade-In Shop [Closes Nov. 10th]
                        </a>
                        <a class="dropdown-item" href="{{ url('/shops/10') }}">
                            <i class="fas fa-lemon"></i> Tricky Treasures Shop [Closes Nov. 5th]
                        </a>
                    </div>
                </li>

            <style>
                .glow {
                    Color: #fffaaf !important;
                    text-shadow: 0 0 3px #b93148, 0 0 5px #f2b83b !important;
                }
            </style>

            </ul>

            <!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if (Auth::user()->isStaff)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin') }}"><i class="fas fa-crown"></i></a>
                        </li>
                    @endif

                    @if(Auth::check() && Auth::user()->is_news_unread && Config::get('lorekeeper.extensions.navbar_news_notif'))
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="{{ url('news') }}"><i class="fas fa-bell"></i></a>
                        </li>
                    @else
                    @endif

                    @if(Auth::user()->notifications_unread)
                        <li class="nav-item">
                            <a class="nav-link btn btn-ilyellow btn-sm" href="{{ url('notifications') }}"><span class="fas fa-envelope"></span> {{ Auth::user()->notifications_unread }}</a>
                        </li>
                    @endif
					<li class="nav-item avatar">
						<img src="/images/avatars/{{ Auth::user()->avatar }}" style="width:25px; height:25px; border-radius:50%; margin-top:8px; margin-left:10px;">
					</li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ Auth::user()->url }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ Auth::user()->url }}">
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ url('notifications') }}">
                                Notifications
                            </a>
                            {{--<a class="dropdown-item" href="{{ url('account/bookmarks') }}">
                                Bookmarks
                            </a>--}}
                            <a class="dropdown-item" href="{{ url('account/settings') }}">
                                Settings
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>

					<li class="nav-item dropdown">
                        <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Submit
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="browseDropdown">
                            <a class="dropdown-item" href="{{ url('/gallery') }}">
                                Submit Art / Literature
                            </a>
                            <a class="dropdown-item" href="{{ url('submissions/new') }}">
                                Submit Activity / Prompt
                            </a>
                            <a class="dropdown-item" href="{{ url('claims/new') }}">
                                Submit Claim
                            </a>
                            <a class="dropdown-item" href="{{ url('reports/new') }}">
                                Submit Report
                            </a>
                        </div>
                    </li>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<div class="live-clock-container">
    <div class>
        <li class="live-clock">
            @guest
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>|
            @if (Route::has('register'))
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
            @else
                <a class="nav-link" href="{{ Auth::user()->url }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><b>{{ Auth::user()->name }}</b></a>
            @foreach(Auth::user()->getCurrencies(false) as $currency)
            &nbsp;<b>|</b>&nbsp;
            {!!$currency->display($currency->quantity) !!}
            @endforeach

            @endguest
        &nbsp;<b>|</b>&nbsp;
            <!-- Clock -->
            <i class="far fa-clock"></i><a href="https://time.is/Glendale,_Arizona" class="inactiveLink" id="time_is_link" rel="nofollow" style="display:none;"></a>
            <span id="Glendale__Arizona_z16c" style="font:Karla;font-size:14 px;">...</span>
                <script src="//widget.time.is/t.js"></script>
                <script>time_is_widget.init({Glendale__Arizona_z16c:{time_format:"12hours:minutes:seconds AMPM"}});</script>
        </li>
    </div>
</div>
