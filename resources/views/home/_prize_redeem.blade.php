@extends('home.layout')

@section('home-title') Redeem Code @endsection

@section('home-content')
{{--{!! breadcrumbs(['Code Redemption' => 'redeem-code']) !!}--}}

<h1>
Secrect Code Redemption
</h1>
<p> Stumbled upon a secret code? Redeem it here for currency, items, and other such prizes.</p>

<hr>
<br>
<div class="text-center">
{!! Form::open(['url' => 'redeem-code/redeem']) !!}
{!! Form::text('code') !!}
<br>
<br>
<div class="text-center">
    {!! Form::submit( 'Redeem', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}
</div>

<p align="center">
    If you have any problems redeeming a code please <a href="/reports/new">submit a report</a>.
</p>

{{--<div class="text-right mb-4">
    <a href="{{ url(Auth::user()->url.'/redeem-logs') }}">View logs...</a>
</div>--}}


@endsection


@section('scripts')
@endsection
