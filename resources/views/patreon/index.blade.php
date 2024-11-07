@extends('user.layout')

@section('profile-title') {{ $user->name }}'s Profile @endsection

@section('meta-img') {{ asset('/images/avatars/'.$user->avatar) }} @endsection

@section('profile-content')
{!! breadcrumbs(['Users' => 'users', 'Patreon' => 'patreon', ]) !!}

<h1>Patreon</h1>

@if(!$patreon)
    <div class="text-center">
        <div class="alert alert-info"><h4>Your Patreon account is not currently linked.</h4></div>
        <a href="{{ $href }}" class="btn-info btn text-white">Link your Patreon!</a>
    </div>
@elseif($patreon && $patreon->access_token != null)
    @if($patreon->allow_login)<div class="alert alert-warning">The system detected a desync with your access tokens, please login again. You will not be able to claim rewards until you do so.</div>
    <a href="{{ $href }}" class="btn-dark btn text-white mb-3">Login to Patreon</a>
    @else<div class="alert alert-success">Your patreon account is currently linked.</div>
    @endif
    <div class="row">
        <div class="col-2">
        <h1>
            @if($patreon->avatar){!! $patreon->avatar !!}@endif
        </h1>
        </div>
        <div class="col-10">
            <div class="mb-1">
                <div class="row">
                    <div class="col-4"><h5>Joined:</h5></div>
                    <div class="col-6">{!! pretty_date($patreon->pledge_start) !!}
                        @if($patreon->last_refresh == NULL)
                        <a href="#" data-toggle="tooltip" title="Refresh" class="badge badge-success float-right refresh p-2"><i class="fas fa-sync-alt"></i></a>
                        @elseif(Carbon\Carbon::parse($patreon->last_refresh)->addDay() <= Carbon\Carbon::now())
                        <a href="#" data-toggle="tooltip" title="Refresh" class="badge badge-success float-right refresh p-2"><i class="fas fa-sync-alt"></i></a>
                        @else
                        <span class="badge badge-danger float-right p-2">You cannot refresh yet, can refresh in {!! pretty_date(Carbon\Carbon::parse($patreon->last_refresh)->addDay()) !!}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-4"><h5>Membership:</h5></div>
                    <div class="col-6">${!! number_format($patreon->membership/100, 2, '.', ' ') !!} Tier</div>
                </div>
                <div class="row">
                    <div class="col-4"><h5>Membership Status:</h5></div>
                    <div class="col-6">{!! $patreon->patron_status == 'active_patron' ? '<div class="text-success">Active</div>' : '<div class="text-danger">Inactive</div>' !!}</div>
                </div>
                <div class="row">
                    <div class="col-4"><h5>Paid?:</h5></div>
                    <div class="col-6">{!! $patreon->last_charge_status == 'Paid' ? '<div class="text-success">Yes</div>' : '<div class="text-danger">No</div>'!!}</div>
                </div>
                @if($patreon->last_charge_status !== 'Paid' && $patreon->checkIfDatePaid == false)
                <div class="alert alert-danger">You are currently not eligible for this month's rewards. If this is a mistake, please press the refresh. You may refresh once every 24 hours.</div>
                @endif
            </div>
        </div>
    </div>
    <hr class="width: 70%;">
    <div class="container text-center">
        <h4>{{ $month }} rewards:</h4>
        <p>Note that if you claim and then increase your tier you will not be able to claim the rewards you missed.</p>
        <div class="card">
            <div class="card-body text-center">
                <table class="table table-sm category-table">
                    <thead>
                        <tr>
                            <th>Reward</th>
                            <th>Quantity</th>
                            <th>Tier</th>
                            <th>Can Claim?</th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach($rewards as $reward)
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
                    <td>
                        @if($reward->tier && !$reward->lock_tier) 
                            @if($patreon->membership >= $reward->tier) <div class="text-success"><i class="fas fa-check"></i></div>
                            @else <div class="text-danger"><i class="fas fa-times"></i></div>
                            @endif
                        @elseif($reward->tier && $reward->lock_tier)
                            @if($patreon->membership == $reward->tier) <div class="text-success"><i class="fas fa-check"></i></div>
                            @else <div class="text-danger"><i class="fas fa-times"></i></div>
                            @endif                            
                        @else <div class="text-success"><i class="fas fa-check"></i></div> @endif
                    </td>
                </tr>
                @endforeach
            </table>
                @if($patreon->last_charge_status !== 'Paid' && $patreon->checkIfDatePaid == false || $patreon->allow_login)
                    <p class="text-danger">You cannot currently claim these rewards.</p>
                @elseif($patreon->has_claimed)
                    <p class="text-info">You have already claimed these rewards.</p>
                @else
                    {!! Form::open(['url' => 'patreon/claim']) !!}

                        {!! Form::button('Claim Rewards', array('class' => 'btn btn-primary', 'type' => 'submit')) !!}

                    {!! Form::close() !!}
                @endif
            </div>
        </div>

    </div>
@else
    <div class="text-center">
        <div class="alert alert-info"><h4>Your Patreon account is not currently linked correctly, please link again!</h4></div>
        <a href="{{ $href }}" class="btn-info btn text-white">Link your Patreon!</a>
    </div>
@endif
@endsection

@section('scripts')
@parent
<script>
$( document ).ready(function() {
    $('.refresh').on('click', function(e) {
        e.preventDefault();
        loadModal("{{ url('patreon/refresh') }}", 'Refresh Details?');
    });
});

</script>
@endsection