<span class="text-left font-weight-bold">Lineage:</span>
@if($lineage != null && count($lineage->getParents()) > 0)
    <div class="container text-center">

        <div class="row">
            <?php $i=0; $parents = $lineage->getParents(); ?>
            @foreach($parents as $parent)
                <div class="col">
                    <div class="border-bottom mb-1">
                        <span class="font-weight-bold">Parent</span>
                            <br><img src="{{ $parent->parent->thumbnail }}" width="60px" class="img-thumbnail" />
                                <br>{!! $parent->parent->display_name !!}
                    </div>
                    <div class="row">
                        <?php $j=0; $gps = $parent->parent->getParents(); ?>
                        @foreach($gps as $gp_link)

                                <div class="col">
                                    <div class="border-bottom mb-1">
                                        <abbr class="font-weight-bold">Grandparent</abbr>
                                            <br><img src="{{ $gp_link->parent->thumbnail }}" width="60px" class="img-thumbnail" />
                                                <br>{!! $gp_link->parent->display_name !!}
                                    </div>
                                    <div class="row">
                                        <?php $k=0; $ggp = $gp_link->parent->getParents(); ?>
                                        @foreach($ggp as $ggp_link)

                                                <div class="col">
                                                    <div class="mb-1">
                                                        <abbr>Great-Grandparent</abbr>
                                                            <br><img src="{{ $ggp_link->parent->thumbnail }}" width="60px" class="img-thumbnail" />
                                                                <br>{!! $ggp_link->parent->display_name !!}
                                                    </div>
                                                </div>
                                        <?php $k++; ?>
                                        @endforeach
                                    </div>
                                </div>
                        <?php $j++; ?>
                        @endforeach
                    </div>
                </div>
            <?php $i++; ?>
            @endforeach
        </div>
    </div>
@else
    <p class="mb-0">Ancestry unknown.</p>
@endif


<?php $flag = true; ?>
@if($lineage)
    <?php $siblings = $lineage->getSiblings(); ?>
    @if($siblings != null && $siblings->count() > 0)
    <hr>
    <span class="text-left font-weight-bold">Siblings:</span>
    <div class="container">
        @include('character.lineage._section2',
        [
            'lineage'   => $lineage,
            'parent'    => false,
            'type'      => "siblings",
            'relatives' => $siblings->take(8)->get(),
        ])
    </div>
        <?php $flag = false; ?>
    @endif
@endif

@if($flag)
@endif


@if($lineage != null && count($lineage->getChildren()) > 0)
<hr>
<span class="text-left font-weight-bold">Children:</span>
    <div class="container">
        <?php $children = $lineage->getChildren(); ?>
            <div class="row">
                @foreach($children as $child)
                    <div class="col-md-1">
                        <img src="{{ $child->child->thumbnail }}" width="70px" class="img-thumbnail" />
                        <div class="text-center">{!! $child->child->display_name !!}</div>
                    </div>
                @endforeach
            </div>
    </div>
@else
@endif

