{{--@if($target->awards && $count)
    <!--<div class="{{ $float ? 'float-md-right ml-md-4' : '' }}"><div class="row justify-content-center align-items-center">-->
        @foreach($target->awards->unique() as $award)
            <div class="text-center mb-1 px-1">
                <a href="{{$award->idUrl}}"><img src="{{ $award->imageUrl }}" alt="{{ $award->name }}" data-toggle="tooltip" data-title="{{ $award->name }}"/></a>
            </div>
        @endforeach
    <!--</div>-->
@endif--}}

{{--Achievement Character Profile Showcase--}}

<style>
.grid-container {
    display: grid;
    gap: 25px;
    background-image:
    url("{{ asset('images/showcase.png')}}");
    background-size: 1175px;
    background-repeat: no-repeat;
    background-position: center center;
    padding: 80px 55px ;
    margin: auto;
}

.grid-container > div {
  gap: 25px;
  background-color: rgba(0, 255, 255, 0.0);
  padding: 0px 0;
  height: 65px;
  width: 100px;
  position: relative
}
</style>

<div class="grid-container">
    <?php
        $awards = $target->awards;
        for($x = 0; $x <= 48; $x++){
            $d = ((($x % 7)+1+floor($x /7) % 2)*2)-floor($x /7) % 2;
            echo"<div style='grid-column:$d; grid-column-end: span 2;'>";
            if(count($awards) > $x)
            {
                $award = $awards[$x];
                echo"<a href='$award->idUrl'><img src=' $award->imageUrl ' alt=' $award->name ' width='100' data-toggle='tooltip' data-title=' $award->name '/></a>";
            }
            //echo'{{$award->idUrl}}';
            echo"</div>";

        }
    ?>
</div>
