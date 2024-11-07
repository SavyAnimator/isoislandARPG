{{-- Setting One --}}
@if (($character->is_condensed) == 0)
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-deck mb-6" style="clear:both;">
                <div class="card character-bio">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="companionTab-{{ $image->id }}" data-toggle="tab" href="#companion-{{ $image->id }}" role="tab">Companions</a>
                            </li>
                        </ul>
                    </div>
                    {{-- Companions Info  --}}
                    <div class="tab-pane fade show active" id="companion-{{ $image->id }}">
                        <div class="text-center row">
                            <div class="card-body tab-content">
                                @if(($parent) || ($children->count()))
                                    @if($parent)
                                    <div class="row justify-content-center text-center">
                                        <div class="col-md-3">
                                            <a href="{{ $parent->parent->url }}"><img src="{{ $parent->parent->image->thumbnailUrl }}" class="img-thumbnail" /></a><br />
                                            <a href="{{ $parent->parent->url }}" class="h5 mb-0">@if(!$parent->parent->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ $parent->parent->fullName }}</a>
                                            <div class="small">
                                                {!! $parent->parent->image->species_id ? $parent->parent->image->species->displayName : 'No Species' !!} ・ {!! $parent->parent->displayOwner !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($children->count())
                                        <div class="row justify-content-center text-center">
                                            @foreach($children as $link)
                                                <div class="col-md-3">
                                                    <a href="{{ $link->child->url }}"><img src="{{ $link->child->image->thumbnailUrl }}" class="img-thumbnail" /></a><br/>
                                                    <a href="{{ $link->child->url }}" class="h5 mb-0"  style="font-size:90%;">@if(!$link->child->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ $link->child->fullName }}</a>
                                                        @if($link->child->character_category_id == 6)
                                                            <div class="small">
                                                                <?php $features = $link->child->image->features()->with('feature.category')->get(); ?>
                                                                @if($features->count())
                                                                    @foreach($features as $feature)
                                                                        <div>@if($feature->feature->feature_category_id) <strong>{!! $feature->feature->category->displayName !!}:</strong> @endif {!! $feature->feature->displayName !!} @if($feature->data) ({{ $feature->data }}) @endif</div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <div>No companions.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card character-bio">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="companionTab-{{ $image->id }}" data-toggle="tab" href="#companion-{{ $image->id }}" role="tab">Critters</a>
                            </li>
                        </ul>
                    </div>
                    {{-- Critters List --}}
                    <div class="tab-pane fade show active" id="critters-{{ $image->id }}">
                        <div class="text-center row">
                            <div class="card-body tab-content">
                                @if(count($image->character->pets)>0)
                                    <div class="row justify-content-center text-center">
                                        @foreach($image->character->pets as $pet)
                                            <div class="col-md-2">
                                                @if($pet->has_image)
                                                    <img src="{{ $pet->variantimage($pet->variant_id) }}" title="{{ $pet->pet->name }}" style="max-width: 120px;"/>
                                                @elseif($pet->pet->variantimage($pet->variant_id))
                                                    <img src="{{ $pet->pet->variantimage($pet->variant_id) }}" title="{{ $pet->pet->name }}" style="max-width: 120px;"/>
                                                @else
                                                    {!!$pet->pet->displayName !!}
                                                @endif
                                                    <br><span class="h5 mb-0" style="font-size:90%;">{!! $pet->pet_name !!}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div>No critters.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-deck mb-6" style="clear:both;">
                <div class="card character-bio">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="equipmentTab-{{ $image->id }}" data-toggle="tab" href="#equipment-{{ $image->id }}" role="tab">Equipment</a>
                            </li>
                        </ul>
                    </div>
                        {{-- Equipment info  --}}
                        <div class="tab-pane fade show active" id="equipment-{{ $image->id }}">
                            <div class="text-center row">
                            <div class="card-body tab-content">
                                @if(count($image->character->weapons)>0)
                                    @foreach($image->character->weapons as $weapon)
                                        <div class="ml-3 mr-3">
                                            @if($weapon->has_image)
                                            <img src="{{ $weapon->imageUrl }}" data-toggle="tooltip" title="{{ $weapon->weapon->name }}" style="max-width: 120px;"/>
                                            @elseif($weapon->weapon->imageurl)
                                            <img src="{{ $weapon->weapon->imageUrl }}" data-toggle="tooltip" title="{{ $weapon->weapon->name }}" style="max-width: 120px;"/>
                                            @else {!!$weapon->weapon->displayName !!}
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                        <div>No equipped gear.</div>
                                @endif
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card character-bio">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="accessoriesTab-{{ $image->id }}" data-toggle="tab" href="#accessories-{{ $image->id }}" role="tab">Accessories</a>
                            </li>
                        </ul>
                    </div>
                        {{-- Accessory info --}}
                        <div class="tab-pane fade show active" id="accessories-{{ $image->id }}">
                            <div class="text-center row">
                            <div class="card-body tab-content">
                                @if(count($image->character->gear)>0)
                                    @foreach($image->character->gear as $gear)
                                    <div class="ml-3 mr-3">
                                        @if($gear->has_image)
                                        <img src="{{ $gear->imageUrl }}" data-toggle="tooltip" title="{{ $gear->gear->name }}" style="max-width: 120px;"/>
                                        @elseif($gear->gear->imageurl)
                                        <img src="{{ $gear->gear->imageUrl }}" data-toggle="tooltip" title="{{ $gear->gear->name }}" style="max-width: 120px;"/>
                                        @else {!!$gear->gear->displayName !!}
                                        @endif
                                    </div>
                                    @endforeach
                                @else
                                    <div>No worn accessories.</div>
                                @endif
                            </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endif
{{-- End of Setting One --}}

