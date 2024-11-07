{{-- Info --}}
<div class="card character-bio">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            {{--<li class="nav-item">
                <a class="nav-link" id="statsTab" data-toggle="tab" href="#stats" role="tab">Stats</a>
            </li>--}}
            {{--<li class="nav-item">
                <a class="nav-link" id="notesTab" data-toggle="tab" href="#notes" role="tab">Description</a>
            </li>--}}
            <li class="nav-item">
                <a class="nav-link active" id="profilesTab" data-toggle="tab" href="#profiles" role="tab">Profile</a>
            </li>
            @if (($image->species_id) == 1) {{--Hide content if Isomara species--}}
            @else
            <li class="nav-item">
                <a class="nav-link" id="dropsTab" data-toggle="tab" href="#drops" role="tab">Care Drops</a>
            </li>
            @endif
            {{--<li class="nav-item">
                <a class="nav-link" id="skillsTab" data-toggle="tab" href="#skills" role="tab">Skills</a>
            </li>--}}
        @if (($image->species_id) == 1 || ($image->species_id) == 6) {{--Hide below content unless an Isomara or Kyti species--}}
            @if($character->getLineageBlacklistLevel() < 2)
                <li class="nav-item">
                    <a class="nav-link" id="lineageTab" data-toggle="tab" href="#lineage" role="tab">Relations</a>
                </li>
            @endif
        @endif
            @if(Auth::check() && Auth::user()->hasPower('manage_characters'))
                <li class="nav-item">
                    <a class="nav-link" id="settingsTab" data-toggle="tab" href="#settings-{{ $character->slug }}" role="tab"><i class="fas fa-cog"></i></a>
                </li>
            @endif
        </ul>
    </div>
    <div class="card-body tab-content">
        {{--<div class="tab-pane fade" id="stats">
            @include('character._tab_stats', ['character' => $character])
        </div>--}}
        {{--<div class="tab-pane fade" id="notes">
            @include('character._tab_notes', ['character' => $character])
        </div>--}}
		<div class="tab-pane fade show active" id="profiles">
            @include('character._tab_profiles', ['character' => $character])
        </div>
        <div class="tab-pane fade" id="drops">
            @if(($parent) || ($children->count()))
            @include('character._tab_drops', ['character' => $character])
            @else
            <div class="text-center">{{ $character->fullName }} will not gather care drops unless an Isomara is companioned.</div>
            @endif
        </div>
        <div class="tab-pane fade" id="skills">
            @include('character._tab_skills', ['character' => $character, 'skills' => $skills])
        </div>
        @if($character->getLineageBlacklistLevel() < 2)
        <div class="tab-pane fade" id="lineage">
            @include('character._tab_lineage', ['character' => $character])
        </div>
        @endif

        @if(Auth::check() && Auth::user()->hasPower('manage_characters'))
            <div class="tab-pane fade" id="settings-{{ $character->slug }}">
                {!! Form::open(['url' => $character->is_myo_slot ? 'admin/myo/'.$character->id.'/settings' : 'admin/character/'.$character->slug.'/settings']) !!}
                    <div class="form-group">
                        {!! Form::checkbox('is_visible', 1, $character->is_visible, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                        {!! Form::label('is_visible', 'Is Visible', ['class' => 'form-check-label ml-3']) !!} {!! add_help('Turn this off to hide the character. Only mods with the Manage Masterlist power (that\'s you!) can view it - the owner will also not be able to see the character\'s page.') !!}
                    </div>
                    <div class="text-right">
                        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                <hr />
                <div class="text-right">
                    <a href="#" class="btn btn-outline-danger btn-sm delete-character" data-slug="{{ $character->slug }}">Delete</a>
                </div>
            </div>
        @endif
    </div>
</div>
