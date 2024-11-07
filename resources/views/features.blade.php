@extends('layouts.app')

@section('content')

<div align="center">
    <div class="monfeat" style="width:60%"></div>
    <p>Monthly features draw attention to specific characters and aspects in the ARPG. There are a lot of cool characters to meet, and plenty of items and achievements to learn about. This is a great way to dive in and get familiar with different aspects of the game and give some love to other member's characters!</p>
    <div class="hr1"></div>

    <div class="row">
        <div class="col-sm-6">

            <h5 style="text-align: center; font-size: 18px;">Isomara of the Month</h5>
                    @if(isset($featured) && $featured)
                        <div>
                            <a href="{{ $featured->url }}"><img src="{{ $featured->image->thumbnailUrl }}" width="150px" class="img-thumbnail" /></a>
                        </div>
                        <div class="mt-1">
                            <a href="{{ $featured->url }}" class="h5 mb-0">@if(!$featured->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ $featured->fullName }}</a>
                        </div>
                        <div class="small">
                            Owner: {!! $featured->displayOwner !!}<br>
                            <div>
                    <span class="btn {{ $character->is_gift_writing_allowed == 1 ? 'badge-ilgreen' : ($character->is_gift_writing_allowed == 2 ? 'badge-ilyellow text-light' : 'badge-ilorange') }}" data-toggle="tooltip" title="{{ $character->is_gift_writing_allowed == 1 ? 'OPEN for gift writing.' : ($character->is_gift_writing_allowed == 2 ? 'PLEASE ASK before gift writing.' : 'CLOSED for gift writing.') }}"><i class="fas fa-scroll"></i></span>
                    <span class="btn {{ $character->is_gift_art_allowed == 1 ? 'badge-ilgreen' : ($character->is_gift_art_allowed == 2 ? 'badge-ilyellow text-light' : 'badge-ilorange') }}" data-toggle="tooltip" title="{{ $character->is_gift_art_allowed == 1 ? 'OPEN for gift art.' : ($character->is_gift_art_allowed == 2 ? 'PLEASE ASK before gift art.' : 'CLOSED for gift art.') }}"><i class="fas fa-paint-brush"></i></span>
                            <br>
                        </div>
                        </div>
                    @else
                        <p>There is no featured character.</p>
                    @endif
                <small><p>Show this wonderful Isomara some attention by including them in <a href="/gallery">gallery submissions</a>, if the owner allows (see the badges above).
                    You'll earn an additional 15 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> per gallery submission when you include the Isomara of the Month.</p></small>

        </div>
        <div class="col-sm-6">

            <h5 style="text-align: center; font-size: 18px;">Companion Species of the Month</h5>
            <div class="small">
                @if( "January" == date('F'))
                    <div align="center">
                        <img class="img-responsive" src="{{ asset('images/Bleps.png') }}" width="240px"/><br>
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a blepper
                    </div>
                @elseif ( "February" == date('F'))
                    <div align="center">
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a memora
                    </div>
                @elseif ( "March" == date('F'))
                    <div align="center">
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a memic
                    </div>
                @elseif ( "April" == date('F'))
                    <div align="center">
                        <img class="img-responsive" src="{{ asset('images/Gooms.png') }}" width="240px"/><br>
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a goom
                    </div>
                @elseif ( "May" == date('F'))
                    <div align="center">
                        <img class="img-responsive" src="{{ asset('images/Bleps.png') }}" width="240px"/><br>
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a blepper
                    </div>
                @elseif ( "June" == date('F'))
                    <div align="center">
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a memora
                    </div>
                @elseif ( "July" == date('F'))
                    <div align="center">
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a memic
                    </div>
                @elseif ( "August" == date('F'))
                    <div align="center">
                        <img class="img-responsive" src="{{ asset('images/Gooms.png') }}" width="240px"/><br>
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a goom
                    </div>
                @elseif ( "September" == date('F'))
                    <div align="center">
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a memic
                    </div>
                @elseif ( "October" == date('F'))
                    <div align="center">
                        <img class="img-responsive" src="{{ asset('images/Bleps.png') }}" width="240px"/><br>
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a blepper
                    </div>
                @elseif ( "November" == date('F'))
                    <div align="center">
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a memora
                    </div>
                @elseif ( "December" == date('F'))
                    <div align="center">
                        <img class="img-responsive" src="{{ asset('images/Gooms.png') }}" width="240px"/><br>
                        +5 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> to all artwork & literature that includes a goom
                    </div>
                @endif
            </div>

        </div>
    </div>

    <div class="hr1"></div>

    <div class="row">
        <div class="col-sm">

            @if(isset($items))
                <h5 style="text-align: center; font-size: 18px;">Newest Items</h5>
                <div align="center">
                    @include('world.new_items', ['items' => $items])
                </div>
            @endif

        </div>
        <div class="col-sm">

            @if(isset($awards))
                <h5 style="text-align: center; font-size: 18px;">Featured Achievement</h5>
                <div align="center">
                    @include('world.feat_achievo', ['awards' => $awards])
                </div>
            @endif

        </div>
        <div class="col-sm">

                <h5 style="text-align: center; font-size: 18px;">Featured Game</h5>
                @if( "January" == date('F'))
                    <a href="/cache"><img src="{{ asset('/images/home/icon_qc.png') }}" style="float:left" width="170px"/><br><strong>Queen's Cache</strong></a>
                    <div>Attempt to pilfer from the Queen Memora's treasure trove! </div>
                @elseif ( "February" == date('F'))
                    <a href="/cache"><img src="{{ asset('/images/home/icon_qc.png') }}" style="float:left" width="170px"/><br><strong>Queen's Cache</strong></a>
                    <div>Attempt to pilfer from the Queen Memora's treasure trove! </div>
                @elseif ( "March" == date('F'))
                    <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="170px"/><br><strong>Tide Pools</strong></a>
                    <div>Come fish in the pools for a fishy snack. </div>
                @elseif ( "April" == date('F'))
                    <a href="/cache"><img src="{{ asset('/images/home/icon_qc.png') }}" style="float:left" width="170px"/><br><strong>Queen's Cache</strong></a>
                    <div>Attempt to pilfer from the Queen Memora's treasure trove! </div>
                @elseif ( "May" == date('F'))
                    <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="170px"/><br><strong>Tide Pools</strong></a>
                    <div>Come fish in the pools for a fishy snack. </div>
                @elseif ( "June" == date('F'))
                    <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="170px"/><br><strong>Tide Pools</strong></a>
                    <div>Come fish in the pools for a fishy snack. </div>
                @elseif ( "July" == date('F'))
                    <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="170px"/><br><strong>Tide Pools</strong></a>
                    <div>Come fish in the pools for a fishy snack. </div>
                @elseif ( "August" == date('F'))
                    <a href="/cache"><img src="{{ asset('/images/home/icon_qc.png') }}" style="float:left" width="170px"/><br><strong>Queen's Cache</strong></a>
                    <div>Attempt to pilfer from the Queen Memora's treasure trove! </div>
                @elseif ( "September" == date('F'))
                    <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="170px"/><br><strong>Tide Pools</strong></a>
                    <div>Come fish in the pools for a fishy snack. </div>
                @elseif ( "October" == date('F'))
                    <a href="/apple"><img src="{{ asset('images/abob.png') }}" style="float:left" width="130px"/><br><strong>Apple Bobbing</strong></a>
                    <div>Dunk your head and bob for rewards in this daily game!</div>
                @elseif ( "November" == date('F'))
                    <a href="/cache"><img src="{{ asset('/images/home/icon_qc.png') }}" style="float:left" width="170px"/><br><strong>Queen's Cache</strong></a>
                    <div>Attempt to pilfer from the Queen Memora's treasure trove! </div>
                @elseif ( "December" == date('F'))
                    <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="170px"/><br><strong>Tide Pools</strong></a>
                    <div>Come fish in the pools for a fishy snack. </div>
                @endif

        </div>
    </div>

    <div class="hr1"></div>

    <div class="row">
        <div class="col-sm">
            @if(isset($prompt))
                <h5 style="text-align: center; font-size: 18px;">Featured Prompt</h5>
                <div align="justify">
                    @include('prompts.prompt_month', ['prompt' => $prompt])
                </div>
            @endif
        </div>
        <div class="col-sm">
            <h5 style="text-align: center; font-size: 18px;">Current Event</h5>
                <strong><a href="https://isomara-island.com/news/32.hallows-extravaga-2024-open">Hallows Extravaganza 2024</a></strong>
                {{--<p>There is no ongoing event at this time.</p>--}}
        </div>
    </div>

@endsection

