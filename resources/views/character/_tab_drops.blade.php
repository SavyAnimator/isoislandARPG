<div class="row">

    @if ($drops->drops_available == 0)
        <div class="col-sm-12">
            <div class="text-center">
            {{ $character->fullName }} has no gifts for their companion at this time.
            <br>The next {{ isset($character->drops->dropData->data['drop_name']) ? strtolower($character->drops->dropData->data['drop_name']) : 'drop' }} will be available to collect {!! pretty_date($drops->next_day) !!}.
            </div>
        </div>
    @else

        <div class="col-sm-7">
            <div class="text-center">

                @if($drops->speciesItem || $drops->subtypeItem)

                    <br>
                    @if ($drops->drops_available > 0)
                        {{ $character->fullName }} has a gift for  <a href="{{ $parent->parent->url }}">{{ $parent->parent->fullName }}</a>!
                    @else
                        {{ $character->fullName }} has no gifts for <a href="{{ $parent->parent->url }}">{{ $parent->parent->fullName }}</a> at this time.
                    @endif
                    @if(isset($drops->dropData->cap) && $drops->dropData->cap > 0)
                        <br>The next {{ isset($character->drops->dropData->data['drop_name']) ? strtolower($character->drops->dropData->data['drop_name']) : 'drop' }} will be available to collect {!! pretty_date($drops->next_day) !!}.
                    @else
                        <br>The next {{ isset($character->drops->dropData->data['drop_name']) ? strtolower($character->drops->dropData->data['drop_name']) : 'drop' }} will be available to collect {!! pretty_date($drops->next_day) !!}.
                    @endif

                @endif

                @if(Auth::check() && Auth::user()->id == $character->user_id && $drops->drops_available > 0)
                {!! Form::open(['url' => 'character/'.$character->slug.'/drops']) !!}
                    {!! Form::submit('Collect '.(isset($character->drops->dropData->data['drop_name']) ? $character->drops->dropData->data['drop_name'] : 'Drop').($drops->drops_available > 1 ? 's' : ''), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
                @endif

            </div>
        </div>

        <div class="col-sm-5">
            <div class="text-center">

                    @if($drops->speciesItem || $drops->subtypeItem)
                    @if ($drops->drops_available > 0)
                        @if($drops->speciesItem)
                            <div class="col-md align-self-center">
                                @if($drops->speciesItem->has_image) <img width="40%" src="{{ $drops->speciesItem->imageUrl }}"><br/> @endif
                            </div>
                        @endif
                    @endif
                    @else
                        <p>{{ $character->fullName }} {{ isset($character->drops->dropData->data['drop_name']) ? 'doesn\'t produce any '.strtolower($character->drops->dropData->data['drop_name']).'s' : 'isn\'t eligible for any drops' }}.</p>
                    @endif

            </div>
        </div>
    @endif
</div>
