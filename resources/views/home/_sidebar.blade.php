@if(Auth::check())
<ul>
    <li class="sidebar-header"><a href="{{ url('/') }}" class="card-link">Home</a></li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Account</div>
        <div class="sidebar-item"><a href="{{ url('characters') }}" class="{{ set_active('characters') }}">My Characters</a></div>
        <div class="sidebar-item"><a href="{{ url('characters/myos') }}" class="{{ set_active('characters/myos') }}">My MYO Slots</a></div>
        <div class="sidebar-item"><a href="{{ url('inventory') }}" class="{{ set_active('inventory*') }}">Inventory</a></div>
        <div class="sidebar-item"><a href="{{ url('awardcase') }}" class="{{ set_active('awardcase*') }}">Awards</a></div>
        <div class="sidebar-item"><a href="{{ url('bank') }}" class="{{ set_active('bank*') }}">Bank</a></div>
        {{--<div class="sidebar-item"><a href="{{ url('level') }}" class="{{ set_active('level*') }}">Level Area</a></div>--}}
        <div class="sidebar-item"><a href="{{ url('accessory') }}" class="{{ set_active('accessory*') }}">Accessories</a></div>
        <div class="sidebar-item"><a href="{{ url('equipment') }}" class="{{ set_active('equipment*') }}">Equipment</a></div>
        {{--@if(Auth::check())<div class="sidebar-item"><a href="{{ url(Auth::user()->url . '/level') }}" class="{{ set_active(Auth::user()->url . '/level') }}">Level Logs</a></div>@endif--}}
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Activity</div>
        <div class="sidebar-item"><a href="{{ url('submissions') }}" class="{{ set_active('submissions*') }}">Activity/Prompt Submissions</a></div>
        <div class="sidebar-item"><a href="{{ url('claims') }}" class="{{ set_active('claims*') }}">Claims</a></div>
        <div class="sidebar-item"><a href="{{ url('characters/transfers/incoming') }}" class="{{ set_active('characters/transfers*') }}">Character Transfers</a></div>
        <div class="sidebar-item"><a href="{{ url('trades/open') }}" class="{{ set_active('trades/open*') }}">Trades</a></div>
        <div class="sidebar-item"><a href="{{ url('surrenders') }}" class="{{ set_active('surrenders') }}">Donated Characters</a></div>
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Crafting</div>
        <div class="sidebar-item"><a href="{{ url('crafting') }}" class="{{ set_active('crafting') }}">My Recipes</a></div>
        <div class="sidebar-item"><a href="{{ url('world/recipes') }}" class="{{ set_active('world/recipes') }}">All Recipes</a></div>
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Reports</div>
        <div class="sidebar-item"><a href="{{ url('reports') }}" class="{{ set_active('reports*') }}">Reports</a></div>
    </li>
</ul>
@else
@endif
