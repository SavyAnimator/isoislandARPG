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

<h1>Hallows Carnival - Palm Reading</h1>
<hr>

<div class="col-sm-12">
    <img style="float:right" width="35%" src=""></div>
    <div class="card-body">
        <p>
            <a href="https://isomara-island.com/character/I-0307">Thyme</a> seems to be a little frazzled and in a hurry. He immediately gets into character as you approach.
        </p><p class="a">
            "Helloooo! I heard my divine mystical readings were severely missed, but alas I have no fortunes to give. This year your fate is in the paws of royalty." <a href="https://www.deviantart.com/slayersstronghold/journal/Hallows-Month-Event-Isomara-Island-ARPG-CLOSED-893604133">{!! add_help('This is a reference to the 2021 Hallows Carnival where Thyme would give out divine fortune tellings.' ) !!}</a>
        </p><p>
            He gestures to a <a href="https://isomara-island.com/character/E-0077">memora</a> sitting on the cushioned table. She has gracefully aged into a slightly desaturated pelt. Her many stingers gently wafted up and down.
        </p><p class="a">
            "While she is technically tamed she doesn't take to all isomara. She will tell you your luck by either swatting your paw or  allowing you to grab a good from her own little cache."
            <br>"I wish you luck and I must be off on important business! Have fun!"
        </p><p>Thyme then tosses a pile of goodies in front of the queen memora and proceeds to gallop away in a hurry swiftly.</p>
    </div>
    <div class="col-12">
        @php $palmFound = false; @endphp
            @foreach ($carnivalpalm as $palm)
                @if ($palm->user_id == auth()->user()->id)
                    @php $palmFound = true; @endphp
                        {!! Form::open(['url' => 'carnivalpalm/editpalm/'.$palm->id]) !!}
                        <strong>{!! Form::label('bi_donation', 'Cost to Play:') !!}</strong> 15 <img src="https://isomara-island.com/images/data/currencies/1-icon.png"> per play
                        {!! add_help('There is no daily limit on carnival games, play responsibly. Note: this will remove the ss from your balance!' ) !!}
                                    <select id='amount' name='amount' class="d-none form-control">
                                        <option value='15'>15</option>
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
    @if ($palmFound == false)
        {!! Form::open(['url' => 'carnivalgames/creategame/']) !!}
                <strong>{!! Form::label('bi_donation', 'Cost to Play:') !!}</strong> 15 <img src="https://isomara-island.com/images/data/currencies/1-icon.png"> per play
                {!! add_help('There is no daily limit on carnival games, play responsibly. Note: this will remove the ss from your balance!' ) !!}
                        <select id='amount' name='amount' class="d-none form-control">
                            <option value='15'>15</option>
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

@endsection
