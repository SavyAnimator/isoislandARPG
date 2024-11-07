<ul>
    <li class="sidebar-header"><a =class="card-link"><a href="{{ url('pavilion') }}">Prompt Pavilion</a></a></li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Prompts</div>
        {{--<div class="sidebar-item"><a href="{{ url('prompts/prompt-categories') }}" class="{{ set_active('prompts/prompt-categories*') }}">Prompt Categories</a></div>--}}
        <div class="sidebar-item"><a href="{{ url('prompts/prompts') }}">All Prompts</a></div>
        <br>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=3') }}" class="{{ set_active('prompts/prompts?prompt_category_id=3') }}">Legacy Prompts</a></div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=9') }}" class="{{ set_active('prompts/prompts?prompt_category_id=9') }}">Island Exploration</a></div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=4') }}" class="{{ set_active('prompts/prompts?prompt_category_id=4') }}">Voyaging</a></div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=8') }}" class="{{ set_active('prompts/prompts?prompt_category_id=8') }}">Companion Quests</a></div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=6') }}" class="{{ set_active('prompts/prompts?prompt_category_id=6') }}">Class Assignments</a></div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=5') }}" class="{{ set_active('prompts/prompts?prompt_category_id=5') }}">Isoling Club Quests</a></div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=1') }}" class="{{ set_active('prompts/prompts?prompt_category_id=1') }}">Dailies</a></div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=2') }}" class="{{ set_active('prompts/prompts?prompt_category_id=2') }}">Limited Time</a></div>
    </li>

    <li class="sidebar-section">
        <div class="sidebar-section-header">Lifetime Beats</div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=12') }}" class="{{ set_active('prompts/prompts?prompt_category_id=12') }}">Egg Hatching [WIP]</a></div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=11') }}" class="{{ set_active('prompts/prompts?prompt_category_id=11') }}">Isoling Growth</a></div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=10') }}" class="{{ set_active('prompts/prompts?prompt_category_id=10') }}">Educational Intrigue</a></div>
        <div class="sidebar-item"><a href="{{ url('prompts/prompts?prompt_category_id=7') }}" class="{{ set_active('prompts/prompts?prompt_category_id=7') }}">Courtship Traditions [WIP]</a></div>
    </li>
</ul>
