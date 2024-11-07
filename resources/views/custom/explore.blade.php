@extends('layouts.app')

@section('content')

<style>
    div.a {
    text-indent: 40px;
    }
</style>


	<h3>Island Exploration</h3>
<hr>
<img width="300" align="right" src="https://pre00.deviantart.net/0752/th/pre/i/2015/263/4/c/exploring_the_beach_by_slayer4949-d9ac1pz.png">
<div align="center">
	<h4>What is Exploration?</h4>
	<p>Exploration is the act of searching the island for items.<br>By exploring a biome, you find items that you can use to eat, trade, sell, and craft into new things.</p>
</div>

<h4>How Does it Work?</h4>
	<div class="a" align="justify">
        Create a drawing or write a story about your Isomara exploring one of the biomes on the island. Once your artwork/story is complete and meets the requirements below, you can submit it, and when approved, you'll receive in-game goodies straight into your inventory!
    </div>
	<div class="a" align="justify">
        Include as many Isomara and companions as you want, as each one will contribute to the number of items you can find and bring back. The kind of items and their amounts found during explorations are randomly generated, and some items are more commonly found than others.
        You may have to do multiple explorations in one biome to find all the items you want. The complete list of items that can be found and their rarities are further below.
	</div>
<br>
<h4>Where can I Explore?</h4>
	<div class="a" align="justify">
        This is the map of Isomara Island, and within the key are the biomes, which you can explore. All areas can be explored except for the Goom Infected and Volcanic biome of Pelemoku, which are needed to be unlocked per Isomara.
    </div>
        <br>
	<div class="a" align="justify">
        To explore the Infected island off the coast, all Isomara must have the <a href="/world/awards/4">Ally of Goo</a> achievement.
        The island of Pelemoku is labeled as the volcanic biome which appeared during a past eruption event, and Isomara will need the <a href="/world/awards/11">Island Hopper</a> achievement to explore that biome.
        Keep an eye out for future events, which sometimes will temporarily grant all Isomara access to these locked biomes without needing the corresponding achievements.
	</div>
    <br>
        <a href="/island"><div align="center"><img src="{{ asset('images/2023_Map.png') }}" width="90%" /></div></a>
    <br>
<h4>Exploration Requirements:</h4>
    <div align="justify">
        <b>Visual Art Base Requirements</b>
    </div>
    <ul>
        <li>Simple Background</li>
        <li>1+ Isomara; full-bodied; Color</li>
    </ul>

    <div align="justify">
        <b>Backgrounds</b>
    </div>
    <div class="a" align="justify">
        When drawing an exploration picture, the background must depict what biome is being explored (For example, you wouldn’t draw your Isomara in an alpine tundra when exploring the ocean).
        One can take plenty of artistic liberty when depicting any biome as long as it can be partially identifiable with the biome you claim to explore.
        <br>
        Isomara are the ones that find and bring back items. Each exploration needs at least one Isomara; it can be an Isomara you own, another player (<span style="color:#007bff" data-toggle="tooltip" title="The top right of a character's masterlist will have icons that display whether their owner gives permission for others to use their character in various activties."><i>If permission allows</i></span>), or an <a href="">NPC</a>.
        <br><br>
    </div>
    <div class="a" align="justify">
        <b>Note:</b> <span style="color:#007bff" data-toggle="tooltip" title="child age Isomara">Isolings</span> cannot explore alone! All Isolings must be accompanied by at least one adult Isomara when exploring. Feel free to use any NPC if you do not own an adult Isomara.
        The exception to this is if your Isoling is part of a team in the <a href="">Isoling Club</a>. Cadet Rank Isolings in a team do not need an adult but do need to be accompanied by at least one other Isoling of their team. Major and General Rank Isolings are specially equipped to handle themselves and do not need an adult or any other Isoling to accompany them.
    </div>
    <br>
    <div align="justify">
        <b>Literature Base Requirements </b>
    </div>
    <ul>
        <li>400+ Words</li>
        <li>1+ Isomara</li>
    </ul>

    <div align="justify">
        For exploration stories, all literature needs to be at least 400 words long. Written explorations also need to include some short description of the scenery of the biome in which the story takes place.
        A few descriptive words or even a single sentence can indicate the biome being explored.
    </div>
