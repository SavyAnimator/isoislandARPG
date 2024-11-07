@extends('layouts.app')

@section('content')

<style>
    div.a {
      text-indent: 40px;
    }
    div.b {
      text-indent: 60px;
    }
    /*Table Styling*/
    table {
        border-collapse: collapse;
        width: 100%;
    }
    td, th {
        vertical-align: top;
        padding: 10px;
    }
    ul {
        list-style: disc;
        display: inline-block;
    }
    table td + td:nth-of-type(2n){
        border-right:1px solid #B0DFFF;
    }

    .fakeimg {
            background-color: rgb(59, 183, 237);
            width: 100px;
            height:100px;
        }
</style>

@if(Auth::user())
        <a href="/hunts/targets/2A1piUW1cL"><img style="position: fixed; bottom: 5%; right: 19%;" src="/images/data/items/219-image.png" alt="Mantis" height="115"/></a>
        <a href="https://isomara-island.com/hunts/targets/vJFLggmMiw"><img style="position: absolute; z-index: 4; top: 50%; left: 8%;" src="{{ asset('images/hunts/KiwiDai.png') }}" height="50"/></a>
@else
@endif
    <h1>Training</h1>
<hr>
<div align="center">
	<h4>What is Training?</h4>
	<p>Training is learning a particular skill or type of behavior and improving one's ability to survive and adapt.</p>
</div>
<h4>How Does it Work, and what counts as training?</h4>
    <p>
        <div class="a" align="justify">
            To train a character, imagine them performing a task or action that could involve one of the attributes listed below, then create a drawing or write a story about them performing or improving it. Once your artwork/story is complete and meets the requirements below, you can submit it, and when approved, all characters involved will receive stat points added to their stat pool.
            <br><img style="float:right; width:17%; padding:10px" src="{{ asset('images/tutorial/trainimg2.png') }}"/><br>
            Training characters owned by you, another player*, or <a href="/NPCs">NPCs</a> is allowed.
        </div>
        <div class="a" align="justify">
            *To check if another player enables their character to be trained by others, go to the character's master list page. On the top right of the page will be a series of icons. The dumbbell icon is for training, and the different colors will signify if the character owner permits others to include their character in trainings.
        </div>
            <br>
        <div class="a" align="justify">
            <b>Note:</b> Isolings (child-aged Isomara) cannot train alone! All Isolings must be supervised by at least one adult Isomara when training. Feel free to use any NPC if you do not own an adult Isomara. The exception to this is if your Isoling is part of a team in the Isoling Club [WIP]. Cadet Rank Isolings in a team do not need an adult but do need to be accompanied by at least one other Isoling of their team. Major and General Rank Isolings are specially equipped to handle themselves and do not need an adult or any other Isoling to accompany them.
        </div>
            <br>
        <div class="a" align="justify">
            Training could mean having them punch a tree, improving their courage by standing up to something that scares them, lifting objects, blocking incoming projectiles and attacks, resisting a force, etc. Training could also be as simple as running, or flying or as intricate as navigating an obstacle course, bounding from tree to tree, or examining and observing their surroundings. If a task or action can hone or improve a character's skills or count as exercise for their brain or body, that counts as training!
        </div>
            <br>
        <div class="a" align="justify">
            As the island is not very advanced, you may want to avoid the modern-day appearance of books, technology, and machinery if you want to stay true to the tribal setting. Overall, be creative with what you add to your training and have fun. You do not have to specify the stat your training; all stat points earned are funneled into the stat pool, where you can divide them out how you see fit.
        </div>
    </p>
    <br>
