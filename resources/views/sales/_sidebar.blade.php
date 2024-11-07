<ul>
    <li class="sidebar-header"><a href="{{ url('sales') }}" class="card-link">Recent Posts</a></li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Adopts & Sales</div>
        @foreach($saleses->take(8) as $sales)
            <div class="sidebar-item"><a href="{{ $sales->url }}" class="{{ set_active('sales/'.$sales->id.'*') }}">{{ $sales->title }}</a></div>
        @endforeach
        <div class="dropdown-divider"></div>
        <div class="sidebar-item"><a href="{{ url('sales?title=&is_open=1&sort=bump-reverse') }}">Open Adoptables</a></div>
            <div class="sidebar-item"><a href="{{ url('sales') }}">All Adoptables</a></div>

</ul>