<br>
<div style="float:right; margin-left:-60px"><div align="right"><img src="{{ asset('images/tutorial/exploretut2.png') }}" width="65%" /></div></div>
<h4>Submitting Your Exploration</h4>
<div class="a" align="justify">
    Submit your exploration drawing/story by selecting Submit in the top right-hand of the navigation bar, just to the right of your username and avatar. Then select Submit Activity from the dropdown or click <a href="/submissions/new">Submit Exploration here</a>.
    <br><br>
</div>
<div class="a" align="justify">(1) Choose the type of exploration on the New Activity Submission page from the Prompt dropdown; this will be the biome you are depicting in your submission (Example: Explore - Coral Reef).</div>
    <div class="a" align="justify">(2) Link your art/literature in the Submission URL field. You can link art and literature from places such as DeviantArt, the <a href="/gallery">art gallery</a>, <a href="/forum">forums</a>, or other hosting sites.</div>
    <div class="a" align="justify">(3) Add any additional comments you may have.</div><br>
<div class="a" align="justify">
    The following section is for you to list all characters included in the submission. You will not receive rewards for any characters left out. As exploration rewards increase with more characters, including all characters in your submission is best.<br>
    Leave Focus set to No for all characters and character rewards blank.</div>
<div class="a" align="justify">
    Lastly, leave the rewards and add-on sections alone, as the activity already has the default rewards filled out for you, and a staff member will change the reward amount if needed.<br><br>
    Once the above is complete, click the blue submit button to send your entry to the queue for approval, and you are done!
</div>
@if(Auth::user())
<br><br><a href="/hunts/targets/tCxA6ILoW2"><img style="float:left" src="/images/data/items/220-image.png" alt="Cicada" height="115"/></a>
@else
@endif

<hr>

<h4>What can I do with the items I get from exploration?</h4>
<div class="a" align="justify">
	The items you find on your explorations can be used to craft other items like food, clothes, and tools to benefit your Isomara and companions. You can <a href="/trades/open">trade items</a> with other members or sell them through <a href="/inventory">your inventory</a>.
</div>
<div class="a" align="justify">
	The main focus of items in the game is for use on your characters. There are materials to create gear and tools that can be equipped to Isomara and some companion species.
	Various kinds of concoctions, accessories, and meals in the ARPG can be made and bought using what you find on the island. The items you find may also be essential for events.
One core use for many items is keeping your Isomara well-fed. Every activity you complete will make your Isomara hungrier. Various edible items can be consumed to raise your Isomara's <a href="/info/hunger">hunger</a> and stats. You can view all the items and their uses here in the <a href="/world">encyclopedia</a>.
</div>


<hr>

