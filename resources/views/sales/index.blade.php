@extends('layouts.app')

@section('title') Site Sales @endsection

@section('sidebar')
    @include('sales._sidebar')
@endsection

@section('content')
<h1>Adoptables & Sales</h1>
    <p>These are characters designed by official guest artists which are available to buy with in-game currency or in-real-life money. <br>
    If looking for more characters and eggs to adopt visit the <a href="/adoptions">The Daycare</a> or if interested in designing your own character buy a MYO Slot from <a href="/shops/7">Slay's Concessions</a> or the <a href="/shops/products">MYO Slot Shop</a>.
    </p>
<div>
    {!! Form::open(['method' => 'GET', 'class' => '']) !!}
        <div class="form-inline justify-content-end">
            <div class="form-group ml-3 mb-3">
                {!! Form::text('title', Request::get('title'), ['class' => 'form-control', 'placeholder' => 'Name']) !!}
            </div>
            <div class="form-group ml-3 mb-3">
                {!! Form::select('is_open', ['1' => 'Open', '0' => 'Closed'], Request::get('is_open'), ['class' => 'form-control', 'placeholder' => 'Status']) !!}
            </div>

            <div class="form-group ml-3 mb-3">
                {!! Form::select('sort', [
                    'bump-reverse'    => 'Updated Newest',
                    'bump'            => 'Updated Oldest',
                    'newest'         => 'Created Newest',
                    'oldest'         => 'Created Oldest',
                    'alpha'          => 'Sort Alphabetically (A-Z)',
                    'alpha-reverse'  => 'Sort Alphabetically (Z-A)'
                ], Request::get('sort') ? : 'Updated Newest', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group ml-3 mb-3">
                {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>

@if(count($saleses))
    {!! $saleses->render() !!}
    @foreach($saleses as $sales)
        @include('sales._sales', ['sales' => $sales, 'page' => FALSE])
        <hr>
    @endforeach
    {!! $saleses->render() !!}
@else
    <div>No sales posts yet.</div>
@endif
@endsection
