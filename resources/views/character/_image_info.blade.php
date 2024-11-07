<style>
.text-stroke {
	color: #6cb2eb;
	font-size: 25px;
	text-shadow: -1px 1px 0 #6cb2eb,
				  1px 1px 0 #6cb2eb,
				 1px -1px 0 #6cb2eb,
				-1px -1px 0 #6cb2eb;
}
</style>

{{-- Image Data --}}
<div class="col-md-5 d-flex">
    <div class="card character-bio w-100">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="infoTab-{{ $image->id }}" data-toggle="tab" href="#info-{{ $image->id }}" role="tab">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="notesTab-{{ $image->id }}" data-toggle="tab" href="#notes-{{ $image->id }}" role="tab">Image Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="creditsTab-{{ $image->id }}" data-toggle="tab" href="#credits-{{ $image->id }}" role="tab">Credits</a>
                </li>
                @if(Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <li class="nav-item">
                        <a class="nav-link" id="settingsTab-{{ $image->id }}" data-toggle="tab" href="#settings-{{ $image->id }}" role="tab"><i class="fas fa-cog"></i></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="card-body tab-content">
            @if(!$image->character->is_myo_slot && !$image->is_valid)
                <div class="alert alert-danger">
                    This version of this character is outdated, and only noted here for recordkeeping purposes. Do not use as an official reference.
                </div>
            @endif

            {{-- Basic info  --}}
            <div class="tab-pane fade show active" id="info-{{ $image->id }}">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><h5>Species</h5></div>
                    <div class="col-lg-8 col-md-6 col-8">{!! $image->species_id ? $image->species->displayName : 'None' !!}
                        {{--{{ $image->species_id && $image->species->hasDrops ? ' ('.$character->drops->parameters.')' : '' }}--}}
                    </div>
                </div>
                @if($image->subtype_id)
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4"><h5>Breed</h5></div>
                        <div class="col-lg-8 col-md-6 col-8">{!! $image->subtype_id ? $image->subtype->displayName : 'None' !!}</div>
                    </div>
                @endif


                @if (($image->species_id) == 1 || ($image->species_id) == 6) {{--Hide below content unless an Isomara or Kyti species--}}

                    {{--Age Row--}}
                    @if (($character->rarity_id) == 0)
                    @else
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-4"><h5>Age</h5></div>
                            <div class="col-lg-8 col-md-6 col-8">
                                @if (($character->rarity_id) == 7)
                                Adult
                                @elseif (($character->rarity_id) == 8)
                                Isoling
                                @elseif (($character->rarity_id) == 9)
                                Egg
                                @endif
                            </div>
                        </div>
                    @endif

                    {{--Height Row--}}
                    @if (($character->chara_height) == 0)
                    @else
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-4"><h5>Height</h5></div>
                            <div class="col-lg-8 col-md-6 col-8">
                                @switch($character->chara_height)

                                @case(1) 4′6″ (137 cm) @break
                                @case(2) 4′7″ (139 cm) @break
                                @case(3) 4′8″ (142 cm) @break
                                @case(4) 4′9″ (144 cm) @break
                                @case(5) 4′10″ (147 cm) @break
                                @case(6) 4′11″ (149 cm) @break
                                @case(7) 5′0″ (152 cm) @break
                                @case(8) 5′1″ (154 cm) @break
                                @case(9) 5′2″ (157 cm) @break
                                @case(10) 5′3″ (160 cm) @break
                                @case(11) 5′4″ (162 cm) @break
                                @case(12) 5′5″ (165 cm) @break
                                @case(13) 5′6″ (167 cm) @break
                                @case(14) 5′7″ (170 cm) @break
                                @case(15) 5′8″ (172 cm) @break
                                @case(16) 5′9″ (175 cm) @break
                                @case(17) 5′10″ (177 cm) @break
                                @case(18) 5′11″ (180 cm) @break
                                @case(19) 6′0″ (182 cm) @break
                                @case(20) 6′1″ (185 cm) @break
                                @case(21) 6′2″ (187 cm) @break
                                @case(22) 6′3″ (190 cm) @break
                                @case(23) 6′4″ (193 cm) @break
                                @case(24) 6′5″ (195 cm) @break
                                @case(25) 6′6″ (198 cm) @break
                                @case(26) 6′7″ (200 cm) @break
                                @case(27) 6′8″ (203 cm) @break
                                @case(28) 6′9″ (205 cm) @break
                                @case(29) 6′10″ (208 cm) @break
                                @case(30) 6′11″ (210 cm) @break
                                @case(31) 3′0″ (91 cm) - Dwarfism @break
                                @case(32) 3′1″ (94 cm) - Dwarfism @break
                                @case(33) 3′2″ (96 cm) - Dwarfism @break
                                @case(34) 3′3″ (99 cm) - Dwarfism @break
                                @case(35) 3′4″ (101 cm) - Dwarfism @break
                                @case(36) 3′5″ (104 cm) - Dwarfism @break
                                @case(37) 3′6″ (107 cm) - Dwarfism @break
                                @case(38) 3′7″ (109 cm) - Dwarfism @break
                                @case(39) 3′8″ (112 cm) - Dwarfism @break
                                @case(40) 3′9″ (114 cm) - Dwarfism @break
                                @case(41) 3′10″ (117 cm) - Dwarfism @break
                                @case(42) 3′11″ (119 cm) - Dwarfism @break
                                @case(43) 4′0″ (122 cm) - Dwarfism @break
                                @case(44) 4′1″ (124 cm) - Dwarfism @break
                                @case(45) 4′2″ (127 cm) - Dwarfism @break
                                @case(46) 4′3″ (129 cm) - Dwarfism @break
                                @case(47) 4′4″ (132 cm) - Dwarfism @break
                                @case(48) 4′5″ (135 cm) - Dwarfism @break
                                @case(49) 7′0″ (213 cm) - Gigantism @break
                                @case(50) 7′1″ (215 cm) - Gigantism @break
                                @case(51) 7′2″ (218 cm) - Gigantism @break
                                @case(52) 7′3″ (221 cm) - Gigantism @break
                                @case(53) 7′4″ (223 cm) - Gigantism @break
                                @case(54) 7′5″ (226 cm) - Gigantism @break
                                @case(55) 7′6″ (229 cm) - Gigantism @break
                                @case(56) 7′7″ (231 cm) - Gigantism @break
                                @case(57) 7′8″ (234 cm) - Gigantism @break
                                @case(58) 7′9″ (236 cm) - Gigantism @break
                                @case(59) 7′10″ (239 cm) - Gigantism @break
                                @case(60) 7′11″ (241 cm) - Gigantism @break
                                @default
                                    Height Unknown
                                @endswitch
                                </div>
                        </div>
                    @endif

                    {{--Gender Identity & Personal Pronoun Rows--}}
                    @if (($character->gender_identity) == 0)
                    @else
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-4"><h5>Gender</h5></div>
                            <div class="col-lg-8 col-md-6 col-8">
                                @if (($character->gender_identity) == 1)
                                Agender
                                @elseif (($character->gender_identity) == 2)
                                Androgynous
                                @elseif (($character->gender_identity) == 3)
                                Bigender
                                @elseif (($character->gender_identity) == 4)
                                Demiflux
                                @elseif (($character->gender_identity) == 5)
                                Demigender
                                @elseif (($character->gender_identity) == 6)
                                Female
                                @elseif (($character->gender_identity) == 7)
                                Genderfluid
                                @elseif (($character->gender_identity) == 8)
                                Genderflux
                                @elseif (($character->gender_identity) == 9)
                                Male
                                @elseif (($character->gender_identity) == 10)
                                Nonbinary
                                @elseif (($character->gender_identity) == 11)
                                Omnigender
                                @elseif (($character->gender_identity) == 12)
                                Transgender
                                @elseif (($character->gender_identity) == 13)
                                Other/Ask
                                @endif
                            </div>
                        </div>
                    @endif
                @endif

                @if (($character->personal_pronouns) == 0)
                @else
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4"><h5>Pronouns</h5></div>
                        <div class="col-lg-8 col-md-6 col-8">
                            @if (($character->personal_pronouns) == 1)
                            they/them/theirs
                            @elseif (($character->personal_pronouns) == 2)
                            she/her/hers
                            @elseif (($character->personal_pronouns) == 3)
                            he/him/his
                            @elseif (($character->personal_pronouns) == 4)
                            xe/xem/xyrs
                            @elseif (($character->personal_pronouns) == 5)
                            ze/hir/hirs
                            @elseif (($character->personal_pronouns) == 6)
                            Any/No Preference
                            @elseif (($character->personal_pronouns) == 7)
                            Other/Ask
                            @endif
                        </div>
                    </div>
                @endif

                {{-- <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><h4>Rarity</h4></div>
                    <div class="col-lg-8 col-md-6 col-8">{!! $image->rarity_id ? $image->rarity->displayName : 'None' !!}</div>
                </div> --}}

                <div class="mb-3">
                    <div><h5>Traits</h5></div>
                    @if(Config::get('lorekeeper.extensions.traits_by_category'))
                        <div>
                            @php $traitgroup = $image->features()->get()->groupBy('feature_category_id') @endphp
                            @if($image->features()->count())
                                @foreach($traitgroup as $key => $group)
                                <div class="mb-2">
                                    @if($key)
                                        <strong>{!! $group->first()->feature->category->displayName !!}:</strong>
                                    @else
                                        <strong>Miscellaneous:</strong>
                                    @endif
                                    @foreach($group as $feature)
                                        <div class="ml-md-2">{!! $feature->feature->displayName !!} @if($feature->data) ({{ $feature->data }}) @endif</div>
                                    @endforeach
                                </div>
                                @endforeach
                            @else
                                <div>No traits listed.</div>
                            @endif
                        </div>
                    @else
                        <div>
                            <?php $features = $image->features()->with('feature.category')->get(); ?>
                            @if($features->count())
                                @foreach($features as $feature)
                                    <div>
                                        {!! $feature->feature->displayName !!}
                                        @if($feature->feature->feature_category_id) {!! $feature->feature->category->displayName !!}
                                        @endif
                                        @if($feature->data) ({{ $feature->data }})
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div>No traits listed.</div>
                            @endif
                        </div>
                    @endif
                </div>

                @if(Auth::check() && Auth::user()->hasPower('manage_characters'))
                <div class="mt-3">
                    <a href="#" class="btn btn-outline-info btn-sm edit-features mb-3" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit Traits</a>
                </div>
                @endif

                @if (($image->species_id) == 1 || ($image->species_id) == 6) {{--Hide below content unless an Isomara or Kyti species--}}
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4"><h5><a href="/info/ailments">Ailments</a></h5></div>
                        <div class="col-lg-8 col-md-6 col-8">
                                @php $statuses = $image->character->getStatusEffects() @endphp {{--THIS DEFINES THE STATUSES VARIABLE!--}}
                                    @if(count($statuses))
                                        <ul class="list-group list-group-flush">
                                    @foreach($statuses as $status)
                                            {!! $status->displaySeverity($status->quantity) !!}
                                    @endforeach
                                </ul>
                                @else
                                    No current ailments.
                                @endif
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4"><h5><a href="/info/hunger">Hunger</a></h5></div>
                        <div class="col-lg-8 col-md-6 col-8">@foreach($character->stats as $stat)
                            @if ($stat->stat->id == 3)
                                @if (($stat->current_count) <= 25)
                                    Starving
                                    @elseif (($stat->current_count) <= 49)
                                    Peckish
                                    @elseif (($stat->current_count) <= 76)
                                    Satisfied
                                    @elseif (($stat->current_count) <= 100)
                                    Full
                                    @elseif (($stat->current_count) >= 101)
                                    Stuffed
                                @endif
                            @endif
                        @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        @foreach($character->stats as $stat)
                            @if ($stat->stat->id == 3)
                            <div class="progress position-relative" style="height: 2.5em; margin-left: 25px;">
                                <div class="progress-bar bg-info text-center text-light text-stroke active h4" role="progressbar"
                                        aria-valuenow="{{$stat->current_count}}" aria-valuemin="0" aria-valuemax="100"style="height:100%; width:{{isset($stat->current_count) ? $stat->current_count : 100 }}%">
                                        <div class="justify-content-center d-flex position-absolute w-100">{{isset($stat->current_count) ? $stat->current_count." / 100" : "TBD"}}</div>
                                            <!--({{isset($stat->current_count) ? round(($stat->current_count/100),3)*100 : 100 }}%)-->
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4"><h5><a href="/training">Stat Pool:</a></h5></div>
                        <div class="col-lg-8 col-md-6 col-8"><h5>{{ $character->level->current_points }} unspent pts</h5></div>
                    </div>
                    <div class="row">
                        @foreach($character->stats as $stat)
                            @if ($stat->stat->id == 1)
                                <div class="col-lg-4 col-md-6 col-4" style="margin-left: 25px;">
                                    Fight - {{$stat->stat_level}}
                                </div>
                                <div class="col-lg-7 col-md-6 col-8">
                                    @if($character->level->current_points > 0 && Auth::check() && Auth::user()->id == $character->user_id)
                                    {{ Form::open(['url' => $character->url . '/stats-area/' . $stat->id]) }}

                                    {!! Form::submit('Spend 1 Pt to level up Fight stat', ['class' => 'btn btn-success btn-sm mb-2']) !!}

                                    {!! Form::close() !!}
                                    @endif
                                </div>
                            @endif
                            @if ($stat->stat->id == 2)
                                <div class="col-lg-4 col-md-6 col-4" style="margin-left: 25px;">
                                    Flight - {{$stat->stat_level}}
                                </div>
                                <div class="col-lg-7 col-md-6 col-8">
                                    @if($character->level->current_points > 0 && Auth::check() && Auth::user()->id == $character->user_id)
                                    {{ Form::open(['url' => $character->url . '/stats-area/' . $stat->id]) }}

                                    {!! Form::submit('Spend 1 Pt to level up Flight stat', ['class' => 'btn btn-success btn-sm mb-2']) !!}

                                    {!! Form::close() !!}
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4"><h5>Class</h5></div>
                        <div class="col-lg-8 col-md-6 col-8">{!! $image->character->class_id ? $image->character->class->displayName : 'None' !!}
                            @if(Auth::check() && Auth::user()->hasPower('manage_characters'))
                            <a href="#" class="btn btn-outline-info btn-sm edit-class ml-1" data-id="{{ $image->character->id }}"><i class="fas fa-cog"></i> Edit Class</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>


            {{-- Image notes --}}
            <div class="tab-pane fade" id="notes-{{ $image->id }}">
                @if($image->parsed_description)
                    <div class="parsed-text imagenoteseditingparse">{!! $image->parsed_description !!}</div>
                @else
                    <div class="imagenoteseditingparse">There are no additional notes given for this image.</div>
                @endif
				@if(Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-notes" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit</a>
                    </div>
				@endif
            </div>

            {{-- Image credits --}}
            <div class="tab-pane fade" id="credits-{{ $image->id }}">

                <div class="row mb-2">
                    <div class="col-lg-4 col-md-6 col-4"><h4>Design</h4></div>
                    <div class="col-lg-8 col-md-6 col-8">
                        @foreach($image->designers as $designer)
                            <div>{!! $designer->displayLink() !!}</div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><h4>Art</h4></div>
                    <div class="col-lg-8 col-md-6 col-8">
                        @foreach($image->artists as $artist)
                            <div>{!! $artist->displayLink() !!}</div>
                        @endforeach
                    </div>
                </div>

                @if(Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-credits" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit Credits</a>
                    </div>
                @endif
            </div>

            @if(Auth::check() && Auth::user()->hasPower('manage_characters'))
                <div class="tab-pane fade" id="settings-{{ $image->id }}">
                    {!! Form::open(['url' => 'admin/character/image/'.$image->id.'/settings']) !!}
                        <div class="form-group">
                            {!! Form::checkbox('is_visible', 1, $image->is_visible, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                            {!! Form::label('is_visible', 'Is Viewable', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is turned off, the image will not be visible by anyone without the Manage Masterlist power.') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::checkbox('is_valid', 1, $image->is_valid, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                            {!! Form::label('is_valid', 'Is Valid', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is turned off, the image will still be visible, but displayed with a note that the image is not a valid reference.') !!}
                        </div>
                        <div class="text-right">
                            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                    <hr />
                    <div class="text-right">
                    @if($character->character_image_id != $image->id) <a href="#" class="btn btn-outline-info btn-sm active-image" data-id="{{ $image->id }}">Set Active</a> @endif <a href="#" class="btn btn-outline-info btn-sm reupload-image" data-id="{{ $image->id }}">Reupload Image</a> <a href="#" class="btn btn-outline-danger btn-sm delete-image" data-id="{{ $image->id }}">Delete</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

