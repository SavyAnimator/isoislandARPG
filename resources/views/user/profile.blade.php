@extends('user.layout')

@section('profile-title') {{ $user->name }}'s Profile @endsection

@section('meta-img') {{ asset('/images/avatars/'.$user->avatar) }} @endsection

@section('profile-content')
{{--{!! breadcrumbs(['Users' => 'users', $user->name => $user->url]) !!}--}}

@if($user->is_banned)
    <div class="alert alert-danger">This user has been banned.</div>
@endif

<div class="row no-margin-lr align-items-center name-card">
    <div class="col-sm-12 col-md-12 col-lg pl-lg-2">
        <div class="row">
            <div class="col col-lg-auto text-center">
                <!-- Avatar, Online, FTO Tag -->
                @if (($user->settings->online_setting) == 1)
                    <div class="tag">{!! $user->isOnline() !!}</div>
                @else
                    <div class="tag"><i class="fas fa-circle text-secondary mr-2" data-toggle="tooltip" title="This user is invisible."></i></div>
                @endif
                    <img src="/images/avatars/{{ $user->avatar }}" class="img2-fluid rounded-circle" alt="{{ $user->name }}" >
                @if($user->settings->is_fto)
                    <div class="fto-tag">
                        <span class="badge badge-sm badge-primary" data-toggle="tooltip" title="" data-original-title="First Time Owner - This player has not owned any Isomara Island characters before.">FTO</span>
                    </div>
                @endif

            </div>
            <div class="col-sm-12 col-md-12 col-lg mt-4 mt-lg-0 align-content-center">
                <div class="text-center text-lg-left" style="word-break: break-word;">
                    <h1 style="word-break: break-word;">
                        {!! $user->displayName !!}
                        <span style="font-size: 1rem; line-height: 1rem;">
                        </span>
                    </h1>

                    <!-- Profile Details -->
                    <div class="col-sm-12 col-md-12 col-lg p-0 align-content-center col small" style="word-break: break-word;">
                        <i class="{!! $user->rank->icon !!} "></i> <b>Rank:</b> {!! $user->rank->displayName !!}
                        ・
                        <i class="fas fa-user"></i> <b>Alias:</b> {!! $user->displayAlias !!}
                        <br>
                        <i class="fas fa-clock"></i> <b>Joined:</b> {!! format_date($user->created_at, false) !!} ({{ $user->created_at->diffForHumans() }})
                        @if($user->birthdayDisplay && isset($user->birthday))
                        <br>
                        <i class="fas fa-birthday-cake"></i> <b>Birthday:</b> {!! $user->birthdayDisplay !!}
                        @endif
                        <br>
                            @if($user->profile->disc)
                            <span style="font-size: 1.1rem; padding-left: 10px; opacity: 0.4;" data-toggle="tooltip" title=" {!! $user->profile->disc !!} "><i class="fab fa-discord"></i></span>
                            @endif
                            @if($user->profile->devian)
                            <span style="font-size: 1.1rem; padding-left: 10px; opacity: 0.4;" data-toggle="tooltip" title=" {!! $user->profile->devian !!}&#64;deviantart "><a href="https://www.deviantart.com/{!! $user->profile->devian !!}"><i class="fab fa-deviantart"></i></a></span>
                            @endif
                            @if($user->profile->house)
                            <span style="font-size: 1.1rem; padding-left: 10px; opacity: 0.4;" data-toggle="tooltip" title=" {!! $user->profile->house !!}&#64;toyhou.se "><a href="https://toyhou.se/{!! $user->profile->house !!}"><i class="fas fa-home"></i></a></span>
                            @endif
                            @if($user->profile->insta)
                            <span style="font-size: 1.1rem; padding-left: 10px; opacity: 0.4;" data-toggle="tooltip" title=" {!! $user->profile->insta !!}&#64;instagram "><a href="https://www.instagram.com/{!! $user->profile->insta !!}"><i class="fab fa-instagram"></i></a></span>
                            @endif
                            @if($user->profile->tumb)
                            <span style="font-size: 1.1rem; padding-left: 10px; opacity: 0.4;" data-toggle="tooltip" title=" {!! $user->profile->tumb !!}&#64;tumblr"><a href="https://{!! $user->profile->tumb !!}.tumblr.com/"><i class="fab fa-tumblr"></i></a></span>
                            @endif
                            @if($user->profile->bluesk)
                            <span style="font-size: 1.1rem; padding-left: 10px; opacity: 0.4;" data-toggle="tooltip" title=" {!! $user->profile->bluesk !!}&#64;bluesky"><a href="https://bsky.app/profile/{!! $user->profile->bluesk !!}"><img style="height:17px; margin-bottom:5px;" src="/files/bluesky.png"></a></span>
                            @endif
                            @if($user->profile->twitt)
                            <span style="font-size: 1.1rem; padding-left: 10px; opacity: 0.4;" data-toggle="tooltip" title=" {!! $user->profile->twitt !!}&#64;twitter"><a href="https://twitter.com/{!! $user->profile->twitt !!}"><i class="fab fa-twitter"></i></a></span>
                            @endif
                            @if($user->profile->youtu)
                            <span style="font-size: 1.1rem; padding-left: 10px; opacity: 0.4;" data-toggle="tooltip" title=" {!! $user->profile->youtu !!}&#64;youtube"><a href="https://www.youtube.com/user/{!! $user->profile->youtu !!}"><i class="fab fa-youtube"></i></a></span>
                            @endif
                            @if($user->profile->newgr)
                            <span style="font-size: 1.1rem; padding-left: 10px; opacity: 0.4;" data-toggle="tooltip" title=" {!! $user->profile->newgr !!}&#64;newgrounds"><a href="https://{!! $user->profile->newgr !!}.newgrounds.com/"><i class="fas fa-film"></i></a></span>
                            @endif
                            @if($user->profile->artsta)
                            <span style="font-size: 1.1rem; padding-left: 10px; opacity: 0.4;" data-toggle="tooltip" title=" {!! $user->profile->artsta !!}&#64;artstation"><a href="https://www.artstation.com/{!! $user->profile->artsta !!}"><i class="fab fa-artstation"></i></a></span>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Floaty Things-->
    <div class="col-sm-12 col-md mt-3 mt-lg-0">
        <div class="row">
            <div class="col col-lg text-center text-lg-right">
                <div style="float:right">
                    <div class="card" style="clear:both;">
                        <div class="card-body row text-center">
                            <div class="row">
                                <div class="title2"> <a href="{{ $user->url.'/bank' }}"><h4>Currency</h4></a></div>
                                @foreach($user->getCurrencies(false) as $currency)
                                    <div class="col-md-6 col-6 small">
                                        <div>{!! $currency->display($currency->quantity) !!}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float:right">
                    @include('widgets._awardcase_feature', ['target' => $user, 'count' => Config::get('lorekeeper.extensions.awards.user_featured'), 'float' => false ])
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.img2-fluid {
  max-width: 125px;
  height: auto;
}
.name-card .avatar {
  position: relative;
}
.col-md-6 {
    padding-bottom: 1%;
    padding-top: 4%;
    padding-right: 0% !important;
    padding-left: 0% !important;
    margin-right: -15%;
    margin-left: 7%;
}
 .tag {
    margin: 0 auto;
    left: 1.8rem;
    bottom: 6.8rem;
    font-size: 150%;
    position: absolute;
    z-index: 6;

 }
 .fto-tag {
    margin: 0 auto;
    margin-bottom: 0px;
    margin-bottom: -1rem;
    bottom: .8rem;
    position: relative;
    z-index: 5;
 }
