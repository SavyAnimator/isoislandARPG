@extends('sales.layout')

@section('sales-title')
    {{ $sales->title }}
@endsection

@section('sidebar')
    <ul>
        <li class="sidebar-header"><a href="{{ url('sales') }}" class="card-link">Recent Posts</a></li>
        <li class="sidebar-section">
            <div class="sidebar-section-header">Adopts & Sales</div>
            <div class="sidebar-item"><a href="{{ $sales->url }}" class="{{ set_active('sales/'.$sales->id.'*') }}">{{ $sales->title }}</a></div>
            <div class="dropdown-divider"></div>
            <div class="sidebar-item"><a href="{{ url('sales?title=&is_open=1&sort=bump-reverse') }}">Open Adoptables</a></div>
            <div class="sidebar-item"><a href="{{ url('sales') }}">All Adoptables</a></div>
    </ul>
@endsection

@section('sales-content')
    {{--{!! breadcrumbs(['Site Sales' => 'sales', $sales->title => $sales->url]) !!}--}}
    @include('sales._sales', ['sales' => $sales, 'page' => true])

    @if ((isset($sales->comments_open_at) && $sales->comments_open_at < Carbon\Carbon::now()) || (Auth::check() && Auth::user()->hasPower('edit_pages')) || !isset($sales->comments_open_at))
        <hr class="mb-5" />
        @comments(['model' => $sales, 'perPage' => 5])
    @else
        <div class="alert alert-warning text-center">
            <p>Comments for this sale aren't open yet! They will open {!! pretty_date($sales->comments_open_at) !!}.</p>
        </div>
    @endif
@endsection