<hr>
<h4>Stat Gains:</h4>
    <p>
        <img style="float:right; width:40%; padding:10px" src="{{ asset('images/tutorial/trainimg1.png') }}"/>
        <div class="a" align="justify">
            After submitting a training, the characters involved will be rewarded with a number of stat points. Various factors, such as age and hunger, determine the point gain. Once the stat gain is calculated, the points are added to the character's stat pool. The stat pool can be located on a character's profile page, which you can assign as seen fit into each stat.
        </div>
        <div class="a" align="justify">
            Once assigned to fight or flight, stat points cannot be removed or exchanged for another stat without using a Realign Elixir. This item will cause all points to be placed back into the stat pool to be reassigned.
        </div>
        <div class="a" align="justify">
        Companion species such as Gooms, Memora, Memics, and Bleppers do not have stat pools, and while they can be included in training submissions, they will not earn any stat points.
        </div>
    </p>

    <p style="padding-left:20px">
        Stats are divided into two attributes: <b>Fight</b> and <b>Flight</b>.<br>
        These two stats can be interpreted in many ways and provide a wide and open canvas for an artist's imagination.
    </p>
    <div class="a" align="justify">
        <u>Fight could be considered:</u>
    </div>
        <div class="b" align="justify">
            Strength, Defense, Constitution, Willpower
        </div>
    <div class="a" align="justify">
        <u>Flight is often associated as:</u>
    </div>
        <div class="b" align="justify">
            Dexterity, Perception, Agility, Stamina, Charisma
        </div>
</p>
<p  style="padding-left:20px">
    "Strength is being able to crush a tomato. Dexterity is being able to dodge a tomato.
    Constitution is being able to eat a bad tomato. Intelligence is knowing a tomato is a fruit.
    Wisdom is knowing not to put a tomato in a fruit salad. Charisma is being able to sell a tomato-based fruit salad."
    - <a href="https://www.reddit.com/r/DnD/comments/1s9l2g/dd_stats_explained_with_tomatoes/">Quote Source</a>
</p>
<div  style="padding-left:20px">
</div>

<h5>
Stat points gained per training changes based on a few variables:
</h5>
<table>
    <tbody>
        <tr>
            <td style="width: 10%; vertical-align:middle; text-align: right">
                <img class="fakeimg" style="margin-right: auto; margin-left: auto"/>
            </td>
            <td style="width: 23%; text-align: center">
                <ul>
                    <h5 style="margin-top: 10px"><u>Age</u></h5>
                        <li>Isolings base 2 stat gain</li>
                        <li>Adults base 3 stat gain</li>
                </ul>
            </td>
            <td style="width: 10%; vertical-align:middle; text-align: right">
                <img src="https://isomara-island.com/files/icon_deu.png" style="width: 110px;margin-right: auto; margin-left: auto"/>
            </td>
            <td style="width: 23%; text-align: center">
                <ul>
                    <h5 style="margin-top: 10px"><u>Species / Breed</u></h5>
                        <li>Deustrum Isomara grant +1 to each other Isomara (stackable)</li>
                        {{--<li>Abyssals grant +1 to other Swimmer Isomara (one time, not stackable)</li>
                        <li>Havens grant +1 to other Flyer Isomara (one time, not stackable)</li>
                        <ul>
                            <li>Abyssal and Haven bonus does not effect Deustrum Isomara</li>
                        </ul>--}}
                </ul>
            </td>
            <td style="width: 10%; vertical-align:middle; text-align: right">
                <img src="https://isomara-island.com/files/Ailments/AI_UpsetStomach.png" style="width: 110px; margin-right: auto; margin-left: auto"/>
            </td>
            <td style="width: 23%; text-align: center">
                <ul>
                    <h5 style="margin-top: 10px"><u><a href="/info/hunger">Hunger</a></u></h5>
                        <li>Starving -1</li>
                        <li>Peckish +0</li>
                        <li>Satisfied +0</li>
                        <li>Full +1</li>
                        <li>Stuffed +2</li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td style="width: 10%; vertical-align:middle; text-align: right">
                <img class="fakeimg" style="margin-right: auto; margin-left: auto"/>
            </td>
            <td style="width: 40%; text-align: center; border-right:1px solid #B0DFFF;">
                <ul>
                    <h5 style="margin-top: 10px"><u>Items</u></h5>
                        <li>Equipment</li>
                        <li>Accessories</li>
                        <li>Consumables</li>
                </ul>
                <br>Some items, when equipped, grant bonuses to the character or whole party.
                <br>There are edible items which grant stat points upon eating
            </td>
            <td style="width: 10%; vertical-align:middle; text-align: right">
                <img src="https://isomara-island.com/images/data/awards/3-image.png" style="width: 110px; margin-right: auto; margin-left: auto"/>
            </td>
            <td style="width: 40%; text-align: center">
                <ul>
                    <h5 style="margin-top: 10px"><u>Achievements</u></h5>
                        <li><a href="/world/awards/3">100 in Both Stats</a> grants double the stat points from training</li>
                        <li><a href="/world/awards/17">Sting or String</a> +1 stat pt when training with Memora companions</li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>

    <hr>

