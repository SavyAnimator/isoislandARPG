@extends('user.layout')

@section('profile-title') Character Donation (#{{ $surrender->id }}) @endsection

@section('profile-content')
{!! breadcrumbs(['Users' => 'users', $user->name => $user->url, 'OC Donation (#' . $surrender->id . ')' => $surrender->viewUrl]) !!}

@include('home._surrender_user_content', ['surrender' => $surrender])

@endsection
