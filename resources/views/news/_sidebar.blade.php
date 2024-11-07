<ul>
    <li class="sidebar-header"><a href="{{ url('news') }}" class="card-link">Recent Posts</a></li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">News & Updates</div>
        @foreach($newses->take(8) as $news)
            <div class="sidebar-item"><a href="{{ $news->url }}" class="{{ set_active('news/'.$news->id.'*') }}">{{ $news->title }}</a></div>
        @endforeach
        <div class="dropdown-divider"></div>
            <div class="sidebar-item"><a href="{{ url('news') }}">All News</a></div>

</ul>
