<ul>
    <!--<li class="sidebar-header"><a href="{{ $user->url }}" class="card-link">{{ Illuminate\Support\Str::limit($user->name, 10, $end='...') }}</a></li>-->
    <li class="sidebar-section">
        <div class="sidebar-section-header">{{$user->name}} <i class="far fa-user"></i></div><div class="dropdown-divider"></div>

        <div class="sidebar-item"><a href="{{ $user->url.'/characters' }}" class="{{ set_active('user/'.$user->name.'/characters*') }}">All Characters</a></div>
       @if(isset($sublists) && $sublists->count() > 0)
                @foreach($sublists as $sublist)
                <div class="sidebar-item"><a href="{{ $user->url.'/sublist/'.$sublist->key }}" class="{{ set_active('user/'.$user->name.'/sublist/'.$sublist->key) }}">{{ $sublist->name }}</a></div>
                @endforeach
        @endif
        <div class="sidebar-item"><a href="{{ $user->url.'/myos' }}" class="{{ set_active('user/'.$user->name.'/myos*') }}">MYO Slots</a></div>
        <div class="dropdown-divider"></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/bank' }}" class="{{ set_active('user/'.$user->name.'/bank*') }}">Currency</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/inventory' }}" class="{{ set_active('user/'.$user->name.'/inventory*') }}">Inventory</a></div>
        <!--<div class="sidebar-item"><a href="{{ $user->url.'/level' }}" class="{{ set_active('user/'.$user->name.'/level*') }}">Level Logs</a></div>-->
        <div class="sidebar-item"><a href="{{ $user->url.'/equipment' }}" class="{{ set_active('user/'.$user->name.'/equipment*') }}">Accessories</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/equipment' }}" class="{{ set_active('user/'.$user->name.'/equipment*') }}">Equipment</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/critters' }}" class="{{ set_active('user/'.$user->name.'/critters*') }}">Critters</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/awardcase' }}" class="{{ set_active('user/'.$user->name.'/awardcase*') }}">Awards</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/aliases' }}" class="{{ set_active('user/'.$user->name.'/aliases*') }}">Aliases</a></div>
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Gallery <i class='far fa-images'></i></div><div class="dropdown-divider"></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/gallery' }}" class="{{ set_active('user/'.$user->name.'/gallery*') }}">{{$user->name}}'s Gallery</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/favorites' }}" class="{{ set_active('user/'.$user->name.'/favorites*') }}">Gallery Favorites</a></div>
        <!--<div class="sidebar-item"><a href="{{ $user->url.'/favorites/own-characters' }}" class="{{ set_active('user/'.$user->name.'/favorites/own-characters*') }}">Own Character Favorites</a></div>-->
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">History <i class="fas fa-book"></i></div><div class="dropdown-divider"></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/ownership' }}" class="{{ $user->url.'/ownership*' }}">Ownership History</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/item-logs' }}" class="{{ $user->url.'/currency-logs*' }}">Item Logs</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/currency-logs' }}" class="{{ set_active($user->url.'/currency-logs*') }}">Currency Logs</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/accessory-logs' }}" class="{{ set_active($user->url.'/accessory-logs*') }}">Accessory Logs</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/equipment-logs' }}" class="{{ set_active($user->url.'/equipment-logs*') }}">Equipment Logs</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/critter-logs' }}" class="{{ set_active($user->url.'/critter-logs*') }}">Critter Logs</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/recipe-logs' }}" class="{{ set_active($user->url.'/recipe-logs*') }}">Recipe Logs</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/award-logs' }}" class="{{ $user->url.'/award-logs*' }}">Award Logs</a></div>
        <div class="sidebar-item"><a href="{{ $user->url.'/submissions' }}" class="{{ set_active($user->url.'/submissions*') }}">Submissions</a></div>
        @auth
            <div class="sidebar-item"><a href="{{ $user->url.'/forum' }}" class="{{ $user->url.'/forum*' }}">Forum Posts</a></div>
        @endauth
    </li>

    @if(Auth::check() && Auth::user()->hasPower('edit_user_info'))
        <li class="sidebar-section">
            <div class="sidebar-section-header">Admin</div>
            <div class="sidebar-item"><a href="{{ $user->adminUrl }}">Edit User</a></div>
        </li>
    @endif
</ul>