{{-- Setting Two --}}
@if (($character->is_condensed) == 1)
    {{-- Companion and Critter Box --}}
    <br>
        <div class="card character-bio">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="companionTab-{{ $image->id }}" data-toggle="tab" href="#companion-{{ $image->id }}" role="tab">Companions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="crittersTab-{{ $image->id }}" data-toggle="tab" href="#critters-{{ $image->id }}" role="tab">Critters</a>
                    </li>
                </ul>
            </div>


                {{-- Companions Info  --}}
                <div class="tab-pane fade show active" id="companion-{{ $image->id }}">
                    <div class="text-center row">
                        <div class="card-body tab-content">

                            @if(($parent) || ($children->count()))
                                @if($parent)
                                {{--<h5 class="text-center">Bound To {!! add_help('This character or add-on is bound to another character which controls the ownership.') !!}</h5>--}}
                                <div class="row justify-content-center text-center">
                                    <div class="col-md-3">
                                        <a href="{{ $parent->parent->url }}"><img src="{{ $parent->parent->image->thumbnailUrl }}" class="img-thumbnail" /></a><br />
                                        <a href="{{ $parent->parent->url }}" class="h5 mb-0">@if(!$parent->parent->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ $parent->parent->fullName }}</a>
                                    <div class="small">
                                        {!! $parent->parent->image->species_id ? $parent->parent->image->species->displayName : 'No Species' !!} ・ {{--{!! $parent->parent->image->rarity_id ? $parent->parent->image->rarity->displayName : 'No Rarity' !!} ・--}} {!! $parent->parent->displayOwner !!}
                                    </div>
                                    </div>
                                </div>
                                @endif

                                @if($children->count())

                                {{--<h5 class="text-center">Binding {!! add_help('This character is in possession of the following add-ons or characters and controls their ownership.') !!}</h5>--}}
                                <div class="row justify-content-center text-center">
                                    @foreach($children as $link)
                                        <div class="col-md-2">
                                            <a href="{{ $link->child->url }}"><img src="{{ $link->child->image->thumbnailUrl }}" class="img-thumbnail" /></a><br/>
                                            <a href="{{ $link->child->url }}" class="h5 mb-0"  style="font-size:90%;">@if(!$link->child->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ $link->child->fullName }}</a>
                                                {{--{!! $link->child->image->species_id ? $link->child->image->species->displayName : 'No Species' !!} ・ {!! $link->child->image->rarity_id ? $link->child->image->rarity->displayName : 'No Rarity' !!} ・ {!! $link->child->displayOwner !!}--}}
                                                @if($link->child->character_category_id == 6)
                                                    <div class="small">
                                                    <?php $features = $link->child->image->features()->with('feature.category')->get(); ?>
                                                    @if($features->count())
                                                        @foreach($features as $feature)
                                                            <div>@if($feature->feature->feature_category_id) <strong>{!! $feature->feature->category->displayName !!}:</strong> @endif {!! $feature->feature->displayName !!} @if($feature->data) ({{ $feature->data }}) @endif</div>
                                                        @endforeach
                                                    @endif
                                                    </div>
                                                @endif
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                            @else
                                <div>No companions.</div>
                            @endif

                        </div>
                    </div>
                </div>

                {{-- Critters List --}}
                <div class="tab-pane fade" id="critters-{{ $image->id }}">
                    <div class="text-center row">
                        <div class="card-body tab-content">
                            @if(count($image->character->pets)>0)
                                <div class="row justify-content-center text-center">
                                    @foreach($image->character->pets as $pet)
                                        <div class="col-md-2">
                                            @if($pet->has_image)
                                                <img src="{{ $pet->variantimage($pet->variant_id) }}" title="{{ $pet->pet->name }}" style="max-width: 120px;"/>
                                            @elseif($pet->pet->variantimage($pet->variant_id))
                                                <img src="{{ $pet->pet->variantimage($pet->variant_id) }}" title="{{ $pet->pet->name }}" style="max-width: 120px;"/>
                                            @else
                                                {!!$pet->pet->displayName !!}
                                            @endif
                                            <br><span class="h5 mb-0" style="font-size:90%;">{!! $pet->pet_name !!}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div>No critters.</div>
                            @endif
                        </div>
                    </div>
                </div>

        </div>
    <br>

    {{-- Equipment and Accessories Box --}}
    <div class="card character-bio">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="equipmentTab-{{ $image->id }}" data-toggle="tab" href="#equipment-{{ $image->id }}" role="tab">Equipment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="accessoriesTab-{{ $image->id }}" data-toggle="tab" href="#accessories-{{ $image->id }}" role="tab">Accessories</a>
                </li>
            </ul>
        </div>

            {{-- Equipment info  --}}
            <div class="tab-pane fade show active" id="equipment-{{ $image->id }}">
                <div class="text-center row">
                <div class="card-body tab-content">
                    @if(count($image->character->weapons)>0)
                        @foreach($image->character->weapons as $weapon)
                            <div class="ml-3 mr-3">
                                 @if($weapon->has_image)
                                <img src="{{ $weapon->imageUrl }}" data-toggle="tooltip" title="{{ $weapon->weapon->name }}" style="max-width: 120px;"/>
                                @elseif($weapon->weapon->imageurl)
                                <img src="{{ $weapon->weapon->imageUrl }}" data-toggle="tooltip" title="{{ $weapon->weapon->name }}" style="max-width: 120px;"/>
                                @else {!!$weapon->weapon->displayName !!}
                                @endif
                            </div>
                        @endforeach
                    @else
                            <div>No equipped gear.</div>
                    @endif
                    </div>
                </div>
            </div>
            {{-- Accessory info --}}
            <div class="tab-pane fade" id="accessories-{{ $image->id }}">
                <div class="text-center row">
                <div class="card-body tab-content">
                    @if(count($image->character->gear)>0)
                        @foreach($image->character->gear as $gear)
                        <div class="ml-3 mr-3">
                            @if($gear->has_image)
                            <img src="{{ $gear->imageUrl }}" data-toggle="tooltip" title="{{ $gear->gear->name }}" style="max-width: 120px;"/>
                            @elseif($gear->gear->imageurl)
                            <img src="{{ $gear->gear->imageUrl }}" data-toggle="tooltip" title="{{ $gear->gear->name }}" style="max-width: 120px;"/>
                            @else {!!$gear->gear->displayName !!}
                            @endif
                        </div>
                        @endforeach
                    @else
                        <div>No worn accessories.</div>
                    @endif
                </div>
                </div>
            </div>

    </div>
