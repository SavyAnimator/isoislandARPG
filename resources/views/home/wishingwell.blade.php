@extends('layouts.app')

@section('title') The Wishful Well @endsection

@section('content')

<style>
    div.a {
      text-indent: 40px;
    }

div.card-body {
  flex-direction:column;
  margin-right:15px;
  margin-bottom:0;
  margin-left:15px;
  overflow: hidden;
}
</style>

@if(Auth::user())
    <a href="https://isomara-island.com/hunts/targets/QAnABZ9d87"><img style="position: absolute; z-index: 4; top: 50%; right: 52%;" src="{{ asset('images/hunts/OraDai.png') }}" height="40"/></a>
@else
@endif


<h1>The Wishful Well</h1>

<hr>

<div align="center"><img width="50%" src="{{ asset('images/wishfulwell.png') }}"></div>
<br><br>

<div class="card-body">

<p>
    "Thanks for all the help wth gathering supplies. It took a while, but it's finished! Many don't believe in wishes coming true, but I sure do and this will prove it! All you have to do is make a wish and throw something into the well. Whether it be seashells, items, or even something more sentimental or valuable. Wishes always have a chance to come true. I cannot wait to see everyone's happy faces when theirs do!" - Slay
</p>
{{--
    <div id="help" class="step" data-x="-1000" data-y="-1500">

        <div class="a" align="justify">
        "Well, I heard some rebellous Isolings were rough housing around and broke the well's canopy.
        The rock barrier was starting to come a part anyway. Would you mind helping gather some supplies to fix it?"
        </div>

        <a href="#sorry">Sorry, I'm busy</a><br>
        <a href="#help">Sure I can help</a>
    </div>

    <div id="sorry" class="step" data-x="0" data-y="-1500">

        <p>Text2</p>

        <a href="#more">Tell me more</a><br>
        <a href="#sleep">Go back to sleep</a>
    </div>

    <div id="oak" class="step" data-x="850" data-y="3000" data-z="1000" data-rotate="90">
        <a href="#sleep">Start over</a>
    </div>
--}}

</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card border-ilblue">

        </div>
    </div>
</div>

    <p>Toss in seashells for a chance to receive an item.</p>

    @if (Auth::user())
        <div class="row align-items-center">
            <div class="col-12">
                <!-- If user has not made a wish in the last 7 days or has never made a wish (does not exist in the wish table) -->
                @php $wishFound = false; @endphp
                @foreach ($wishingwell as $wish)
                    @if ($wish->user_id == auth()->user()->id)
                        @php $wishFound = true; @endphp
                        {!! Form::open(['url' => 'wishingwell/editwish/'.$wish->id]) !!}
                            @if ( now()->diffInDays($wish->last_wish, false) < -7 )
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                {!! Form::label('bi_donation', 'Seashells (ss): ') !!} {!! add_help('Select the amount of Seashells to toss into the well. This will remove the ss from your balance!' ) !!}
                                                <select id='amount' name='amount' class="form-control">
                                                    <option value='5'>5</option>
                                                    <option value='10'>10</option>
                                                    <option value='15'>15</option>
                                                    <option value='20'>20</option>
                                                    <option value='25'>25</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value='{!! auth()->user()->id !!}' />
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">
                                            Make Your Wish <i class="fad fa-star-shooting"></i>
                                        </button>
                                    </div>
                                </div>
                                @break
                            @else
                                <center>
                                    <p class="mt-4 mb-1">The well stands before you, silent and deep. Something tells you you won't be getting any more wishes for another few days...</p><br>
                                    <h4 class="text-muted"><i>{!! (7+(now()->diffInDays($wish->last_wish, false)) > 0) ? ('You can make your next wish in '.(7+(now()->diffInDays($wish->last_wish, false))).' days.') : ('You can make your next wish in '.gmdate('H \\h\\o\\u\\r\\s i \\m\\i\\n\\u\\t\\e\\s \\a\\n\\d s \\s\\e\\c\\o\\n\\d\\s', 86400-(now()->diffInSeconds($wish->last_wish))).'.') !!}</i></h4>
                                </center>
                                @break
                            @endif
                        {!! Form::close() !!}
                    @endif
                @endforeach
                @if ($wishFound == false)
                    {!! Form::open(['url' => 'wishingwell/createwish/']) !!}
                        <div class="container">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('bi_donation', 'Seashells (ss): ') !!} {!! add_help('Select the amount of Seashells to add to the well. Note: this will remove the ss from your balance!' ) !!}
                                        <select id='amount' name='amount' class="form-control">
                                            <option value='5'>5</option>
                                            <option value='10'>10</option>
                                            <option value='15'>15</option>
                                            <option value='20'>20</option>
                                            <option value='25'>25</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value='{!! auth()->user()->id !!}' />
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit">
                                    Make Your Wish <i class="fad fa-star-shooting"></i>
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                @endif
            </div>
    @else
        <center><div class="card mt-4" style="width: 50%">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-3">
                        <h2 class="text-muted"><i class="fas fa-exclamation-circle mr-3" style="font-size: 3.5vmax;"></i></h2>
                    </div>
                    <div class="col-9">
                        <h4 class="text-muted mt-2">You must be logged in to make a wish; please return to this page after logging in to make a wish.</h3>
                    </div>
                </div>
            </div>
        </div></center>
    @endif
{{--<div class="container mt-4">
    <div class="row align-items-center text-center mb-3">
        <div class="col-12">
            <hr>
            <h3>Recent Wishes...</h3>
        </div>
    </div>
    <div class="row align-items-center text-center">
        <div class="col-2">
            <h5>Date</h5>
        </div>
    </div>
    @if($wishingwell->count() == 0)
        <center><h5>No one has made any wishes yes... Perhaps you should try?</h5></center>
    @else
        @foreach($wishingwell->slice($wishingwell->count() - 10)->reverse() as $wish)
            <div class="row align-items-center text-center mb-3">
                <div class="col-2">
                    @php
                        $date = strtotime($wish->last_wish);
                        $formattedDate = date('M j, Y', $date);
                    @endphp
                    {!! $formattedDate !!}
                </div>

            </div>
        @endforeach
    @endif
</div>--}}

@if(Auth::check())
    <script>
        $(document).ready(function() {
            var user = {!! auth()->user()->toJson() !!};
            var id = user.id;

        });
    </script>
@endif


@endsection