<h4>Training Requirements:</h4>

    <b style="padding-left:20px">Visual Art Base Requirements</b>
        <div>
            <ul style="padding-left:60px">
                <li>Simple Background</li>
                <li>1+ Isomara; full bodied</li>
            </ul>
        </div>
    <b style="padding-left:20px">Literature Base Requirements</b>
        <div>
            <ul style="padding-left:60px">
                <li>350+ Words per 1 Isomara per 1 training</li>
            </ul>
        </div>

    <div class="a" align="justify">
        A training story needs to be at least 350 words long per character being trained per training. If adding more trainable characters or wanting to train a character more than once in a training submission, then an additional 350 words must be added per character or additional training.    </div>
    <br>

    <p style="padding-left:40px">
    <b>Examples:</b>
        <ol style="padding-left:80px">
            <li>A story with <b>two Isomara</b>, each <b>training twice</b>, would need to be at least <b>1,400 words</b> long (2(350)+2(350)=1,400)</li>
            <li><b>Three Isomara</b> and two goom <b>training once</b> each ≥ 1,050 words ( 3x350=1050 - Gooms and other companions who do not have stat pools do not count towards the needed word count)</li>
            <li>One Isomara training five times ≥ 1,750 words</li>
        </ol>

    </p>
    <b>Note:</b> You may only train up to eight (8) different characters per image/story (These eight do not count companions which do not have stat pools). If you include more than eight characters in training, please specify which ones are being trained.
    <br><br>

    <div style="float:right; margin-left:-60px"><div align="right"><img src="{{ asset('images/tutorial/trainimg3.png') }}" width="65%" /></div></div>
<h4>Submitting Your Training</h4>
    <div class="a" align="justify">
        Submit your training drawing/story by selecting Submit in the top right-hand of the navigation bar, just to the right of your username and avatar. Then select Submit Activity from the dropdown or click <a href="/submissions/new">Submit Training here</a>.
        <br><br>
    </div>
    <div class="a" align="justify">(1) In on the New Activity Submission page select Training from the Prompt dropdown or type Training.</div>
        <div class="a" align="justify">(2) Link your artwork or literature in the Submission URL field.</div>
            <div style="padding-left:60px" align="justify">You can link art and stories from places such as DeviantArt, the <a href="/gallery">art gallery</a>, the <a href="/forum">forums</a>, or other hosting sites.</div>
        <div class="a" align="justify">(3) Add any additional comments you may have.</div><br>
    <div class="a" align="justify">
        List all characters included in the submission in the following field. Any characters left out will not receive any stat gain for their participation. Leave Focus set to No for all characters and character rewards blank.</div>
    <div class="a" align="justify">
        Lastly, leave the rewards and add-on sections alone, as stat points will be calculated by a staff member and will be the one to change the reward amount.<br><br>
        Once the above is complete, click the blue submit button to send your entry to the queue for approval, and you are done!
    </div>
<br>
    <hr>
<h4>Training Milestones:</h4>
    <p>
        <div class="a" align="justify">
            After enough training Isomara are able to earn achievements and have other opportunities open up to them!
        </div>
        <br>
            <ul style="padding-left:80px">
                <li>Reaching 10 in both fight and flight completes one of the prerequisites to voyaging</li>
                <li>After reaching 35 in either stat Isomara can now participate in [Dungeon Dash] [WIP]</li>
                <li>Once an Isomara has 100 in both stats, their training gain will be doubled from that point on!</li>
                <li>There are also training related achievements which grant perks to Isomara:</li>
            </ul>
        <br>
        <p style="padding-left:60px">
        <a href="/world/awards/2"><img src="/images/data/awards/2-image.png"></a>
        <a href="/world/awards/21"><img src="/images/data/awards/21-image.png"></a>
        <a href="/world/awards/22"><img src="/images/data/awards/22-image.png"></a>
        <a href="/world/awards/3"><img src="/images/data/awards/3-image.png"></a>
        <br>
        </p>
    </p>
@endsection
