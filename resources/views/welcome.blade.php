@extends('layouts.app')

@section('title') Home @endsection

@section('content')


<style>
.container {  display: grid;
  grid-template-columns: 0.3fr 2.0fr 0.7fr;
  gap: 0px 0px;
  grid-template-areas:
    "buttons main monthly"
    "recent recent monthly"
    "event event event";
    padding: 0px;
    max-width: 1300px;
}

.monthly { grid-area: monthly; padding-left: 6px; align-content: center; max-height: 700px; }

.buttons { grid-area: buttons; padding-right: 4px; align-content: center; max-height: 700px; }

.main { grid-area: main; padding: 2px; align-content: center; }

.recent { grid-area: recent; padding: 0px; align-content: center; }

.event { grid-area: event; padding: 0px; align-content: center; }

html, body , .container {
  height: 100%;
  margin: 0;
}

        /*fakeimg can be removed once replaced*/
        .fakeimg2 {
            background-color: rgb(59, 183, 237);
            width: 30%;
            height: 30%;
            padding: 10px;
            margin-right: 10px;
            border-radius: .75rem;
        }

        :root {
        --lh: 1.4rem;
        }
        .truncate-overflow {
            --max-lines: 5;
            position: relative;
            max-height: calc(var(--lh) * var(--max-lines));
            overflow: hidden;
        }
        .truncate-overflow::before {
            position: absolute;
            content: "...";
            bottom: -5px;
            right: 20px;
        }
        .truncate-overflow::after {
            content: "";
            position: absolute;
            right: 0;
            width: 1rem;
            height: 1rem;
            background: white;
        }

        .img-responsive {
          max-width: 100%;
        }
        p {
          align: justify;
          text-indent: 1cm;
        }
        .p2 {
          align: justify;
        }
        img {
          margin: 5 5 5 5px;
        }
        .carousel-inner img {
            width: 130%;
        }

        .title3 {
            position: absolute;
            left: 70%;
            top: 0px;
            color: white;
            text-shadow: 2px 0 #fff, -2px 0 #fff, 0 2px #fff, 0 -2px #fff,
            2px 2px #fff, -2px -2px #fff, 2px -2px #fff, -2px 2px #fff;
        }
        .tag {
            float: right;
            position: absolute;
            left: 180px;
            top: 89px;
            font-size: 60%;
            padding: .3rem .6rem;
        }
        .btn {
            padding: .3rem .6rem;
        }
</style>

<!-- TEMP WHILE IN EARLY ACCESS-->
    <div class="row">
        <div class="col-12">
            <div class="card-group">
                <div class="card border-ilblue" style="border-width:2px">
                    <div class="card-body text-ilblue">
                        <div align="center">
                            <img class="img-responsive" width="482.5px" src="{{ asset('images/sup1.png') }}"/>
                                <p align="center" class="card-text">Isomara Island ARPG is currently in Early Access. While in Early Access, you may find some pages unavailable, empty or containing placeholder images.
                                        Consider <a href="/support">supporting</a> the developers and artists continued efforts on this ARPG and, in return, receive in-game items, virtual currency, critters, and an Early Access Invitation Key to register and start playing today!
                                </p>
                                <a href="/support"><img class="img-responsive" width="443.3px" src="{{ asset('images/sup3.png') }}"/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <br>
            <div class="hr1"></div>
        <br>
<!-- END TEMP-->