.badge {
  display: inline-block;
  padding: .25em .35em;
  font-size: 100%;
  font-weight: 600;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: .75rem;
  border: 3px solid #f8f9fa;
}
.title2 {
    position: absolute;
    left: 10px;
    top: -15px;
    color: white;
    text-shadow: 2px 0 #fff, -2px 0 #fff, 0 2px #fff, 0 -2px #fff,
    2px 2px #fff, -2px -2px #fff, 2px -2px #fff, -2px 2px #fff;
}
.pad {
    padding-right: 10px !important;
    padding-left: 15px !important;
}
.pad2 {
    padding-right: 5px !important;
    padding-left: 5px !important;
}
@media (max-width: 400px) {
    .pad {
    padding-right: 10px !important;
    padding-left: 5px !important;
    }
    .pad2 {
        padding-right: 5px !important;
        padding-left: 5px !important;
    }
}
</style>

@if(isset($user->profile->parsed_text))
<div class="card" style="clear:both;">
    <div class="card-body">
        <div class="title"><h4>About Me</h4></div>
        {!! $user->profile->parsed_text !!}
    </div>
</div>
@endif

@if (Auth::check() && Auth::user()->id == $user->id)
@else
    <div align="right">
        <a href="{{ url('reports/new?url=') . $user->url }}">
        <i class="fas fa-exclamation-triangle fa-xs" data-toggle="tooltip" title="Click here to report this user." style="opacity: 50%; font-size:1em;"></i>
        </a>
    </div>
