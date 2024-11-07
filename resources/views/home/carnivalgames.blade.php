@extends('layouts.app')

@section('title') Hallows Carnival @endsection

@section('content')

<style>
    p.a {
        text-indent: 20px;
    }

    div.card-body {
        flex-direction:column;
        margin-right:15px;
        margin-bottom:0;
        margin-left:15px;
        overflow: hidden;
    }
</style>

<h1>Hallows Carnival - Bubble Pop</h1>
<hr>

<div class="col-sm-12">
    <img style="float:right" width="35%" src="{{ asset('/images/bubblepop.png') }}"></div>
    <div class="card-body">
        <p>
            A blue Isomara with large horns greets you as you approach the colorful bubble board.
        </p><p class="a">
            "Hello, wanna give my game a try? All you have to do is throw these sticks and try to pop a bubble with them," You see Slayer holding a few sticks in their claws.
        </p><p class="a">
        "The smaller the bubbles the more difficult to hit and pop, so aim for small bubbles for 3 mochi, medium sized bubbled reward 2 mochi, and a large bubble earns you 1. If you don't manage to pop any bubbles then no prize."
        </p><p>
              She smiles and awaits to see if you'll take her offer to play.
        </p>
    </div>
    <div class="col-12">
        @php $gameFound = false; @endphp
            @foreach ($carnivalgames as $game)
                @if ($game->user_id == auth()->user()->id)
                    @php $gameFound = true; @endphp
                        {!! Form::open(['url' => 'carnivalgames/editgame/'.$game->id]) !!}
                        <strong>{!! Form::label('bi_donation', 'Cost to Play:') !!}</strong> 5 <img src="https://isomara-island.com/images/data/currencies/1-icon.png"> per play
                        {!! add_help('There is no daily limit on carnival games, play responsibly. Note: this will remove the ss from your balance!' ) !!}
                                    <select id='amount' name='amount' class="d-none form-control">
                                        <option value='5'>5</option>
                                    </select>
                        <input type="hidden" name="user_id" value='{!! auth()->user()->id !!}' />

                        <div class="text-center">
                                {{--<button class="btn btn-primary" type="submit">
                                    Play Game
                                </button>--}}
                                <p><i>The carnival is closed this time of year!</i></p>
                        </div>
                    @break
            {!! Form::close() !!}
            @endif
    @endforeach
    @if ($gameFound == false)
        {!! Form::open(['url' => 'carnivalgames/creategame/']) !!}
                <strong>{!! Form::label('bi_donation', 'Cost to Play:') !!}</strong> 5 <img src="https://isomara-island.com/images/data/currencies/1-icon.png"> per play
                {!! add_help('There is no daily limit on carnival games, play responsibly. Note: this will remove the ss from your balance!' ) !!}
                        <select id='amount' name='amount' class="d-none form-control">
                            <option value='5'>5</option>
                        </select>
                <input type="hidden" name="user_id" value='{!! auth()->user()->id !!}' />
                <div class="text-center">
                                {{--<button class="btn btn-primary" type="submit">
                                    Play Game
                                </button>--}}
                                <p><i>The carnival is closed this time of year!</i></p>
                </div>
            </div>
        {!! Form::close() !!}
    @endif

    <p class="mb-2">Spend your mochi at the <a href="https://isomara-island.com/shops/9">Treat Trade-In shop</a> or <a href="https://isomara-island.com/shops/10">Tricky Treasures Shop</a></p>
    <p class="mb-2">Return to the <a href="https://isomara-island.com/carnival">carnival game hub</a></p>

        <hr>

        <h5>Bubble Pop Prompt</h5>
            <p class="a">
                Draw/write about one of your Isomara playing the game, and you'll receive five plays of Bubble Pop. The art does not need to be colored or shaded; it needs to depict one or more of your Isomara playing the game. Stories need to be at least 150 words. This prompt will also reward +2 Stat Points to the character.
            </p><p class="a">
                "Before I forget, if you bring your stick, you can get three free plays, and I get to keep the stick after you're done." (Art/literature + x1 stick for a total of 8 plays for 0ss)
            </p>

        <strong><a href="/prompts/42">View & Submit Bubble Pop Game Prompt Here</a></strong>

@endsection
