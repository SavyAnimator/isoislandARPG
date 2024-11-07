<ul>
    <li class="sidebar-header"><a href="{{ url('adoptions') }}" class="card-link">{{ $name }}</a></li>
    @auth
        <li class="sidebar-section">
            <div class="sidebar-section-header">Adopt</div>
            <div class="sidebar-item"><a href="{{ url('adoptions') }}"  class="{{ set_active('adoptions') }}">{{ $name }}</a></div>
            <div class="sidebar-item"><a href="{{ url('adoptions/history') }}" class="{{ set_active('adoptions/history') }}">My Adoption History</a></div>
        </li>

        <li class="sidebar-section">
            <div class="sidebar-section-header">Character Donation</div>
            <div class="sidebar-item"><a href="{{ url('surrenders/new') }}"  class="{{ set_active('surrenders/new') }}">New Character Donation</a></div>
            <div class="sidebar-item"><a href="{{ url('surrenders') }}" >My Character Donation History</a></div>
        </li>

    @endauth
</ul>
