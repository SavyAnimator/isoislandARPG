@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title') Editing {{ $character->fullName }}'s Profile @endsection

@section('meta-img') {{ $character->image->thumbnailUrl }} @endsection

@section('profile-content')
{{--@if($character->is_myo_slot)
{!! breadcrumbs(['MYO Slot Masterlist' => 'myos', $character->fullName => $character->url, 'Editing Profile' => $character->url . '/profile/edit']) !!}
@else
{!! breadcrumbs([($character->category->masterlist_sub_id ? $character->category->sublist->name.' Masterlist' : 'Character masterlist') => ($character->category->masterlist_sub_id ? 'sublist/'.$character->category->sublist->key : 'masterlist' ), $character->fullName => $character->url, 'Editing Profile' => $character->url . '/profile/edit']) !!}
@endif--}}

@include('character._header', ['character' => $character])

@if($character->user_id != Auth::user()->id)
    <div class="alert alert-warning">
        You are editing this character as a staff member.
    </div>
@endif

{!! Form::open(['url' => $character->url . '/profile/edit']) !!}
@if(!$character->is_myo_slot)
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $character->name, ['class' => 'form-control']) !!}
    </div>
    @if(Config::get('lorekeeper.extensions.character_TH_profile_link'))
        <div class="form-group">
            {!! Form::label('link', 'Profile Link') !!}
            {!! Form::text('link', $character->profile->link, ['class' => 'form-control']) !!}
        </div>
    @endif

    <div class="row">
        @if (($character->image->species_id) == 1 || ($character->image->species_id) == 6) {{--Hide below content unless an Isomara or Kyti species--}}
        <div class="col-md form-group">
            {!! Form::label('chara_height', 'Height', ['class' => 'form-check-label mb-3']) !!}

            @if(($character->awards->where('id', 37)->first()) && ($character->awards->where('id', 38)->first()))
                {!! Form::select('chara_height', [31 => '3′0″ (91 cm) - Dwarfism', 32 => '3′1″ (94 cm) - Dwarfism', 33 => '3′2″ (96 cm) - Dwarfism',
                    34 => '3′3″ (99 cm) - Dwarfism', 35 => '3′4″ (101 cm) - Dwarfism', 36 => '3′5″ (104 cm) - Dwarfism',
                    37 => '3′6″ (107 cm) - Dwarfism', 38 => '3′7″ (109 cm) - Dwarfism', 39 => '3′8″ (112 cm) - Dwarfism',
                    40 => '3′9″ (114 cm) - Dwarfism', 41 => '3′10″ (117 cm) - Dwarfism', 42 => '3′11″ (119 cm) - Dwarfism',
                    43 => '4′0″ (122 cm) - Dwarfism', 44 => '4′1″ (124 cm) - Dwarfism', 45 => '4′2″ (127 cm) - Dwarfism',
                    46 => '4′3″ (129 cm) - Dwarfism', 47 => '4′4″ (132 cm) - Dwarfism', 48 => '4′5″ (135 cm) - Dwarfism',
                    0 => 'Not Specified', 1 => '4′6″ (137 cm)', 2 => '4′7″ (139 cm)', 3 => '4′8″ (142 cm)', 4 => '4′9″ (144 cm)',
                    5 => '4′10″ (147 cm)', 6 => '4′11″ (149 cm)', 7 => '5′0″ (152 cm)', 8 => '5′1″ (154 cm)', 9 => '5′2″ (157 cm)',
                    10 => '5′3″ (160 cm)', 11 => '5′4″ (162 cm)', 12 => '5′5″ (165 cm)', 13 => '5′6″ (167 cm)', 14 => '5′7″ (170 cm)',
                    15 => '5′8″ (172 cm)', 16 => '5′9″ (175 cm)', 17 => '5′10″ (177 cm)', 18 => '5′11″ (180 cm)', 19 => '6′0″ (182 cm)',
                    20 => '6′1″ (185 cm)', 21 => '6′2″ (187 cm)', 22 => '6′3″ (190 cm)', 23 => '6′4″ (193 cm)', 24 => '6′5″ (195 cm)',
                    25 => '6′6″ (198 cm)', 26 => '6′7″ (200 cm)', 27 => '6′8″ (203 cm)', 28 => '6′9″ (205 cm)', 29 => '6′10″ (208 cm)',
                    30 => '6′11″ (210 cm)', 49 => '7′0″ (213 cm) - Gigantism', 50 => '7′1″ (215 cm) - Gigantism',
                    51 => '7′2″ (218 cm) - Gigantism', 52 => '7′3″ (221 cm) - Gigantism',
                    53 => '7′4″ (223 cm) - Gigantism', 54 => '7′5″ (226 cm) - Gigantism',
                    55 => '7′6″ (229 cm) - Gigantism', 56 => '7′7″ (231 cm) - Gigantism',
                    57 => '7′8″ (234 cm) - Gigantism', 58 => '7′9″ (236 cm) - Gigantism',
                    59 => '7′10″ (239 cm) - Gigantism', 60 => '7′11″ (241 cm) - Gigantism'],
                $character->chara_height, ['class' => 'form-control user-select']) !!}
            @elseif ($character->awards->where('id', 38)->first())
                {!! Form::select('chara_height', [
                    0 => 'Not Specified', 1 => '4′6″ (137 cm)', 2 => '4′7″ (139 cm)', 3 => '4′8″ (142 cm)', 4 => '4′9″ (144 cm)',
                    5 => '4′10″ (147 cm)', 6 => '4′11″ (149 cm)', 7 => '5′0″ (152 cm)', 8 => '5′1″ (154 cm)', 9 => '5′2″ (157 cm)',
                    10 => '5′3″ (160 cm)', 11 => '5′4″ (162 cm)', 12 => '5′5″ (165 cm)', 13 => '5′6″ (167 cm)', 14 => '5′7″ (170 cm)',
                    15 => '5′8″ (172 cm)', 16 => '5′9″ (175 cm)', 17 => '5′10″ (177 cm)', 18 => '5′11″ (180 cm)', 19 => '6′0″ (182 cm)',
                    20 => '6′1″ (185 cm)', 21 => '6′2″ (187 cm)', 22 => '6′3″ (190 cm)', 23 => '6′4″ (193 cm)', 24 => '6′5″ (195 cm)',
                    25 => '6′6″ (198 cm)', 26 => '6′7″ (200 cm)', 27 => '6′8″ (203 cm)', 28 => '6′9″ (205 cm)', 29 => '6′10″ (208 cm)',
                    30 => '6′11″ (210 cm)',
                    49 => '7′0″ (213 cm) - Gigantism', 50 => '7′1″ (215 cm) - Gigantism',
                    51 => '7′2″ (218 cm) - Gigantism', 52 => '7′3″ (221 cm) - Gigantism',
                    53 => '7′4″ (223 cm) - Gigantism', 54 => '7′5″ (226 cm) - Gigantism',
                    55 => '7′6″ (229 cm) - Gigantism', 56 => '7′7″ (231 cm) - Gigantism',
                    57 => '7′8″ (234 cm) - Gigantism', 58 => '7′9″ (236 cm) - Gigantism',
                    59 => '7′10″ (239 cm) - Gigantism', 60 => '7′11″ (241 cm) - Gigantism'
                ], $character->chara_height, ['class' => 'form-control user-select']) !!}
            @elseif ($character->awards->where('id', 37)->first())
                {!! Form::select('chara_height', [31 => '3′0″ (91 cm) - Dwarfism', 32 => '3′1″ (94 cm) - Dwarfism', 33 => '3′2″ (96 cm) - Dwarfism',
                    34 => '3′3″ (99 cm) - Dwarfism', 35 => '3′4″ (101 cm) - Dwarfism', 36 => '3′5″ (104 cm) - Dwarfism',
                    37 => '3′6″ (107 cm) - Dwarfism', 38 => '3′7″ (109 cm) - Dwarfism', 39 => '3′8″ (112 cm) - Dwarfism',
                    40 => '3′9″ (114 cm) - Dwarfism', 41 => '3′10″ (117 cm) - Dwarfism', 42 => '3′11″ (119 cm) - Dwarfism',
                    43 => '4′0″ (122 cm) - Dwarfism', 44 => '4′1″ (124 cm) - Dwarfism', 45 => '4′2″ (127 cm) - Dwarfism',
                    46 => '4′3″ (129 cm) - Dwarfism', 47 => '4′4″ (132 cm) - Dwarfism', 48 => '4′5″ (135 cm) - Dwarfism',
                    0 => 'Not Specified', 1 => '4′6″ (137 cm)', 2 => '4′7″ (139 cm)', 3 => '4′8″ (142 cm)', 4 => '4′9″ (144 cm)',
                    5 => '4′10″ (147 cm)', 6 => '4′11″ (149 cm)', 7 => '5′0″ (152 cm)', 8 => '5′1″ (154 cm)', 9 => '5′2″ (157 cm)',
                    10 => '5′3″ (160 cm)', 11 => '5′4″ (162 cm)', 12 => '5′5″ (165 cm)', 13 => '5′6″ (167 cm)', 14 => '5′7″ (170 cm)',
                    15 => '5′8″ (172 cm)', 16 => '5′9″ (175 cm)', 17 => '5′10″ (177 cm)', 18 => '5′11″ (180 cm)', 19 => '6′0″ (182 cm)',
                    20 => '6′1″ (185 cm)', 21 => '6′2″ (187 cm)', 22 => '6′3″ (190 cm)', 23 => '6′4″ (193 cm)', 24 => '6′5″ (195 cm)',
                    25 => '6′6″ (198 cm)', 26 => '6′7″ (200 cm)', 27 => '6′8″ (203 cm)', 28 => '6′9″ (205 cm)', 29 => '6′10″ (208 cm)',
                    30 => '6′11″ (210 cm)'],
                $character->chara_height, ['class' => 'form-control user-select']) !!}
            @else
                {!! Form::select('chara_height', [
                    0 => 'Not Specified', 1 => '4′6″ (137 cm)', 2 => '4′7″ (139 cm)', 3 => '4′8″ (142 cm)', 4 => '4′9″ (144 cm)',
                    5 => '4′10″ (147 cm)', 6 => '4′11″ (149 cm)', 7 => '5′0″ (152 cm)', 8 => '5′1″ (154 cm)', 9 => '5′2″ (157 cm)',
                    10 => '5′3″ (160 cm)', 11 => '5′4″ (162 cm)', 12 => '5′5″ (165 cm)', 13 => '5′6″ (167 cm)', 14 => '5′7″ (170 cm)',
                    15 => '5′8″ (172 cm)', 16 => '5′9″ (175 cm)', 17 => '5′10″ (177 cm)', 18 => '5′11″ (180 cm)', 19 => '6′0″ (182 cm)',
                    20 => '6′1″ (185 cm)', 21 => '6′2″ (187 cm)', 22 => '6′3″ (190 cm)', 23 => '6′4″ (193 cm)', 24 => '6′5″ (195 cm)',
                    25 => '6′6″ (198 cm)', 26 => '6′7″ (200 cm)', 27 => '6′8″ (203 cm)', 28 => '6′9″ (205 cm)', 29 => '6′10″ (208 cm)',
                    30 => '6′11″ (210 cm)'],
                $character->chara_height, ['class' => 'form-control user-select']) !!}
            @endif

        </div>
        @else
        @endif
        <div class="col-md form-group">
            {!! Form::label('gender_identity', 'Gender Identity', ['class' => 'form-check-label mb-3']) !!}
            {!! Form::select('gender_identity', [0 => 'Not Specified', 1 => 'Agender', 2 => 'Androgynous', 3 => 'Bigender', 4 => 'Demiflux', 5 => 'Demigender', 6 => 'Female', 7 => 'Genderfluid', 8 => 'Genderflux', 9 => 'Male', 10 => 'Nonbinary', 11 => 'Omnigender', 12 => 'Transgender', 13 => 'Other/Ask'], $character->gender_identity, ['class' => 'form-control user-select']) !!}
        </div>
        <div class="col-md form-group">
            {!! Form::label('personal_pronouns', 'Personal Pronouns', ['class' => 'form-check-label mb-3']) !!}
            {!! Form::select('personal_pronouns', [0 => 'Not Specified', 1 => 'they/them/theirs', 2 => 'she/her/hers', 3 => 'he/him/his', 4 => 'xe/xem/xyrs', 5 => 'ze/hir/hirs', 6 => 'Any/No Preference', 7 => 'Other/Ask'], $character->personal_pronouns, ['class' => 'form-control user-select']) !!}
        </div>
    </div>
