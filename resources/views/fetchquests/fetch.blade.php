@extends('layouts.app')

@section('title') Home @endsection

@section('content')

<style>
    div.a {
      text-indent: 40px;
    }
    div.b {
      text-indent: 60px;
    }
    .fakeimg {
        background-color: rgb(59, 183, 237);
        width: 200px;
        height:200px;
    }
    .arrow [data-toggle].collapsed:after {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f077";
    right: 10px;
    }
    .arrow [data-toggle]:not(.collapsed):after {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f078";
    }
    /*Table Styling*/
    table {
        width: 100%;
        }

        th {
        border: 1px solid #B0DFFF;
        text-align: left;
        padding: 5px;
        }

</style>

<h1>Prompt Pavilion</h1>
    <hr>

    <div class="a" align="justify">
        When in the world did this get here? You were looking around for Slayer at their hut, and to your surprise, nearby was a newly built pavilion.
"Lookin' for me?" Slayer asks, turning the corner. "I had to step out for a bit; I see you noticed the new pavilion," they gestured. "Pacings and our friends helped build an outdoor structure for me to work in."
Her tail flicks back and forth with eagerness. "I have a lot of things to do, and I was using this standing board to organize the jobs, but I could get community members like yourself to help me with some of these requests.
    </div>
    <br>
    <div class="a" align="justify">
        The Prompt Pavilion holds a plethora of prompts, tasks, and quests. They can range from an NPC fetch quest to fighting off encroaching Memics to a fun challenge of drawing your character doing something silly. Anyone can do these and can do them as many times as they like (unless otherwise stated).
        <br>
        If you do not own an Isomara or any companions, you may use any community-owned NPCs and their companions.
        <br>
    </div>
    <div align="center">
        Head to <a href="/shops/3">Darwin's Exchange Center</a> to trade in Pearls and Black Pearls for items!
    </div>

    <hr>
<div class="row">
    <div class="col-sm-6">
        <div align="center"><h2>Featured Prompt</h2>
            <strong>Bonus Reward: x1 Black Pearl<br>The bonus reward can be earned once per player per month</strong>
        </div>
        <div class="card-group">
            <div class="card border-ilblue" style="border-width:2px">
                <div class="card-body text-ilblue">

                    <div align="justify">
                        @if(isset($featprompt) && $featprompt)

                        @if($featprompt->has_image)
                        <a href="{{ $featprompt->imageUrl }}" data-title="{{ $featprompt->name }}"><img class="img-responsive float-left" style="margin-left: 5px; margin-right: 25px; width: 100px" src="{{ $featprompt->imageUrl }}" ></a>
                        @endif
                            <div align="center"><strong><a href="{{ $featprompt->url }}">{{ $featprompt->name }}</a></strong></div>
                            {!! $featprompt->parsed_description !!}

                        @else
                        <p>There is no featured prompt at this time.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div align="center">
            <h2>
            @if(date('l') == 'Saturday')
                <a href="/character/I-0028"><img style="max-width:80px;" src="images/npc/icon_dar.png">Darwin</a> is
                @elseif (date('l') == 'Sunday')
                <a href="/character/I-0049"><img style="max-width:80px;" src="images/npc/icon_fri.png">Frio</a> is
                @elseif (date('l') == 'Monday')
                <a href="/character/I-0307"><img style="max-width:80px;" src="">Thyme</a> is
                @elseif (date('l') == 'Tuesday')
                <a href="/character/I-0018"><img style="max-width:80px;" src="images/npc/icon_pac.png">Pacings</a> is
                @elseif (date('l') == 'Wednesday')
                <a href="/character/I-0028"><img style="max-width:80px;" src="">Hasha</a> is
                @elseif (date('l') == 'Thursday')
                <a href="/character/I-0001"><img style="max-width:80px;" src="images/npc/icon_slay.png">Slayer</a> is
                @elseif (date('l') == 'Friday')
                <a href="/character/I-0068"><img style="max-width:80px;" src="images/npc/icon_car.png">Carmen</a> is
            @endif
               Currently looking for
            </h2>

                @if(isset($fetchItem) && $fetchItem)
                    <div class="mt-1">
                        <a href="{{ $fetchItem->url }}" class="h2 mb-0"> {{ $fetchItem->name }}</a>
                    </div>
                        @if($fetchItem->imageUrl)
                    <div>
                        <a href="{{ $fetchItem->url }}"><img src="{{ $fetchItem->imageUrl}}" style='max-height: 120px;'/></a>
                    </div>
                    @endif

                    @else
                        <p>Nothing else at this time.</p>
                @endif
            <br>

            @if(Auth::check())
                @if(isset($fetchCurrency) && $fetchCurrency && $fetchRewardmax && $fetchReward)
                <h5>Reward: A Bundle of Seashells</h5>
                    <small>
                        <div class=arrow>
                        <a data-toggle="collapse" data-target="#viewdetails"><strong>View Reward Details&nbsp;&nbsp;</strong></a>
                        </div>
                        <p class="collapse" id="viewdetails">Fetch quest seashells rewards are random from 20 <img width=13px src="/images/data/currencies/1-icon.png"> to 150 <img width=13px src="/images/data/currencies/1-icon.png"></p>
                    </small>


                {{--<div>{!! $fetchCurrency->display($fetchReward) !!} - {!! $fetchCurrency->display($fetchRewardmax) !!}</div>--}}
                    @else
                        <p>There is no reward.</p>
                    @endif
                        @if(isset($fetchCurrency) && $fetchCurrency && $fetchRewardmax && $fetchReward && !Auth::user()->fetchCooldown)
                        <br>
                        <div class="text-center">
                            <a href="#" class="btn btn-primary" id="submitButton">Deliver {{ $fetchItem->name }}</a>
                        </div>
                        @elseif(Auth::user()->fetchCooldown)
                            You can complete another quest {!! pretty_date(Auth::user()->fetchCooldown) !!}!
                        @else
                            You can't turn in a quest with no reward!
                        @endif

                    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title h5 mb-0">Confirm  Submission</span>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>This will submit the fetch quest, remove the item asked for, and add currency to your account. Are you sure?</p>
                                {!! Form::open(['url' => 'pavilion/new']) !!}
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <p> You need to be <a href="/login">logged in</a> to complete a delivery quest</p>
                @endif
        </div>
    </div>
