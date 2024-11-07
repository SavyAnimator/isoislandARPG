@extends('user.layout')

@section('profile-title')
    {{ $user->name }}'s {{ $sublist->name }}
@endsection

@section('profile-content')
    {{--{!! breadcrumbs(['Users' => 'users', $user->name => $user->url, $sublist->name => $user->url . '/sublist/' . $sublist->key]) !!}--}}

    <h1>
        {!! $user->displayName !!}'s {{ $sublist->name }}
    </h1>


    <style>
        .h5 {
            font-size: 85%;
        }
    </style>

@if($characters->count())
    <div class="row">
        @foreach($characters as $character)
            <div class="col-md-2 col-6 text-center mb-2">
                <div>
                    <a href="{{ $character->url }}"><img src="{{ $character->image->thumbnailUrl }}" class="img-thumbnail" alt="{{ $character->fullName }}" /></a>
                </div>
                <div class="mt-1 h5">
                    @if(!$character->is_visible) <i class="fas fa-eye-slash"></i>
                    @endif {{ Illuminate\Support\Str::limit($character->fullName, 22, $end = '...') }}
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No characters found.</p>
@endif



@endsection


