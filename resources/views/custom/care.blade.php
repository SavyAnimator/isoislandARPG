@extends('layouts.app')

@section('content')

<style>
    div.a {
        text-indent: 40px;
    }
    .tab {
        display: inline-block;
        margin-left: 5px;
    }
</style>

<h1>Companion Care Drops</h1>

<hr>

<div align="center"><img width="80%" src="{{ asset('images/compscare.png') }}">
<br><br>
    <p class="mb-2">Your companions like to show they care for you in their own special kind of way.</p>
</div>

<div class="a" align="justify">
    <p>
        Along with providing company and various buffs to an Isomara during <a href="/explore">explorations</a>, <a href="/train">training</a>, and other areas of the game, companions will also leave gifts for their Isomara companion as a show of affection and appreciation.
        Once a month, you can find your companions carrying a bundle you can collect and open for goodies.
    </p>
</div>
<img style="float: right; margin: 10px;" width="30%" src="{{ asset('images/tutorial/caredrop1.png') }}">
<h4>Getting Your Drops:</h4>
    <div class="a" align="justify">
        <p>
            To collect the gift bundle from a companion species, visit their <a href="/sublist/Comp">master list page</a>. On their master list page, you can either select the Care Drops tab just under their image or select Care Drops over on the sidebar.
            <br><br>
            If your companion has an Isomara companion and you have yet to collect the bundle, there will be a button you can press to collect the bundle. The care drop bundle will be added to your inventory, where you can open it to see what items were gathered.
A new gift bundle will be available to claim on the 1st of every month for each companion with a companioned Isomara.

<br>
<br>
To add or remove a companion character from an Isomara, <a href="/claims/new">submit a claim</a> containing the companion(s) and the Isomara they will be companioned to. Please submit only one claim per Isomara. The Goom and Blepper species can be freely companioned to Isomara as they are a friendly species. Memic and Memora must be <a href="/tame">tamed</a> in order to be eligible for companionship.
        </p>
    </div>

<hr>

<h4>Companion Drops and Rates:</h4>
    <div class="a" align="justify">
        <p>
            Each species of companions will gather and drop different items and amounts. There are relevant [achievements], which, if the Isomara companion has, can buff the chance and amount of drops of those companions.
        </p>
    </div>

<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
    <thead>
        <tr style="height: 20px;">
            <td style="width: 500px; height: 15px; text-align: center;">
                <a href=""><img src="/images/Gooms.png" width="300px"/></a>
            </td>
            <td style="width: 500px; height: 15px; text-align: center;">
                <a href=""><img src="/images/Bleps.png" width="300px"/></a>
            </td>
        </tr>
    </thead>
</table>

{{--<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
    <tbody>
        <tr style="height: 30px;">
            <td style="width: 300px; height: 30px; text-align: center; vertical-align: top;">
                <div class="card-group">
                    <div class="card border-ilblue" style="border-width:2px">
                        <div class="card-body text-ilblue">

                        </div>
                    </div>
                </div>
            </td>
            <td style="width: 300px; height: 30px; text-align: center; vertical-align: top;">
                <div class="card-group">
                    <div class="card border-ilblue" style="border-width:2px">
                        <div class="card-body text-ilblue">

                        </div>
                    </div>
                </div>
            </td>

            <td style="width: 300px; height: 30px; text-align: center; vertical-align: top;">
                <div class="card-group">
                    <div class="card border-ilblue" style="border-width:2px">
                        <div class="card-body text-ilblue">

                        </div>
                    </div>
                </div>
            </td>

            <td style="width: 300px; height: 30px; text-align: center; vertical-align: top;">
                <div class="card-group">
                    <div class="card border-ilblue" style="border-width:2px">
                        <div class="card-body text-ilblue">
                            <div align="left">
                                <p>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>--}}

