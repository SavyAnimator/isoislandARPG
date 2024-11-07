<ul>
    <li class="sidebar-header"><a href="{{ url('world') }}" class="card-link">ARPG Index</a></li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Characters</div>
        <div class="sidebar-item"><a href="{{ url('world/species') }}" class="{{ set_active('world/species*') }}">Island Inhabitants</a></div>

        <div class="sidebar-item"><a href="{{ url('world/subtypes') }}" class="{{ set_active('world/subtypes*') }}">Isomara Breeds</a></div>
        <div class="dropdown-divider"></div>
        {{--<div class="sidebar-item"><a href="{{ url('world/rarities') }}" class="{{ set_active('world/rarities*') }}">Rarities</a></div>
        <div class="sidebar-item"><a href="{{ url('world/trait-categories') }}" class="{{ set_active('world/trait-categories*') }}">Trait Categories</a></div>--}}
        {{--<li class="list-group-item"><a href="{{ url('world/traits') }}">Traits</a></li>--}}
        <div class="sidebar-item"><a href="{{ url('world/kitchensink') }}" class="{{ set_active('world/kitchensink*') }}">All Traits Index</a></div>
        <div class="sidebar-item"><a href="{{ url('/world/species/1/traits') }}" class="{{ set_active('/world/species/1/traits*') }}">Isomara Trait Index</a></div>
        <div class="sidebar-item"><a href="{{ url('/world/species/2/traits') }}" class="{{ set_active('/world/species/2/traits*') }}">Goom Trait Index</a></div>
        <div class="sidebar-item"><a href="{{ url('/world/species/4/traits') }}" class="{{ set_active('/world/species/4/traits*') }}">Blepper Trait Index</a></div>
        <div class="sidebar-item"><a href="{{ url('/world/species/5/traits') }}" class="{{ set_active('/world/species/5/traits*') }}">Memic Trait Index</a></div>
        <div class="sidebar-item"><a href="{{ url('/world/species/3/traits') }}" class="{{ set_active('/world/species/3/traits*') }}">Memora Trait Index</a></div>
        <div class="dropdown-divider"></div>
        <div class="sidebar-item"><a href="{{ url('masterlist') }}" class="{{ set_active('masterlist*') }}">Character Masterlist</a></div>
        {{--<div class="sidebar-item"><a href="{{ url('world/character-categories') }}" class="{{ set_active('world/character-categories*') }}">Character Categories</a></div>--}}
        <div class="sidebar-item"><a href="{{ url('world/character-classes') }}" class="{{ set_active('world/character-classes*') }}">Character Classes</a></div>
        <div class="sidebar-item"><a href="{{ url('world/status-effects') }}" class="{{ set_active('world/status-effects*') }}">Inflictions & Ailments</a></div>
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Items</div>
        <div class="sidebar-item"><a href="{{ url('world/currencies') }}" class="{{ set_active('world/currencies*') }}">Currencies</a></div>
        <div class="sidebar-item"><a href="{{ url('world/items') }}" class="{{ set_active('world/items*') }}">All Items</a></div>
       {{-- <div class="sidebar-item"><a href="{{ url('world/item-categories') }}" class="{{ set_active('world/item-categories*') }}">Item Categories</a></div>--}}
        <div class="sidebar-item"><a href="{{ url('world/recipes') }}" class="{{ set_active('world/recipes*') }}">Crafting Recipes</a></div>
        {{--<div class="sidebar-item"><a href="{{ url('world/weapon-categories') }}" class="{{ set_active('world/weapon-categories*') }}">Equipment Categories</a></div>--}}
        <div class="sidebar-item"><a href="{{ url('world/equipment') }}" class="{{ set_active('world/equipment*') }}">Equipment</a></div>
        <div class="sidebar-item"><a href="{{ url('world/accessory') }}" class="{{ set_active('world/accessory*') }}">Accessories</a></div>
        <div class="sidebar-item"><a href="{{ url('world/accessory-categories') }}" class="{{ set_active('world/accessory-categories*') }}">Accessory Categories</a></div>
    </li>
    {{--<li class="sidebar-section">
        <div class="sidebar-section-header">Levels</div>
        <div class="sidebar-item"><a href="{{ url('world/levels/user') }}" class="{{ set_active('world/levels/user*') }}">User Levels</a></div>
        <div class="sidebar-item"><a href="{{ url('world/levels/character') }}" class="{{ set_active('world/levels/character*') }}">Character Levels</a></div>
        <div class="sidebar-item"><a href="{{ url('world/stats') }}" class="{{ set_active('world/stats*') }}">Stats</a></div>
    </li>--}}
    <li class="sidebar-section">
        <div class="sidebar-section-header">Awards</div>
        <div class="sidebar-item"><a href="{{ url('world/awards') }}" class="{{ set_active('world/awards*') }}">All Awards</a></div>
        <div class="sidebar-item"><a href="{{ url('world/awards?name=&award_category_id=1&sort=alpha&ownership=character') }}" class="{{ set_active('world/awards?name=&award_category_id=1&sort=alpha&ownership=character*') }}">Character Achievements</a></div>
        <div class="sidebar-item"><a href="{{ url('world/awards?name=&award_category_id=2&sort=alpha&ownership=user') }}" class="{{ set_active('world/awards?name=&award_category_id=2&sort=alpha&ownership=user*') }}">User Badges</a></div>
    </li>
</ul>
