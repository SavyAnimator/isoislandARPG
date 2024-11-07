@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title') {{ $character->fullName }} @endsection

@section('meta-img') {{ $character->image->thumbnailUrl }} @endsection

@section('profile-content')

<style>
    .image {
        max-height: 750px;
    }
</style>

@include('character._header', ['character' => $character])

{{-- Main Image --}}
<div class="row mb-3">
    <div class="col-md-7">
        <div class="text-center">
            <a href="{{ $character->image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists( public_path($character->image->imageDirectory.'/'.$character->image->fullsizeFileName)) ? $character->image->fullsizeUrl : $character->image->imageUrl }}" data-lightbox="entry" data-title="{{ $character->fullName }}">
                <img src="{{ $character->image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists( public_path($character->image->imageDirectory.'/'.$character->image->fullsizeFileName)) ? $character->image->fullsizeUrl : $character->image->imageUrl }}" class="image" alt="{{ $character->fullName }}" />
            </a>
        </div>
        @if($character->image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists( public_path($character->image->imageDirectory.'/'.$character->image->fullsizeFileName)))
            <div class="text-right">You are viewing the full-size image. <a href="{{ $character->image->imageUrl }}">View watermarked image</a>?</div>
        @endif
    </div>
    @include('character._image_info', ['image' => $character->image])
</div>

{{-- Contains the  box --}}
@include('character._profiledesc_info', ['image' => $character->image])

{{-- Contains the Companions and Critters box --}}
@include('character._critter_info', ['image' => $character->image])

@endsection

@section('scripts')
    @parent
    @include('character._image_js', ['character' => $character])
@endsection

