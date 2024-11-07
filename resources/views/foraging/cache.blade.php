@extends('home.layout')

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

@section('home-title') Queen's Cache @endsection

@section('home-content')
<div class="text-center game">

    <h1>Queen's Cache</h1>
    <hr>

    <img width="80%" src="{{ asset('images/queenmem.png') }}">
    <br><br>
    <p class="mb-2">As she has come to be called by Isomara, the Queen is a large Memora who sleeps atop a pile of gathered goods. Her cache is an ever-growing pile built by other Memora of her pride. She seems to be asleep; do you dare risk waking her up in an attempt to pilfer an item from the pile?
    <br>Users have three (3) stamina a day which is shared between Queen's Cache and Tide Pools.</p>


    @if(Auth::user())
        <a href="/hunts/targets/fn0I9CF18f"><img style="transform:rotate(30deg); position: fixed; z-index: 4; bottom: 70%; left: 15%;" src="/images/data/items/221-image.png" alt="Spider" height="110" /></a>
    @else
    @endif

    <hr>

    <p>To avoid any issue, do not pilfer from the Queen's Cache while fishing from the Tide Pools. <br>Claim your reward before attempting to roll from the other, else stamina may be wasted, and rewards lost. </p>
    @if($user->foraging->foraged_at)
        <p>
            Last Pilfer: {!! pretty_date($user->foraging->foraged_at) !!}
            <br>
            Remaining Daily Stamina: {{ $user->foraging->stamina }}
        </p>
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

          var text = "Rummaging in progress, check back in " + minutes + ":" + seconds + " to see what you snagged!";
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

  <div id="time">Pilfering complete in {{ $diff < 1 ? 'less than a minute' : $diff }}</div>
  <p>Started {!! pretty_date($user->foraging->foraged_at)!!}
@elseif($user->foraging->distribute_at <= $now && $user->foraging->forage_id)
  {{-- When foraging is done and we can claim --}}
  <div class="container text-center">
      {!! Form::open(['url' => 'cache/claim' ]) !!}
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
      <p>The cache is gone! Come back later.</p>
  @else
  <div class="row text-center">
      @foreach($tables as $table)
        @if ($table->id == 6)
          <div class="col-md-4">
              {!! Form::open(['url' => 'cache/forage/'.$table->id ]) !!}

                  <img src="{{ $table->imageUrl }}" class="img-fluid mb-2"/>
                  {!! Form::submit('Pilfer from the ' . $table->display_name , ['class' => 'btn btn-primary m-2']) !!}

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
