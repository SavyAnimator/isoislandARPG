@extends('user.layout')

@section('profile-title') {{ $user->name }}'s Critter Logs @endsection

@section('profile-content')
{{--{!! breadcrumbs(['Users' => 'users', $user->name => $user->url, 'Inventory' => $user->url . '/inventory', 'Logs' => $user->url.'/critter-logs']) !!}--}}

<h1>
    {!! $user->displayName !!}'s Critter Logs
</h1>

{!! $logs->render() !!}
<table class="table table-sm">
    <thead>
        <th>Sender</th>
        <th>Recipient</th>
        <th>Critter</th>
        <th>Log</th>
        <th>Date</th>
    </thead>
    <tbody>
        @foreach($logs as $log)
            @include('user._pet_log_row', ['log' => $log, 'user' => $user])
        @endforeach
    </tbody>
</table>
{!! $logs->render() !!}

@endsection
