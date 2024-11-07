@extends('shops.layout')

@section('shops-title') {{ $shop->name }} @endsection

@section('shops-content')
{{--{!! breadcrumbs(['Shops' => 'shops', $shop->name => $shop->url]) !!}--}}

<h1>
    {{ $shop->name }}
</h1>

<div class="text-center">
    <img src="{{ $shop->shopImageUrl }}" style="max-width:75%" alt="{{ $shop->name }}" />
    <p>{!! $shop->parsed_description !!}</p>
</div>

@if($shop->use_coupons)
    <div class="col-6 alert alert-success">This shop accepts the following coupons: @foreach($shop->allAllowedCoupons as $coupon) {!! $coupon->displayName !!}{{$loop->last ? '' : ', '}} @endforeach</div>
    {{--@if($shop->allowed_coupons && count(json_decode($shop->allowed_coupons, 1)))
        <div class="alert alert-info">You can use the following coupons: @foreach($shop->allAllowedCoupons as $coupon) {!! $coupon->displayName !!}{{$loop->last ? '' : ', '}} @endforeach</div>
    @endif--}}
@endif

@foreach($stocks as $type => $stock)
    @if(count($stock)){{--<h3>{{ $type }}</h3>--}}@endif
        @if(Settings::get('shop_type'))
            @include('shops._tab', ['items' => $stock, 'shop' => $shop])
        @else
        @foreach($stock as $categoryId=>$categoryItems)
            <div class="card mb-2 inventory-category">
                <h4 class="title">
                    {!! isset($categoryItems->first()->category) ? '<a href="'.$categoryItems->first()->category->searchUrl.'">'.$categoryItems->first()->category->name.'</a>' : 'Miscellaneous' !!}
                </h4>
                <div class="card-body inventory-body">
                    @foreach($categoryItems->chunk(6) as $chunk)
                        <div class="row mb-2">
                            @foreach($chunk as $item)
                                <div class="col-sm-2 col-6 text-center inventory-item" data-id="{{ $item->pivot->id }}">
                                    <div class="mb-1">
                                        <a href="#" class="inventory-stack"><img src="{{ $item->imageUrl }}" style="max-width:75%" alt="{{ $item->name }}" /></a>
                                    </div>
                                    <div>
                                        <a href="#" class="inventory-stack inventory-stack-name"><strong>{{ $item->name }}</strong></a>
                                        <div><strong>Price: </strong> {!! $currencies[$item->pivot->currency_id]->display((int)$item->pivot->cost) !!}</div>
                                        @if($item->pivot->is_limited_stock) <div>Stock: {{ $item->pivot->quantity }}</div> @endif
                                        @if($item->pivot->purchase_limit) <div class="text-danger">Max {{ $item->pivot->purchase_limit }} @if($item->pivot->purchase_limit_timeframe !== 'lifetime') {{ $item->pivot->purchase_limit_timeframe }} @endif per user</div> @endif
                                        @if($item->pivot->disallow_transfer) <div class="text-danger">Cannot be transferred after purchase</div> @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <br>
        @endforeach
    @endif
@endforeach
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.inventory-item').on('click', function(e) {
            e.preventDefault();

            loadModal("{{ url('shops/'.$shop->id) }}/" + $(this).data('id'), 'Purchase Item');
        });
    });

</script>
@endsection
