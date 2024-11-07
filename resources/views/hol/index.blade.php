@extends('home.layout')

@section('home-title') Sink or Soar @endsection

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
    <div class="text-center game">

        <h1>Sink or Soar</h1>
        <hr>
        <img width="80%" src="{{ asset('images/games/sinkorsoar.png') }}">
        <br><br>
        <p class="mb-2"> Draw a numbered pebble from this bowl. They range from 2 to 14. I will also draw one, but from a different bowl of 1 to 15. <br>Then you will need to guess whether the pebble I have will be smaller (sink) or larger (soar) than the number on your pebble.</p>
        <p>Got it kid? It's your job to guess whether you think
            my pebble is <strong>soaring</strong> or <strong>sinking</strong> compared to the pebble you picked up. <br>Win, and I'll give you a few seashells.</p>

        @if(Auth::check())
            @if ($user->settings->hol_plays != 0)
                <a href="#" class="btn btn-primary play-hol"><i class="fas fa-gamepad"></i> Play!</a>
                <p class="text-right"> You have <strong>{{ $user->settings->hol_plays }}</strong> plays left today. </p>
            @else
                <div class="alert alert-danger text-center">
                    Aycorn wants to rest. Come back tomorrow to play again.
                </div>
            @endif
        @else
        <p>You need to be <a href="/login">logged in</a> to play this game.</p>
        @endif
    </div>
    <script>
        $(document).ready(function() {
            $('.play-hol').on('click', function(e) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('sink-or-soar/play') }}",
                }).done(function(res) {
                    $(".game").fadeOut(490, function() {
                        $(".game").html(res);
                        $(".game").fadeIn(490);
                    });
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    alert("AJAX call failed: " + textStatus + ", " + errorThrown);
                });
            });
        });
    </script>
@endsection