<div style="display: flex">
    <div class="container">
        <div class="buttons">

            @if(Auth::check())
            <!-- Logged In -->
            <div style="font-family: poets" align="center">
                <a href="/guide">
                    <img src="/images/home/icon_bg.png" class="zoom-img" style="display:block;width:110px;height:auto;">Beginner's Guide</a>
                <a href="/info/inhabitants" class="btn">
                    <img src="https://isomara-island.com/files/icon_inhab.png" class="zoom-img" style="display:block;width:110px;height:auto;">Island Inhabitants</a>
                <a href="/sales?title=&is_open=1&sort=bump-reverse" class="btn">
                    <img src="/images/home/icon_au.png" class="zoom-img" style="display:block;width:110px;height:auto;">Open Adopts</a>
                <a href="/info/myo" class="btn">
                    <img src="https://isomara-island.com/images/myo.png" class="zoom-img" style="display:block;width:110px;height:auto;">Buy a MYO Slot</a>
                <a href="/design" class="btn">
                    <img src="https://isomara-island.com/files/icon_design.png" class="zoom-img" style="display:block;width:110px;height:auto;">Design Guide</a>
            </div>
        @else
            <!-- Logged Out -->
            <a href="{{ Auth::check() ? '/shops/7' : '/register' }}"><img max-width="200px" src="{{ asset('images/Signup.png') }}" class="img-responsive"/></a>
                <br><br>
            <a href="/support"><img max-width="200px" src="{{ asset('images/supportus.png') }}" class="img-responsive zoom-img"/></a>
        @endif

        </div>
        <div class="main">

            <div id="demo" class="carousel slide" data-ride="carousel" >
                <!--Indicators-->
                    <ol class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" ></li>
                        <li data-target="#demo" data-slide-to="1" class="active"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                        <li data-target="#demo" data-slide-to="3"></li>
                    </ol>

                <!--Slides-->
                    <div class="carousel-inner" role="listbox" >
                    <!--#1-->
                        <div class="carousel-item">
                            <a href="/cache"><img class="d-block w-100" src="{{ asset('images/games/banner3.png') }}" alt="Fourth Slide" style="width:120%;"></a>
                        </div>
                    <!--#2-->
                        <div class="carousel-item">
                            <a href="/support"><img class="d-block w-100" src="{{ asset('images/Banner_Support.png') }}" alt="Second Slide" style="width:120%;"></a>
                        </div>
                    <!--#3-->
                        <div class="carousel-item">
                            <a href="https://discord.gg/62ZGCYFUDu"><img class="d-block w-100" src="{{ asset('images/Banner_Discord.png') }}" alt="Third Slide" style="width:120%;"></a>
                        </div>
                    <!--#4-->
                        <div class="carousel-item active">
                        <a href="/sink-or-soar"><img class="d-block w-100" src="{{ asset('images/games/banner2.png') }}" alt="First Slide" style="width:120%;"></a>
                        </div>
                    </div>

                <!--Controls-->
                    <a class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#demo" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
            </div>

            <br>

            @if(Auth::check())
                <!-- Logged In -->
                <h3>Welcome back to the island, {!! Auth::user()->displayName !!}!</h3>
                <p></p>
                <div style="font-family: Poets" align="center">
                    <a href="/sink-or-soar" class="btn">
                        <img src="/images/home/icon_ss.png" class="zoom-img" style="display:block;width:110px;height:auto;">Play Sink or Soar</a>
                    <a href="/wishingwell" class="btn">
                        <img src="/images/home/icon_ww.png" class="zoom-img" style="display:block;width:110px;height:auto;">Wishful Well</a>
                    <a href="/pavilion" class="btn">
                        <img src="/images/home/icon_fq.png" class="zoom-img" style="display:block;width:110px;height:auto;">Daily Fetch Quest</a>
                    <a href="/cache" class="btn">
                        <img src="/images/home/icon_qc.png" class="zoom-img" style="display:block;width:110px;height:auto;">Queen's Cache</a>
                    <a href="/pool" class="btn">
                        <img src="/images/home/icon_tp.png" class="zoom-img" style="display:block;width:110px;height:auto;">Tide Pools</a>
                    </div>
                <div style="font-family: Poets" align="center">
                    <a href="/shops/1" class="btn">
                        <img src="/images/home/icon_ps.png" class="zoom-img" style="display:block;width:110px;height:auto;">Pacing's Shop</a>
                    <a href="/shops/donation-shop" class="btn">
                        <img src="/images/home/icon_dd.png" class="zoom-img" style="display:block;width:110px;height:auto;">Darwin's Donations</a>

                    </div>
            @else
                <!-- Logged Out -->
                <h3>Welcome to Isomara Island</h3>
                <p>Isomara Island is an online Art Role Playing Game️ (ARPG). Create a character or adopt a premade one and complete prompts through drawings or written fiction to develop your characters, earn items and virtual currency, and shape the future of the island.</p>
                <p>The primary species of the ARPG, Isomara, are fluffy semi-aquatic dragons but are not the only playable characters here. There are plenty of unique creatures and wildlife across the island and surrounding sea. Develop your character's personality and story by completing prompts, forming families, training their skills, and exploring the vast island and beyond.</p>
                <p>With plenty of activities to do, prompts to complete, items to collect, and characters to meet and more added regularly, there is much to explore and fun to be had!
                    <br>

                    <a href="/guide"><img style="float:right;" src="{{ asset('images/BeginGuide.png') }}" class="img-fluid, w-50"></a>

                Check out the <a href="/guide">Beginner's Guide</a> on how to adopt/create your first character and start <a href="/info/currency">earning in-game currency</a> and items.
                    <br><br>
                Don't have an account yet? <a href="/register">Register now</a>!<br>(Already a member? Be sure to grab your freebie bundle from <a href="https://isomara-island.com/shops/7">Slay's Concessions</a>!)
                </p>
            @endif

        </div>
        <div class="monthly">

            <a href="/features"><div class="monfeat img-responsive"></div>
                <div class="hr1"></div>
                    <h5 style="text-align: center; font-size: 16px;">Isomara of the Month</h5>
                    <div align="center">
                        @if(isset($featured) && $featured)
                                <a href="{{ $featured->url }}"><img src="{{ $featured->image->thumbnailUrl }}" width="150px" class="img-thumbnail" /></a>
                            <div class="mt-1">
                                <a href="{{ $featured->url }}" class="h5 mb-0">@if(!$featured->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ $featured->fullName }}</a>
                            </div>
                            <div class="small">
                                Owner: {!! $featured->displayOwner !!}<br>
                                +15 <img src="{{ asset('images/data/currencies/1-icon.png') }}"/> by including them in <a href="/gallery">gallery submissions</a>, if the owner allows (see badges on profile).

                            </div>
                        @else
                            <p>There is no featured character.</p>
                        @endif
                    </div>

                    <div class="hr1"></div>
                        <h5 style="text-align: center; font-size: 16px;">Companion Species of the Month</h5>
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

                        <div class="hr1"></div>
                        @if(isset($items))
                            <h5 style="text-align: center; font-size: 16px;">Newest Items</h5>
                            <div align="center">
                                @include('world.new_items', ['items' => $items])
                            </div>
                        @endif

                        <div class="hr1"></div>
                        @if(isset($awards))
                            <h5 style="text-align: center; font-size: 16px;">Featured Achievement</h5>
                            <div align="center">
                                @include('world.feat_achievo', ['awards' => $awards])
                            </div>
                        @endif

                        <div class="hr1"></div>

                        @if(isset($prompt))
                            <h5 style="text-align: center; font-size: 16px;">Featured Prompt</h5>
                            <div align="justify">
                                @include('prompts.prompt_month', ['prompt' => $prompt])
                            </div>
                            <br>
                        @endif

                        <div class="hr1"></div>

                            <h5 style="text-align: center; font-size: 18px;">Featured Game</h5>
                            @if( "January" == date('F'))
                                <a href="/cache"><img src="{{ asset('/images/home/icon_qc.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Queen's Cache</div></a>
                                <div>Attempt to pilfer from the Queen Memora's treasure trove! </div>
                            @elseif ( "February" == date('F'))
                                <a href="/cache"><img src="{{ asset('/images/home/icon_qc.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Queen's Cache</div></a>
                                <div>Attempt to pilfer from the Queen Memora's treasure trove! </div>
                            @elseif ( "March" == date('F'))
                                <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Tide Pools</div></a>
                                <div>Come fish in the pools for a fishy snack. </div>
                            @elseif ( "April" == date('F'))
                                <a href="/cache"><img src="{{ asset('/images/home/icon_qc.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Queen's Cache</div></a>
                                <div>Attempt to pilfer from the Queen Memora's treasure trove! </div>
                            @elseif ( "May" == date('F'))
                                <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Tide Pools</div></a>
                                <div>Come fish in the pools for a fishy snack. </div>
                            @elseif ( "June" == date('F'))
                                <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Tide Pools</div></a>
                                <div>Come fish in the pools for a fishy snack. </div>
                            @elseif ( "July" == date('F'))
                                <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Tide Pools</div></a>
                                <div>Come fish in the pools for a fishy snack. </div>
                            @elseif ( "August" == date('F'))
                                <a href="/cache"><img src="{{ asset('/images/home/icon_qc.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Queen's Cache</div></a>
                                <div>Attempt to pilfer from the Queen Memora's treasure trove! </div>
                            @elseif ( "September" == date('F'))
                                <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Tide Pools</div></a>
                                <div>Come fish in the pools for a fishy snack. </div>
                            @elseif ( "October" == date('F'))
                                <a href="/apple"><img src="{{ asset('images/abob.png') }}" style="float:left" width="130px"/><br><div style="font-family: Poets">Apple Bobbing</div></a>
                                <div>Dunk your head and bob for rewards in this daily game!</div>
                            @elseif ( "November" == date('F'))
                                <a href="/cache"><img src="{{ asset('/images/home/icon_qc.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Queen's Cache</div></a>
                                <div>Attempt to pilfer from the Queen Memora's treasure trove! </div>
                            @elseif ( "December" == date('F'))
                                <a href="/pool"><img src="{{ asset('/images/home/icon_tp.png') }}" style="float:left" width="160px"/><br><div style="font-family: Poets">Tide Pools</div></a>
                                <div>Come fish in the pools for a fishy snack. </div>
                            @endif

        </div>
        <div class="recent">
            <div class="hr1"></div>
            @if(Auth::check())
            <br>
            @else
                <div style="font-family: Poets" align="center">
                    <a href="/info/inhabitants" class="btn">
                        <img src="https://isomara-island.com/files/icon_inhab.png" class="zoom-img" style="display:block;width:130px;height:auto;">Learn about the <br>Island's Inhabitants</a>
                    <a href="/info/myo" class="btn">
                        <img src="https://isomara-island.com/images/myo.png" class="zoom-img" style="display:block;width:130px;height:auto;">Earn or Buy a <br>Make-Your-Own Slot</a>
                    <a href="/sales?title=&is_open=1&sort=bump-reverse" class="btn">
                        <img src="/images/home/icon_au.png" class="zoom-img" style="display:block;width:130px;height:auto;">Adopt A Premade <br>Character</a>
                    <a href="/design" class="btn">
                        <img src="https://isomara-island.com/files/icon_design.png" class="zoom-img" style="display:block;width:130px;height:auto;">Character <br>Design Guide</a>
                    <a href="/info/currency" class="btn">
                        <img src="/images/home/icon_bg.png" class="zoom-img" style="display:block;width:130px;height:auto;">Earning In-Game <br>Currency</a>
                </div>
                <br>
            @endif

            <div class="card-group">
                <div class="card border-ilblue" style="border-width:2px">
                    <div class="title"><h4>Recent News & Updates</h4></div>
                    <div class="card-body text-ilblue">

                        @if(isset($newses))
                            @foreach($newses = App\Models\News::orderBy("id", "desc")->get()->take(3) as $news)
                                <span class="d-flex flex-column flex-sm-row align-items-sm-end pt-3">
                                    <h5 class="mb-0">{!! $news->displayName !!}</h5>
                                </span>
                                    <p style="right: 5; text-align:left;" class="pl-3">
                                        {!! substr(strip_tags(str_replace("<br />", "&nbsp;", $news->parsed_text)), 0, 300) !!}...
                                        <a href="{!! $news->url !!}"><i class="fas fa-book-reader"></i> Read more</a>
                                    </p>
                                    <div align="right"><small>{!! format_date($news->post_at ? : $news->created_at) !!}</small></div>
                                        <hr>
                            @endforeach

                                <div style="position: absolute; bottom: 0; right: 5; width: 90%; text-align:right;">
                                    <a href="/news"><strong>More News...</strong></a>
                                </div>
                        @else
                            <div>No news posts yet.</div>
                        @endif
                    </div>
                </div>
                <div class="card border-ilblue" style="border-width:2px">
                    <div class="title"><h4>Recent Character Adoptable Sales</h4></div>
                    <div class="card-body text-ilblue">
                        @if($saleses->count())
                            @foreach($saleses as $sales)
                                <div class="row py-3">
                                    @if($sales->characters->count())
                                        <div class="col-md-3 text-center">
                                            <a href="{{ $sales->url }}">
                                                <img src="{{ $sales->characters->first()->character->image->thumbnailUrl }}" alt="{!! $sales->characters->first()->character->fullName !!}" class="img-thumbnail" />
                                            </a>
                                        </div>
                                    @endif
                                    <div class="{{ $sales->characters->count() ? 'col-md-9' : 'col-12' }} d-flex flex-column justify-content-center">
                                        <span class="d-flex flex-column flex-sm-row align-items-sm-end">
                                            <h5 class="mb-0">{!! $sales->displayName !!}</h5>
                                        </span>
                                    </div>
                                <div class="truncate-overflow">
                                    <p class="mb-0">{!! $sales->parsed_text !!}</p>
                                </div>
                                </div>
                                <div class="pl-3">
                                    @if($sales->characters->count() == 1)
                                        <a href="{{ $sales->url }}"><strong>View Character Up For Adoption </strong> <i class="fas fa-greater-than"></i></a>
                                    @else
                                        <a href="{{ $sales->url }}"><strong>View {!! $sales->characters->count() !!} Characters Up For Adoption </strong> <i class="fas fa-greater-than"></i></a>
                                    @endif
                                </div>
                                <hr>
                            @endforeach
                            <div style="position: absolute; bottom: 0; right: 5; width: 90%; text-align:right;">
                                <a href="/sales?title=&is_open=1&sort=bump-reverse"><strong>View All Open Sales...</strong></a>
                            </div>
                        @else
                            <div>No sales posts yet.</div>
                        @endif
                    </div>


                </div>
            </div>

        </div>
        <div class="event">

                <div class="hr1"></div>
                    <br>
                        @if($gallerySubmissions->count())
                            <div class="card-group">
                                <div class="card border-ilblue" style="border-width:2px">
                                    <div class="title"><h4>Recent Gallery Submissions</h4></div>
                                    <div class="card-body text-ilblue">
                                        <div class="row mw-100 mx-auto">
                                            @foreach($gallerySubmissions->get() as $submission)
                                                <div class="col-md-2 align-self-center">
                                                    @include('galleries._thumb', ['submission' => $submission, 'gallery' => false])
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="text-right" style="padding-right:10px"><a href="/gallery"><b>View Gallery Submissions...</b></a></div>
                                </div>
                            </div>
                        @endif
                    <br>
                    <div class="card-group">
                        <div class="card border-ilblue" style="border-width:2px">
                            <div class="card-body text-ilblue">
                                <div class="title"><h4>Recent Events & Contests</h4></div>
                                <div class="row">
                                    <div class="col-4 col-md-4">
                                        <div class="fakeimg2" style="float:left; margin-right:10px;"></div>
                                            <a href="/news/32.hallows-extravaga-2024-open">
                                            <p2 class="card-text"><h5>Hallows Extravaganza 2024</h5><br>Ends: October 31st</p></a>
                                            <br><br>
                                        <img width="130px" src="https://isomara-island.com/files/blub.png" style="float:left; margin-right:10px; border-radius: .75rem;"></img>
                                        <p2 class="card-text"><h5>Bubbling Under Plot</h5><br><a href="info/blub">View Teaser #1</a></p><a href="info/blub2">View Teaser #2</a></p>
                                    </div>
                                    <div class="col-4 col-md-4">
                                        <a href="https://isomara-island.com/news/16.hallows-extravaganza-event-2023-open">
                                            <img width="130px" src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/62058ebb-e52e-4397-abcd-af54f0d37418/dgar7o8-1dc47efe-4506-4a6e-accb-f9c47bdb0252.png/v1/fill/w_231,h_200/mmmm_by_slayersstronghold_dgar7o8-200h.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9NTAzIiwicGF0aCI6IlwvZlwvNjIwNThlYmItZTUyZS00Mzk3LWFiY2QtYWY1NGYwZDM3NDE4XC9kZ2FyN284LTFkYzQ3ZWZlLTQ1MDYtNGE2ZS1hY2NiLWY5YzQ3YmRiMDI1Mi5wbmciLCJ3aWR0aCI6Ijw9NTgxIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmltYWdlLm9wZXJhdGlvbnMiXX0.j7K1gsmww05ZkYlnDUkIIsAXZbJvyV4eO4Gjs3QKB50" style="float:left; margin-right:10px;"></img>
                                            <p2 class="card-text"><h5>Hallows Extravaganza 2023</h5></a>Ended: October 31st, 2023 </p>
                                            <br><br><br>
                                        <a href="https://isomara-island.com/news/25.basking-in-rainbows-event-ended">
                                            <img width="130px" src="https://isomara-island.com/images/data/pets/1-Rainbow-image.png" style="float:left; margin-right:10px;"></img>
                                            <p2 class="card-text"><h5>Basking in Rainbows</h5></a>Ended: July 31st, 2024 </p>
                                    </div>
                                    <div class="col-4 col-md-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr1"></div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="card border-ilblue" style="border-width:2px">
                                <div class="card-body text-ilblue">
                                    <div  class="title"><h4>Bluesky News Feed</h4></div>
                                    <script src="https://cdn.jsdelivr.net/npm/bsky-embed@0.1.5/dist/bsky-embed.es.js" async></script>
                                        <bsky-embed
                                            username="isomaraisland.com"
                                            mode="light"
                                            limit="1"
                                            link-target="_self"
                                            link-image="false"
                                            load-more="true"
                                            custom-styles=".border-slate-300; .body {font-size: 65%};">
                                        </bsky-embed>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <a href="/NPCs"><div  class="title3 align:right"><h4>Meet the NPCs!</h4></div>
                            <img class="img-responsive" src="https://isomara-island.com/images/gallery/0/99_xY4KwFn3iI.png"></img></a>
                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <iframe src="https://discordapp.com/widget?id=1079570745027461122&theme=dark" width="100%" height="350" allowtsparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>
@endsection
