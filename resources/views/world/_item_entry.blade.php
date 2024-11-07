<div class="row world-entry">
    @if($imageUrl)
        <div class="col-md-3 world-entry-image"><a href="{{ $idUrl }}"><img src="{{ $imageUrl }}" class="world-entry-image" alt="{{ $name }}"/></a></div>
    @endif
    <div class="{{ $idUrl ? 'col-md-9' : 'col-12' }}">
        <a href="{{ $idUrl }}"><h3>{{ $item->name }} @if(isset($idUrl) && $idUrl) @endif
            @if (Auth::check() && Auth::user()->isstaff)
                <div class="btn btn-sm">[{{ $item->id }}]</div>
            @endif
        </h3></a>
        <div class="world-entry-text">
            @if(isset($item->reference) && $item->reference && Config::get('lorekeeper.extensions.item_entry_expansion.extra_fields'))  <p><strong>Reference Link:</strong> <a href="{{ $item->reference }}">{{ $item->reference }}</a></p> @endif
            {!! $description !!}
            @if((isset($item->uses) && $item->uses || isset($item->source) && $item->source || $shops->count() || isset($item->data['prompts']) && $item->data['prompts']) && Config::get('lorekeeper.extensions.item_entry_expansion.extra_fields'))

            <div id="item-{{ $item->id }}">
                @if(isset($item->uses) && $item->uses)  <p><strong>Uses:</strong> {{ $item->uses }}</p> @endif
                @if(isset($item->source) && $item->source || $shops->count() || isset($item->data['prompts']) && $item->data['prompts'])
                    <div class="row">
                        @if(isset($item->source) && $item->source)
                            <div class="col">
                                <p><strong>Source:</strong></p>
                                <p>{!! $item->source !!}</p>
                            </div>
                        @endif
                        @if($shops->count())
                            <div class="col"><p><strong>Purchase At:</strong></p>
                                <div class="row">
                                    @foreach($shops as $shop)
                                            <div class="col"><a href="{{ $shop->url }}">{{ $shop->name }}</a></div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if(isset($item->data['prompts']) && $item->data['prompts'])
                            <div class="col">
                                <p><strong>Drops From:</strong></p>
                                    <div class="row">
                                        @foreach($item->prompts as $prompt) <div class="col"><a href="{{ $prompt->url }}">{{ $prompt->name }}</a></div> @endforeach
                                    </div>
                            </div>
                        @endif
                        @if(Config::get('lorekeeper.extensions.item_entry_expansion.extra_fields'))
                        {{--@if(isset($item->rarity) && $item->rarity)
                            <div class="col-md">
                                <p><strong>Rarity:</strong> {!! $item->rarity !!}</p>
                            </div>
                        @endif--}}

                        @endif
                        @if(isset($item->data['resell']) && $item->data['resell'] && App\Models\Currency\Currency::where('id', $item->resell->flip()->pop())->first() && Config::get('lorekeeper.extensions.item_entry_expansion.resale_function'))
                            <div class="col-md">
                                <p><strong>Sells For:</strong> {!! App\Models\Currency\Currency::find($item->resell->flip()->pop())->display($item->resell->pop()) !!}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md">
                        <div class="row" align="center">
                            @foreach($item->tags as $tag)
                                @if($tag->is_active)
                                <div class="col">
                                    {!! $tag->displayTag !!}
                                    @if($tag->tag == 'seed')
                                    @php $months = [
                                        '1' => 'January',
                                        '2' => 'February',
                                        '3' => 'March',
                                        '4' => 'April',
                                        '5' => 'May',
                                        '6' => 'June',
                                        '7' => 'July',
                                        '8' => 'August',
                                        '9' => 'September',
                                        '10' => 'October',
                                        '11' => 'November',
                                        '12' => 'December',
                                    ];
                                    @endphp
                                        @if($tag->data['start_month'] && $tag->data['end_month'])
                                        <small><span class="text-muted">Available to plant during ({!! $months[$tag->data['start_month']] !!} - {!! $months[$tag->data['end_month']] !!})</span></small>
                                        @endif
                                    @endif
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            @endif
            <div class="row">
                @if(isset($item->category) && $item->category)
                <div class="col-md">
                    <p><strong>Category:</strong> {!! $item->category->name !!}</p>
                </div>
                @endif
                @if(isset($item->itemArtist) && $item->itemArtist)
                <div class="col-md">
                    <p><strong>Artist:</strong> {!! $item->itemArtist !!}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
