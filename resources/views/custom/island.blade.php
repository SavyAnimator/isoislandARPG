@extends('layouts.app')
@section('content')

<style>
    p.a {
      text-indent: 40px;
      line-height: 0.9;
    }
    p.b {
      text-indent: 20px;
    }
</style>

<div align="center"><img src="{{ asset('images/2023_Map.png') }}" width="100%" /></div>

<h1>Biomes</h1>
<hr>

<div class="row">
    <div class="col">
        <h2>Beach</h2>
        <p class="b" align="justify">The shores along the coast are littered with seashells, the main <a href="/info/currency">currency</a> of the Isomara species, along with other useful crafting materials and sometimes washed-up goodies from the ocean. Be wary, as sometimes seagulls will be irritated by your presence.</p>
        <p class="a"><b>Inhabitants:</b> Isomara, Gooms, Seagulls, Tormuga, Crabs, Cloud Hoppers</p>
        <p class="a"><b>Notable Locations:</b> <a href="/shops/7">Slay's Concessions</a> / <a href="pool">Tide Pool's</a></p>
        <hr>
    </div>
    <div class="col">
        <h2>Ocean</h2>
        <p class="b" align="justify">Although vast and seemingly desolate, the oceans are brimming with nutritious creatures and valuable materials. It's a good thing Isomara are semi-aquatic creatures and can easily maneuver within the water. Careful, though; the further out to sea, the more dangerous it is.</p>
        <p class="a"><b>Inhabitants:</b> Isomara, Sharks, Seagulls, Skrill, Crabs, Cloud Hoppers</p>
        <p class="a"><b>Notable Locations:</b> None At This Time</p>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Forest</h2>
        <p class="b" align="justify">Scattered woods and forests cover more land than any other biome on the island. The forest hides countless lively critters, materials, and bountiful acres of fruits and vegetables. The forest is a favored biome to explore for both novice and master explorers.</p>
        <p class="a"><b>Inhabitants:</b> Isomara, Humbles, Memoras, Memics, Boars, Rabbits</p>
        <p class="a"><b>Notable Locations:</b> <a href="/shops/1">Pacings' Shop</a> / <a href="/shops/8">Carmen's Fabrication Station</a> / <a href="/adoptions">The Daycare</a></p>
        <hr>
    </div>
    <div class="col">
        <h2>Jungle / Marsh</h2>
        <p class="b" align="justify">Dense jungle and marshy terrain take up a small portion of the island, but the thick coverage can easily render any Isomara lost if not keen in directions. The tall trees block most natural light, and predators often lurk in the shadows guarding their nests.</p>
        <p class="a"><b>Inhabitants:</b> Isomara, Humbles, Memoras, Memics, Bleppers, Boars, Bitter Bytes</p>
        <p class="a"><b>Notable Locations:</b> <a href="/shops/2">Hasha's Hut</a> / <a href="/shops/4">Thyme's Taming Tavern</a></p>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Mountain</h2>
        <p class="b" align="justify">Some say, why bother exploring in such a hazardous and rocky terrain? Well, those who do not know there are valuable goods in those caverns and tunnels. Only a few practical goods can be found on and in the mountains, but if you are hunting for something pretty or unique, you're in the correct biome.</p>
        <p class="a"><b>Inhabitants:</b> Memoras, Memics, Bats</p>
        <p class="a"><b>Notable Locations:</b> <a href="/shops/5">Charlotte's Iron Emporium</a> / <a href="/cache">Queen's Cache</a></p>
        <hr>
    </div>
    <div class="col">
        <h2>Desert</h2>
        <p class="b" align="justify">Not all sand and sun as most think. The desert is blooming with unique flora used in medicinal treatments. There are even slight chances to stumble upon a rare oasis with sparkling fresh water, but be sure to bring your own just in case your luck runs sour.</p>
        <p class="a"><b>Inhabitants:</b> Tortoises, Memoras, Boars</p>
        <p class="a"><b>Notable Locations:</b> <a href="/shops/3">Darwin's Exchange Center</a> / <a href="/shops/donation-shop">Darwin's Donations</a></p>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Fross (Snow)</h2>
        <p class="b" align="justify">Even with fluffy manes, many Isomara catch frostbite trekking out to the crisp snow-filled areas. Rare flora and edible fungi can survive in this harsh climate, and snow is also a great way to gather fresh water.</p>
        <p class="a"><b>Inhabitants:</b> Isomara, Tormuga, Rabbits</p>
        <p class="a"><b>Notable Locations:</b> None At This Time</p>
        <hr>
    </div>
    <div class="col">
        <h2>Coral Reef</h2>
        <p class="b" align="justify">Colorful schools of fish and bouquets of coral can be found mingling together. The reefs are often very safe places for young Isomara to find nutritious food quickly and in large quantities.</p>
        <p class="a"><b>Inhabitants:</b> Sharks, Skrill, Crabs</p>
        <p class="a"><b>Notable Locations:</b> None At This Time</p>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Goom Island (Infected)</h2>
        <p class="b" align="justify">Originating from a small island off the coast this dense forest biome has been altered to suitably home Gooms and ward off predators. The sand and vegetation has all taken to an unnatural light teal color hue due to the goo from the native Goom species.
            The water around the area is poisonous and prolonged exposure could sicken any creature not immune. Gooms call this small island home and work to keep their ecosystem stable. Isomara are unable to live in Goom Infected biomes. Any trespassers will be attacked by Gooms relentlessly.</p>
        <p class="a"><b>Inhabitants:</b> Gooms, Tormuga, Crabs</p>
        <p class="a"><b>Notable Locations:</b> None At This Time</p>
    </div>
    <div class="col">
        <h2>Pelemoku (Volcanic)</h2>
        <p class="b" align="justify">The minor island, Pelemoku, emerged recently from the sea after an underwater volcanic eruption. After the heat and magma cooled, new and unique flora and fauna quickly sprouted across Pelemoku.
            Explorations on Pelemoku are kept short as the small island volcano is still very active, with rumbling heard even at the base.</p>
        <p class="a"><b>Inhabitants:</b> Bleppers, Seagulls, Humbles, Crabs</p>
        <p class="a"><b>Notable Locations:</b> None At This Time</p>
    </div>
</div>
@endsection
