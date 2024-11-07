@extends('adoptions.layout')

@section('title') {{ $adoption->name }} @endsection

@section('content')
{{--{!! breadcrumbs([$adoption->name => $adoption->url]) !!}--}}

<h1>
    {{ $adoption->name }}
</h1>

<div class="text-center">
    <img src="{{ $adoption->adoptionImageUrl }}" />
    <p>{!! $adoption->parsed_description !!}</p>
</div>

@if(!count($stocks))
    <p>The Daycare is empty at this time.</p>
@else
    <div class="row">
        @foreach($stocks as $stock)
            <div style="padding-bottom:15px" class="col-md-3 col-6 profile-inventory-item">
                <div class="card p-3">
                    <h4 class="text-center"><a href="{{ $stock->character->url }}"> {!! $stock->character->displayname !!}</a></h4>
                    <h5 class="text-center"> (<a href="{{ $stock->character->image->species->url }}">{!! $stock->character->image->species->name !!}</a>)</h5>
                    <div class="text-center inventory-character" data-id="{{ $stock->character->id }}">
                        <div class="mb-1">
                            <a href="{{ $stock->character->url }}"><img src="{{ $stock->character->image->thumbnailUrl }}" class="img-thumbnail" /></a>
                        </div>
                        <strong>Adoption Fee:</strong>
                        <br>
                        @if($stock->currency->count() > 1)
                            <?php $currencies = []; // Create an empty array
                                foreach($stock->currency as $currency)
                                {
                                    $d1 = $currency->cost;
                                    $d2 = $currency->currency->name;
                                    $currencies[$currency->id] = ' ' . $d1 . ' ' . $d2; // Add a new value to your array
                                }
                                echo implode(" or", $currencies); // implode the full array and separate the values with "or"
                            ?>
                            <br>
                         @else
                            @foreach($stock->currency as $currency)
                                {!! $currency->cost !!}
                                {!! $currency->currency->name !!}
                                <br>
                            @endforeach
                        @endif

                        <a href="#" class="btn btn-primary m-2">
                            {{--@if($stock->use_character_bank == 1) <i class="fas fa-paw mr-1" data-toggle="tooltip" title="Can be purchased using Character Bank"></i>@endif--}}
                            <strong>Adopt Me!</strong>
                            {{--@if($stock->use_user_bank == 1) <i class="fas fa-user ml-1" data-toggle="tooltip" title="Can be purchased using User Bank"></i> @endif--}}
                        </a>
                    </div>
                </div>
            </div><br>
        @endforeach
    </div>
@endif
<br>
@if(Settings::get('is_surrenders_open') && Auth::check())
    <div class="text-right mb-2">
        <a href="{{ url('surrenders/new') }}" class="btn btn-dark">Donate a character to {{ $adoption->name }}?</a>
    </div>
@endif

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.inventory-character').on('click', function(e) {
            e.preventDefault();

            loadModal("{{ url('adoptions/'.$adoption->id) }}/" + $(this).data('id'), 'Purchase Character');
        });
    });
</script>
@endsection
