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

<h1>Sugar</h1>
<p></p>

<p><a href="/hunts/targets/NC7XiMny2I"><img style="float:right" src="/images/hunts/BoarMeat.png" height="500" /></a></p>

@endsection