<div class="row">
    <div class="col-sm-6">
        <div class="card border-ilblue">
            <div class="card-body">
            <h2 class="card-title">Beach</h2>
                <div class="a" align="justify">
                    <p>The shores along the coast are littered with seashells, the main currency of the Isomara species, along with other useful crafting materials and sometimes washed-up goodies from the ocean. Be wary, as sometimes seagulls will be irritated by your presence.</p>
                    <h5>Rarity: COMMON</h5>
                        <div align="center">
                            <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Seashells" alt="Seashells"/></a>
                            <a href="/world/items/49"><img class="img-responsive" style="width: 90px" src="images/data/items/49-image.png" data-toggle="tooltip" title="Eggshells" alt="Eggshells"/></a>
                            <a href="/world/items/53"><img class="img-responsive" style="width: 90px" src="images/data/items/53-image.png" data-toggle="tooltip" title="Feathers" alt="Feathers"/></a>
                            <a href="/world/items/92"><img class="img-responsive" style="width: 90px" src="images/data/items/92-image.png" data-toggle="tooltip" title="Kelp" alt="Kelp"/></a>
                            <a href="/world/items/137"><img class="img-responsive" style="width: 90px" src="images/data/items/137-image.png" data-toggle="tooltip" title="Sand" alt="Sand"/></a>
                        </div>
                        <br>
                    <h5>Rarity: UNCOMMON</h5>
                        <div align="center">
                            <a href="/world/items/45"><img class="img-responsive" style="width: 90px" src="images/data/items/45-image.png" data-toggle="tooltip" title="Driftwood" alt="Driftwood"/></a>
                            <a href="/world/items/163"><img class="img-responsive" style="width: 90px" src="images/data/items/163-image.png" data-toggle="tooltip" title="Teeth" alt="Teeth"/></a>
                            <a href="/world/items/27"><img class="img-responsive" style="width: 90px" src="images/data/items/27-image.png" data-toggle="tooltip" title="Coconut" alt="Coconut"/></a>
                        </div>
                        <br>
                    <h5>Rarity: RARE</h5>
                        <div align="center">
                            <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Goo" alt="Goo"/></a>
                            <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/currencies/2-image.png" data-toggle="tooltip" title="Sand Dollar" alt="Sand Dollar"/></a>
                            <a href="/world/items/39"><img class="img-responsive" style="width: 90px" src="images/data/items/39-image.png" data-toggle="tooltip" title="Crab" alt="Crab"/></a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card border-ilblue">
            <div class="card-body">
            <h2 class="card-title">Ocean</h2>
                <div class="a" align="justify">
                <p>Although vast and seemingly desolate, the oceans are brimming with nutritious creatures and valuable materials. It's a good thing Isomara are semi-aquatic creatures and can easily maneuver within the water. Careful, though; the further out to sea, the more dangerous it is.</p>
                <h5>Rarity: COMMON</h5>
                    <div align="center">
                        <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Seashells" alt="Seashells"/></a>
                        <a href="/world/items/92"><img class="img-responsive" style="width: 90px" src="images/data/items/92-image.png" data-toggle="tooltip" title="Kelp" alt="Kelp"/></a>
                        <a href="/world/items/36"><img class="img-responsive" style="width: 90px" src="images/data/items/36-image.png" data-toggle="tooltip" title="Coral" alt="Coral"/></a>
                        <a href="/world/items/137"><img class="img-responsive" style="width: 90px" src="images/data/items/137-image.png" data-toggle="tooltip" title="Sand" alt="Sand"/></a>
                    </div>
                    <br>
                <h5>Rarity: UNCOMMON</h5>
                    <div align="center">
                        <a href="/world/items/150"><img class="img-responsive" style="width: 90px" src="images/data/items/150-image.png" data-toggle="tooltip" title="Skrill" alt="Skrill"/></a>
                        <a href="/world/items/139"><img class="img-responsive" style="width: 90px" src="images/data/items/139-image.png" data-toggle="tooltip" title="Scallop" alt="Scallop"/></a>
                        <a href="/world/items/24"><img class="img-responsive" style="width: 90px" src="images/data/items/24-image.png" data-toggle="tooltip" title="Clam" alt="Clam"/></a>
                        <a href="/world/items/45"><img class="img-responsive" style="width: 90px" src="images/data/items/45-image.png" data-toggle="tooltip" title="Driftwood" alt="Driftwood"/></a>
                    </div>
                    <br>
                <h5>Rarity: RARE</h5>
                    <div align="center">
                        <a href="/world/items/152"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Squid" alt="Squid"/></a>
                        <a href="/world/items/100"><img class="img-responsive" style="width: 90px" src="images/data/items/100-image.png" data-toggle="tooltip" title="Lobster" alt="Lobster"/></a>
                        <a href="/world/items/39"><img class="img-responsive" style="width: 90px" src="images/data/items/39-image.png" data-toggle="tooltip" title="Crab" alt="Crab"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-sm-6">
        <div class="card border-ilblue">
            <div class="card-body">
            <h2 class="card-title">Forest</h2>
                <div class="a" align="justify">
                <p>Scattered woods and forests cover more land than any other biome on the island. The forest hides countless lively critters, materials, and bountiful acres of fruits and vegetables. The forest is a favored biome to explore for both novice and master explorers.</p>
                <h5>Rarity: COMMON</h5>
                    <div align="center">
                        <a href="/world/items/13"><img class="img-responsive" style="width: 90px" src="images/data/items/13-image.png" data-toggle="tooltip" title="Berries" alt="Berries"/></a>
                        <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Seashells" alt="Seashells"/></a>
                        <a href="/world/items/61"><img class="img-responsive" style="width: 90px" src="images/data/items/61-image.png" data-toggle="tooltip" title="Flowers" alt="Flowers"/></a>
                        <a href="/world/items/37"><img class="img-responsive" style="width: 90px" src="images/data/items/37-image.png" data-toggle="tooltip" title="Cotton" alt="Cotton"/></a>
                        <a href="/world/items/155"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Sticks" alt="Sticks"/></a>
                        <a href="/world/items/178"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Wheat" alt="Wheat"/></a>
                    </div>
                    <br>
                <h5>Rarity: UNCOMMON</h5>
                    <div align="center">
                        <a href="/world/items/184"><img class="img-responsive" style="width: 90px" src="images/data/items/184-image.png" data-toggle="tooltip" title="Wood" alt="Wood"/></a>
                        <a href="/world/items/107"><img class="img-responsive" style="width: 90px" src="images/data/items/107-image.png" data-toggle="tooltip" title="Mushrooms" alt="Mushrooms"/></a>
                        <a href="/world/items/106"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Moss" alt="Moss"/></a>
                    </div>
                    <br>
                <h5>Rarity: RARE</h5>
                    <div align="center">
                        <a href="/world/items/83"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Honeycomb" alt="Honeycomb"/></a>
                        <a href="/world/items/19"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Bone" alt="Bone"/></a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card border-ilblue">
            <div class="card-body">
            <h2 class="card-title">Jungle</h2>
                <div class="a" align="justify">
                <p>Dense jungle and marshy terrain take up a small portion of the island, but the thick coverage can easily render any Isomara lost if not keen in directions. The tall trees block most natural light, and predators often lurk in the shadows guarding their nests.</p>
                <h5>Rarity: COMMON</h5>
                    <div align="center">
                        <a href="/world/items/161"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Tall Grass" alt="Tall Grass"/></a>
                        <a href="/world/items/155"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Sticks" alt="Sticks"/></a>
                        <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Seashells" alt="Seashells"/></a>
                        <a href="/world/items/53"><img class="img-responsive" style="width: 90px" src="images/data/items/53-image.png" data-toggle="tooltip" title="Feathers" alt="Feathers"/></a>
                        <a href="/world/items/62"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Flowers" alt="Flowers"/></a>
                        <a href="/world/items/184"><img class="img-responsive" style="width: 90px" src="images/data/items/184-image.png" data-toggle="tooltip" title="Wood" alt="Wood"/></a>
                    </div>
                    <br>
                <h5>Rarity: UNCOMMON</h5>
                    <div align="center">
                        <a href="/world/items/107"><img class="img-responsive" style="width: 90px" src="images/data/items/107-image.png" data-toggle="tooltip" title="Mushrooms" alt="Mushrooms"/></a>
                        <a href="/world/items/106"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Moss" alt="Moss"/></a>
                        <a href="/world/items/176"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Vine" alt="Vine"/></a>
                    </div>
                    <br>
                <h5>Rarity: RARE</h5>
                    <div align="center">
                        <a href="/world/items/104"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Memic Egg" alt="Memic Egg"/></a>
                        <a href="/world/items/19"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Bone" alt="Bone"/></a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-sm-6">
        <div class="card border-ilblue">
            <div class="card-body">
            <h2 class="card-title">Mountain</h2>
                <div class="a" align="justify">
                    <p>Some say, why bother exploring in such a hazardous and rocky terrain? Well, those who do not know there are valuable goods in those caverns and tunnels. Only a few practical goods can be found on and in the mountains, but if you are hunting for something pretty or unique, you're in the correct biome.</p>
                <h5>Rarity: COMMON</h5>
                    <div align="center">
                        <a href="/world/items/134"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Rocks" alt="Rocks"/></a>
                        <a href="/world/items/171"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Turquoise" alt="Turquoise"/></a>
                        <a href="/world/items/35"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Copper" alt="Copper"/></a>
                    </div>
                    <br>
                <h5>Rarity: UNCOMMON</h5>
                    <div align="center">

                        <a href="/world/items/147"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Silver" alt="Silver"/></a>
                        <a href="/world/items/43"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Diamond" alt="Diamond"/></a>
                    </div>
                    <br>
                <h5>Rarity: RARE</h5>
                    <div align="center">
                        <a href="/world/items/67"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Gold" alt="Gold"/></a>
                        <a href="/world/items/168"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Topaz" alt="Topaz"/></a>
                        <a href="/world/items/138"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Sapphire" alt="Sapphire"/></a>
                        <a href="/world/items/50"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Emerald" alt="Emerald"/></a>
                        <a href="/world/items/135"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Ruby" alt="Ruby"/></a>
                        <a href="/world/items/7"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Amethyst" alt="Amethyst"/></a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card border-ilblue">
            <div class="card-body">
            <h2 class="card-title">Desert</h2>
                <div class="a" align="justify">
                    <p>Not all sand and sun as most think. The desert is blooming with unique flora used in medicinal treatments. There are even slight chances to stumble upon a rare oasis with sparkling fresh water, but be sure to bring your own just in case your luck runs sour.</p>
                    <h5>Rarity: COMMON</h5>
                    <div align="center">
                        <a href="/world/items/137"><img class="img-responsive" style="width: 90px" src="images/data/items/137-image.png" data-toggle="tooltip" title="Sand" alt="Sand"/></a>
                        <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Seashells" alt="Seashells"/></a>
                        <a href="/world/items/53"><img class="img-responsive" style="width: 90px" src="images/data/items/53-image.png" data-toggle="tooltip" title="Feathers" alt="Feathers"/></a>
                        <a href="/world/items/21"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Cactus Pear" alt="Cactus Pear"/></a>
                    </div>
                    <br>
                <h5>Rarity: UNCOMMON</h5>
                    <div align="center">
                        <a href="/world/items/6"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Aloe Vera" alt="Aloe Vera"/></a>
                        <a href="/world/items/5"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Agave" alt="Agave"/></a>
                        <a href="/world/items/169"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Tumbleweed" alt="Tumbleweed"/></a>
                    </div>
                    <br>
                <h5>Rarity: RARE</h5>
                    <div align="center">
                        <a href="/world/items/19"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Bone" alt="Bone"/></a>
                        <a href="/world/items/144"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Shell" alt="Shell"/></a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-sm-6">
        <div class="card border-ilblue">
            <div class="card-body">
            <h2 class="card-title">Snow</h2>
                <div class="a" align="justify">
                    <p>Even with an Isomara's thick coat and fluffy mane, many catch frostbite trekking out to the crisp snow-filled areas. Rare flora and edible fungi can be found here that can survive harsh climates, and snow is also a great way to gather fresh water.</p>
                    <h5>Rarity: COMMON</h5>
                    <div align="center">
                        <a href="/world/items/151"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Snow" alt="Snow"/></a>
                        <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Seashells" alt="Seashells"/></a>
                        <a href="/world/items/87"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Ice" alt="Ice"/></a>
                        <a href="/world/items/53"><img class="img-responsive" style="width: 90px" src="images/data/items/53-image.png" data-toggle="tooltip" title="Feathers" alt="Feathers"/></a>
                    </div>
                    <br>
                <h5>Rarity: UNCOMMON</h5>
                    <div align="center">
                        <a href="/world/items/184"><img class="img-responsive" style="width: 90px" src="images/data/items/184-image.png" data-toggle="tooltip" title="Wood" alt="Wood"/></a>
                        <a href="/world/items/107"><img class="img-responsive" style="width: 90px" src="images/data/items/107-image.png" data-toggle="tooltip" title="Mushrooms" alt="Mushrooms"/></a>
                        <a href="/world/items/106"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Moss" alt="Moss"/></a>
                        <a href="/world/items/60"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Flowering Quince" alt="Flowering Quince"/></a>
                    </div>
                    <br>
                <h5>Rarity: RARE</h5>
                    <div align="center">
                        <a href="/world/items/183"><img class="img-responsive" style="width: 90px" src="images/data/items/183-image.png" data-toggle="tooltip" title="Witch Hazel" alt="Witch Hazel"/></a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card border-ilblue">
            <div class="card-body">
            <h2 class="card-title">Coral Reef</h2>
                <div class="a" align="justify">
                    <p>Colorful schools of fish and bouquets of coral can be found mingling together. The reefs are often very safe places for young Isomara to find nutritious food quickly and in large quantities.</p>
                    <h5>Rarity: COMMON</h5>
                    <div align="center">
                        <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Seashells" alt="Seashells"/></a>
                        <a href="/world/items/92"><img class="img-responsive" style="width: 90px" src="images/data/items/92-image.png" data-toggle="tooltip" title="Kelp" alt="Kelp"/></a>
                        <a href="/world/items/36"><img class="img-responsive" style="width: 90px" src="images/data/items/36-image.png" data-toggle="tooltip" title="Coral" alt="Coral"/></a>
                        <a href="/world/items/150"><img class="img-responsive" style="width: 90px" src="images/data/items/150-image.png" data-toggle="tooltip" title="Skrill" alt="Skrill"/></a>
                    </div>
                    <br>
                <h5>Rarity: UNCOMMON</h5>
                    <div align="center">
                        <a href="/world/items/137"><img class="img-responsive" style="width: 90px" src="images/data/items/137-image.png" data-toggle="tooltip" title="Sand" alt="Sand"/></a>
                        <a href="/world/items/139"><img class="img-responsive" style="width: 90px" src="images/data/items/139-image.png" data-toggle="tooltip" title="Scallop" alt="Scallop"/></a>
                        <a href="/world/items/24"><img class="img-responsive" style="width: 90px" src="images/data/items/24-image.png" data-toggle="tooltip" title="Clam" alt="Clam"/></a>
                    </div>
                    <br>
                <h5>Rarity: RARE</h5>
                    <div align="center">
                        <a href="/world/items/100"><img class="img-responsive" style="width: 90px" src="images/data/items/100-image.png" data-toggle="tooltip" title="Lobster" alt="Lobster"/></a>
                        <a href="/world/items/39"><img class="img-responsive" style="width: 90px" src="images/data/items/39-image.png" data-toggle="tooltip" title="Crab" alt="Crab"/></a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-sm-6">
        <div class="card border-ilblue">
            <div class="card-body">
            <h2 class="card-title">Infected</h2>
                <div class="a" align="justify">
                <p>Originating from a small island off the coast this dense forest biome has been altered to suitably home Gooms and ward off predators. The sand and vegetation has all taken to an unnatural light teal color hue due to the goo from the native Goom species.
                The water around the area is poisonous and prolonged exposure could sicken any creature not immune. Gooms call this small island home and work to keep their ecosystem stable. Isomara are unable to live in Goom Infected biomes. Any trespassers will be attacked by Gooms relentlessly.
                <br>Isomara may only explore here if they've earned the <a href="/world/awards/4">Ally of Goo</a> achievement or during some events.</p>
                <h5>Rarity: COMMON</h5>
                <div align="center">
                    <a href="/world/items/161"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Tall Grass" alt="Tall Grass"/></a>
                    <a href="/world/items/137"><img class="img-responsive" style="width: 90px" src="images/data/items/137-image.png" data-toggle="tooltip" title="Sand" alt="Sand"/></a>
                    <a href="/world/items/36"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Grapes" alt="Grapes"/></a>
                    <a href="/world/items/155"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Sticks" alt="Sticks"/></a>
                </div>
                <br>
            <h5>Rarity: UNCOMMON</h5>
                <div align="center">
                    <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Goo" alt="Goo"/></a>
                    <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Seashells" alt="Seashells"/></a>
                    <a href="/world/items/155"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Oranges" alt="Oranges"/></a>
                    <a href="/world/items/155"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Peanuts" alt="Peanuts"/></a>
                    <a href="/world/items/176"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Vine" alt="Vine"/></a>
                </div>
                <br>
            <h5>Rarity: RARE</h5>
                <div align="center">
                    <a href="/world/items/155"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Grapefruit" alt="Grapefruit"/></a>
                    <a href="/world/items/155"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Potatoes" alt="Potatoes"/></a>
                    <a href="/world/items/155"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Ectoplasm" alt="Ectoplasm"/></a>
                </div>
                <br>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card border-ilblue">
            <div class="card-body">
            <h2 class="card-title">Volcanic</h2>
                <div class="a" align="justify">
                <p>The minor island, Pelemoku, emerged recently from the sea after an underwater volcanic eruption. After the heat and magma cooled, new and unique flora and fauna quickly sprouted across Pelemoku.
                    Explorations on Pelemoku are kept short as the small island volcano is still very active, with rumbling heard even at the base. <br>
                    Isomara may only explore here if they have earned the <a href="/world/awards/11">Island Hopper</a> achievement.</p>
                    <h5>Rarity: COMMON</h5>
                    <div align="center">
                        <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Seashells" alt="Seashells"/></a>
                        <a href="/world/items/137"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Kiwi" alt="Kiwi"/></a>
                        <a href="/world/items/36"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Sweet Potatoes" alt="Sweet Potatoes"/></a>
                        <a href="/world/items/61"><img class="img-responsive" style="width: 90px" src="images/data/items/61-image.png" data-toggle="tooltip" title="Flowers" alt="Flowers"/></a>
                    </div>
                    <br>
                <h5>Rarity: UNCOMMON</h5>
                    <div align="center">
                        <a href="/world/items/111"><img class="img-responsive" style="width: 90px" src="images/data/items/111-image.png" data-toggle="tooltip" title="Obsidian" alt="Obsidian"/></a>
                        <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Watermelon" alt="Watermelon"/></a>
                        <a href="/world/items/163"><img class="img-responsive" style="width: 90px" src="images/data/items/163-image.png" data-toggle="tooltip" title="Teeth" alt="Teeth"/></a>
                        <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Vine" alt="Vine"/></a>
                    </div>
                    <br>
                <h5>Rarity: RARE</h5>
                    <div align="center">
                        <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Bone" alt="Bone"/></a>
                        <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Red Dacca" alt="Red Dacca"/></a>
                        <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Pineapple" alt="Pineapple"/></a>
                        <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Gold" alt="Gold"/></a>
                        <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/items/39-image.png" data-toggle="tooltip" title="Crab" alt="Crab"/></a>
                        <a href="/world/currencies"><img class="img-responsive" style="width: 90px" src="images/data/items/100-image.png" data-toggle="tooltip" title="Sand Dollar" alt="Sand Dollar"/></a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="col-sm-12">
    <div class="card border-ilblue">
        <div class="card-body">
        <h2 class="card-title">Legendary Fruits</h2>
            <div class="a" align="justify">
            <p>Two exceedingly scarce fruits, the Dragon  can be found anywhere on the island. No plant has been found to grow these unique fruits, seemingly found in random places lying on the ground.</p>
            <div align="center">
                <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Dragon Fruit" alt="Dragon Fruit"/></a>
                <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Star Fruit" alt="Star Fruit"/></a>
            </div>
        </div>
        </div>
    </div>
</div>

<hr>

<div class="col-sm-12">
    <div class="card border-ilblue">
        <div class="card-body">
        <h2 class="card-title">Findings of Adept Explorers</h2>
            <div class="a" align="justify">
            <p>The entire island has more than just the above. There are some items only Isomara, with qualified skills, can find and collect. An Isomara should enroll in one of the many <a href="">classes<a> to learn to locate hard-to-spot foods or catch slippery fish.
                Classes give unique perks and rewards per level, which enhance other activities.
            <br>
                These are just some of the items that Isomara enrolled in classes can find during explorations:</p>
            <div align="center">
                <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Lemons" alt="Lemons"/></a>
                <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Carrots" alt="Carrots"/></a>
                <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Mangoes" alt="Mangoes"/></a>
                <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Sugar Cane" alt="Sugar Cane"/></a>
                <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Goom Orb" alt="Goom Orb"/></a>
                <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Salmon" alt="Salmon"/></a>
                <a href="/world/items/70"><img class="img-responsive" style="width: 90px" src="images/data/currencies/1-image.png" data-toggle="tooltip" title="Tuna" alt="Tuna"/></a>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
