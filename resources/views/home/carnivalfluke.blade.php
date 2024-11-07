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

<h1>Hallows Carnival - Flukey Ball </h1>
<hr>

<div class="col-sm-12">
    <img style="float:right" width="22%" src="{{ asset('/images/flukeyball.png') }}"></div>
    <div class="card-body">
        <p>
            You walk by another game. Frio, the chilly blue Isomara, is here waving and smiling. He seems a little nervous as you approach him.
        </p><p class="a">
            "H-hi, I...uh, this game is called Flukey Ball. Every play gives you three chances to throw this coconut, or well, 'Ball,' into the basket. If you make it into the basket, you get an ah-a mochi, make all three tosses, and the grand prize of 5 mochi. The catch is, uh, well, you need to bounce the ball off the backboard there and land it into the basket."
        </p><p>
            Frio is now pointing to the board, standing right behind the wicker basket. The game seems easy enough.
        </p><p class="a">
            "Would you... like to give it a try?"
        </p>
    </div>
    <div class="col-12">
        @php $flukeFound = false; @endphp
            @foreach ($carnivalfluke as $fluke)
                @if ($fluke->user_id == auth()->user()->id)
                    @php $flukeFound = true; @endphp
                    {!! Form::open(['url' => 'carnivalfluke/editfluke/'.$fluke->id]) !!}
                            <strong>{!! Form::label('bi_donation', 'Cost to Play:') !!}</strong> 9 <img src="https://isomara-island.com/images/data/currencies/1-icon.png"> per play
                                {!! add_help('There is no daily limit on carnival games, play responsibly. Note: this will remove the ss from your balance!' ) !!}
                                    <select id='amount' name='amount' class="d-none form-control">
                                        <option value='9'>9</option>
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
            @if ($flukeFound == false)
            {!! Form::open(['url' => 'carnivalfluke/createfluke/']) !!}
                    <strong>{!! Form::label('bi_donation', 'Cost to Play:') !!}</strong> 9 <img src="https://isomara-island.com/images/data/currencies/1-icon.png"> per play
                    {!! add_help('There is no daily limit on carnival games, play responsibly. Note: this will remove the ss from your balance!' ) !!}
                            <select id='amount' name='amount' class="d-none form-control">
                                <option value='9'>9</option>
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

        <h5>Flukey Ball Prompt</h5>
            <p class="a">
                Tossing a ball at a board to bounce into a basket isn't too much trouble. However, it's more challenging than it looks. Draw/write about your Isomara playing the game for five free plays. The art does not need to be colored or shaded. It must somehow depict one or more of your Isomara playing the game. Stories need to be at least 150 words. This prompt will also reward +2 Stat Points to the character.
            </p>

        <strong><a href="/prompts/44">View & Submit Flukey Ball Game Prompt Here</a></strong>

@endsection
