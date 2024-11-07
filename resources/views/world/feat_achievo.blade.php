
@if(!count($awards))
@else
    @foreach($awards as $key=>$award)
    <a href="{{ $award->url }}"><img class="img-responsive" style="width: 120px" src="{{ $award->imageUrl }}"/></a>
            <!--<p>{{ $award->name }}</p>-->
    @endforeach
@endif