@endif



<div class="form-group">
    {!! Form::label('text', 'Profile Content') !!}
    {!! Form::textarea('text', $character->profile->text, ['class' => 'wysiwyg form-control']) !!}
</div>

@if($character->user_id == Auth::user()->id)
    @if(!$character->is_myo_slot)

        <div class="row">
            @if (($character->image->species_id) == 1 || ($character->image->species_id) == 6) {{--Hide below content unless an Isomara or Kyti species--}}
            <div class="col-md form-group">
                {!! Form::label('is_training', 'Allow Others to Train Character', ['class' => 'form-check-label mb-3']) !!} {!! add_help('This will place the character on the list of characters that can be included in trainings. This does not have any other functionality, but allow users looking for characters to include in trainings to find your character easily.') !!}
                {!! Form::select('is_training', [0 => 'No', 1 => 'Yes', 2 => 'Ask First'], $character->is_training, ['class' => 'form-control user-select']) !!}
            </div>
            @else
            @endif
            <div class="col-md form-group">
                {!! Form::label('is_explore', 'Allow Others to Explore with Character', ['class' => 'form-check-label mb-3']) !!} {!! add_help('This will place the character on the list of characters that can be included in explorations. This does not have any other functionality, but allow users looking for characters to include in explorations to find your character easily.') !!}
                {!! Form::select('is_explore', [0 => 'No', 1 => 'Yes', 2 => 'Ask First'], $character->is_explore, ['class' => 'form-control user-select']) !!}
            </div>
            <div class="col-md form-group">
                {!! Form::label('is_gift_art_allowed', 'Allow Gift Art', ['class' => 'form-check-label mb-3']) !!} {!! add_help('This will place the character on the list of characters that can be drawn for gift art. This does not have any other functionality, but allow users looking for characters to draw to find your character easily.') !!}
                {!! Form::select('is_gift_art_allowed', [0 => 'No', 1 => 'Yes', 2 => 'Ask First'], $character->is_gift_art_allowed, ['class' => 'form-control user-select']) !!}
            </div>
            <div class="col-md form-group">
                {!! Form::label('is_gift_writing_allowed', 'Allow Gift Writing', ['class' => 'form-check-label mb-3']) !!} {!! add_help('This will place the character on the list of characters that can be written about for gift writing. This does not have any other functionality, but allow users looking for characters to write about to find your character easily.') !!}
                {!! Form::select('is_gift_writing_allowed', [0 => 'No', 1 => 'Yes', 2 => 'Ask First'], $character->is_gift_writing_allowed, ['class' => 'form-control user-select']) !!}
            </div>
        </div>
    @endif
    @if($character->is_tradeable ||  $character->is_sellable)
        <div class="form-group disabled">
            {!! Form::checkbox('is_trading', 1, $character->is_trading, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
            {!! Form::label('is_trading', 'Up For Trade', ['class' => 'form-check-label ml-3']) !!} {!! add_help('This will place the character on the list of characters that are currently up for trade. This does not have any other functionality, but allow users looking for trades to find your character easily.') !!}
        </div>
    @else
        <div class="alert alert-secondary">Cannot be set to "Up for Trade" as character cannot be traded or sold.</div>
    @endif

    <div class="form-group disabled">
        {!! Form::checkbox('is_condensed', 1, $character->is_condensed, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
        {!! Form::label('is_condensed', 'Separate Companion/Critter Box & Equipment/Accessories Box', ['class' => 'form-check-label ml-3']) !!} {!! add_help('This toggle allows you to change how the profile boxes for companions, critter, equipment, and acessories look. If ON the boxes will be condesnsed and display as one big box with multiple tabs. If OFF boxes will display side by side.') !!}
    </div>
@endif
@if($character->user_id != Auth::user()->id)
    <div class="form-group">
        {!! Form::checkbox('alert_user', 1, true, ['class' => 'form-check-input', 'data-toggle' => 'toggle', 'data-onstyle' => 'danger']) !!}
        {!! Form::label('alert_user', 'Notify User', ['class' => 'form-check-label ml-3']) !!} {!! add_help('This will send a notification to the user that their character profile has been edited. A notification will not be sent if the character is not visible.') !!}
    </div>
@endif
<div class="text-right">
    {!! Form::submit('Edit Profile', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@endsection
