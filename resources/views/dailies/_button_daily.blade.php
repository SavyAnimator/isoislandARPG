<script>

function toggle() {
    for (var elem of document.getElementsByClassName("demo"))
    elem.classList.toggle("hidden");
}
</script>
<style>

.hidden {
    display: none;
}
.card {
    padding: 18px;
}
</style>

<div class="text-center">
    @if($daily->has_image)
    <img src="{{ $daily->dailyImageUrl }}" style="max-width:100%" alt="{{ $daily->name }}" />
    @endif
    <p>{!! $daily->parsed_description !!}</p>
</div>

@if(Auth::user())
    @if($daily->has_button_image)
    <div class="row justify-content-center mt-2">
        <form action="" method="post">
            @csrf
            <button class="btn" style="background-color:transparent;" name="daily_id" value="{{ $daily->id }}" @if($isDisabled) disabled @endif>
                <img src="{{ $daily->buttonImageUrl }}" class="w-100" style="max-width:200px;" />
            </button>
        </form>
    </div>
    @else
    <div class="row justify-content-center mt-2">
        <form action="" method="post">
            @csrf
            <button class="btn btn-primary" name="daily_id" value="{{ $daily->id }}" @if($isDisabled) disabled @endif>Collect Reward!</button>
        </form>
    </div>
    @endif
    <div class="text-center">
        <small>
            @if($daily->daily_timeframe == 'lifetime')
            {{--You will be able to collect rewards once.--}}
            @else
            {{--You will be able to collect rewards {!! $daily->daily_timeframe !!}.--}}
            @endif
            @if(Auth::check() && isset($cooldown))
            Come back in {!! pretty_date($cooldown) !!} to collect the next daily reward.
            @endif
        </small>
    </div>
    <hr>
@else
    <div class="row mt-2 mb-2 justify-content-center">
        <div class="alert alert-danger" role="alert">
            You must be logged in to collect {{ __('dailies.dailies') }}!
        </div>
    </div>
@endif

@if($daily->progress_display != 'none')
<div class="card mt-5">
    <div  class="title">
        <h3 class="align-items-center">Daily Login Progress ({{$timer->step ?? 0}}/{{$daily->maxStep}}) {{--{!! add_help(($daily->is_streak) ? 'Progress will reset if you miss collecting your reward in the given timeframe.' : 'Progress is safe even if you miss collecting your reward in the given timeframe.') !!}--}}</h3>
    </div>
    <div class="card-body row p-0 m-auto w-100">
        @foreach($daily->rewards()->get()->groupBy('step') as $step => $rewards)
        @if($step > 0)
            <div class="col-lg-2 col-5 w-100 {{ ($step > ($timer->step ?? 0)) ? '' : '' }} text-center justify-content-center border p-0">
                <div class="row w-100 p-1 m-auto {{ ($step <= ($timer->step ?? 0)) ? 'text-light border' : 'text-light border' }}">
                    <div class="col-lg col-5 h-100">
                        <h5 class="p-1 m-0">Day {{ $step }}</h5>
                        <h5 class="p-1 m-0">
                            @if($step > ($timer->step ?? 0))<i class="fa fa-lock"></i>
                            @else <i class="fa fa-unlock"></i> Claimed
                            @endif
                        </h5>
                    </div>
                </div>
                <div class="row w-100 p-0 m-auto">
                    @if($daily->progress_display =='all' || ($step <= ($timer->step ?? 0)))
                        @foreach($rewards as $reward)
                        <div class="col-5">
                            <br>
                            @if($reward->rewardImage)
                                <div class="row justify-content-center">
                                    <img src="{{ $reward->rewardImage }}" alt="{{ $reward->reward()->first()->name }}" style="max-width:75px;width:100%;" />
                                </div>
                            @endif
                            <div class="row justify-content-center">{{$reward->quantity}} {{$reward->reward()->first()->name}}</div>
                        </div>
                        @endforeach
                    @else
                        <div class="col-4"></div>
                        <div class="col-4">
                            <h1 onclick="toggle()" style="margin-top:35px" class="align-center">
                                {!! add_help( 'Keep collecting rewards daily to find out the next days reward. <br> By clicking this ALL hidden rewards will be unveiled for you to view! If you would like to keep the rewards a secret and hidden do not select this icon.') !!}
                            </h1>
                        </div>
                        <div class="col-4"></div>
                            @foreach($rewards as $reward)
                                <div class="demo hidden col-5">
                                    <br>
                                    @if($reward->rewardImage)
                                        <div class="row justify-content-center">
                                            <img src="{{ $reward->rewardImage }}" alt="{{ $reward->reward()->first()->name }}" style="max-width:75px;width:100%;" />
                                        </div>
                                    @endif
                                    <div class="row justify-content-center">{{$reward->quantity}} {{$reward->reward()->first()->name}}</div>
                                </div>
                            @endforeach
                    @endif
                </div>
            </div>
        @endif
        @endforeach
    </div>
</div>
@endif
