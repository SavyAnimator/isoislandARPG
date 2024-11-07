@extends('world.layout')

@section('title') Home @endsection

@section('content')
{{--{!! breadcrumbs(['Index' => 'world']) !!}--}}

<h1>Index</h1>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('images/characters.png') }}" height="150px" alt="Characters" />
                <h5 class="card-title">Characters & Inhabitants</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ url('world/species') }}">Island Inhabitants</a></li>
				<li class="list-group-item"><a href="{{ url('world/subtypes') }}">Isomara Breeds</a></li>
                {{--<li class="list-group-item"><a href="{{ url('world/rarities') }}">Rarities</a></li>
                <li class="list-group-item"><a href="{{ url('world/trait-categories') }}">Trait Categories</a></li>--}}
                {{--<li class="list-group-item"><a href="{{ url('world/traits') }}">Traits</a></li>--}}
                <li class="list-group-item"><a href="{{ url('world/kitchensink') }}">Visual Trait Index</a></li>
                <li class="list-group-item"><a href="{{ url('world/traits') }}">Information Trait Index</a></li>
                <li class="list-group-item"><a href="{{ url('masterlist') }}">Character Masterlist</a></li>
                {{--<li class="list-group-item"><a href="{{ url('world/character-categories') }}">Character Categories</a></li>--}}
                <li class="list-group-item"><a href="{{ url('world/character-classes') }}">Character Classes</a></li>
                {{--<li class="list-group-item"><a href="{{ url('world/pet-categories') }}">Critter Categories</a></li>--}}
                <li class="list-group-item"><a href="{{ url('world/critters') }}">Critters</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('images/inventory.png') }}" height="150px" alt="Items" />
                <h5 class="card-title">Items</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ url('world/items') }}">All Items</a></li>
                <li class="list-group-item"><a href="{{ url('world/item-categories') }}">Item Categories</a></li>
                {{--<li class="list-group-item"><a href="{{ url('world/skill-categories') }}">Skill Categories</a></li>
                <li class="list-group-item"><a href="{{ url('world/skills') }}">All Skills</a></li>--}}
                <li class="list-group-item"><a href="{{ url('world/recipes') }}">Recipes</a></li>
                <li class="list-group-item"><a href="{{ url('world/currencies') }}">Currencies</a></li>
                {{--<li class="list-group-item"><a href="{{ url('world/weapon-categories') }}">Equipment Categories</a></li>--}}
                <li class="list-group-item"><a href="{{ url('world/equipment') }}">Equipment</a></li>
                <li class="list-group-item"><a href="{{ url('world/accessory') }}">Accessories</a></li>
                <li class="list-group-item"><a href="{{ url('world/accessory-categories') }}">Accessory Categories</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('/images/data/awards/16-image.png') }}" height="150px" alt="Awards" />
                <h5 class="card-title">Awards</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ url('world/awards') }}">All Awards</a></li>
                <li class="list-group-item"><a href="{{ url('world/awards?name=&award_category_id=1&sort=alpha&ownership=character') }}">Character Achievements</a></li>
                <li class="list-group-item"><a href="{{ url('world/awards?name=&award_category_id=2&sort=alpha&ownership=user') }}">User Badges</a></li>
                <li class="list-group-item"><a href="{{ url('world/awards?name=&award_category_id=3&sort=alpha&ownership=default') }}">Sigils</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('images/inventory.png') }}" height="150px" alt="Other" />
                <h5 class="card-title">Other</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ url('world/status-effects') }}">Inflictions & Ailments</a></li>
            </ul>
        </div>
    </div>
@endsection
