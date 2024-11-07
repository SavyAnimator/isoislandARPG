
@if(!count($items))
@else
    @foreach($items as $key=>$item)
    <a href="{{ $item->url }}"><img class="img-responsive" style="width: 120px" src="{{ $item->imageUrl }}" data-toggle="tooltip" title="{{ $item->name }}" alt="{{ $item->name }}"/></a>
            <!--<p>{{ $item->name }}</p>-->
    @endforeach
@endif