<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
    <tbody>
        <tr style="height: 30px;">
            <td style="width: 600px; height: 30px; vertical-align: top;">
                <div class="card-group">
                    <div class="card border-ilblue" style="border-width:2px">
                        <div class="card-body text-ilblue">
                            <div align="left">
                                <p>
                                    <strong>Goom Care Bundle Drops</strong>
                                    <ul>
                                        <li>3/5/9 Grapes [60/10/10% chance]</li>
                                        <li>5/7/10 Seashells [60/10/10% chance]</li>
                                        <li>2/3 Peanuts [20/15% chance]</li>
                                        <li>1 Orange [10% chance]</li>
                                        <li>1 Goo [10% chance]</li>
                                        <li>1 Potato [5% chance]</li>
                                        <li>1 Ectoplasm [3% chance]</li>
                                        <li>1 Sand Dollar [2% chance]</li>
                                        <li>1 Ally of Goo Achievement [2% chance]</li>
                                        <li>1 Goom Orb [1% chance]</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td style="width: 600px; height: 30px; vertical-align: top;">
                <div class="card-group">
                    <div class="card border-ilblue" style="border-width:2px">
                        <div class="card-body text-ilblue">

                            <div align="left">
                                <p>
                                    <strong>Blepper Care Bundle Drops</strong>
                                    <ul>
                                        <li>2/4/5 Feathers [60/20/10% chance]</li>
                                        <li>5/7/10 Seashells [60/10/10% chance]</li>
                                        <li>2/3 Sticks [50/25% chance]</li>
                                        <li>1/2 Mushroom [15/10% chance]</li>
                                        <li>1 Vine [10% chance]</li>
                                        <li>1 Memic Egg [5% chance]</li>
                                        <li>1 Humble [3% chance]</li>
                                        <li>1 Sand Dollar [2% chance]</li>
                                        <li>1 Dumb Love Achievement [2% chance]</li>
                                        <li>1 Mystery Candy [1% chance]</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>

<br>

<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
    <thead>
        <tr style="height: 20px;">
            <td style="width: 600px; height: 15px; text-align: center;">
                <a href=""><img src="" width="300px"/></a>
            </td>
            <td style="width: 600px; height: 15px; text-align: center;">
                <a href=""><img src="" width="300px"/></a>
            </td>
        </tr>
    </thead>
</table>

<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
    <tbody>
        <tr style="height: 30px;">
            <td style="width: 600px; height: 30px; vertical-align: top;">
                <div class="card-group">
                    <div class="card border-ilblue" style="border-width:2px">
                        <div class="card-body text-ilblue">
                            <div align="left">
                                <p>
                                    <strong>Memora Care Bundle Drops</strong>
                                    <ul>
                                        <li>1/2/3 Teeth [60/20/10% chance]</li>
                                        <li>6/8/12 Seashells [60/10/10% chance]</li>
                                        <li>2/3 Cotton [50/25% chance]</li>
                                        <li>1/2 Mint [15/10% chance]</li>
                                        <li>1 Gull Drummie [10% chance]</li>
                                        <li>1 Salmon [5% chance]</li>
                                        <li>1 Sand Dollar [2% chance]</li>
                                        <li>1 Mystery Candy [1% chance]</li>
                                        <li>1 Venom [1% chance] (If Scarred 0% chance)</li>
                                        <li>1 String [1% chance]</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td style="width: 600px; height: 30px; vertical-align: top;">
                <div class="card-group">
                    <div class="card border-ilblue" style="border-width:2px">
                        <div class="card-body text-ilblue">
                            <div align="left">
                                <p>
                                    <strong>Memic Care Bundle Drops</strong>
                                    <ul>
                                        <li>1/2/3 Feathers [60/20/10% chance]</li>
                                        <li>2/4/7 Seashells [65/25/10% chance]</li>
                                        <li>1/2 Teeth [40/15% chance]</li>
                                        <li>1/2 Vines [22/11% chance]</li>
                                        <li>1 Fur Tuft [14% chance]</li>
                                        <li>1 Gull Drummie [10% chance]</li>
                                        <li>1 Tilapia [5% chance]</li>
                                        <li>1 Boar Meat [5% chance]</li>
                                        <li>1 Bone [3% chance]</li>
                                        <li>1 Memic Egg [40% chance]</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>


@endsection
