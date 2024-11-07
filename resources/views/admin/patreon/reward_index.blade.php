@extends('admin.layout')

@section('admin-title') Rewards @endsection

@section('admin-content')
{!! breadcrumbs(['Admin Panel' => 'admin', 'Rewards' => 'admin/patreon/rewards']) !!}

<h1>Rewards</h1>

<h4>Current month: {{ Carbon\Carbon::now()->format('F') }}</h4>
<p>You can edit rewards by what month they are in.</p>

<div class="text-right mb-3">
    <a class="btn btn-primary" href="{{ url('admin/patreon/rewards/create') }}"><i class="fas fa-plus"></i> Create New Rewards</a>
</div>

<h4>This month's rewards:</h4>
@if(!count($rewardsNow))
    <p>No rewards found.</p>
@else
    <div class="card" style="width:25%">
        <div class="card-body text-center">
            <h5>{{ Carbon\Carbon::now()->format('F') }} Rewards</h5>
            <table class="table table-sm category-table">
                <thead>
                    <tr>
                        <th>Reward</th>
                        <th>Quantity</th>
                        <th>Tier</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($rewardsNow as $reward)
            <tr>
                <td>
                    {!! $reward->reward->displayName !!}
                </td>
                <td>
                    {!! $reward->quantity !!}
                </td>
                <td>
                    @if($reward->tier) ${!! number_format($reward->tier/100, 2, '.', ' ') !!} Tier @else All Tiers @endif
                </td>
            </tr>
            @endforeach
        </table>
        <a class="btn btn-primary" href="{{ url('admin/patreon/rewards/edit/'. Carbon\Carbon::now()->month) }}">Edit {{ Carbon\Carbon::now()->format('F') }}'s rewards</a>
        </div>
    </div>
@endif
<hr>
<h5>All rewards:</h5>
@if(!count($rewards))
    <p>No rewards found.</p>
@else
<div class="row">
    @foreach($rewards as $key => $group)
    <div class="card m-1" style="width:25%">
        <div class="card-body text-center">
            <h5>{{ Carbon\Carbon::create()->month($key)->format('F') }} Rewards</h5>
            <table class="table table-sm category-table">
                <thead>
                    <tr>
                        <th>Reward</th>
                        <th>Quantity</th>
                        <th>Tier</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($group as $reward)
            <tr>
                <td>
                    {!! $reward->reward->displayName !!}
                </td>
                <td>
                    {!! $reward->quantity !!}
                </td>
                <td>
                    @if($reward->tier) ${!! number_format($reward->tier/100, 2, '.', ' ') !!} Tier @else All Tiers @endif
                </td>
            </tr>
            @endforeach
        </table>
        <a class="btn btn-primary" href="{{ url('admin/patreon/rewards/edit/'. $key) }}">Edit {{ Carbon\Carbon::create()->month($key)->format('F') }}'s rewards</a>
        </div>
    </div>
    @endforeach
</div>
@endif
<hr>
<h2>Creator Details</h2>
{!! Form::open(['url' => 'admin/patreon/creator']) !!}
<p>Only update if the refresh hasn't occurred.</p>
<p>Last refresh: @if($creator && isset($creator->last_refresh)) {!! pretty_date($creator->last_refresh) !!}@else No Data @endif</p>
<p>These fields are optional, press button for automatic refresh. <span class="text-danger">If you want to manually update you must input both fields</span></p>
{!! Form::text('access', null, ['class' => 'form-control m-1', 'placeholder' => 'Access Token']) !!}
{!! Form::text('refresh', null, ['class' => 'form-control m-1', 'placeholder' => 'Refresh Token']) !!}

<div class="text-right">
    {!! Form::submit('Post', ['class' => 'btn btn-primary mb-2']) !!}
</div>

{!! Form::close() !!}
@endsection

@section('scripts')
@parent
@endsection
