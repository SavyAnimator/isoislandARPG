@extends('shops.layout')

@section('shops-title') Donation Shop @endsection

@section('shops-content')
{{--{!! breadcrumbs(['Shops' => 'shops', 'Donation Shop' => 'shops/donation-shop']) !!}--}}

<h1>
    Darwin's Donations
</h1>

<div class="text-center">
    <img src="{{ asset('images/donation_shop.png') }}" style="max-width:100%" />
    <p>{!! $text->parsed_text !!}</p>

    @if(Auth::check() && Auth::user()->donationShopCooldown)
        You can collect an item {!! pretty_date(Auth::user()->donationShopCooldown) !!}!
    @endif
</div>

@foreach($items as $categoryId=>$categoryItems)
    <div class="card mb-2 inventory-category">
        <h4 class="title">
            {!! isset($categories[$categoryId]) ? '<a href="'.$categories[$categoryId]->searchUrl.'">'.$categories[$categoryId]->name.'</a>' : 'Miscellaneous' !!}
        </h4>
        <div class="card-body inventory-body">
            @foreach($categoryItems->chunk(6) as $chunk)
                <div class="row mb-2">
                    @foreach($chunk as $item)
                        <div class="col-sm-2 col-6 text-center inventory-item" data-id="{{ $item->id }}">
                            <div class="mb-1">
                                <a href="#" class="inventory-stack"><img src="{{ $item->item->imageUrl }}" /></a>
                            </div>
                            <div>
                                <a href="#" class="inventory-stack inventory-stack-name"><strong>{{ $item->item->name }}</strong></a>
                                <div>Stock: {{ $item->stock }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <br>
@endforeach

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.inventory-item').on('click', function(e) {
            e.preventDefault();

            loadModal("{{ url('shops/donation-shop') }}/" + $(this).data('id'), 'Collect Item');
        });
    });

</script>
@endsection
