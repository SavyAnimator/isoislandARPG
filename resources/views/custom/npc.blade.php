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
        padding: 5px;
    }
    ul {
        list-style: disc;
        display: inline-block;
    }

    .fakeimg {
            background-color: rgb(59, 183, 237);
            width: 120px;
            height:120px;
        }
</style>

<h1>NPCs</h1>
<p>These characters are either owned by <a href="/info/team">the Team</a> or have no one owner. NPCs typically have a larger role in the island and can serve as shopkeepers, game hosts, and often will play a role in plots and teach player's about the ARPG. Players can use any NPC in <a href="/pavilion">prompts</a>, general art and literature to earn items and currency and aid in your own character's development.</p>
@if(Auth::user())
        <img style="position: fixed; bottom: 70px; left: 220px;" src="/images/LookR.png" height="115"/>
@else

@endif

<div class="site-page-content parsed-text">
    <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
        <thead>
            <tr style="height: 30px;">
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Slayer"><img src="/images/npc/icon_slay.png" width="200px"/>
                    <h5>Slay</h5><p>Tour Guide</p></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Pacings"><img src="/images/npc/icon_pac.png" width="200px"/>
                    <h5>Pacings</h5><p>General Shopkeeper</p></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Carmen"><img src="/images/npc/icon_car.png" width="200px"/>
                    <h5>Carmen</h5><p>Daycare Manager & Tailor</p></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Frio"><img src="/images/npc/icon_fri.png" width="200px"/>
                    <h5>Frio</h5><p>Daycare Assistant</p></a>
                </td>
            </tr>
        </thead>
    </table>

    <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
        <thead>
            <tr style="height: 30px;">
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Hasha"><img src="/images/IsoLogo.png" width="200px"/>
                    <h5>Hasha</h5><p>Witch Doctor</p></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Darwin"><img src="/images/npc/icon_dar.png" width="200px"/>
                    <h5>Darwin</h5><p>Delivery Boy</p></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Thyme"><img src="/images/IsoLogo.png" width="200px"/>
                    <h5>Thyme</h5><p>Fauna Enthusiast</p></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Parsley"><img src="/images/IsoLogo.png" width="200px"/>
                    <h5>Parsley</h5><p>Advocator of Fun</p></a>
                </td>
            </tr>
        </thead>
    </table>

    <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
        <thead>
            <tr style="height: 30px;">
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Charlotte"><img src="/images/IsoLogo.png" width="200px"/>
                    <h5>Charlotte</h5><p>Blacksmith</p></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Aycorn"><img src="/images/IsoLogo.png" width="200px"/>
                    <h5>Aycorn</h5><p>Old Man</p></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Sugar"><img src="/images/IsoLogo.png" width="200px"/>
                    <h5>Sugar</h5><p>Local Bubbler</p></a>
                </td>
            </tr>
        </thead>
    </table>
</div>

<hr>

<h1>Community Characters</h1>
<p>Purely community owned characters. The players of the ARPG (like you!) get to develop and grow these characters through events, plots, and polls.
    Players who do not own a character are strongly encouraged to use community characters in general art and literature, <a href="/explore">explorations</a>, and in <a href="/pavilion">prompts</a> to earn <a href="/info/currency">currency</a> and aim towards purchasing a <a href="/info/myo">MYO Slot</a>.</p>
<div class="site-page-content parsed-text">
    <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
        <thead>
            <tr style="height: 30px;">
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/NPCs/Deustrum"><img src="/images/npc/icon_deu.png" width="200px"/>
                    <h5>Deus</h5><p>The First Deustrum</p></a>
                </td>
            </tr>
        </thead>
    </table>
</div>

@endsection
