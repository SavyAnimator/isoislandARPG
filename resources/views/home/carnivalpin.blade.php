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

<h1>Hallows Carnival - Pin-the-Stinger </h1>
<hr>

<div class="col-sm-12">
    {{--<img style="float:right" width="35%" src="{{ asset('') }}"></div>--}}
    <div class="card-body">
        <p class="a">
            "Come come, play Pin-the-Stinger," urges Thyme. "This game is all in jest and splendid fun for the watchers, too. The goal is to be as close to pinning the stingers around the Memora's venom sack as possible. The catch is you are blindfolded and spun around."
        </p><p>
            The thought of being dizzy may sound unfavorable, but the sheer challenge of attempting to pin a portion of a vine to a poorly drawn Memora on a large canvas does sound fun.
        </p><p class="a">
            "For each stinger pinned in range of the venom sack, you will receive one mochi."
        </p>
    </div>
    <div class="col-12">
        @php $pinFound = false; @endphp
            @foreach ($carnivalpin as $pin)
                @if ($pin->user_id == auth()->user()->id)
                    @php $pinFound = true; @endphp
                    {!! Form::open(['url' => 'carnivalpin/editpin/'.$pin->id]) !!}
                            <strong>{!! Form::label('bi_donation', 'Cost to Play:') !!}</strong> 2 <img src="https://isomara-island.com/images/data/currencies/1-icon.png"> per play
                                {!! add_help('There is no daily limit on carnival games, play responsibly. Note: this will remove the ss from your balance!' ) !!}
                                    <select id='amount' name='amount' class="d-none form-control">
                                        <option value='2'>2</option>
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
            @if ($pinFound == false)
            {!! Form::open(['url' => 'carnivalpin/createpin/']) !!}
                    <strong>{!! Form::label('bi_donation', 'Cost to Play:') !!}</strong> 2 <img src="https://isomara-island.com/images/data/currencies/1-icon.png"> per play
                    {!! add_help('There is no daily limit on carnival games, play responsibly. Note: this will remove the ss from your balance!' ) !!}
                            <select id='amount' name='amount' class="d-none form-control">
                                <option value='2'>2</option>
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

        <h5>Pin-the-Stinger Prompt</h5>
            <p class="a">
                Draw/write about one of your Isomara playing the game, and you'll receive five plays of Pin-the-Stinger. The art does not need to be colored or shaded; it needs to depict one or more of your Isomara playing the game. Stories need to be at least 150 words. This prompt will also reward +2 Stat Points to the character.
            </p>

        <strong><a href="/prompts/46">View & Submit Pin-the-Stinger Game Prompt Here</a></strong>

@endsection
