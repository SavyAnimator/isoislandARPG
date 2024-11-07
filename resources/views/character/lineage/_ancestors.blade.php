
<h2 style="display:inline;">{!! $character->displayName !!}'<h2 style="display:inline; text-transform:lowercase;">s</h2><h2 style="display:inline;"> Ancestors & Descendants </h2>
<hr>
<div class="row">
<div class="col">
@if($lineage)
    {{-- Parents, Grandparents and Great-Grandparents --}}
    <?php $parents = $lineage->getParents(); ?>
    @if($parents != null && $parents->count() > 0)
        {{-- Parents --}}
        @include('character.lineage._section',
        [
            'lineage'   => $lineage,
            'parent'    => true,
            'type'      => "parents",
            'relatives' => $parents->take(3),
        ])
<hr>
        <?php $gps = $lineage->getGrandparents(); ?>
        @if($gps != null && $gps->count() > 0)
            {{-- Grandparents --}}
            @include('character.lineage._section',
            [
                'lineage'   => $lineage,
                'parent'    => true,
                'type'      => "grandparents",
                'relatives' => $gps->take(3)->get(),
            ])
<hr>
            <?php $greats = $lineage->getGreatGrandparents(); ?>
            @if($greats != null && $greats->count() > 0)
                {{-- Great-Grandparents --}}
                @include('character.lineage._section',
                [
                    'lineage'   => $lineage,
                    'parent'    => true,
                    'type'      => "great-grandparents",
                    'relatives' => $greats->take(3)->get(),
                ])
            @endif
        @endif
    @else
        <p>No ancestors known.</p>
    @endif
@endif
</div>
<div class="col">
    @if($lineage)
    {{-- Parents, Grandparents and Great-Grandparents --}}
    <?php $children = $lineage->getChildren(); ?>
    @if($children != null && $children->count() > 0)
        {{-- Children --}}
        @include('character.lineage._section',
        [
            'lineage'   => $lineage,
            'parent'    => false,
            'type'      => "children",
            'relatives' => $children->take(3),
        ])
<hr>
        <?php $grands = $lineage->getGrandchildren(); ?>
        @if($grands != null && $grands->count() > 0)
            {{-- Grandchildren --}}
            @include('character.lineage._section',
            [
                'lineage'   => $lineage,
                'parent'    => false,
                'type'      => "grandchildren",
                'relatives' => $grands->take(3)->get(),
            ])
<hr>
            <?php $greats = $lineage->getGreatGrandchildren(); ?>
            @if($greats != null && $greats->count() > 0)
                {{-- Great-Grandchildren --}}
                @include('character.lineage._section',
                [
                    'lineage'   => $lineage,
                    'parent'    => false,
                    'type'      => "great-grandchildren",
                    'relatives' => $greats->take(3)->get(),
                ])
            @endif
        @endif
    @else
        <p>No descendants known.</p>
    @endif
@endif
</div>
</div>
