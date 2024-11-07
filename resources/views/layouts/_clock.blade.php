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
