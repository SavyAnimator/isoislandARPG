@extends('layouts.app')

@section('content')
<!--{!! breadcrumbs(['me' => url('me') ]) !!}-->
    @if(Auth::check())
		@include('pages._dashboard')
    @else
        @include('pages._logged_out')
    @endif


@endsection
