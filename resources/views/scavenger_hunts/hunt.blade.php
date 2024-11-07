@extends('layouts.app')

@section('title') Scavenger Hunt :: {{ $hunt->displayName }} @endsection

@section('content')
{{--{!! breadcrumbs(['Scavenger Hunts' => $hunt->url, $hunt->displayName => $hunt->url]) !!}--}}

<div class="row">
    <div class="col-sm">
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="mb-3">

            <div class="text-center">
                @if(isset($participantLog))
                    @foreach($logArray as $key => $found)
                        @if(isset($found))
                            <span class="px-2 mb-2">
                                {!! $hunt->targets[$key - 1]->displayItemShort !!}
                            </span>
                        @endif
                    @endforeach
                @endif

                <p>
                    You have found
                    @if(isset($participantLog))
                        {{$participantLog->targetsCount}}
                    @else
                        0
                    @endif
                    /{{ count($hunt->targets) }} targets!
                </p>
            </div>

            <div class="card mb-4">
                <div class="title"><a href="{{ $hunt->url }}"><h3>{{ $hunt->displayName }}</h3></a></div>
                <div class="card-body">
                @if($hunt->summary)
                    <i>{{ $hunt->summary }}</i>
                @endif
                <br><br>
                <small><div><strong>Start Time: </strong>{!! format_date($hunt->start_at) !!} ({{ $hunt->start_at->diffForHumans() }})</div>
                <div class="mb-2"><strong>End Time: </strong>{!! format_date($hunt->end_at) !!} ({{ $hunt->end_at->diffForHumans() }})</div></small>
                </div>
            </div>

            <div class="card">
                <div class="title"><h3>Clues</h3></div>
                <div class="card-body">
                    @if($hunt->clue)
                        <p>Here's a clue to get you started...</p>
                            <i>{{ $hunt->clue }}</i>
                    @else
                        <p>There doesn't seem to be a clue for this hunt. You're on your own!</p>
                    @endif

                    <hr/>

                    @if(isset($participantLog))
                        @foreach($logArray as $key => $found)
                            @if(isset($found))
                                @if(isset($hunt->targets[$key - 1]->description))
                                    <p>The <strong>{!! ($hunt->targets[$key - 1]->item) ? $hunt->targets[$key - 1]->item->name : 'Deleted Asset' !!}</strong> had this message for you:</p>
                                    <p>
                                        <i>{!! $hunt->targets[$key - 1]->description !!}</i>
                                    </p>
                                @endif
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm">
    </div>
</div>

@endsection