@endif
<hr style="padding-bottom:3px">

<div class="row">
    <div class="col-sm-10">
        <div class="card mb-3" style="clear:both;">
            <div class="title"><a href="{{ $user->url.'/sublist/Iso' }}"><h4>Isomara</h4></a></div>
            <div class="card-body">
                    @foreach($isoCharacters->take(6)->get()->chunk(6) as $chunk)
                        <div class="row">
                        @foreach($chunk as $character)
                            <div class="col-md-2 col-5 text-center">
                                <a href="{{ $character->url }}"><img src="{{ $character->image->thumbnailUrl }}" class="img-thumbnail" /></a>
                                <div class="mt-1">
                                    <a href="{{ $character->url }}" class="h6 mb-0"> @if(!$character->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ $character->fullName }}</a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @endforeach
                <div class="text-right"><a href="{{ $user->url.'/sublist/Iso' }}">View all...</a></div>
            </div>
        </div>

        <div class="card mb-3" style="clear:both;">
            <div class="title"><a href="{{ $user->url.'/sublist/Comp' }}"><h4>Companions</h4></a></div>
            <div class="card-body">
                    @foreach($compCharacters->take(6)->get()->chunk(6) as $chunk)
                        <div class="row">
                        @foreach($chunk as $character)
                            <div class="col-md-2 col-5 text-center">
                                <a href="{{ $character->url }}"><img src="{{ $character->image->thumbnailUrl }}" class="img-thumbnail" /></a>
                                <div class="mt-1">
                                    <a href="{{ $character->url }}" class="h6 mb-0"> @if(!$character->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ $character->fullName }}</a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @endforeach
                <div class="text-right"><a href="{{ $user->url.'/sublist/Comp' }}">View all...</a></div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="card mb-2" style="clear:both;">
            <div class="title text-center"><a href="{{ $user->url.'/awardcase' }}"><h4 class="card-title">Badges</h4></a></div>
            <div class="card-body text-center">
                <div class="card-body">
                    @if(count($awards))
                        <div class="row">
                            @foreach($awards as $award)
                                <div class="profile-inventory-item">
                                    <img width="89%" src="{{ $award->imageUrl }}" class="img-fluid" data-toggle="tooltip"/>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-right"><a href="{{ $user->url.'/awardcase' }}">View all...</a></div>
                    @else
                        <div>No Badges Earned.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<hr style="padding-bottom:3px">
