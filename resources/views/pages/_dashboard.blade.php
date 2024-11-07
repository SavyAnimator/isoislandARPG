<h1>Welcome, {!! Auth::user()->displayName !!}!</h1>

<div class="card mb-4">
    <div class="card-body">
        {{--<i class="far fa-clock"></i> {!! format_date(Carbon\Carbon::now()) !!}--}}

        <h5>Quick Links:</h5>
        <div align="center">
            <a href="/gallery/submissions/pending"><button type="button" class="btn btn-primary">Art Gallery Submissions</button></a>
            <a href="/submissions/new"><button type="button" class="btn btn-primary">Submit Activity/Prompt</button></a>
            <a href="/reports/new"><button type="button" class="btn btn-primary">Submit Report</button></a>
            <a href="/claims/new"><button type="button" class="btn btn-primary">Submit Claim</button></a>
        </div>
        <hr>
        <div align="center">
            <div class="row">
                <div class="col-md">
                    <a href="/cache"><div style="font-family: Poets">Queen's Cache</div>
                    <img src="{{ asset('/images/home/icon_qc.png') }}" class="zoom-img" height="125px"/></a>
                </div>
                <div class="col-md">
                    <a href="/pool"><div style="font-family: Poets">Tide Pools</div>
                        <img src="{{ asset('/images/home/icon_tp.png') }}" class="zoom-img" height="125px"/></a>
                </div>
                <div class="col-md">
                    <a href="/sink-or-soar"><div style="font-family: Poets">Sink or Soar</div>
                        <img src="{{ asset('/images/home/icon_ss.png') }}" class="zoom-img" height="125px"/></a>
                </div>
                <div class="col-md">
                    <a href="/wishingwell"><div style="font-family: Poets">Wishful Well</div>
                        <img src="/images/home/icon_ww.png" class="zoom-img" height="125px"/></a>
                </div>
                <div class="col-md">
                    <a href="/pavilion"><div style="font-family: Poets">Daily Fetch Quest</div>
                        <img src="/images/home/icon_fq.png" class="zoom-img" height="125px"/></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body text-center">



                <img src="/images/avatars/{{ Auth::user()->avatar }}" height="150px" style="border-radius:50%;" alt="Account" />
                <h5 class="card-title">My Account</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ Auth::user()->url }}">Profile</a></li>
                <li class="list-group-item"><a href="{{ url('account/settings') }}">User Settings</a></li>
                <li class="list-group-item"><a href="{{ url('trades/open') }}">Item & Character Trades</a></li>
                <li class="list-group-item"><a href="{{ url('reports') }}">My Reports</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('images/characters.png') }}" height="150px" alt="Characters" />
                <h5 class="card-title">Characters</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ url('characters') }}">My Characters</a></li>
                <li class="list-group-item"><a href="{{ url('characters/myos') }}">My MYO Slots</a></li>
                <li class="list-group-item"><a href="{{ url('critters') }}">My Critters</a></li>
                <li class="list-group-item"><a href="{{ url('characters/transfers/incoming') }}">Character Transfers</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('images/inventory.png') }}" height="150px" alt="Inventory" />
                <h5 class="card-title">Items & Currency</h5>
            </div>
            <ul class="list-group list-group-flush">
                <div class="row">
                    <div class="col-md">
                <li class="list-group-item"><a href="{{ url('inventory') }}">My Inventory</a></li>
                <li class="list-group-item"><a href="{{ Auth::user()->url . '/item-logs' }}">Item Logs</a></li>
                <li class="list-group-item"><a href="{{ url('bank') }}">Currency Bank</a></li>
                <li class="list-group-item"><a href="{{ Auth::user()->url . '/currency-logs' }}">Currency Logs</a></li>
                    </div>
                    <div class="col-md">
                <li class="list-group-item"><a href="{{ url('equipment') }}">My Equipment</a></li>
                <li class="list-group-item"><a href="{{ url('accessory') }}">My Accessories</a></li>
                <li class="list-group-item"><a href="{{ url('awardcase') }}">My Awards</a></li>
                <li class="list-group-item"><a href="{{ Auth::user()->url . '/award-logs' }}">Award Logs</a></li>
                </div>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ asset('/images/data/shops/1-image.png') }}" height="150px" alt="Shops" />
                <h5 class="card-title">Shops</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="/">My Shop (TBA)</a></li>
                <li class="list-group-item"><a href="/">Player Shop Directory (TBA)</a></li>
                <li class="list-group-item"><a href="/shops">NPC Shop Directory</a></li>
                <div class="row">
                    <div class="col-md">
                        <li class="list-group-item">
                            <a href="/shops/1">Pacing's Shop</a><br>
                            <img src="{{ asset('/images/data/shops/1-image.png') }}" class="zoom-img" height="125px"/></a>
                        </li>
                    </div>
                    <div class="col-md">
                        <li class="list-group-item">
                            <a href="/shops/1">Darwin's Donations</a><br>
                            <img src="{{ asset('/images/donation_shop.png') }}" class="zoom-img" height="125px"/></a>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    {{--<div class="col-md-6">
        <div class="card mb-12">
            <div class="card-body text-center">
                <img src="{{ asset('images/awards.png') }}" height="150px" alt="Awards" />
                <h5 class="card-title">Awards</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ url('awardcase') }}">My Awards</a></li>
                <li class="list-group-item"><a href="{{ Auth::user()->url . '/award-logs' }}">Award Logs</a></li>
            </ul>
        </div>
    </div>--}}
</div>
