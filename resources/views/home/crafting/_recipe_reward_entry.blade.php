
    @if(isset($reward['asset']->image_url))
        <img class="small-icon" width="10%" src="{{ $reward['asset']->image_url }}">
    @endif
    {{ $reward['quantity'] }}
<span>{!! $reward['asset']->displayName !!}</span><br>
