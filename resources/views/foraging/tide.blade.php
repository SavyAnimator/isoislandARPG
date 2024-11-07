@extends('home.layout')

@section('home-title') Tide Pools @endsection

@section('sidebar')
    <ul>
        <li class="sidebar-header"><a href="{{ url(__('dailies.dailies')) }}" class="card-link">{{__('dailies.dailies')}}</a></li>

        <li class="sidebar-section">
            <div>
                <a class="dropdown-item" href="{{ url('sink-or-soar') }}">
                    Sink or Soar
                </a>
                <a class="dropdown-item" href="{{ url('cache') }}">
                    <i class="far fa-gem"></i>  Queen's Cache
                </a>
                <a class="dropdown-item" href="{{ url('pool') }}">
                    <i class="fas fa-fish"></i>  Tide Pools
                </a>
                <a class="dropdown-item" href="{{ url('pavilion') }}">
                    <i class="fas fa-lemon"></i>  NPC Fetch Quest
                </a>
            </div>
        </li>
    </ul>
@endsection

@section('home-content')

    <style>
    SkrillAnim {
      width: 100px;
      height: 100px;
      position: absolute;
      animation: mysecond 6s linear 0s infinite alternate;
      animation-timing-function: ease;
    }

    @keyframes mysecond {
      0%   { left:15px; bottom:50px; opacity: 1; transform: rotate( 0deg ) scale(1);}
      100% { left:1200px; bottom:50px; opacity: 1;transform: rotate( 720deg ) scale(1);}
    }
    </style>

@if(Auth::user())
<SkrillAnim>
<a href="https://isomara-island.com/hunts/targets/9RO7autoB9"><img src="{{ asset('images/hunts/skrill.png') }}" height="50"/></a>
</SkrillAnim>
@endif

<div class="text-center game">

    <h1>Tide Pools</h1>
    <hr>

    <img width="80%" src="{{ asset('images/tidepool.png') }}">
<br><br>
<p class="mb-2">"Aye, your companions will need to go and fish for you. We got to keep the fish numbers high," states Aycorn. The water in the pools and the surrounding ocean has returned to its normal color. The tide pools that formed earlier have remained filled with an abundance of skrill and other sea creatures. Send out your companions to gather resources daily.
    <br> Users have three(3) stamina a day which is shared between Queen's Cache and Tide Pools.</p>

<hr>
    <p>To avoid any issue, do not fish from the Tide Pool while pilfering from the Queen's Cache. <br>Claim your reward before attempting to roll from the other, else stamina may be wasted, and rewards lost. </p>
    @if($user->foraging->foraged_at)
        <p>
            Last Cast: {!! pretty_date($user->foraging->foraged_at) !!}
            <br>
            Remaining Daily Stamina: {{ $user->foraging->stamina }}
        </p>
    @endif

    @if(Config::get('lorekeeper.foraging.use_characters') && !$user->foraging->distribute_at)
    <div class="col-md-6 justify-content-center text-center">
        <h3>Current Character</h3>
        @if (!$user->foraging->character)
            <p>No character selected!</p>
        @else
            <div>
                <a href="{{ $user->foraging->character->url }}">
                    <img src="{{ $user->foraging->character->image->thumbnailUrl }}" style="width: 150px;" class="img-thumbnail" />
                </a>
            </div>
            <div class="mt-1">
                <a href="{{ $user->foraging->character->url }}" class="h5 mb-0">
                    @if (!$user->foraging->character->is_visible)
                        <i class="fas fa-eye-slash"></i>
                    @endif {{ $user->foraging->character->fullName }}
                </a>
            </div>
        @endif
        {!! Form::open(['url' => 'foraging/edit/character']) !!}
            {!! Form::select('character_id', $characters, $user->foraging->character_id, ['class' => 'form-control m-1', 'placeholder' => 'None Selected']) !!}
            {!! Form::submit('Select Character', ['class' => 'btn btn-primary mb-2']) !!}
        {!! Form::close() !!}
    </div>
    @endif

    @php
        // getting a php static var for safari because it sucks
        $now = Carbon\Carbon::now();
        $diff = $now->diffInMinutes($user->foraging->distribute_at, false);
        $left = $now->diffInHours($user->foraging->reset_at, false);
    @endphp

