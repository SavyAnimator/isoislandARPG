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
        padding: 25px;
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

<h1>Hallows Carnival</h1>
<p>See the latest<a href="https://isomara-island.com/news/32.hallows-extravaganza-2024-open">Halloween Extravaganza Event</a> for full event details, and the questline prompts.</p>
<p align="center">The NPCs have already packed up their carnival games for the year and are back to their normal jobs. Come by next October to participate.</p>

<div class="site-page-content parsed-text">
    <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
        <thead>
            <tr style="height: 30px;">
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/carnivalgames"><img src="images/bubblepop.png" width="250px"/>
                    <h5>Bubble Pop</h5></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/carnivalrock"><img src="/images/IsoLogo.png" width="150px"/></a>
                    <h5>One Rock</h5>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/carnivalfluke"><img src="images/flukeyball.png" width="170px"/>
                    <h5>Flukey Ball</h5></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/carnivalpalm"><img src="" width="170px"/>
                    <h5>Palm Reading</h5></a>
                </td>
            </tr>
        </thead>
    </table>

    <table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" cellpadding="8">
        <thead>
            <tr style="height: 30px;">
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/carnivalwhap"><img src="/images/IsoLogo.png" width="150px"/>
                    <h5>Whap-a-Memic</h5></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/carnivalpin"><img src="/images/IsoLogo.png" width="150px"/></a>
                    <h5>Pin-the-Stinger</h5>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="/apple"><img src="{{ asset('images/abob.png') }}" width="150px"/>
                    <h5>Apple Bobbing</h5></a>
                </td>
                <td style="width: 243px; height: 25px; text-align: center;">
                    <a href="dailies/2"><img src="" width="150px"/>
                    <h5>Wheel of Seasons</h5></a>
                </td>
            </tr>
        </thead>
    </table>
</div>

@endsection
