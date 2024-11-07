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

<h1>Hallows Carnival - Whap-a-Memic </h1>
<hr>

<div class="col-sm-12">
    {{--<img style="float:right" width="35%" src="{{ asset('') }}"></div>--}}
    <div class="card-body">
        <p class="a">
            "Pssst, hey. Wanna play an entertaining game!" Charlotte is standing next to a large wooden box with holes cut out of the top.
        </p><p class="a">
            "This is Whap-a-Memic. When I say start, little memic puppets made out of cloth will start popping out randomly from the whole in the top of this box. Hit some and get a single mochi. You'll get a better prize if you manage to hit most of them. All of them, and you'll get the jackpot!"
        </p><p>
            Charlotte assures you there are no real memics around, and the game is purely to let out some aggression, but don't hit anything too hard. She doesn't want you breaking anything.
        </p>
    </div>
    <div class="col-12">
        @php $whapFound = false; @endphp
            @foreach ($carnivalwhap as $whap)
                @if ($whap->user_id == auth()->user()->id)
                    @php $whapFound = true; @endphp
                    {!! Form::open(['url' => 'carnivalwhap/editwhap/'.$whap->id]) !!}
                            <strong>{!! Form::label('bi_donation', 'Cost to Play:') !!}</strong> 8 <img src="https://isomara-island.com/images/data/currencies/1-icon.png"> per play
                                {!! add_help('There is no daily limit on carnival games, play responsibly. Note: this will remove the ss from your balance!' ) !!}
                                    <select id='amount' name='amount' class="d-none form-control">
                                        <option value='8'>8</option>
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
            @if ($whapFound == false)
            {!! Form::open(['url' => 'carnivalwhap/createwhap/']) !!}
                    <strong>{!! Form::label('bi_donation', 'Cost to Play:') !!}</strong> 8 <img src="https://isomara-island.com/images/data/currencies/1-icon.png"> per play
                    {!! add_help('There is no daily limit on carnival games, play responsibly. Note: this will remove the ss from your balance!' ) !!}
                            <select id='amount' name='amount' class="d-none form-control">
                                <option value='8'>8</option>
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

        <h5>Whap-a-Memic Prompt</h5>
            <p class="a">
                Draw/write about one of your Isomara playing the game, and you'll receive five plays of Whap-a-Memic. The art does not need to be colored or shaded; it needs to depict one or more of your Isomara playing the game. Stories need to be at least 150 words. This prompt will also reward +2 Stat Points to the character.
            </p>

        <strong><a href="/prompts/45">View & Submit Whap-a-Memic Game Prompt Here</a></strong>
@endsection