<div class="row">
    <div class="col-sm-12">
        <div class="card-deck mb-4 profile-assets" style="clear:both;">
            <div class="card profile-inventory profile-assets-card">
                <div class="title"><a href="{{ $user->url.'/inventory' }}"><h4>Inventory</h4></a></div>
                <div class="card-body">
                        @if(count($items))
                        <div class="row">
                            @foreach($items as $item)
                                <div class="col-md-3 col-6 profile-inventory-item">
                                    @if($item->imageUrl)
                                        <img style="margin-bottom:10px" src="{{ $item->imageUrl }}" data-toggle="tooltip" title="{{ $item->name }}" alt="{{ $item->name }}"/>
                                    @else
                                        <p>{{ $item->name }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="text-right"><a href="{{ $user->url.'/inventory' }}">View all...</a></div>
                        @else
                            <div>No items owned.</div>
                        @endif
                </div>
            </div>
            <div class="card profile-inventory profile-assets-card">
                <div class="title"><a href="{{ $user->name.'/equipment' }}"><h4>Equipment</h4></a></div>
                <div class="card-body">
                        @if(count($weapons))
                        <div class="row">
                            @foreach($weapons as $weapon)
                                <div class="col-md-3 col-6 profile-inventory-item">
                                    @if($weapon->imageUrl)
                                        <img style="margin-bottom:10px" src="{{ $weapon->imageUrl }}" data-toggle="tooltip" title="{{ $weapon->name }}" alt="{{ $weapon->name }}"/>
                                    @else
                                        <p>{{ $weapon->name }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="text-right"><a href="{{ $user->name.'/equipment' }}">View all...</a></div>
                        @else
                            <div>No equipment owned.</div>
                        @endif
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="col-sm-12">
        <div class="card-deck mb-4 profile-assets">
            <div class="card profile-inventory profile-assets-card">
                <div class="title"><a href="{{ $user->name.'/critters' }}"><h4>Critters</h4></a></div>
                <div class="card-body">
                        @if(count($pets))
                            <div class="row">
                                @foreach($pets as $pet)
                                    <div class="col-md-3 col-6 profile-inventory-item">
                                        <a class="inventory-stack"><img style="margin-bottom:10px" src="{{ $pet->variantimage($pet->pivot->variant_id) }}" class="img-fluid" style="width:100%;" data-toggle="tooltip" title="{{ $pet->name }}" alt="{{ $pet->name }}" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-right"><a href="{{ $user->url.'/critters' }}">View all...</a></div>
                        @else
                            <div>No critters owned.</div>
                        @endif
                </div>
            </div>

            <div class="card profile-inventory profile-assets-card">
                <div class="title"><a href="{{ $user->name.'/equipment' }}"><h4>Accessories</h4></a></div>
                <div class="card-body">
                        @if(count($gears))
                        <div class="row">
                            @foreach($gears as $gear)
                                <div class="col-md-3 col-6 profile-inventory-item">
                                    @if($gear->imageUrl)
                                        <img style="margin-bottom:10px" src="{{ $gear->imageUrl }}" data-toggle="tooltip" title="{{ $gear->name }}" alt="{{ $gear->name }}"/>
                                    @else
                                        <p>{{ $gear->name }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="text-right"><a href="{{ $user->name.'/equipment' }}">View all...</a></div>
                        @else
                            <div>No accessories owned.</div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

 {{--Gallery Box--}}
 @if ($user->gallerySubmissions->count())
 <hr style="padding-bottom:3px">
<div class="row">
    <div class="col-sm-12">
        <div class="card mb-3" style="clear:both;">
            <div class="title"><a href="{{ $user->name.'/gallery' }}"><h4>Gallery</h4></a></div>
            <div class="card-body">

                <div class="row mw-100 mx-auto">
                    @foreach($gallerySubmissions->get() as $submission)
                    <div class="col-md-2 align-self-center">
                        @include('galleries._thumb', ['submission' => $submission, 'gallery' => false])
                    </div>
                    @endforeach
                </div>

                    <div class="text-right"><a href="{{ $user->name.'/gallery' }}">View all...</a></div>
            </div>
        </div>
    </div>
</div>
@else
@endif
{{--<hr>
<div class="col-sm-12">
@comments(['model' => $user->profile,
        'perPage' => 5
    ])
</div>--}}
@endsection
