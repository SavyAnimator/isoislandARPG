<ul>
    <li class="sidebar-header"><a href="{{ url(__('dailies.dailies')) }}" class="card-link">{{__('dailies.dailies')}}</a></li>

    <li class="sidebar-section">
        @foreach($dailies as $daily)
        <div class="sidebar-item"><a href="{{ $daily->url }}" class="{{ set_active('dailies/'.$daily->id) }}">{{ $daily->name }}</a></div>
        @endforeach
        <div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('sink-or-soar') }}">
                Sink or Soar
            </a>
            <a class="dropdown-item" href="{{ url('cache') }}">
                <i class="far fa-gem"></i>  Queen's Cache
            </a>
            <a class="dropdown-item" href="{{ url('pool') }}">
                <i class="fas fa-fish"></i>  Tide Pools
            </a>
            <a class="dropdown-item" href="{{ url('pavilion') }}">
                <i class="fas fa-fish"></i>  NPC Fetch Quest
            </a>
        </div>
    </li>
</ul>