</div>

<hr>

<div class="site-page-content parsed-text">
    <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
        <thead>
            <tr style="height: 20px;">
                <td style="width: 325px; height: 15px; text-align: center;">
                    <a href="/prompts/prompts?prompt_category_id=3"><img src="/images/IsoLogo.png" width="150px"/></a>
                </td>
                <td style="width: 325px; height: 15px; text-align: center;">
                    <a href="/prompts/prompts?prompt_category_id=9"><img src="/images/IsoLogo.png" width="150px"/></a>
                </td>
                <td style="width: 325px; height: 15px; text-align: center;">
                    <a href="/prompts/prompts?prompt_category_id=4"><img src="/images/IsoLogo.png" width="150px"/></a>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr style="height: 30px;">
                <td style="width: 325px; height: 30px; border-right: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                    <h5><a href="prompts/prompts?prompt_category_id=3">Legacy Prompts</a></h5>
                    <p>The original 12 prompts from the DeviantArt version of the ARPG</p>
                </td>
                <td style="width: 325px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                    <h5><a href="prompts/prompts?prompt_category_id=9">Island Exploration</a></h5>
                    <p>Go on the search for matierials and edible goods by <a href="/explore">exploring</a> the many biomes on the island</p>
                </td>
                <td style="width: 325px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                    <h5><a href="prompts/prompts?prompt_category_id=4">Voyaging</a></h5>
                    <p>Trek past the island boundaries and discover new islands, items, and creatures</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
        <thead>
            <tr style="height: 20px;">
                <td style="width: 325px; height: 15px; text-align: center;">
                    <a href="prompts/prompts?prompt_category_id=8"><img src="/images/IsoLogo.png" width="150px"/></a>
                </td>
                <td style="width: 325px; height: 15px; text-align: center;">
                    <a href="prompts/prompts?prompt_category_id=6"><img src="/images/IsoLogo.png" width="150px"/></a>
                </td>
                <td style="width: 325px; height: 15px; text-align: center;">
                    <a href="prompts/prompts?prompt_category_id=5"><img src="/images/IsoLogo.png" width="150px"/></a>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr style="height: 30px;">
                <td style="width: 325px; height: 30px; border-right: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                    <h5><a href="prompts/prompts?prompt_category_id=8">Companion Quests [WIP]</a>&nbsp;</h5>
                    <p>The gooms, memora, and other island companions have their own daily lives away from their Isomara companions. Send them off on various jobs and utilize their skills.</p>
                </td>
                <td style="width: 325px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                    <h5><a href="prompts/prompts?prompt_category_id=6">Class Assignments [WIP]</a>&nbsp;</h5>
                    <p>Earn additional class experience by fullfilling a class master's various tasks.</p>
                </td>
                <td style="width: 325px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                    <h5><a href="prompts/prompts?prompt_category_id=5">Isoling Club Quests [WIP]</a></h5>
                    <p>The Isolings who play in the large sandcastle off a ways tend to leave poorly scribbled quests on the board for other Isolings in their game to come by and participate in.</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
        <thead>
            <tr style="height: 20px;">
                <td style="width: 500px; height: 15px; text-align: center;">
                    <a href="prompts/prompts?prompt_category_id=1"><img src="https://isomara-island.com/images/home/icon_qc.png" width="150px"/></a>
                </td>
                <td style="width: 500px; height: 15px; text-align: center;">
                    <a href="prompts/prompts?prompt_category_id=2"><img src="/images/IsoLogo.png" width="150px"/></a>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr style="height: 30px;">

                <td style="width: 500px; height: 30px; border-right: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                    <h5><a href="prompts/prompts?prompt_category_id=1">Dailies</a></h5>
                    <p>Submit a <a href="/cache">Queen's Cache</a> or <a href="/pool">Tide Pool's</a> prompt for additional rolls on top of the standard stamina daily rolls.</p>
                </td>
                <td style="width: 500px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                    <h5><a href="prompts/prompts?prompt_category_id=2">Limited Time Prompts</a></h5>
                    <p>These prompts are only available for a small time frame and usually are a part of an event or promotion.</p>
                </td>
            </tr>
        </tbody>
    </table>


    <hr/>

    <h3>Lifetime Beats</h3>
        <p>Lifetime Beats are common milestones and stages nearly all Isomara go through. These storylines assist in character development.</p>

    <div class="spoiler border-ilblue" style="border-width:2px">
        <div class=arrow>
            <div data-toggle="collapse" data-target="#viewegg" class="spoiler-toggle">Egg Hatching [WIP]&nbsp;&nbsp;</div>
            <div class="collapse spoiler-text" id="viewegg" style="display: none;">

                <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
                    <thead>
                        <tr style="height: 20px;">
                        <td style="width: 300px; height: 15px; text-align: center;">
                            <a href=""><img src="/images/IsoLogo.png" width="150px" /></a>
                        </td>
                        <td style="width: 300px; height: 15px; text-align: center;">
                            <a href=""><img src="/images/IsoLogo.png" width="150px" /></a>
                        </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height: 30px;">
                        <td style="width: 300px; height: 30px; border-right: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                            <h5>Prompt Title</h5>
                            <p>Text</p>
                        </td>
                        <td style="width: 300px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                            <h5>Prompt Title</h5>
                            <p>Text</p>
                        </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <br>

    <div class="spoiler border-ilblue" style="border-width:2px">
        <div class=arrow>
            <div data-toggle="collapse" data-target="#viewgrow" class="spoiler-toggle">Isoling Grow-Up&nbsp;&nbsp;</div>
            <div class="collapse spoiler-text" id="viewgrow" style="display: none;">

                <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
                    <thead>
                        <tr style="height: 20px;">
                        <td style="width: 300px; height: 15px; text-align: center;">
                            <a href="/prompts/50"><img src="/images/data/awards/35-image.png" width="125px" /></a>
                        </td>
                        <td style="width: 300px; height: 15px; text-align: center;">
                            <a href=""><img src="/images/IsoLogo.png" width="150px" /></a>
                        </td>
                        <td style="width: 300px; height: 15px; text-align: center;">
                            <a href=""><img src="/images/IsoLogo.png" width="150px" /></a>
                        </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height: 30px;">
                        <td style="width: 300px; height: 30px; border-right: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                            <h5><a href="/prompts/50">A Lesson in Give & Take</a></h5>
                            <p>Every isoling needs to learn the value of sharing and helping their fellow villagers.</p>
                        </td>
                        <td style="width: 300px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                            <h5>Prompt Title</h5>
                            <p>Text</p>
                        </td>
                        <td style="width: 300px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                            <h5>Prompt Title</h5>
                            <p>Text</p>
                        </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <br>

    <div class="spoiler border-ilblue" style="border-width:2px">
        <div class=arrow>
            <div data-toggle="collapse" data-target="#viewedu" class="spoiler-toggle">Educational Intrigue&nbsp;&nbsp;</div>
            <div class="collapse spoiler-text" id="viewedu" style="display: none;">

                <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
                    <thead>
                        <tr style="height: 20px;">
                        <td style="width: 300px; height: 15px; text-align: center;">
                            <a href="/prompts/47"><img src="/images/data/awards/32-image.png" width="125px" /></a>
                        </td>
                        <td style="width: 300px; height: 15px; text-align: center;">
                            <a href=""><img src="/images/IsoLogo.png" width="150px" /></a>
                        </td>
                        <td style="width: 300px; height: 15px; text-align: center;">
                            <a href=""><img src="/images/IsoLogo.png" width="150px" /></a>
                        </td>
                        <td style="width: 300px; height: 15px; text-align: center;">
                            <a href="/prompts/48"><img src="/images/IsoLogo.png" width="150px" /></a>
                        </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height: 30px;">
                        <td style="width: 300px; height: 30px; border-right: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                            <h5><a href="/prompts/47">Fire Safety Training</a></h5>
                            <p>Learn the dangers of fire and the basics on how to carefully observe and use it.</p>
                        </td>
                        <td style="width: 300px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                            <h5>Prompt Title [WIP]</h5>
                            <p>Text</p>
                        </td>
                        <td style="width: 300px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                            <h5>Prompt Title [WIP]</h5>
                            <p>Text</p>
                        </td>
                        <td style="width: 300px; height: 30px; border-left: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                            <h5><a href="/prompts/48">Dumb Love</a></h5>
                            <p>A dozen bleppers are in your care. Watch over them and learn from their silly behavior.</p>
                        </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <br>

    <div class="spoiler border-ilblue" style="border-width:2px">
        <div class=arrow>
            <div data-toggle="collapse" data-target="#viewcourt" class="spoiler-toggle">Courtship Traditions&nbsp;&nbsp;</div>
            <div class="collapse spoiler-text" id="viewcourt" style="display: none;">
                <p>Building a family takes time and commitment between two Isomara. View the <a href="/info/court">Isomara courtship information here.</a></p>
                <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
                <tbody>
                    <tr style="height: 30px;">
                        <td style="width: 120px; height: 30px; text-align: center; vertical-align: top;">
                            <a href="/prompts/53"><img src="https://isomara-island.com/images/data/prompts/53-image.png" width="100px" /></a>
                        </td>
                    <td style="width: 300px; height: 30px; border-right: 1px solid #B0DFFF; text-align: center; vertical-align: top;">
                        <h5><a href="/prompts/53">Date #1 - First Encounters</a></h5>
                        <p>A fateful meeting, a planned arrangement, what was the couple's first date like?</p>
                    </td>
                    <td style="width: 120px; height: 30px; text-align: center; vertical-align: top;">
                        <a href="/prompts/52"><img src="https://isomara-island.com/images/data/prompts/52-image.png" width="100px" /></a>
                    </td>
                    <td style="width: 300px; height: 30px; text-align: center; vertical-align: top;">
                        <h5><a href="/prompts/52">Date #2 - A Rendezvous For Two</a></h5>
                        <p>Build the bonds of the Isomara couple by going on a 2nd date.</p>
                    </td>
                    </tr>
                </tbody>
                </table>

            </div>
        </div>
    </div>

    <hr>
    <h3>Monthly Mini Prompts</h3>
    <p>COMING SOON</p>

</div>

@endsection

@section('scripts')
@parent
    <script>
        $(document).ready(function() {
            var $submitButton = $('#submitButton');
            var $confirmationModal = $('#confirmationModal');
            var $formSubmit = $('#formSubmit');

            $submitButton.on('click', function(e) {
                e.preventDefault();
                $confirmationModal.modal('show');
            });

            $formSubmit.on('click', function(e) {
                e.preventDefault();
                $submissionForm.submit();
            });

            $('.is-br-class').change(function(e){
            console.log(this.checked)
            $('.br-form-group').css('display',this.checked ? 'block' : 'none')
                })
            $('.br-form-group').css('display',$('.is-br-class').prop('checked') ? 'block' : 'none')
        });
    </script>
@endsection
