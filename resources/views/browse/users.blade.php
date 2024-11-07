@extends('layouts.app')

@section('title') Users @endsection

@section('content')

<h1>
    Players List
    @if($blacklistLink)
        <a href="{{ url('blacklist') }}" class="btn btn-dark float-right">Blacklist</a>
    @endif
</h1>

{!! Form::open(['method' => 'GET', 'class' => 'form-inline justify-content-end']) !!}
    <div class="form-group mr-3 mb-3">
        {!! Form::text('name', Request::get('name'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group mr-3 mb-3">
        {!! Form::select('rank_id', $ranks, Request::get('rank_id'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group mr-3 mb-3">
        {!! Form::select('sort', [
        'alpha'          => 'Sort Alphabetically (A-Z)',
        'alpha-reverse'  => 'Sort Alphabetically (Z-A)',
        'alias'          => 'Sort by Alias (A-Z)',
        'alias-reverse'  => 'Sort by Alias (Z-A)',
        'rank'           => 'Sort by Rank (Default)',
        'newest'         => 'Newest First',
        'oldest'         => 'Oldest First'
        ], Request::get('sort') ? : 'category', ['class' => 'form-control']) !!}
    </div>
    <div class="form-group mb-3">
        {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

{!! $users->render() !!}
<div class="row ml-md-2">
    <div class="d-flex row flex-wrap col-12 pb-1 px-0 ubt-bottom">
        <div class="col-3 col-md-3 font-weight-bold">Username</div>
        <div class="col-4 col-md-3 font-weight-bold">Primary Alias</div>
        <div class="col-3 col-md-1 font-weight-bold">Rank</div>
        <div class="col-5 col-md-3 font-weight-bold">Joined</div>
        <div class="col-4 col-md-2 font-weight-bold">Last Seen</div>
    </div>
    @foreach($users as $user)
        <div class="d-flex row flex-wrap col-12 mt-1 pt-1 px-0 ubt-top">
            <div class="col-3 col-md-3 ">
                @if (($user->settings->online_setting) == 1)
                    {!! $user->isOnline() !!}
                @else
                    <i class="fas fa-circle text-secondary mr-2" data-toggle="tooltip" title="This user is invisible."></i>
                @endif
                <a href="{{ $user->url }}"><img src="/images/avatars/{{ $user->avatar }}" style="width:18px; height:18px; border-radius:50%; margin-bottom:3px;margin-right:5px;"></a> {!! $user->displayName !!}
            </div>
            <div class="col-4 col-md-3">{!! $user->displayAlias !!}</div>
            <div class="col-3 col-md-1">{!! $user->rank->displayName !!}</div>
            <div class="col-5 col-md-3">{!! pretty_date($user->created_at, false) !!}</div>
            <div class="col-4 col-md-2">
                @if (($user->settings->online_setting) == 1)
                {{ isset($user->last_seen) ? Carbon\Carbon::parse($user->last_seen)->diffForHumans() : '-' }}
                @else
                    Unknown
                @endif
            </div>
        </div>
    @endforeach
</div>
{!! $users->render() !!}

    <div class="text-center mt-4 small text-muted">{{ $users->total() }} result{{ $users->total() == 1 ? '' : 's' }} found.</div>

@endsection
