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

@section('home-title') Hallows Carnival - Apple Bobbing @endsection

@section('home-content')

<h1>Apple Bobbing</h1>
    @if(Auth::user())
        <a href="https://isomara-island.com/hunts/targets/x4JSzVhOe7">
            <img style="position: absolute; top: 55%; left: 80%;" src="{{ asset('images/hunts/StrawDai.png') }}" height="30"/>
        </a>
    @else
    @endif
<hr>
{{--<p align="center"> Apple Bobbing is not available this time of year!</p>--}}
<img class="float-right" width="30%" src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/62058ebb-e52e-4397-abcd-af54f0d37418/des5nbd-e6f93a50-e73b-473d-952c-48d74a888398.png/v1/fill/w_1280,h_1389,q_80,strp/apple_munch_munch_by_slayersstronghold_des5nbd-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTM4OSIsInBhdGgiOiJcL2ZcLzYyMDU4ZWJiLWU1MmUtNDM5Ny1hYmNkLWFmNTRmMGQzNzQxOFwvZGVzNW5iZC1lNmY5M2E1MC1lNzNiLTQ3M2QtOTUyYy00OGQ3NGE4ODgzOTgucG5nIiwid2lkdGgiOiI8PTEyODAifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ._ovylMHt9yJYskYTKasz5TL9PTARQUDHq6keBaNaRCk">
<br><br>
<p class="mb-2">Try your skill at bobbing for apples. Depending on the color of apple you pull you'll receive 1-3 mochi (currency) or apples in return.</p>
<br>
<p class="mb-2">Spend your mochi at the <a href="https://isomara-island.com/shops/9">Treat Trade-In shop</a> or <a href="https://isomara-island.com/shops/10">Tricky Treasures Shop</a></p>
<p class="mb-2">Return to the <a href="https://isomara-island.com/carnival">carnival game hub</a></p>
<br>
<hr>
<br>
<div align="center">
    <p>To avoid any issue, do not bob for apples while casting from the Tide Pool or pilfering from the Queen's Cache. <br>Claim your reward before attempting to roll from the others, else stamina may be wasted, and rewards lost. </p>
    @if($user->foraging->foraged_at)
        <p>
            Last Bobbed: {!! pretty_date($user->foraging->foraged_at) !!}
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

          var text = "You plunge your head into the water. You have " + seconds + " to grab a reward.";
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

  <script>
      // we have to check for safari since it doesn't agree with formatted times
      const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
      var timeLeft = Date.parse("<?php echo $user->foraging->distribute_at ?>");
      // if not safari, set off the loop!
      if(!isSafari) setInterval(timeCount(timeLeft), 1000);
  </script>

  <div id="time">Fishin up catch in {{ $diff < 1 ? 'less than a minute' : $diff }}</div>
  <p>Started {!! pretty_date($user->foraging->foraged_at)!!}
@elseif($user->foraging->distribute_at <= $now && $user->foraging->forage_id)

  <div class="container text-center">
      {!! Form::open(['url' => 'pool/claim' ]) !!}
          <img src="{{ $user->foraging->forage->imageUrl }}" class="mb-2" style="max-width: 30%;"/>
          <br>
          {!! $user->foraging->forage->fancyDisplayName !!}
          <br>
          {!! Form::submit('Claim Reward' , ['class' => 'btn btn-primary m-2']) !!}
      {!! Form::close() !!}
  </div>
@elseif($user->foraging->stamina > 0)

  @if(!count($tables))
      <p>We are all out of apples! Come back later.</p>
  @else
  <div class="row text-center">
      @foreach($tables as $table)
        @if ($table->id == 8)
          <div class="col-md-4">
            <i>The carnival is closed this time of year!</i>
            {{--
            {!! Form::open(['url' => 'apple/forage/'.$table->id ]) !!}

                  <img src="{{ $table->imageUrl }}" class="img-fluid mb-2"/>
                  {!! Form::submit('Try ' . $table->display_name , ['class' => 'btn btn-primary m-2']) !!}

              {!! Form::close() !!}
              --}}
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
