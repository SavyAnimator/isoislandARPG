@extends('home.layout')

@section('home-title') Crafting @endsection

@section('home-content')
{{--{!! breadcrumbs(['Crafting' => 'crafting']) !!}--}}

<h1>
    Crafting Recipes
</h1>
<p> This is a list of recipes that you have unlocked, as well as automatically unlocked recipes. </p>

<hr>

<h3>Common Knowledge Recipes</h3>
<p>Crafting recipes that every character inheretly knows from birth.</p>
@if($default->count())
    <div class="row mx-0">
        @foreach($default as $recipe)
            @include('home.crafting._smaller_recipe_card', ['recipe' => $recipe])
        @endforeach
    </div>
@else
    There are no free recipes.
@endif

<hr>

<h3>Learned Recipes</h3>
@if(Auth::user()->recipes->count())
    <div class="row mx-0">
        @foreach(Auth::user()->recipes as $recipe)
            @include('home.crafting._smaller_recipe_card', ['recipe' => $recipe])
        @endforeach
    </div>
@else
    You haven't learned any recipes!
@endif
<div class="text-right mb-4">
    <a href="{{ url(Auth::user()->url.'/recipe-logs') }}">View logs...</a>
</div>


@endsection


@section('scripts')
<script>
$( document ).ready(function() {
    $('.btn-craft').on('click', function(e) {
        e.preventDefault();
        var $parent = $(this).parent().parent().parent();
        loadModal("{{ url('crafting/craft') }}/" + $parent.data('id'), $parent.data('name'));
    });
});
</script>
@endsection
