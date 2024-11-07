<style>
        .featbadge {
            max-height:100px;
        }
</style>

@if($target->awards->where('is_featured',1)->where('pivot.count','>',0) && $count)
    <!--<div class="{{ $float ? 'float-md-right ml-md-4' : '' }}"><div class="row justify-content-center align-items-center">-->
        @foreach($target->awards->where('is_featured',1)->where('pivot.count','>',0)->unique()->take($count) as $award)
            <div class="text-center mb-1 px-1">
                <a href="{{$award->idUrl}}"><img src="{{ $award->imageUrl }}" alt="{{ $award->name }}" data-toggle="tooltip" data-title="{{ $award->name }}" class="featbadge"/></a>
                <br><br>
            </div>
        @endforeach
    <!--</div>-->
@endif
