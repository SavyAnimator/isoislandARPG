@if(isset($featprompt) && $featprompt)


@if($featprompt->has_image)
<a href="{{ $featprompt->imageUrl }}" data-title="{{ $featprompt->name }}"><img class="img-responsive float-right" style="margin-left: 5px; width: 90px" src="{{ $featprompt->imageUrl }}" ></a>
@endif
<div align="center"><strong><a href="{{ $featprompt->url }}">{{ $featprompt->name }}</a></strong></div>
    {{--{{ $featprompt->summary }}--}}
    <div class="truncate-overfloww">
    {!! $featprompt->parsed_description !!}
    </div>
@else
<div align="center">
<p>There is no featured prompt at this time.</p>
</div>
@endif

