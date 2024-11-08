@extends('world.layout')

@section('title') Items @endsection

@section('content')
{{--{!! breadcrumbs(['Index' => 'world', 'Items' => 'world/items']) !!}--}}
<h1>Items</h1>

<div>
    {!! Form::open(['method' => 'GET', 'class' => '']) !!}
        <div class="form-inline justify-content-end">
            <div class="form-group ml-3 mb-3">
                {!! Form::text('name', Request::get('name'), ['class' => 'form-control', 'placeholder' => 'Name']) !!}
            </div>
            <div class="form-group ml-3 mb-3">
                {!! Form::select('item_category_id', $categories, Request::get('item_category_id'), ['class' => 'form-control']) !!}
            </div>
            @if(Config::get('lorekeeper.extensions.item_entry_expansion.extra_fields'))
                <div class="form-group ml-3 mb-3">
                    {!! Form::select('artist', $artists, Request::get('artist'), ['class' => 'form-control']) !!}
                </div>
            @endif
            <div class="form-group ml-3 mb-3">
                {!! Form::select('sort', [
                    'alpha'          => 'Sort Alphabetically (A-Z)',
                    'alpha-reverse'  => 'Sort Alphabetically (Z-A)',
                    'category'       => 'Sort by Category',
                    'newest'         => 'Newest First',
                    'oldest'         => 'Oldest First'
                ], Request::get('sort') ? : 'category', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group ml-3 mb-3">
                {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>

{!! $items->render() !!}
<div class="container-flex">
    <div class="row">
        @foreach($items as $item)
            <div class="col-xs-12 col-s-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                    <?php $shops = App\Models\Shop\Shop::whereIn('id', App\Models\Shop\ShopStock::where('stock_type', 'Item')->where('item_id', $item->id)->pluck('shop_id')->unique()->toArray())->orderBy('sort', 'DESC')->get(); ?>
                    <?php $prompts = App\Models\Prompt\Prompt::whereIn('id', App\Models\Prompt\PromptReward::where('rewardable_type', '=', 'Item')->where('rewardable_id', $item->id)->pluck('prompt_id')->toArray())->orderBy('id', 'DESC')->get(); ?>
                    @include('world._item_entry', ['idUrl' => $item->idUrl, 'imageUrl' => $item->imageUrl, 'name' => $item->displayName, 'description' => $item->parsed_description, 'idUrl' => $item->idUrl, 'shops' => $shops])
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
{!! $items->render() !!}
    <div class="text-center mt-4 small text-muted">{{ $items->total() }} result{{ $items->total() == 1 ? '' : 's' }} found.</div>
@endsection
