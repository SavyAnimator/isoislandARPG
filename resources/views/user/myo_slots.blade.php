@extends('user.layout')

@section('profile-title')
    {{ $user->name }}'s MYO Slots
@endsection

@section('profile-content')
    {{--{!! breadcrumbs(['Users' => 'users', $user->name => $user->url, 'MYO Slots' => $user->url . '/myos']) !!}--}}

    <h1>
        {!! $user->displayName !!}'s MYO Slots
    </h1>

    <style>
        .h5 {
            font-size: 85%;
        }
    </style>

@if($myos->count())
    <div class="row">
        @foreach ($myos as $myo)
            <div class="col-md-2 col-6 text-center mb-2">
                <div>
                    <a href="{{ $myo->url }}"><img src="{{ $myo->image->thumbnailUrl }}" class="img-thumbnail" alt="{{ $myo->fullName }}" /></a>
                </div>
                <div class="mt-1">
                    <a href="{{ $myo->url }}" class="h5 mb-0">
                        @if (!$myo->is_visible)
                            <i class="fas fa-eye-slash"></i>
                        @endif {{ Illuminate\Support\Str::limit($myo->fullName, 22, $end = '...') }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No MYO slots found.</p>
@endif

@endsection
