<div class="text-center">
    <p>You pick up a pebble with the numeric sigil: <strong>{{ $number }}</strong></p>

        @switch ($number)
            @case(2)
                <img width="15%" src="{{ asset('images/games/peb2.png') }}">
                @break
            @case(3)
                <img width="15%" src="{{ asset('images/games/peb3.png') }}">
                @break
            @case(4)
                <img width="15%" src="{{ asset('images/games/peb4.png') }}">
                @break
            @case(5)
                <img width="15%" src="{{ asset('images/games/peb5.png') }}">
                @break
            @case(6)
                <img width="15%" src="{{ asset('images/games/peb6.png') }}">
                @break
            @case(7)
                <img width="15%" src="{{ asset('images/games/peb7.png') }}">
                @break
            @case(8)
                <img width="15%" src="{{ asset('images/games/peb8.png') }}">
                @break
            @case(9)
                <img width="15%" src="{{ asset('images/games/peb9.png') }}">
                @break
            @case(10)
                <img width="15%" src="{{ asset('images/games/peb10.png') }}">
                @break
            @case(11)
                <img width="15%" src="{{ asset('images/games/peb11.png') }}">
                @break
            @case(12)
                <img width="15%" src="{{ asset('images/games/peb12.png') }}">
                @break
            @case(13)
                <img width="15%" src="{{ asset('images/games/peb13.png') }}">
                @break
            @case(14)
                <img width="15%" src="{{ asset('images/games/peb14.png') }}">
                @break
            @default
                <img width="15%" src="{{ asset('images/games/peb14.png') }}">
        @endswitch

    <br>
    <p>Aycorn then draws a pebble. What is your guess? Is his pebble <strong>soaring</strong> or
        <strong>sinking</strong>? <i class="fas fa-question-circle" data-toggle="tooltip" title="Reminder Aycorn's pebble can be any number from 1 through 15." style="opacity: 50%;"></i>
    </p>
    {!! Form::open(['url' => 'sink-or-soar/play/guess']) !!}
    {!! Form::hidden('number', $number) !!}
    {!! Form::hidden('guess', 'soar') !!}
    <div class="form-group">
        {!! Form::submit('Soar!', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

    {!! Form::open(['url' => 'sink-or-soar/play/guess']) !!}
    {!! Form::hidden('number', $number) !!}
    {!! Form::hidden('guess', 'sink') !!}
    <div class="form-group">
        {!! Form::submit('Sink!', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