<script>
  // this is ugly up here and i hate it but it wont work otherwise
  let now = new Date("<?php echo date('Y-m-d H:i:s'); ?>");
  function timeCount(timer) {
      // timer = carbon time
      setInterval(function() {
          var date = new Date(timer);
          getServerTime();
          // count down time difference between now and date
          var diff = date.getTime() - now.getTime();
          var time = new Date(diff);

          var seconds = time.getUTCSeconds();
          if(seconds < 10) seconds = "0" + seconds;

          var minutes = time.getUTCMinutes();
          if(minutes < 10) minutes = "0" + minutes;

          if(seconds == '00' && minutes == '00') {
              // reload page
              location.reload();
          }

          var text = "Fishing in progress, check back in " + seconds + " to see what your companions caught.";
          $("#time").text(text);
      }, 1000);
  }
  function getServerTime()
  {
      // ajax get call to get the time
      $.ajax({
          url: '{{ url("time") }}',
          type: 'GET',
          success: function(data) {
              // update the time
              now = new Date(data);
          }
      });
  }
</script>

@if($user->foraging->distribute_at && $user->foraging->distribute_at > $now)
  {{-- Whilst foraging is in progress--}}
  <script>
      // we have to check for safari since it doesn't agree with formatted times
      const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
      var timeLeft = Date.parse("<?php echo $user->foraging->distribute_at ?>");
      // if not safari, set off the loop!
      if(!isSafari) setInterval(timeCount(timeLeft), 1000);
  </script>

        @if (Config::get('lorekeeper.foraging.use_characters') && $user->foraging->character)
            <div class="mb-1">
                <a href="{{ $user->foraging->character->url }}">
                    <img src="{{ $user->foraging->character->image->thumbnailUrl }}" style="width: 150px;" class="img-thumbnail" />
                </a>
            </div>
        @endif

  <div id="time">Fishin up catch in {{ $diff < 1 ? 'less than a minute' : $diff }}</div>
  <p>Started {!! pretty_date($user->foraging->foraged_at)!!}
@elseif($user->foraging->distribute_at <= $now && $user->foraging->forage_id)
  {{-- When foraging is done and we can claim --}}
  <div class="container text-center">
    @if (Config::get('lorekeeper.foraging.use_characters') && $user->foraging->character)
        <a href="{{ $user->foraging->character->url }}">
            <img src="{{ $user->foraging->character->image->thumbnailUrl }}" style="width: 150px;" class="img-thumbnail" />
        </a>
    @endif
    {!! Form::open(['url' => 'pool/claim' ]) !!}
          <img src="{{ $user->foraging->forage->imageUrl }}" class="mb-2" style="max-width: 30%;"/>
          <br>
          {!! $user->foraging->forage->fancyDisplayName !!}
          <br>
          {!! Form::submit('Claim Reward' , ['class' => 'btn btn-primary m-2']) !!}
    {!! Form::close() !!}

  </div>
  @elseif($user->foraging->stamina > 0)
  {{-- Base State --}}
  @if(!count($tables))
      <p>The pools have dried up! Come back later.</p>
  @else
  <div class="row text-center">
      @foreach($tables as $table)
        @if ($table->id == 7)
          <div class="col-md-4">
              {!! Form::open(['url' => 'pool/forage/'.$table->id ]) !!}

                  <img src="{{ $table->imageUrl }}" class="img-fluid mb-2"/>
                  {!! Form::submit('Cast out into the ' . $table->display_name , ['class' => 'btn btn-primary m-2']) !!}

              {!! Form::close() !!}
          </div>
        @endif
      @endforeach
  </div>
  @endif
@else
  <div class="alert alert-info">
    You've used all your stamina today. Come back tomorrow.
  </div>
</div>
@endif
@endsection