@endif
{{-- End of Setting Two --}}

@if (($image->species_id) == 1 || ($image->species_id) == 6) {{--Hide below content unless an Isomara or Kyti species--}}
<br>
    {{-- Achievement Box --}}
    <div class="card character-bio">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="awardTab-{{ $image->id }}" data-toggle="tab" href="#award-{{ $image->id }}" role="tab">Achievements</a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            {{-- Achievo Case  --}}
            <div class="tab-pane fade show active" id="award-{{ $image->id }}">
                @include('widgets._awardcase_all', ['target' => $character, 'count' => Config::get('lorekeeper.extensions.awards.character_featured')])
            </div>
        </div>
      <div align="right" style="margin-right: 10px; margin-bottom: 10px;" >
        <a href="{{ $character->slug . '/award-logs' }}" class="btn btn-outline-info btn-sm ml-1 {{ set_active('character/'.$character->slug.'/award-logs') }}">
            <i class="fas fa-scroll"></i> View Achievement Logs
        </a>
      </div>
    </div>
@else
@endif
<br>

    {{--Gallery Box--}}
@if ($character->gallerySubmissions->count())
<div class="card character-bio">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="awardTab-{{ $image->id }}" data-toggle="tab" href="#award-{{ $image->id }}" role="tab">Gallery</a>
            </li>
        </ul>
    </div>

    <div class="card-body tab-content">
        <div class="row mw-100 mx-auto">


        @foreach($gallerySubmissions->get() as $submission)
            <div class="col-md-2 align-self-center">
                @include('galleries._thumb', ['submission' => $submission, 'gallery' => false])
            </div>
        @endforeach


        </div>
    </div>

    <div align="right" style="margin-right: 10px; margin-bottom: 10px;" >
        <a href="{{ $character->slug . '/gallery' }}" class="btn btn-outline-info btn-sm ml-1 {{ set_active('character/'.$character->slug.'/gallery') }}">
            <i class="fas fa-paint-brush"></i> View Entire Gallery
        </a>
    </div>
</div>
@else
@endif
