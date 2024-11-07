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

<h1>Hallows Carnival - One Rock </h1>
<hr>

<div class="col-sm-12">
    {{--<img style="float:right" width="35%" src="{{ asset('') }}"></div>--}}
    <div class="card-body">
        <p>
            What an odd sight. Looks like Darwin got a vacation from his endless mail delivery to help with the carnival. He appears overly cheerful.
        </p><p class="a">
                "Hey, come here kid. You think you're strong enough to knock over these sugar canes?" He winks at you.
        </p><p>
            The game seems easy enough from the looks of it. six sugar canes are stacked up in a pyramid formation. Three on the bottom, two in the middle row, and one atop the pyramid.
        </p><p class="a">
            "If you manage to knock down at least three canes with this rock then I'll give you two peices of mochi, knock down all six and I'll give ya three pieces. Anything less than three and I'll refund you a single seashell."
        </p>
    </div>
    <div class="col-12">
        @php $rockFound = false; @endphp
            @foreach ($carnivalrock as $rock)
                @if ($rock->user_id == auth()->user()->id)
                    @php $rockFound = true; @endphp
                        {!! Form::open(['url' => 'carnivalrock/editrock/'.$rock->id]) !!}
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
            @if ($rockFound == false)
            {!! Form::open(['url' => 'carnivalrock/createrock/']) !!}
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

        <p class="mb-2">Spend your mochi at the <a href="https://isomara-island.com/shops/9">Treat Trade-In shop</a></p>
        <p class="mb-2">Return to the <a href="https://isomara-island.com/carnival">carnival game hub</a></p>

        <hr>

        <h5>One Rock Prompt</h5>
            <p class="a">
                Test your luck and skills by throwing a rock at the stack of sugar cane. If you draw/write your Isomara playing the game you will receive 5 free plays. The art does not need to be colored or shaded it just needs to depict one or more of your Isomara playing the game in some way. Stories need to be at least 150 words. This prompt will also reward +2 Stat Points to the character.
            </p>
            <p class="a">
                "Oh, and if you bring your own rock I'll let you have three plays free of charge. I'll be keeping the rock after that though." (Art/literature + x1 rock for a total of 8 plays for 0ss)<br>
            </p>

        <strong><a href="/prompts/43">View & Submit One Rock Game Prompt Here</a></strong>
@endsection
