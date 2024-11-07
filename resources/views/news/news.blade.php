@extends('news.layout')

@section('news-title')
    {{ $news->title }}
@endsection

@section('sidebar')
    <ul>
        <li class="sidebar-header"><a href="{{ url('news') }}" class="card-link">Recent Posts</a></li>
        <li class="sidebar-section">
            <div class="sidebar-section-header">News & Updates</div>
            <div class="sidebar-item"><a href="{{ $news->url }}" class="{{ set_active('news/'.$news->id.'*') }}">{{ $news->title }}</a></div>
            <div class="dropdown-divider"></div>
            <div class="sidebar-item"><a href="{{ url('news') }}">All News</a></div>
    </ul>
@endsection

@section('news-content')
    {{--{!! breadcrumbs(['Site News' => 'news', $news->title => $news->url]) !!}--}}
    @include('news._news', ['news' => $news, 'page' => true])
    <hr class="mb-5" />

    @comments(['model' => $news, 'perPage' => 5])
@endsection
