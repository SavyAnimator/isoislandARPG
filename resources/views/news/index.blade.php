@extends('layouts.app')

@section('title') Island News & Updates @endsection

@section('sidebar')
    @include('news._sidebar')
@endsection

@section('content')
<h1>Island News & Updates</h1>
@if(count($newses))
    {!! $newses->render() !!}
    @foreach($newses as $news)
        @include('news._news', ['news' => $news, 'page' => FALSE])
    @endforeach
    {!! $newses->render() !!}
@else
    <div>No news posts yet.</div>
@endif
@endsection
